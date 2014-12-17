<?php

class BatimentTest extends TestCase {

  public function testCreateBatiment()
  {
    $user = new User();
    $user->login(array('email' => 'cua', 'password' => 'cua'));

    $batiment = array();
    $batiment['Nom'] = 'Hôtel de ville';
    $batiment['Adresse1'] = 'Adresse 1';
    $batiment['Adresse2'] = 'Adresse2';
    $batiment['Adresse3'] = 'Adresse3';
    $batiment['altitude'] = 'altitude';
    $batiment['Latitude'] = 'Latitude';
    $batiment['Longitude'] = 'Longitude';
    $batiment['Patrimoine'] = 2;
    $batiment['Anneeconstruction'] = 2000;
    $batiment['NbrEtage'] = 2;
    $batiment['Surface'] = 400;
    $batiment['SurfaceNette'] = 140;
    $batiment['SurfaceBrute'] = 300;
    $batiment['NbrEmployee'] = 10;
    $batiment['Pv'] = 123;
    $batiment['SystemeChauffageEau'] = 50;
    $batiment['Ces'] = 20;

    //Création du batiment
    $response = $this->call('POST', '/tbge/patrimoine/batiment', $batiment);

    //Vérifier la redirection vers la vue
    $this->assertRedirectedTo('tbge/patrimoine/batiment');
    $this->assertSessionHas('batiment.success');
    
    //Vérifier que la réponse contient l'url du batiment pour modification
    $message = $response->getSession()->get('batiment.success');
    $content = $response->getContent();
    $pattern = "/tbge\/patrimoine\/batiment\/([\d]+)\//";
    $this->assertRegExp($pattern, $message);
    preg_match_all($pattern, $message, $batimentIdFinded);
    $this->assertCount(2, $batimentIdFinded, "Après la création d'un batiment, la vue qi suit doit contenir le numero du batiment dans le lien de modification");

    $batimentId = $batimentIdFinded[1][0];;

    //modification des informations du batiment
    $batiment = array();
    $batiment['Nom'] = 'Hôtel de ville';
    $batiment['Adresse1'] = 'Adresse 1';
    $batiment['Adresse2'] = 'Adresse2';
    $batiment['Adresse3'] = 'Adresse3';
    $batiment['altitude'] = 'altitude';
    $batiment['Latitude'] = 'Latitude';
    $batiment['Longitude'] = 'Longitude';
    $batiment['Patrimoine'] = 2;
    $batiment['Anneeconstruction'] = 2000;
    $batiment['NbrEtage'] = 2;
    $batiment['Surface'] = 400;
    $batiment['SurfaceNette'] = 140;
    $batiment['SurfaceBrute'] = 300;
    $batiment['NbrEmployee'] = 10;
    $batiment['Pv'] = 123;
    $batiment['SystemeChauffageEau'] = 50;
    $batiment['Ces'] = 20;

    $response = $this->call('PUT', '/tbge/patrimoine/batiment/' . $batimentId, $batiment);

    $this->assertRedirectedTo('tbge/patrimoine/batiment');
    $this->assertSessionHas('batiment.success');
    
    //Vérifier que la réponse contient l'url du batiment pour modification
    $message = $response->getSession()->get('batiment.success');
    $content = $response->getContent();
    $pattern = "/tbge\/patrimoine\/batiment\/([\d]+)\//";
    $this->assertRegExp($pattern, $message);
    preg_match_all($pattern, $message, $batimentIdFinded);
    $this->assertCount(2, $batimentIdFinded, "Après la modification d'un batiment, la vue qui suit doit contenir le numero du batiment dans le lien de modification");

    //Suppression du batiment
    $response = $this->call('DELETE', '/tbge/patrimoine/batiment/' . $batimentId);

  }

}
