SELECT 
    tt . *,
    (tt.r_consommation - tt.total_facture_consommation) AS difference_releve_facture_consommation,
    (tt.r_consommation - tt.total_facture_valeur_observation) AS difference_releve_facture_valeur_observation
FROM
    (SELECT 
        r.ReleveID AS r_releve_id,
            r.SouscompteurID AS r_sous_compteur_id,
            r.Dateprecedent AS r_date_precedente,
            r.Datereleve AS r_date_releve,
            r.Consommation AS r_consommation,
            r.BaseID AS r_base_id,
            r.MouvrageID AS r_mouvrage_id,
            sc.SousCompteurID AS sc_sous_compteur_id,
            sc.CompteurID AS sc_compteur_id,
            f.FactureID AS f_facture_id,
            f.Debutperiode AS f_date_debut,
            f.Finperiode AS f_date_fin,
            f.Consommation AS f_consommation,
            f.ValeurObservation AS f_valeur_observation,
            f.DateObservation AS f_date_observation,
            SUM(f.Consommation) AS total_facture_consommation,
            SUM(f.ValeurObservation) AS total_facture_valeur_observation,
            c.CompteurID AS c_compteur_id,
            c.Nomprestataire AS c_nom_prestataire
    FROM
        releve r
    LEFT JOIN souscompteur sc ON sc.SouscompteurID = r.SouscompteurID
    LEFT JOIN facture f ON f.CompteurID = sc.CompteurID
        AND f.DateObservation >= r.Dateprecedent
        AND f.DateObservation <= r.Datereleve
        AND f.BaseID = r.BaseID
    LEFT JOIN compteur c ON c.CompteurID = f.CompteurID
    GROUP BY r.ReleveID) tt
WHERE
    (tt.r_consommation - tt.total_facture_consommation) > 0
        OR (tt.r_consommation - tt.total_facture_valeur_observation) > 0
