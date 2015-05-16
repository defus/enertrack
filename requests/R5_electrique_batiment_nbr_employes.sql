SELECT 
    tt.f_annee_date_fin AS annee,
    tt.f_trimestre_date_fin AS trimestre,
    tt.energie_nom AS energie,
	tt.energie_unite AS energie_unite,
	tt.b_nom AS nom_batiment,
	tt.is_energie AS is_energie,
	SUM(tt.b_nbr_employes) AS nbr_employes,
    SUM(f_consommation) AS total_consommation
FROM
    (SELECT 
        f.FactureID AS f_facture_id,
            f.Consommation AS f_consommation,
            f.Debutperiode AS f_debut,
            f.Finperiode AS f_fin,
            YEAR(f.Finperiode) AS f_annee_date_fin,
            QUARTER(f.Finperiode) AS f_trimestre_date_fin,
            c.CompteurID AS c_id,
            energie.EnergieID AS energie_energie_id,
            energie.Nom AS energie_nom,
			energie.Est_energie AS is_energie,
			energie.Unite AS energie_unite,
            b.BatimentID AS b_id,
			b.Nom AS b_nom,
			COALESCE(b.NbrEmployee,0) AS b_nbr_employes
    FROM
        facture f
    JOIN compteur c ON c.CompteurID = f.CompteurID
    JOIN energie energie ON energie.EnergieID = c.EnergieID AND energie.Est_energie > 0
    JOIN compteurbatiments compteur_b ON compteur_b.CompteurID = f.CompteurID
    JOIN batiment b ON b.BatimentID = compteur_b.BatimentID
    GROUP BY f.FactureID) tt 
GROUP BY annee , trimestre ,b_id