SELECT 
    tt.f_annee_date_debut AS annee,
    tt.f_trimestre_date_debut AS trimestre,
    tt.b_nom AS nom_batiment,
    tt.b_division AS division_batiment,
    tt.energie_nom AS energie,
    SUM(tt.b_nbr_employes) AS nbr_employes,
    SUM(CASE
        WHEN b_id IS NOT NULL THEN f_total_ttc
        ELSE 0
    END) AS total_b,
    SUM(CASE
        WHEN b_id IS NOT NULL THEN f_consommation
        ELSE 0
    END) AS conso_b
FROM
    (SELECT 
        f.Consommation AS f_consommation,
            f.Totalttc AS f_total_ttc,
            YEAR(f.Debutperiode) AS f_annee_date_debut,
            QUARTER(f.Debutperiode) AS f_trimestre_date_debut,
            c.CompteurID AS c_id,
            energie.EnergieID AS energie_energie_id,
            energie.Nom AS energie_nom,
            b.BatimentID AS b_id,
            b.Nom AS b_nom,
            COALESCE(b.Division, 'Division Inconnue') AS b_division,
            COALESCE(b.NbrEmployee, 0) AS b_nbr_employes
    FROM
        facture f
    LEFT JOIN compteur c ON c.CompteurID = f.CompteurID
    LEFT JOIN energie energie ON energie.EnergieID = c.EnergieID
    LEFT JOIN compteurbatiments compteur_b ON compteur_b.CompteurID = f.CompteurID
    LEFT OUTER JOIN batiment b ON b.BatimentID = compteur_b.BatimentID
    WHERE
        b.BatimentID IS NOT NULL
    GROUP BY f.FactureID) tt
GROUP BY annee , trimestre , nom_batiment , energie