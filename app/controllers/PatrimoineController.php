<?php

class PatrimoineController extends \BaseController {

    public function index()
    {
      $baseid = Auth::user()->BaseID; 

      $batiments = DB::select("SELECT batiment.*, mouvrage.Societe, coordonnee.Societe as Contact FROM batiment INNER JOIN mouvrage ON mouvrage.MouvrageID = batiment.MouvrageID LEFT OUTER JOIN coordonnee ON coordonnee.CoordonneeID = batiment.CoordonneeID WHERE batiment.BaseID='$baseid'");

      $eclairages = DB::select("SELECT eclairage.*, mouvrage.Societe, coordonnee.Societe as Contact, categorie.libelle as categorie  FROM eclairage INNER JOIN mouvrage ON mouvrage.MouvrageID = eclairage.MouvrageID LEFT OUTER JOIN coordonnee ON coordonnee.CoordonneeID = eclairage.CoordonneeID LEFT OUTER JOIN categorie on categorie.CategorieID = eclairage.CategorieID WHERE eclairage.BaseID='$baseid'");

      $vehicules = DB::select("SELECT vehicule.*, mouvrage.Societe, coordonnee.Societe as Contact, categorie.libelle as categorie FROM vehicule  INNER JOIN mouvrage ON mouvrage.MouvrageID = vehicule.MouvrageID LEFT OUTER JOIN coordonnee ON coordonnee.CoordonneeID = vehicule.CoordonneeID  LEFT OUTER JOIN categorie on categorie.CategorieID = vehicule.CategorieID WHERE vehicule.BaseID='$baseid'");

      $posteproductions = DB::select("SELECT posteproduction.*, mouvrage.Societe, coordonnee.Societe as Contact, categorie.libelle as categorie FROM posteproduction  INNER JOIN mouvrage ON mouvrage.MouvrageID = posteproduction.MouvrageID LEFT OUTER JOIN coordonnee ON coordonnee.CoordonneeID = posteproduction.CoordonneeID LEFT OUTER JOIN categorie on categorie.CategorieID = posteproduction.CategorieID WHERE posteproduction.BaseID='$baseid'");

      $autrepostes = DB::select("SELECT autreposte.*, mouvrage.Societe, coordonnee.Societe as Contact, categorie.libelle as categorie FROM autreposte INNER JOIN mouvrage ON mouvrage.MouvrageID = autreposte.MouvrageID LEFT OUTER JOIN coordonnee ON coordonnee.CoordonneeID = autreposte.CoordonneeID LEFT OUTER JOIN categorie on categorie.CategorieID = autreposte.CategorieID  WHERE autreposte.BaseID='$baseid'");

      return  View::make('patrimoine.index')
        ->with('batiments', $batiments)
        ->with('eclairages', $eclairages)
        ->with('vehicules', $vehicules)
        ->with('posteproductions', $posteproductions)
        ->with('autrepostes', $autrepostes);
    }

    
}