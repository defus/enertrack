SELECT 
    tt.f_annee_date_fin AS annee,
    tt.f_trimestre_date_fin AS trimestre,
    tt.ev_nom AS nom_espace_vert,
    tt.ev_categorie AS categorie_espace_vert,
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
            ev.EspaceVertID AS ev_id,
            ev.Nom AS ev_nom,
            ev.Categorie AS ev_categorie,
            COALESCE(ev.NbrEmployee, 0) AS ev_nbr_employes,
            COALESCE(ev.Surface, 0) AS ev_surface,
            COALESCE(ev.SurfaceIrrigue, 0) AS ev_surface_irriguee
    FROM
        facture f
    JOIN compteur c ON c.CompteurID = f.CompteurID
    JOIN energie energie ON energie.EnergieID = c.EnergieID
    JOIN compteurespaceverts compteur_ev ON compteur_ev.CompteurID = f.CompteurID
    RIGHT JOIN espacevert ev ON ev.EspacevertID = compteur_ev.EspacevertID
    WHERE f.FactureID IS NOT NULL
    GROUP BY f.FactureID) tt
GROUP BY annee , trimestre , ev_id ORDER BY conso_ev DESC