SELECT 
tt.f_total_ttc,
tt.f_annee_date_debut, 
tt.f_trimestre_date_debut,
tt.f_consommation,
tt.energie_unite,
tt.energie_nom
FROM (
SELECT 
f.FactureID AS f_formation_id,
f.CompteurID AS f_compteur_id,
f.Debutperiode AS f_date_debut,
f.Finperiode AS f_date_fin,
f.Consommation AS f_consommation,
SUM(f.Totalttc) AS f_total_ttc,

YEAR(f.Debutperiode) AS f_annee_date_debut,
YEAR(f.Finperiode) AS f_annee_date_fin,
QUARTER(f.Debutperiode) AS f_trimestre_date_debut,
QUARTER(f.Finperiode) AS f_trimestre_date_fin,

f.BaseID AS f_base_id,

c.CompteurID AS c_compteur_id,
c.Reference AS c_reference,
c.Numero AS c_numero,
c.EnergieID AS c_energie_id,
c.FournisseurID AS c_fournisseur_id,
c.Seuil AS c_seuil,
c.Estenergie AS c_est_energie,
c.type AS c_type,

c.BaseID AS c_base_id,

energie.EnergieID AS energie_energie_id,
energie.Nom AS energie_nom,
energie.Unite AS energie_unite,
energie.Coefkwhpci AS energie_kwh_pci,
energie.Facteurges AS energie_facteur_ges,
energie.Facteurep AS energie_facteur_ep,
energie.Tauxnucleaire AS energie_taux_nucleaire,
energie.Tauxfossile AS energie_taux_fossile,
energie.Tauxenr AS energie_taux_enr,
energie.Prixmaxkwhpci AS energie_prix_max_kwh_pci,
energie.seuil AS energie_seuil,


compteur_ae.CompteurID AS cae_compteur_id,
compteur_ap.CompteurID AS cap_compteur_id,
compteur_b.CompteurID AS cb_compteur_id,
compteur_e.CompteurID AS ce_compteur_id,
compteur_ev.CompteurID AS cev_compteur_id,
compteur_pp.CompteurID AS cpp_compteur_id,
compteur_v.CompteurID AS cv_compteur_id,

ae.ArriveeauID AS ae_id,
ae.nom AS ae_nom,
ae.Reference AS ae_reference,
ae.Categorie AS ae_categorie,
ae.NbrEtage AS ae_nbr_etages,
ae.Surface AS ae_surface,
ae.SurfaceIrrigue AS ae_surface_irrigue,
ae.Forage AS ae_forage,
ae.SystArrosage AS ae_systeme_arrosage,
ae.NbrEmployee AS ae_nbr_employes,
ae.SystemeChauffageEau ae_system_chauffage_eau,
ae.AlignementArbre AS ae_alignement_arbre,


ap.AutreposteID AS ap_id,
ap.CategorieID AS ap_categorie_id,
ap.Nom AS ap_nom,
ap.puissance AS ap_puissance,

b.BatimentID AS b_id,
b.nom AS b_nom,
b.Reference AS b_reference,
b.NbrEtage AS b_nbr_etages,
b.Surface AS b_surface,
b.SurfaceNette AS b_surface_nette,
b.SurfaceBrute AS b_surface_brute,
b.NbrEmployee AS b_nbr_employes,
b.SystemeChauffageEau b_system_chauffage_eau,
b.Division AS b_division,


e.EclairageID AS e_id,
e.CategorieID AS e_categorie_id,
e.Nom AS e_nom,
e.Armoires AS e_armoires,
e.Secteur AS e_secteur,
e.Puissance AS e_puissance,
e.Puissancemesuree AS e_puissance_mesuree,
e.Declencheur AS e_declencheur,
e.TypeTechnologie AS e_type_technologie,
e.MarqueLampe AS e_marque_lampe,
e.NbrJourInterrupServ AS e_nbr_jours_interrup_serv,
e.NbrJourIntervServ AS e_nbr_jours_interv_serv,
e.TypeTarif AS e_type_tarif,
e.PuissanceInstalle AS e_puissance_installee,
e.PuissanceSouscrite AS e_puissance_souscrite,
e.PuissanceAppele AS e_puissance_appelee,
e.EltElecSystAllum AS e_elt_elec_syst_allum,

ev.EspacevertID AS ev_id,
ev.nom AS ev_nom,
ev.Reference AS ev_reference,
ev.Categorie AS ev_categorie,
ev.NbrEtage AS ev_nbr_etages,
ev.Surface AS ev_surface,
ev.SurfaceIrrigue AS ev_surface_irrigue,
ev.Forage AS ev_forage,
ev.SystArrosage AS ev_systeme_arrosage,
ev.NbrEmployee AS ev_nbr_employes,
ev.SystemeChauffageEau ev_system_chauffage_eau,
ev.ArriveeauID AS ev_arrivee_eau_id,

pp.PosteproductionID AS pp_id,
pp.nom AS pp_nom,
pp.Reference AS pp_reference,
pp.CategorieID AS pp_categorie_id,
pp.Productiontheorique AS pp_production_theorique,
pp.Coutinitial As pp_cout_initial,
pp.Energie AS pp_energie,
pp.Puissance AS pp_puissance,
pp.NbrHeurefct AS pp_nbr_heure_fct,
pp.QteEauPompeMois AS pp_qte_eau_pompe_mois,
pp.ModeleMarqueEquipement AS pp_model_marque_equipement,
pp.`Type` AS pp_type,


v.VehiculeID AS v_id


FROM facture f
LEFT JOIN compteur c ON c.CompteurID = f.CompteurID
LEFT JOIN energie energie ON energie.EnergieID = c.EnergieID

LEFT OUTER JOIN compteurarriveeaux  compteur_ae ON compteur_ae.CompteurID = f.CompteurID
LEFT OUTER JOIN compteurautrepostes  compteur_ap ON compteur_ap.CompteurID = f.CompteurID
LEFT OUTER JOIN compteurbatiments  compteur_b ON compteur_b.CompteurID = f.CompteurID
LEFT OUTER JOIN compteureclairages  compteur_e ON compteur_e.CompteurID = f.CompteurID
LEFT OUTER JOIN compteurespaceverts  compteur_ev ON compteur_ev.CompteurID = f.CompteurID
LEFT OUTER JOIN compteurposteproductions  compteur_pp ON compteur_pp.CompteurID = f.CompteurID
LEFT OUTER JOIN compteurvehicules compteur_v ON compteur_v.CompteurID = f.CompteurID

LEFT OUTER JOIN arriveeau ae ON ae.ArriveeauID = compteur_ae.ArriveeauID
LEFT OUTER JOIN autreposte ap ON ap.AutrePosteID = compteur_ap.AutrePosteID
LEFT OUTER JOIN batiment b ON b.BatimentID = compteur_b.BatimentID
LEFT OUTER JOIN eclairage e ON e.EclairageID = compteur_e.EclairageID
LEFT OUTER JOIN espacevert ev ON ev.EspaceVertID = compteur_ev.EspaceVertID
LEFT OUTER JOIN posteproduction pp ON pp.PosteProductionID = compteur_pp.PosteProductionID
LEFT OUTER JOIN vehicule v ON v.VehiculeID = compteur_v.VehiculeID

GROUP BY energie_nom,f_annee_date_debut,f_trimestre_date_debut ) tt