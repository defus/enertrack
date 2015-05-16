<?php

class R1Controller extends BaseController {
    static $r1_bis = <<<EOD
    
    SELECT
    tt.f_annee_date_debut AS annee,
    tt.f_trimestre_date_debut AS trimestre,
    SUM(f_total_ttc) AS total_cout,
	SUM(CASE
        WHEN est_energie > 0 THEN f_total_ttc
        ELSE 0
        END) AS total_energie_cout,
	SUM(CASE
        WHEN est_energie <= 0 THEN f_total_ttc
        ELSE 0
        END) AS total_eau_cout,
    SUM(f_consommation) AS total_consommation,
	SUM(CASE
        WHEN est_energie > 0 THEN f_consommation
        ELSE 0
        END) AS total_energie_consommation,
	SUM(CASE
        WHEN est_energie <= 0 THEN f_consommation
        ELSE 0
        END) AS total_eau_consommation,
    SUM(CASE
        WHEN ae_id IS NOT NULL THEN f_total_ttc
        ELSE 0
        END) AS total_ae,
	SUM(CASE
        WHEN ae_id IS NOT NULL AND est_energie > 0 THEN f_total_ttc
        ELSE 0
        END) AS total_energie_ae,
	SUM(CASE
        WHEN ae_id IS NOT NULL AND est_energie <= 0 THEN f_total_ttc
        ELSE 0
        END) AS total_eau_ae,
    SUM(CASE
        WHEN ap_id IS NOT NULL THEN f_total_ttc
        ELSE 0
        END) AS total_ap,
	SUM(CASE
        WHEN ap_id IS NOT NULL AND est_energie > 0 THEN f_total_ttc
        ELSE 0
        END) AS total_energie_ap,
	SUM(CASE
        WHEN ap_id IS NOT NULL AND est_energie <= 0 THEN f_total_ttc
        ELSE 0
        END) AS total_eau_ap,
    SUM(CASE
        WHEN e_id IS NOT NULL THEN f_total_ttc
        ELSE 0
        END) AS total_e,
	SUM(CASE
        WHEN e_id IS NOT NULL AND est_energie > 0 THEN f_total_ttc
        ELSE 0
        END) AS total_energie_e,
	SUM(CASE
        WHEN e_id IS NOT NULL AND est_energie <= 0 THEN f_total_ttc
        ELSE 0
        END) AS total_eau_e,
    SUM(CASE
        WHEN ev_id IS NOT NULL THEN f_total_ttc
        ELSE 0
        END) AS total_ev,
	SUM(CASE
        WHEN ev_id IS NOT NULL AND est_energie > 0 THEN f_total_ttc
        ELSE 0
        END) AS total_energie_ev,
	SUM(CASE
        WHEN ev_id IS NOT NULL AND est_energie <= 0 THEN f_total_ttc
        ELSE 0
        END) AS total_eau_ev,
    SUM(CASE
        WHEN pp_id IS NOT NULL THEN f_total_ttc
        ELSE 0
        END) AS total_pp,
	SUM(CASE
        WHEN pp_id IS NOT NULL AND est_energie > 0 THEN f_total_ttc
        ELSE 0
        END) AS total_energie_pp,
	SUM(CASE
        WHEN pp_id IS NOT NULL AND est_energie <= 0 THEN f_total_ttc
        ELSE 0
        END) AS total_eau_pp,
    SUM(CASE
        WHEN b_id IS NOT NULL THEN f_total_ttc
        ELSE 0
        END) AS total_b,
	SUM(CASE
        WHEN b_id IS NOT NULL AND est_energie > 0 THEN f_total_ttc
        ELSE 0
        END) AS total_energie_b,
	SUM(CASE
        WHEN b_id IS NOT NULL AND est_energie <= 0 THEN f_total_ttc
        ELSE 0
        END) AS total_eau_b,
    SUM(CASE
        WHEN v_id IS NOT NULL THEN f_total_ttc
        ELSE 0
        END) AS total_v,
	SUM(CASE
        WHEN v_id IS NOT NULL AND est_energie > 0 THEN f_total_ttc
        ELSE 0
        END) AS total_energie_v,
	SUM(CASE
        WHEN v_id IS NOT NULL AND est_energie <= 0 THEN f_total_ttc
        ELSE 0
        END) AS total_eau_v,
    SUM(CASE
        WHEN
        (ae_id IS NULL AND v_id IS NULL
         AND ap_id IS NULL
         AND b_id IS NULL
         AND e_id IS NULL
         AND ev_id IS NULL
         AND pp_id IS NULL
         AND v_id IS NULL)
        THEN
        f_total_ttc
        ELSE 0
        END) AS total_unknown,
	SUM(CASE
        WHEN
        (ae_id IS NULL AND v_id IS NULL
         AND ap_id IS NULL
         AND b_id IS NULL
         AND e_id IS NULL
         AND ev_id IS NULL
         AND pp_id IS NULL
         AND v_id IS NULL
         AND est_energie > 0)
        THEN
        f_total_ttc
        ELSE 0
        END) AS total_energie_unknown,
	SUM(CASE
        WHEN
        (ae_id IS NULL AND v_id IS NULL
         AND ap_id IS NULL
         AND b_id IS NULL
         AND e_id IS NULL
         AND ev_id IS NULL
         AND pp_id IS NULL
         AND v_id IS NULL
         AND est_energie <= 0)
        THEN
        f_total_ttc
        ELSE 0
        END) AS total_eau_unknown,
    SUM(CASE
        WHEN ae_id IS NOT NULL THEN f_consommation
        ELSE 0
        END) AS conso_ae,
    SUM(CASE
        WHEN ap_id IS NOT NULL THEN f_consommation
        ELSE 0
        END) AS conso_ap,
    SUM(CASE
        WHEN e_id IS NOT NULL THEN f_consommation
        ELSE 0
        END) AS conso_e,
    SUM(CASE
        WHEN ev_id IS NOT NULL THEN f_consommation
        ELSE 0
        END) AS conso_ev,
    SUM(CASE
        WHEN pp_id IS NOT NULL THEN f_consommation
        ELSE 0
        END) AS conso_pp,
    SUM(CASE
        WHEN b_id IS NOT NULL THEN f_consommation
        ELSE 0
        END) AS conso_b,
    SUM(CASE
        WHEN v_id IS NOT NULL THEN f_consommation
        ELSE 0
        END) AS conso_v,
    SUM(CASE
        WHEN
        (ae_id IS NULL AND v_id IS NULL
         AND ap_id IS NULL
         AND b_id IS NULL
         AND e_id IS NULL
         AND ev_id IS NULL
         AND pp_id IS NULL
         AND v_id IS NULL)
        THEN
        f_consommation
        ELSE 0
        END) AS conso_unknown
    FROM
    (SELECT
     f.Consommation AS f_consommation,
     f.Totalttc AS f_total_ttc,
     YEAR(f.Debutperiode) AS f_annee_date_debut,
     QUARTER(f.Debutperiode) AS f_trimestre_date_debut,
     c.CompteurID AS c_id,
     compteur_ae.CompteurID AS cae_compteur_id,
     energie.EnergieID AS energie_energie_id,
     energie.Nom AS energie_nom,
     energie.Est_energie AS est_energie,
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
     LEFT JOIN energie energie ON energie.EnergieID = c.EnergieID
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
     LEFT OUTER JOIN vehicule v ON v.VehiculeID = compteur_v.VehiculeID
     GROUP BY f.FactureID) tt
    GROUP BY annee
    
EOD;
    
    
    
