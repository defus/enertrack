SELECT 
    tt.f_annee_date_fin AS annee,
    tt.f_trimestre_date_fin AS trimestre,
    tt.energie_nom AS energie,
	tt.energie_unite AS energie_unite,
	tt.energie_facteur_ges AS energie_facteur_ges,
	tt.energie_taux_fossile AS energie_taux_fossile,
	tt.energie_taux_nucleaire AS energie_taux_nucleaire,
	tt.energie_taux_enr AS energie_taux_enr,
    tt.type_patrimoine AS patrimoine,
    SUM(tt.nbr_employes) AS nbr_employes,
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
			energie.Unite AS energie_unite,
            COALESCE(energie.Facteurges, 0.0) AS energie_facteur_ges,
            COALESCE(energie.Tauxfossile, 0.0) AS energie_taux_fossile,
            COALESCE(energie.Tauxnucleaire, 0.0) AS energie_taux_nucleaire,
            COALESCE(energie.Tauxenr, 0.0) AS energie_taux_enr,
            (CASE
                WHEN e.EclairageID IS NOT NULL THEN 'Eclairages'
                WHEN b.BatimentID IS NOT NULL THEN 'Bâtiments'
                WHEN pp.PosteproductionID IS NOT NULL THEN 'Postes de Productions'
                WHEN ap.AutreposteID IS NOT NULL THEN 'Autres Postes'
                WHEN v.VehiculeID IS NOT NULL THEN 'Véhicules'
                ELSE 'Non Catégorisé'
            END) AS type_patrimoine,
            (CASE
                WHEN e.EclairageID IS NOT NULL THEN 0
                WHEN b.BatimentID IS NOT NULL THEN b.NbrEmployee
                WHEN pp.PosteproductionID IS NOT NULL THEN 0
                WHEN ap.AutreposteID IS NOT NULL THEN 0
                WHEN v.VehiculeID IS NOT NULL THEN 0
                ELSE 0
            END) AS nbr_employes
    FROM
        facture f
    LEFT JOIN compteur c ON c.CompteurID = f.CompteurID
    LEFT JOIN energie energie ON energie.EnergieID = c.EnergieID
    LEFT OUTER JOIN compteurautrepostes compteur_ap ON compteur_ap.CompteurID = f.CompteurID
    LEFT OUTER JOIN compteurbatiments compteur_b ON compteur_b.CompteurID = f.CompteurID
    LEFT OUTER JOIN compteureclairages compteur_e ON compteur_e.CompteurID = f.CompteurID
    LEFT OUTER JOIN compteurposteproductions compteur_pp ON compteur_pp.CompteurID = f.CompteurID
    LEFT OUTER JOIN compteurvehicules compteur_v ON compteur_v.CompteurID = f.CompteurID
    LEFT OUTER JOIN autreposte ap ON ap.AutrePosteID = compteur_ap.AutrePosteID
    LEFT OUTER JOIN batiment b ON b.BatimentID = compteur_b.BatimentID
    LEFT OUTER JOIN eclairage e ON e.EclairageID = compteur_e.EclairageID
    LEFT OUTER JOIN posteproduction pp ON pp.PosteProductionID = compteur_pp.PosteProductionID
    LEFT OUTER JOIN vehicule v ON v.VehiculeID = compteur_v.VehiculeID
    GROUP BY f.FactureID) tt
GROUP BY annee , trimestre ,patrimoine