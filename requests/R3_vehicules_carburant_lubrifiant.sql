SELECT 
    tt.f_annee_date_debut AS annee,
    tt.f_trimestre_date_debut AS trimestre,
    tt.v_nom AS nom_vehicule,
    tt.v_unite_administrative AS unite_administrative,
	tt.v_fonction AS fonction,
	tt.v_service AS service,
    tt.energie_nom AS energie,
    SUM(CASE
        WHEN v_id IS NOT NULL THEN f_total_ttc
        ELSE 0
    END) AS total_v,
    SUM(CASE
        WHEN v_id IS NOT NULL THEN f_consommation
        ELSE 0
    END) AS conso_v
FROM
    (SELECT 
        f.Consommation AS f_consommation,
            f.Totalttc AS f_total_ttc,
            YEAR(f.Debutperiode) AS f_annee_date_debut,
            QUARTER(f.Debutperiode) AS f_trimestre_date_debut,
            c.CompteurID AS c_id,
            energie.EnergieID AS energie_energie_id,
            energie.Nom AS energie_nom,
            v.VehiculeID AS v_id,
            v.Nom AS v_nom,
            COALESCE(v.UniteAdministrative, 'Unité Inconnue') AS v_unite_administrative,
			COALESCE(v.Service, 'Service Inconnu') AS v_service,
			COALESCE(v.Fonction, 'Fonction Inconnue') AS v_fonction,
    FROM
        facture f
    LEFT JOIN compteur c ON c.CompteurID = f.CompteurID
    LEFT JOIN energie energie ON energie.EnergieID = c.EnergieID
    LEFT JOIN compteurvehicules compteur_v ON compteur_v.CompteurID = f.CompteurID
    LEFT JOIN vehicule v ON b.VehiculeID = compteur_v.VehiculeID
    GROUP BY f.FactureID) tt
GROUP BY annee , trimestre ,energie, unite_administrative , service, fonction