    static $r1_patrimoines = <<<EOD
    
    SELECT
    tt.f_annee_date_debut AS annee,
    tt.f_trimestre_date_debut AS trimestre,
    tt.energie_nom AS energie,
    tt.energie_unites AS unites,
    SUM(CASE
        WHEN est_energie > 0 THEN f_total_ttc
        ELSE 0
        END) AS total_energie_cout,
	SUM(CASE
        WHEN est_energie <= 0 THEN f_total_ttc
        ELSE 0
        END) AS total_eau_cout,
    SUM(f_consommation) AS total_consommation,
    SUM(CASE
        WHEN ae_id IS NOT NULL THEN f_total_ttc
        ELSE 0
        END) AS total_ae,
    SUM(CASE
        WHEN ap_id IS NOT NULL THEN f_total_ttc
        ELSE 0
        END) AS total_ap,
    SUM(CASE
        WHEN e_id IS NOT NULL THEN f_total_ttc
        ELSE 0
        END) AS total_e,
    SUM(CASE
        WHEN ev_id IS NOT NULL THEN f_total_ttc
        ELSE 0
        END) AS total_ev,
    SUM(CASE
        WHEN pp_id IS NOT NULL THEN f_total_ttc
        ELSE 0
        END) AS total_pp,
    SUM(CASE
        WHEN b_id IS NOT NULL THEN f_total_ttc
        ELSE 0
        END) AS total_b,
    SUM(CASE
        WHEN v_id IS NOT NULL THEN f_total_ttc
        ELSE 0
        END) AS total_v,
    SUM(CASE
        WHEN
        (ae_id IS NULL AND v_id IS NULL
         AND ap_id IS NULL
         AND b_id IS NULL
         AND e_id IS NULL
         AND ev_id IS NULL
         AND pp_id IS NULL
         AND v_id IS NULL)
        THEN
        f_total_ttc
        ELSE 0
        END) AS total_unknown,
    SUM(CASE
        WHEN ae_id IS NOT NULL THEN f_consommation
        ELSE 0
        END) AS conso_ae,
    SUM(CASE
        WHEN ap_id IS NOT NULL THEN f_consommation
        ELSE 0
        END) AS conso_ap,
    SUM(CASE
        WHEN e_id IS NOT NULL THEN f_consommation
        ELSE 0
        END) AS conso_e,
    SUM(CASE
        WHEN ev_id IS NOT NULL THEN f_consommation
        ELSE 0
        END) AS conso_ev,
    SUM(CASE
        WHEN pp_id IS NOT NULL THEN f_consommation
        ELSE 0
        END) AS conso_pp,
    SUM(CASE
        WHEN b_id IS NOT NULL THEN f_consommation
        ELSE 0
        END) AS conso_b,
    SUM(CASE
        WHEN v_id IS NOT NULL THEN f_consommation
        ELSE 0
        END) AS conso_v,
    SUM(CASE
        WHEN
        (ae_id IS NULL AND v_id IS NULL
         AND ap_id IS NULL
         AND b_id IS NULL
         AND e_id IS NULL
         AND ev_id IS NULL
         AND pp_id IS NULL
         AND v_id IS NULL)
        THEN
        f_consommation
        ELSE 0
        END) AS conso_unknown
    FROM
    (SELECT
     f.Consommation AS f_consommation,
     f.Totalttc AS f_total_ttc,
     YEAR(f.Debutperiode) AS f_annee_date_debut,
     QUARTER(f.Debutperiode) AS f_trimestre_date_debut,
     c.CompteurID AS c_id,
     compteur_ae.CompteurID AS cae_compteur_id,
     energie.EnergieID AS energie_energie_id,
     energie.Nom AS energie_nom,
     energie.Est_energie AS est_energie,
     energie.Unite AS energie_unites,
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
     LEFT JOIN energie energie ON energie.EnergieID = c.EnergieID
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
     LEFT OUTER JOIN vehicule v ON v.VehiculeID = compteur_v.VehiculeID
     GROUP BY f.FactureID) tt
    GROUP BY annee
    
EOD;
    
    public function r1Page() {
        return \View::make('R1', []);
    }
    
    public function r1Data() {
        $quarterly =  static::$r1_bis . ', trimestre ORDER BY annee DESC';
         $data = DB::select($quarterly);
        return Response::json((object )["type"=>"quaterly","status"=>"success","records"=>$data]);
    }
    
    public function r1DataYearly() {
    	$yearly = static:: $r1_bis . ' ORDER BY annee DESC';
    	$data = DB::select($yearly);
    	return Response::json((object )["type"=>"yearly","status"=>"success","records"=>$data]);
    }

    
    public function r1DataPatrimoines() {
    	$yearly = static:: $r1_patrimoines . ' ORDER BY annee DESC,energie';
    	$data = DB::select($yearly);
    	return Response::json((object )["type"=>"par_patrimoine","status"=>"success","records"=>$data]);
    }
    
    

}