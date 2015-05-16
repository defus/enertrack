SELECT 
    COUNT(tt.f_id) AS nbr_entries,
    COUNT(DISTINCT tt.f_id) nbr_factures
FROM
    (SELECT 
        f.FactureID AS f_id,
            f.Consommation AS f_consommation,
            f.Totalttc AS f_total_ttc,
            YEAR(f.Debutperiode) AS f_annee_date_debut,
            QUARTER(f.Debutperiode) AS f_trimestre_date_debut,
            c.CompteurID AS c_id,
            compteur_ae.CompteurID AS cae_compteur_id,
            ae.ArriveeauID AS ae_id,
            ap.AutreposteID AS ap_id,
            b.BatimentID AS b_id,
            e.EclairageID AS e_id,
            ev.EspacevertID AS ev_id,
            pp.PosteproductionID AS pp_id,
            v.VehiculeID AS v_id
    FROM
        facture f
    LEFT JOIN compteur c ON c.CompteurID = f.CompteurID
    
	LEFT OUTER JOIN compteurarriveeaux compteur_ae ON compteur_ae.CompteurID = f.CompteurID
    LEFT OUTER JOIN compteurautrepostes compteur_ap ON compteur_ap.CompteurID = f.CompteurID
    LEFT OUTER JOIN compteurbatiments compteur_b ON compteur_b.CompteurID = f.CompteurID
    LEFT OUTER JOIN compteureclairages compteur_e ON compteur_e.CompteurID = f.CompteurID
    LEFT OUTER JOIN compteurespaceverts compteur_ev ON compteur_ev.CompteurID = f.CompteurID
    LEFT OUTER JOIN compteurposteproductions compteur_pp ON compteur_pp.CompteurID = f.CompteurID
    LEFT OUTER JOIN compteurvehicules compteur_v ON compteur_v.CompteurID = f.CompteurID
    LEFT OUTER JOIN arriveeau ae ON ae.ArriveeauID = compteur_ae.ArriveeauID
    LEFT OUTER JOIN autreposte ap ON ap.AutrePosteID = compteur_ap.AutrePosteID
    LEFT OUTER JOIN batiment b ON b.BatimentID = compteur_b.BatimentID
    LEFT OUTER JOIN eclairage e ON e.EclairageID = compteur_e.EclairageID
    LEFT OUTER JOIN espacevert ev ON ev.EspaceVertID = compteur_ev.EspaceVertID
    LEFT OUTER JOIN posteproduction pp ON pp.PosteProductionID = compteur_pp.PosteProductionID
    LEFT OUTER JOIN vehicule v ON v.VehiculeID = compteur_v.VehiculeID GROUP BY f.FactureID) tt