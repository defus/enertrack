## Enertrack

Enertrack is a product focuses on environment preservation

## Todo

Les actions de la phase 2
* Sortir les indicateurs
* Faire les rapports avec les indicateurs possible
* Définir pourquoi il manque les données avec certains indicateurs
* 

Les actions techniques
* Gérer la sélection de valeur initial dans les formulairs avec select2 (OK)
* Avoir l'affichage des dates avec le format français (OK)
* Sur utiliser les groupes sur le formulaire de facture (OK)
* faire une page pour chaque patrimoine
* Créer des formualires spécifiques pour l'AO
* remplacer nouveau par ajouter
* Charte graphique de l'application
* Faire la sécurité
* Faire un composant pour aficher le mo. Permet de ne pas afficher le MO lorsque l'utilisateur n'en a qu'un seul
* Faire les dashbords
* recherche full texte dans la zone de recherche du menu
* Faire les filtres au niveau des datatable

# Questions
* On ne peut associer une facture à plusieurs compteurs. Sinon, on ne peut pas faire de l'analytique dessus. C'est quoi l'objectif de ce concept 

## Installation prerequisites

* PHP >= 5.4
* mcrypt PHP Extension
* mbstring PHP Extension
* Note: As of PHP 5.5, some OS distributions may require you to manually install the PHP JSON extension. When using Ubuntu, this can be done via apt-get install php5-json.
* Activer le mod_rewrite sous apache 
* activer php_fileinfo pour afficher le type mime d'un fichier automatiquement

## Configuration

* Les fichiers de configuration sont dans le repertoire app/config
* $queries = DB::getQueryLog(); : avoir la liste des requêtes exécutées

## Migration
* Ajouter dans la table utilisateur le champ : 
** remember_token nvarchar(100), 
** password (au moins nvarchar 60), 

## Model
* Mouvrage : maitre d'ouvrage
** CategorieID : identifiant de la categorie du maitre d'ouvrage
** roles.record_id=mouvrage.MouvrageID : pour déterminer si l'utilisateur a le droit de modifier les informations du maitre d'ouvrage. Le username dans la table role permet de savoir l'utilisateur associé au role en question.

## Laravel PHP Framework

Laravel is the Framework we use in order to develop our product !

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/downloads.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, and caching.

Laravel aims to make the development process a pleasing one for the developer without sacrificing application functionality. Happy developers make the best code. To this end, we've attempted to combine the very best of what we have seen in other web frameworks, including frameworks implemented in other languages, such as Ruby on Rails, ASP.NET MVC, and Sinatra.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the entire framework can be found on the [Laravel website](http://laravel.com/docs).

### Contributing To Laravel

**All issues and pull requests should be filed on the [laravel/framework](http://github.com/laravel/framework) repository.**

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
