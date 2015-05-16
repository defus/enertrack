SELECT 
    tt.f_annee_date_fin AS annee,
    tt.f_trimestre_date_fin AS trimestre,
    tt.energie_nom AS energie,
	tt.energie_unite AS energie_unite,
	tt.e_nom AS nom_eclairage,
	tt.is_energie AS is_energie,
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
            e.EclairageID AS e_id,
			e.Nom AS e_nom
    FROM
        facture f
    JOIN compteur c ON c.CompteurID = f.CompteurID
    JOIN energie energie ON energie.EnergieID = c.EnergieID AND energie.Est_energie > 0
    JOIN compteureclairages compteur_e ON compteur_e.EclairageID = f.CompteurID
    JOIN eclairage e ON e.EclairageID = compteur_e.EclairageID
    GROUP BY f.FactureID) tt 
GROUP BY annee , trimestre ,e_id