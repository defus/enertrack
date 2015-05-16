SELECT 
    tt.f_annee_date_fin AS annee,
    tt.f_trimestre_date_fin AS trimestre,
    tt.v_nom AS nom_espace_vert,
    tt.energie_nom AS energie,
    SUM(tt.ev_nbr_employes) AS nbr_employes,
    SUM(f_total_ttc) AS total_ev,
    SUM(f_consommation) AS conso_ev
FROM
    (SELECT 
        f.FactureID AS f_facture_id,
            f.Consommation AS f_consommation,
            f.Totalttc AS f_total_ttc,
            f.Debutperiode AS f_debut,
            f.Finperiode AS f_fin,
            YEAR(f.Finperiode) AS f_annee_date_fin,
            QUARTER(f.Finperiode) AS f_trimestre_date_fin,
            c.CompteurID AS c_id,
            energie.EnergieID AS energie_energie_id,
            energie.Nom AS energie_nom,
            v.VehiculeID AS v_id,
            v.Nom AS v_nom
    FROM
        facture f
    INNER JOIN compteur c ON c.CompteurID = f.CompteurID
    INNER JOIN energie energie ON energie.EnergieID = c.EnergieID
    INNER JOIN compteurvehicules compteur_v ON compteur_v.CompteurID = f.CompteurID
    RIGHT JOIN vehicule v ON v.VehiculeID = compteur_v.VehiculeID
    WHERE f.FactureID IS NOT NULL
    GROUP BY f.FactureID) tt
GROUP BY annee , trimestre , v_id ORDER BY conso_ev DESC