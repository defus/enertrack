-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 03 Décembre 2014 à 18:55
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
-- --------------------------------------------------------

--
-- Structure de la table `accueil`
--

CREATE TABLE IF NOT EXISTS `accueil` (
  `accueil_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`accueil_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `accueil`
--

INSERT INTO `accueil` (`accueil_id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Structure de la table `action`
--

CREATE TABLE IF NOT EXISTS `action` (
  `ActionID` int(11) NOT NULL AUTO_INCREMENT,
  `BaseID` char(36) NOT NULL,
  `Type` enum('Utilisation','Gestion','Bati','Equipement') NOT NULL,
  `Nom` varchar(45) NOT NULL,
  `Description` text,
  `Prescription` tinyint(4) NOT NULL DEFAULT '0',
  `Coutmoyenm2` decimal(11,2) DEFAULT NULL,
  `Dureevie` int(11) DEFAULT NULL,
  `Modifbatiment` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ActionID`),
  KEY `BaseID` (`BaseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=186 ;

--
-- Contenu de la table `action`
--

INSERT INTO `action` (`ActionID`, `BaseID`, `Type`, `Nom`, `Description`, `Prescription`, `Coutmoyenm2`, `Dureevie`, `Modifbatiment`) VALUES
(1, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Utilisation', 'Formation usagers', 'Formation utilisateurs / Formation exploitant / Sensibilisation du public ', 0, NULL, NULL, 0),
(2, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Utilisation', 'Changement d''usage', '', 0, NULL, NULL, 1),
(3, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Utilisation', 'Nombre d''usagers/ frequentation', 'Modification des plages d utilisation ou du nombre d''usagers', 0, NULL, NULL, 1),
(4, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Utilisation', 'Evolution du confort', 'Appr├®ciation des utilisateurs suite ├á des am├®liorations ├®nerg├®tique ou du b├óti (protections solaires, diminution des surchauffesÔÇª).', 0, NULL, NULL, 0),
(5, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Utilisation', 'Sinistre /pathologie', 'Nature des d├®sordres constat├®s apr├¿s des travaux d''am├®lioration ├®nerg├®tique (b├óti, ├®quipement, comportement)', 0, NULL, NULL, 0),
(6, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Utilisation', 'Autre : precisez svp', '', 0, NULL, NULL, 0),
(7, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'Changement de la surface', 'Extension, d├®molition ou r├®affectation de surfaces chauff├®es et ou climatis├®es', 0, NULL, NULL, 1),
(8, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'Isolation des murs', 'Isolation par l''int├®rieur, l''ext├®rieur ou int├®gr├®e des murs ext├®rieurs ou donnant sur des locaux 0 chauff├®s', 0, NULL, NULL, 1),
(9, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'Isolation du plancher', 'Isolation en surface ou en sous face des planchers terre-plein, ext├®rieurs ou donnant sur des locaux 0 chauff├®s', 0, NULL, NULL, 1),
(10, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'Isolation de la toiture', 'Isolation par l''int├®rieur, l''ext├®rieur ou int├®gr├®e des plafonds ext├®rieurs ou donnant sur des locaux 0 chauff├®s', 0, NULL, NULL, 1),
(11, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'Modification des menuiseries', 'Remplacement ou doublage des vitrages ou des menuiseries compl├¿tes', 0, NULL, NULL, 1),
(12, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'Etancheite ├á l''air', 'Traitement des fuites d''air par joints, calfeutrements, enduits ÔÇª', 0, NULL, NULL, 0),
(13, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'Protection solaire', 'Remplacement ou ajout de volets, auvents, casquettes, stores, ÔÇª', 0, NULL, NULL, 1),
(14, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'Autre : precisez svp', '', 0, NULL, NULL, 1),
(15, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'Action sur le chauffage', 'Remplacement de g├®n├®rateurs, Isolation de la distribution, Equilibrage Hydraulique, A├®raulique, Modification des pompes, R├®gulation, Emission', 0, NULL, NULL, 1),
(16, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'Action sur le refroidissement', 'Remplacement de g├®n├®rateurs, Isolation de la distribution, Equilibrage Hydraulique, A├®raulique, Modification des pompes, R├®gulation, Emission', 0, NULL, NULL, 1),
(17, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'Action sur l''ECS (Eau chaude sanitaire)', 'Remplacement de g├®n├®rateurs, Isolation de la distribution, Equilibrage Hydraulique des boucles, Modification des pompes, R├®gulation,', 0, NULL, NULL, 1),
(18, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'Action sur l''eau', 'Reducteurs de pression, mousseurs', 0, NULL, NULL, 1),
(19, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'Action sur la ventilation', 'Remplacement de Ventilateurs, Isolation de la distribution, Equilibrage A├®raulique,  R├®gulation, Horloges', 0, NULL, NULL, 1),
(20, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'Action sur l''eclairage', 'Remplacement des luminaires, des sources, de la gestion, gradation, d├®tection de pr├®sence, de contr├┤le d''intensit├® lumineuse, de programmation horaire', 0, NULL, NULL, 1),
(21, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'Action sur les equipements divers', 'Facteur de forme _Cos Phi_ Equilibrage de r├®seau ├®lectrique, introduction d''appariel moins consommateurs _R├®frig├®ration, compresseur d''air, Equipements Electrodomestiques, cuissonÔÇª_', 0, NULL, NULL, 1),
(22, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'Energies Renouvelables', 'Solaire thermique ECS et ou chauffage et ou Rafra├«chissement / Solaire PhotovoltA├»que / Bois ├®nergie / Cog├®n├®ration / G├®othermie verticale, horizontale, sur l''air / Puits canadiens / Eolien / Bomasse / Biogaz ', 0, NULL, NULL, 0),
(23, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'Changement d''energie', 'En compl├®ment des ├®quipements pr├®c├®dents, introduction suppression d''├®quipements d''├®nergie sp├®cifiques', 0, NULL, NULL, 0),
(24, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'Autre : precisez svp', '', 0, NULL, NULL, 1),
(25, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'Exploitation', 'Contrat d''exploitation P1 P2 P3 avec ou sans interressement / CPE / PPP / ', 0, NULL, NULL, 0),
(26, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'Programmation', 'Horloge / R├®gulation / Modification des horaires / Modification de la gestion d''air neuf / Modification des consignes de temp├®ratures.', 0, NULL, NULL, 0),
(27, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'Optimisation tarifaire', 'N├®gociation de contrat / Chgt de fournisseurs / Chgt de Tarif ', 0, NULL, NULL, 0),
(28, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'Telesuivi / optimisation', 'Suivi par t├®l├®gestion / Intervention d''un sp├®cialiste de la r├®gulation', 0, NULL, NULL, 0),
(29, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'Autre : precisez svp', '', 0, NULL, NULL, 0),
(104, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'Division en plusieurs batiments ou zones ', 'RELOCALISER L USAGELe b├ótiment est peu fr├®quent├® pour l usage. Le partage des locaux est un moyen de limiter les surfaces chauff├®es. D autres locaux disposent de surfaces pouvant accueillir l activit├® et/ou permettant de mieux g├®rer l intermittence. Etudier et optimiser les regroupements possibles ', 1, NULL, 0, 1),
(105, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'Passage d un zone d occupation en local non c', 'LIMITER LES SURFACESLa surface chauff├®e doit se limiter ├á la surface n├®cessaire ├á l usage. Condamner le chauffage de la zone inutilis├®e. ', 1, NULL, 0, 1),
(106, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'Passage du batiment en local non chauff├® ', 'Mettre hors service ce b├ótiment ', 1, NULL, 0, 1),
(107, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'Autre type d action concernant la surface ', ' ', 1, NULL, 0, 1),
(108, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'ISOLER MURS EXTERIEURS PAR L EXTERIEUR ', 'Les murs ne sont pas isol├®s. De fait, il para├«t important de proc├®der ├á la mise en place d une isolation ext├®rieure efficace sur l ensemble de la surface -isolation telle que la r├®sistance thermique soit au minium de 4 m2.K/W, soit une ├®paisseur d environ 12 cm Th32- permettant une diminution des consommations ├®nerg├®tiques ainsi qu une am├®lioration du confort thermique. Contrairement ├á une isolation int├®rieure, ces travaux peuvent ├¬tre r├®alis├®s durant l occupation des locaux et permettent le traitement efficace des ponts thermiques ainsi qu un maintien du confort estival du b├ótiment. ', 1, NULL, 35, 1),
(109, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'ISOLER MURS SUR LOCAUX NON CHAUFFES - ', 'Les murs  ne sont pas tous isol├®s. Les pertes via ces locaux non chauff├®s ne sont pas n├®gligeables et la consommation d ├®nergie est augment├®e inutilement. De fait, il para├«t important de proc├®der ├á la mise en place d une isolation efficace de ces paroi sur l ensemble de leur surface -isolation telle que la r├®sistance thermique soit au minium de 3 m2.K/W, soit une ├®paisseur d environ 10 cm Th32- ', 1, NULL, 35, 1),
(110, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'RENOVATION THERMIQUE COMPLETE DE L ENVELOPPE ', ' Compte tenu de la mauvaise qualit├® d ensemble de l enveloppe du b├ótiment et afin de garantir le niveau de performance de la r├®novation, il est pr├®f├®rable de proc├®der ├á une r├®novation compl├¿te du b├ótiment et de se placer dans le cadre d une r├®novation avec un niveau de performance ├®nerg├®tique si possible B├ótiment Basse Consommation dÔÇÖ├®nergie Existant -RT2012-. Ne pas faire de demi-mesure pour tendre vers des r├®novations durables ... ', 1, NULL, 35, 1),
(111, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'MISE EN PLACE D ALLEGE DERRIERE RADIATEUR ', 'Entre le radiateur et le mur, la temp├®rature est plus ├®lev├®e que dans dans la salle. Or, la perte de chaleur au travers d une paroi ext├®rieure est multipli├®e par 2 si celle-ci se trouve derri├¿re un radiateur. Dans la mesure o├╣ les murs ne sont pas isol├®s, il serait tr├¿s int├®ressant de mettre en place une isolation de cette partie de paroi. V├®rifier la place disponible et la possibilit├® d accroitre l espace entre le mur et le radiateur pour la mise en place d une plaque d isolant -2cm par exemple- rev├¬tue d un mat├®riau  r├®fl├®chissant -aluminium, par exemple-. Il convient de  laisser un espace de 3 cm entre le radiateur et la finition du mur. ', 1, NULL, 0, 1),
(112, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'ISOLER PLANCHER BAS SUR LOCAUX NON CHAUFFES ', 'Les plancher bas ne sont pas tous isol├®s. Les pertes via ces locaux non chauff├®s ne sont pas n├®gligeables et la consommation d ├®nergie est augment├®e inutilement. De fait, il para├«t important de proc├®der ├á la mise en place d une isolation efficace de cette paroi sur l ensemble de sa surface -isolation telle que la r├®sistance thermique soit au minium de 4 m2.K/W, soit une ├®paisseur d environ 12 cm Th32-  ', 1, NULL, 35, 1),
(113, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'ISOLER PLANCHER BAS SUR L EXTERIEUR ', ' Un vide sanitaire, par d├®finition ventil├®, est une source importante de d├®perdition par le plancher bas. De fait, il para├«t important de proc├®der ├á la mise en place d une isolation efficace de cette paroi sur l ensemble de sa surface -isolation telle que la r├®sistance thermique soit au minimu de 4 m2.K/W, soit une ├®paisseur d environ 12 cm Th32-  ', 1, NULL, 35, 1),
(114, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'ISOLER COMBLE ', 'Les combles ne sont pas isol├®s. Une grande partie des d├®perditions thermiques provient de la toiture des b├ótiments -30% dans les b├ótiments non isol├®s-. De fait, il para├«t urgent de proc├®der ├á la mise en place d une isolation efficace sur l ensemble de la surface -isolation telle que la r├®sistance thermique soit au minimum de 7,5 m2.K/W, soit une ├®paisseur d environ 24 cm Th32 - ', 1, NULL, 35, 1),
(115, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'RENOVER FAUX PLAFOND ', 'Isoler au plus proche du local permet de limiter les d├®perditions. Dans le cadre d une r├®novation des faux plafonds, pr├®voir leur isolation -isolation telle que la r├®sistance thermique soit au minimum de 7,5 m2.K/W, soit une ├®paisseur d environ 24 cm Th32 - ', 1, NULL, 35, 1),
(116, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'ISOLER TOITURES TERRASSES ', 'La toiture terrasse n est pas isol├®e. Une grande partie des d├®perditions thermiques provient de la toiture des b├ótiments -30% dans les b├ótiments non isol├®s-. De fait, il para├«t urgent de proc├®der ├á la mise en place d une isolation efficace sur l ensemble de la surface -isolation d une ├®paisseur d environ 16 cm ou telle que la r├®sistance thermique soit au minimum de 4 m2.K/W-. Si l ├®tanch├®it├® est ├á reprendre, l isolation est mise en place avant de r├®aliser la nouvelle ├®tanch├®it├®, dans le cas contraire, l isolant peut ├¬tre pos├® au dessus de l ├®tanch├®it├® existante -toiture invers├®e-. ', 1, NULL, 35, 1),
(117, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'REMPLACER LES VITRAGES SIMPLES ', ' De part leurs fonctions dÔÇÖouverture et de transparence, les baies vitr├®es constituent les parois les plus vuln├®rables aux d├®perditions thermiques. Cela entra├«ne un inconfort pour les occupants -sensation de paroi froide-, des probl├¿mes de condensation, d infiltration  et surtout des besoins de chauffage non n├®gligeables. Pr├®voir le remplacement des menuiseries existantes par des menuiseries double vitrage 4/16/4 faible ├®missivit├®, remplissage argon ou telle que Uw Ôëñ 1,6 W/ m2.K ', 1, NULL, 35, 1),
(118, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'ISOLER COFFRES DE VOLETS ROULANTS ', 'Les pertes par ces coffres sont importantes et la consommation d ├®nergie est augment├®e inutilement. En fonction de l espace disponible, coller ou fixer des plaques de polystyr├¿ne ou de laine min├®rale afin de limiter les d├®perditions par ces parois. ', 1, NULL, 35, 1),
(119, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'PROTECTION SOLAIRE ESTIVALE ', 'compte tenu de l orientation des baies vitr├®es, du recours ├á la climatisation et de l inconfort en p├®riode chaude, il est souhaitable de mettre en place des protections solaires efficaces afin de lutter contre la surchauffe du b├ótiment. ', 1, NULL, 0, 1),
(120, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'REVISION DES JOINTSPLINTHES BASCULANTES ', ' ', 1, NULL, 0, 1),
(121, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'FERME PORTE AUTOMATIQUE - ', 'Le batiment ne dispose pas d une fermeture automatique au niveau des portes . Toute infiltration d air par une porte ou fen├¬tre ouverte g├®n├¿re une consommation suppl├®mentaire de chaleur en hiver et une p├®n├®tration de la chaleur en ├®t├®. La quantit├® d ├®nergie gaspill├®e d├®pend de la taille de l ouverture, et du temps pendant lequel elle est ouverte. Installer un dispostif de fermeture automatique de  porte ', 1, NULL, 0, 1),
(122, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Bati', 'Autre type d action concernant l enveloppe ', ' ', 1, NULL, 0, 1),
(123, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'ISOLER LA DISTRIBUTION ', 'Les canalisations sont pos├®es dans des zones non chauff├®es. Lors de la circulation Aller et Retour de l eau de chauffage, une partie de l ├®nergie est perdue. Isoler les canalisations et accessoires. ', 1, NULL, 20, 0),
(124, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'ROBINETS THERMOSTATIQUES ', 'Compte tenu des usages des pi├¿ces, le besoin de confort est diff├®rent. Sans modifier la r├®gulation du b├ótiment, il est possible d installer un robinet thermostatique dans les pi├¿ces dont le besoin est moindre. Installer de tels ├®quipements dans ... ', 1, NULL, 12, 1),
(125, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'INSERT POELE FOYER FERME ', ' ', 1, NULL, 10, 1),
(126, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'CHAUDIERE VETUSTE ', 'La chaudi├¿re actuelle semble v├®tuste -plus de 20 ans-. R├®aliser une mesure de combustion et un calcul de rendement ├®nerg├®tique, pour ├®valuer les gains potentiels de son remplacement par un ├®quipement actuel plus performant. -Prix hors mise en conformit├® du local- ', 1, NULL, 16, 1),
(127, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'CHAUFFAGE POUR USAGE PONCTUEL ET DECALE ', 'Dans le b├ótiment, un local est utilis├® ponctuellement et en d├®calage de l usage principal. Chauffer l ensemble du b├ótiment pour ce seul local est disproportionn├®. Un chauffage d appoint de type ├®lectrique est la solution adapt├®e. Sa mise en oeuvre n├®cessite une maitrise du temps de fonctionnement -programmation- et de l arr├¬t du chauffage central du local concern├®. ', 1, NULL, 16, 0),
(128, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'DOUBLE FLUX ', 'Le b├ótiment est d├®j├á ventil├® et son examen permet d envisager l int├®gration d un syst├¿me double flux, qui doit alors ├¬tre consid├®r├® comme int├®gration d un ├®quipement de chauffage. Faire une ├®tude thermique et de ventilation pour en valider les enjeux financiers et techniques. ', 1, NULL, 0, 1),
(129, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'REGULATION CHAUDIERE ', 'La chaudi├¿re ne poss├¿de pas de syst├¿me de r├®gulation. R├®guler, programmer et adapter la temp├®rature de l eau permet de r├®aliser des ├®conomies d ├®nergie notoires. Installer sonde et r├®gulation de chaudi├¿re. ', 1, NULL, 0, 1),
(130, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'KERDANE ', 'Cette ├®nergie est plus ch├¿re que l ├®lectricit├®:  12,5cÔé¼/kWh ├®lectrique, contre 20Ôé¼/20litres, pour 7 kWhPCI/litre soit 14,3 cÔé¼/kWh. De plus la combustion lib├®re des gaz susceptibles dÔÇÖalt├®rer la sant├® et la qualit├® de lÔÇÖair, g├®n├®rant beaucoup d humidit├®. Ce mode de chauffage est une fausse ├®conomie, et une fausse source de confort ├á banir. ', 1, NULL, 0, 1),
(131, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'CONFLIT AVEC CHAUFFAGE ', 'Le b├ótiment ou certains locaux du b├ótiment peuvent rencontrer un double fonctionnement chauffage et climatisation qui conduit ├á chauffer de l air refroidit par ailleurs simultan├®ment. Instaurer des conditions de fonctionnement au tableau ├®lectrique, sensibiliser les usagers, et les informer du nouveau mode de fonctionnement. Profiter de ces travaux pour asservir la climatisation et le chauffage ├á l ouverture des fen├¬tres. ', 1, NULL, 0, 0),
(132, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'MAUVAIS EMPLACEMENT ', 'En usage froid exclusif, l unit├® ext├®rieure sera plac├®e sur une fa├ºade Nord. De plus la ventilation de l unit├® doit ├¬tre assur├®e. Modifier l installation en cons├®quence. ', 1, NULL, 0, 0),
(133, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'BALLON SOLAIRE THERMIQUE ', 'L examen de l installation de production d eau chaude, de la taille des locaux de stockage et de l exposition du b├ótiment permet d envisager la mise en place d un syst├¿me solaire thermique de production d ECS. Une ├®tude technico-├®conomique est n├®cessaire afin de valider cette solution. ', 1, NULL, 20, 1),
(134, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'PRODUCTION INSTANTANEE ', 'L usage d eau chaude est limit├®. En vue de diminuer les d├®penses de stockage, installer un chauffe eau ├®lectrique ├á production instantan├®e de 15l -ou ├á pr├®voir en tout cas au moment du renouvellement- ', 1, NULL, 12, 1),
(135, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'MITIGEUR DEPART DOUCHES ', 'Les douches sont aliment├®es individuellement en eau chaude. R├®glementairement, il est demand├® d alimenter ces ├®quipements par eau mitig├®e sans d├®passer 50deg.C  en vue d ├®viter les br├╗lures. Cela permet de limiter la consommation d eau chaude. Installer un mitigeur au niveau des douches. 2 r├®glages annuels peuvent ├¬tre r├®alis├®s afin d adapter la temp├®rature ├á la saison -├®t├®hiver- et faire des ├®conomies lors de la p├®riode estivale. A v├®rifier  ', 1, NULL, 12, 1),
(136, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'ISOLER LA DISTRIBUTION ', 'Les canalisations sont pos├®es dans des zones non chauff├®es. Lors d un appel d eau chaude, une partie de l ├®nergie est perdue. Isoler les canalisations par pose de coquilles de laine min├®rale ou de caoutchouc cellulaire. ', 1, NULL, 20, 1),
(137, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'REPARATION FUITES ', 'Une fuite sur un r├®seau d eau chaude g├®n├¿re des gaspillages importants d eau et d ├®nergie. La fuite constat├®e sur l installation lors de notre visite n├®cessite une intervention rapide. ', 1, NULL, 0, 0),
(138, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'RELOCALISER ', 'Le point de production est ├®loign├® du lieu de puisage. Cela g├®n├¿re des consommations d eau -attente eau chaude- et d ├®nergie -perte distribution-, toutes deux inutiles. Revoir l emplacement de la production. ', 1, NULL, 12, 1),
(139, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'PUISAGE et MELANGEUR ', 'Un m├®langeur sur un puisage permet d obtenir une eau temp├®r├®e. Toutefois, dans de nombreux cas, le temps d utilisation du puisage est inf├®rieur au temps d appel d eau chaude. L eau chaude souhait├®e reste dans les canalisations. Un m├®langeur cr├®e l habitude d appeler une eau temp├®r├®e par principe, sans r├®el besoin ! Pr├®f├®rer des robinetteries ├á commande s├®par├®e pour les lieux ├á fort usage.', 1, NULL, 0, 1),
(140, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'MODULATION ', 'Le local dispose d un volume n├®cessitant un syst├¿me de ventilation cons├®quent. Les conditions limites de calcul de son dimensionnement ne sont pas toujours atteintes. La mise en place d une modulation du d├®bit peut se faire en fonction de l occupation du local, et diminuer ainsi les pertes de ventilation. ', 1, NULL, 12, 1),
(141, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'CHEMINEE OUVERTE ', 'Le local dispose d un conduit de chemin├®e ouvert. Cela constitue une source de d├®perdition majeure. A d├®faut d obturation d├®finitive et isol├®e, une obturation ├®tanche ├á l air et manoeuvrable permet de limiter ces effets, tout en conservant l usage. ', 1, NULL, 20, 1),
(142, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'REDUIRE ECLAIREMENT ', 'L ├®clairage existant est surdimensionn├® pour l usage qui en est fait. Supprimer des appareils, ou des ampoules -les n├®ons doivent continuer ├á fonctionner par paire- en conservant l homog├®n├®it├® du flux lumineux n├®cessaire ├á l usage. ', 1, NULL, 10, 1),
(143, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'AUGMENTER ECLAIREMENT ', 'L ├®clairage existant est sous dimensionn├® pour l usage qui en est fait. Ajouter des appareils en veillant ├á l homog├®n├®it├® de l ├®clairement n├®cessaire ├á l usage. ', 1, NULL, 10, 1),
(144, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'DETECTEUR DE PRESENCE ', 'Les lieux de passage n exigent pas d ├®clairement permanent. Des cellules de d├®tection permettent de g├®rer la pr├®sence ou non d usagers. NB : ce type d allumage fr├®quent ne convient pas aux ampoules Fluo compactes dont la dur├®e de vie serait fortement d├®t├®rior├®e. ', 1, NULL, 10, 1),
(145, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'SUPPRIMER AMPOULES HALOGENES ', 'De nombreuses ampoules de ce type sont utilis├®es. Elles poss├¿dent la moins bonne efficacit├® lumi├¿re ├®mise / kWh consomm├®. Remplacer le parc par du mat├®riel plus sobre et en nombre adapt├® au besoin. ', 1, NULL, 5, 1),
(146, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'REMPLACEMENT DES NEONS ', 'Les n├®ons en place de type T8 18W peuvent ├¬tre remplac├®s en fin de vie par des n├®ons ├®co de 16W plus efficaces -type Philips MASTER TL-D Eco ou ├®quivalent- ├á dur├®e de vie plus longue. La rentabilit├® en co├╗t global -achat, maintenance, ├®nergie- est assur├®e. ', 1, NULL, 0, 1),
(147, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'REGULATEUR POUR LES ROBINETS ', 'Les brises jets et a├®rateurs standards n ont pas d effet sur le d├®bit : moyenne de 10 ├á 12 l/mn. Un r├®gulateur permet d obtenir un d├®bit de 2 ├á 6 l/mn en fonction des usages. Les version autor├®gul├®es permettent de maintenir le d├®bit quelque soit la pression du r├®seau. Sur les lieux de puisage principaux et pour tout nouvel appareil, mettre en place un r├®gulateur. La pr├®conisation permet en plus d ├®conomiser de l ├®nergie, sur l eau chaude non consomm├®e. ', 1, NULL, 15, 1),
(148, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'BOUTON POUSSOIRS LAVABOS ', 'Le robinet simple temporis├® est adapt├® aux sites ├á forte fr├®quentation. La dur├®e dÔÇÖ├®coulement est g├®n├®ralement de 15 s. En cas de d├®rive, cela provient d un manque d entretien -d├®bris, impuret├®s ...-. Le d├®bit de sortie peut ├¬tre r├®gl├® ├á  partir de la bague de r├®glage ├á 4 positions. Faire une campagne de r├®glage et d entretien pour que le d├®bit soit ├á 6 ou 7 l/mn.  La pr├®conisation permet en plus d ├®conomiser de l ├®nergie, sur l eau chaude non consomm├®e. ', 1, NULL, 15, 1),
(149, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'REMPLACEMENT ROBINETS SIMPLES DES LAVABOS ', 'Les robinet ├á papillon sont source de consommation et de fuites. Dans le cas d une ├®cole il est fortement recommand├® d installer des boutons poussoirs. La dur├®e dÔÇÖ├®coulement est g├®n├®ralement de 15 s. En cas de d├®rive, cela provient d un manque d entretien -d├®bris, impuret├®s ...-. Le d├®bit de sortie peut ├¬tre r├®gl├® ├á  partir de la bague de r├®glage ├á 4 positions. Le d├®bit doit ├¬tre de 6 ou 7 l/mn. ', 1, NULL, 15, 1),
(150, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'COMMANDE DOUBLE FLUX ', 'Ce syst├¿me permet de ne vider que partiellement le r├®servoir -la moiti├®-. Cependant lÔÇÖefficacit├® est fonction de lÔÇÖutilisateur, car cela reste une d├®marche volontaire. Le syst├¿me, accompagn├® d une campagne dÔÇÖinformations en direction des usagers, est applicable au b├ótiment. ', 1, NULL, 7, 1),
(151, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'PLAQUETTES RESERVOIR ', 'Elles limitent le volume d eau appel├® ├á 6l ├á la place de 9l. Leur avantage r├®side dans le fait que cela ne d├®pend pas de l usager. ', 1, NULL, 15, 1),
(152, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'REGLAGE BOUTON POUSSOIR ', 'Que ce soit sur WC ou urinoir, ce syst├¿me permet de r├®guler le d├®bit -6l/mn pour urinoirs60l/mn pour WC- et de limiter le temps d appel -6 secondes-. La consommation tr├¿s sobre et le mat├®riel robuste, en font un dispositif bien adapt├® au b├ótiment. R├®gler ce mat├®riel pour limiter les consommations ', 1, NULL, 15, 1),
(153, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'DOUCHETTES ', 'Sous une pression r├®seau de 3 bars, le d├®bit en sortie peut varier de 10 ├á 20 l/mn avec une douchette standard. Il existe sur le march├® des mat├®riels permettant de diminuer le d├®bit -sans baisse de confort- et de ramener ce dernierde 6 ├á 9 l/mn. Renouveler le parc des douchettes en place.', 1, NULL, 0, 1),
(154, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'Autre type d action concernant l equipement ', ' ', 1, NULL, 0, 1),
(155, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'PROGRAMMATION ', 'La programmation de l appareil n est pas satisfaisante pour l usage des locaux. Demander ├á l installateur de l appareil s  il peut ├¬tre asservi ├á un thermostat programmable externe et r├®aliser les travaux. Profiter de ces travaux pour asservir la climatisation ├á l ouverture des fen├¬tres. ', 1, NULL, 0, 0),
(156, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'INSTALLER COMPTAGE ', 'l alimentation en eau froide du ballon de production d ECS n est pas ├®quip├®e d un compteur divisionnaire. Il est donc impossible de conna├«tre les consommations, de d├®tecter d ├®ventuelles fuites et d optimiser le dimensionnement en fonction des besoins. La mise en place d un compteur volum├®trique et son relev├® r├®gulier permettra ces am├®liorations. ', 1, NULL, 20, 1),
(157, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'REGLER THERMOSTAT ', 'Une temp├®rature de production trop ├®lev├®e augmente inutilement les pertes par les parois et affecte la consommation d ├®nergie. La temp├®rature de stockage optimale doit se situer entre 58 et 60deg.C. R├®gler le thermostat. ', 1, NULL, 1, 1),
(158, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'PROGRAMMATEUR ', 'La gestion du chauffage dans les b├ótiments est essentielle aux ├®conomies d ├®nergie. Le temps de relance du chauffage ├®tant inf├®rieur au temps d inoccupation, une ├®conomie substantielle est possible. Installer un thermostat programmateur r├®gulateur pour chaque zone ', 1, NULL, 12, 1),
(159, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'PROGRAMMATEUR PAR CLE ', 'La gestion du chauffage dans les b├ótiments est essentielle aux ├®conomies d ├®nergie. Le temps de relance du chauffage ├®tant inf├®rieur au temps d inoccupation, une ├®conomie substantielle est possible. Installer un thermostat programmateur r├®gulateur pour chaque zone. Le programmateur ├á cl├® permettra de faciliter l ensemble des programmations de ce type. ', 1, NULL, 12, 1),
(160, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'GTB ', 'La Gestion Technique du B├ótiment dans les b├ótiments est essentielle aux ├®conomies d ├®nergie. Le temps de relance du chauffage ├®tant inf├®rieur au temps d inoccupation, une ├®conomie substantielle est possible. L intermittence ├®tant al├®atoire, et l enjeu de consommation ├®tant fort, ├®tudier et mettre en place une Gestion Technique du Chauffage. ', 1, NULL, 12, 1),
(161, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'ZONAGE DU CHAUFFAGE ', 'Le b├ótiment accueille des activit├®s pr├®sentant des usages diff├®rents, dans des salles diff├®rentes. Un zonage du chauffage permet de chauffer la surface utile, au moment utile. La distribution actuelle du chauffage permet, moyennant quelques modifications, de mettre en place un tel dispositif. ', 1, NULL, 12, 1),
(162, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'BRIDAGE THERMOSTAT ', 'La consigne de temp├®rature des radiateurs est accessible. La r├®gulation et les consommations ne peuvent ├¬tre ma├«tris├®es. Installer un dispositif de bridage r├®versible. ', 1, NULL, 12, 1),
(163, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'GESTION DES INOCCUPATIONS ', 'Du fait des longues p├®riodes d inoccupation du b├ótiment, il est fortement rentable de mettre hors gel le local. Pour cela une intervention humaine et une organisation sont ├á mettre en place, pour l arr├¬t et la remise en chauffe des locaux. Planning d occupation ├á ├®tablir annuellement. ', 1, NULL, 5, 1),
(164, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'FORMATION USAGERS ', 'Les utilisateurs ne connaissent pas le mat├®riel en place sur lequel ils doivent agir pour assurer la maitrise de l ├®nergie de chauffage. R├®aliser une formation et mettre en place une documentation adapt├®e. ', 1, NULL, 5, 1),
(165, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'MAITRISE DES TEMPERATURES ', 'La consigne de chauffage est trop ├®lev├®e pour l usage du b├ótiment. Les consommations d ├®nergie de chauffage sont directement proportionnelles ├á cette consigne. R├®gler ├á 21deg.C. V├®rifier annuellement que la consigne n a pas ├®t├® modifi├®e, et que l appareil est fiable. ', 1, NULL, 5, 1),
(166, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'GESTION DES FORTES INTERMITTENCES ', 'Le b├ótiment est occup├® avec une forte intermittence. Le regroupement avec d autres b├ótiments n est pas possible ├á l instant. Seul l utilisateur pourra agir sur le niveau de consommation. Convenir avec les usagers d un niveau de consommation annuel maximal, pour un nombre d heures d utilisation. En cas de d├®passement, une r├®percution financi├¿re pourrait ├¬tre envisag├®e. Pr├®voir une p├®riodicit├® de r├®vision de cette convention, et bien s├╗r, suivre les consommations r├®elles. ', 1, NULL, 1, 1),
(167, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'MINUTERIE ', 'Le local r├®duit ├®tant tr├¿s peu utilis├® pour une courte dur├®e courte, il est envisageable de piloter le chauffage par minuterie d une dur├®e de 1h par exemple. Les utilisateurs pourront relancer autant de fois qu ils le d├®sirent. ', 1, NULL, 1, 1),
(168, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'ARROSAGE PELOUSE ', 'L arrosage pr├®conis├® est de 3 l/m2/cycle d arrosage. L ├®cart de consommation ├®tant significatif, une ├®tude technique de l arrosage est n├®cessaire en int├®grant : le mat├®riel, la programmation, l hygrom├®trie du solÔÇª ', 1, NULL, 0, 1),
(169, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'CONTACTEUR JOUR / NUIT ', 'Le local b├®n├®ficiant d une double tarification horaire, et l usage le permettant, installer un contacteur jour / nuit sur la ligne du cumulus. ', 1, NULL, 0, 1),
(170, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'REGLAGE BOUTON POUSSOIR ', 'Le temps de r├®glage actuel est trop important : viser une temporisation ├á 20 sec. ', 1, NULL, 0, 1),
(171, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'ARROSAGE ABONNEMENT ', 'Pour m├®moire, la consommation de ce poste est telle qu elle n├®cessite un abonnement sp├®cifique n incluant pas les frais d assainissement - Voir commentaires sur abonnements- ', 1, NULL, 0, 1),
(172, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'Autre type d action concernant la gestion ', ' ', 1, NULL, 0, 0),
(173, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Utilisation', 'PRESENCE USAGERS ', ' La ventilation en place n est pas r├®gul├®e en fonction de l occupation. Sur les p├®riodes d inoccupation, le local rejette de l air chaud ou temp├®r├® pour introduire de l air froid. On cr├®e donc un refroidissement sans int├®r├¬t. Installer une r├®gulation programmable identique au chauffage -date/heures/vacances...- pour en g├®rer le fonctionnement. Au-del├á du chauffage, un gain est fait sur les consommations propres de la ventilation. ', 1, NULL, 12, 1),
(174, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Utilisation', 'TEMPERATURE CONSIGNE ', 'La temp├®rature demand├®e ├á une climatisation ne doit pas ├¬tre inf├®rieure de plus de 5deg. par rapport ├á la temp├®rature ext├®rieure. Cela est suffisant pour apporter la sensation de fraicheur, et permet d avoir des consommations raisonnables. Former les usagers ├á cette bonne pratique. ', 1, NULL, 0, 0),
(175, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Utilisation', 'Autre type d action concernant l usage ou les', ' ', 1, NULL, 0, 0),
(176, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Utilisation', 'SUIVI  ET ENTRETIEN ANNUEL ', 'La chaudi├¿re n est pas suivie r├®guli├¿rement. Un entretien g├®n├®ral, une mesure de combustion, et une analyse de rendement permettent d agir au plus t├┤t sur des d├®rives. Demander ├á un chauffagiste une prestation de contr├┤le annuelle de chaudi├¿re incluant mesures de combustion et de rendement. ', 1, NULL, 1, 1),
(177, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'ENTRETIEN ANNUEL de La climatisation ', 'Il est n├®cessaire d entretenir une climatisation pour des raisons de confort et de sant├®. Au-del├á de cette n├®cessit├®, l encrassement des filtres affecte le rendement de l appareil. R├®aliser un entretien r├®gulier des appareils. ', 1, NULL, 0, 1),
(178, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Equipement', 'REVISION BOUCHES EXTRACTION ', 'L installation de ventilation dispose de bouches d aspiration r├®gulantes afin de limiter les d├®bits. Ces syst├¿mes ne sont pas entretenus, ou d├®t├®rior├®s. Faire une r├®vision compl├¿te des bouches pour remettre en ├®tat leur bon fonctionnement ', 1, NULL, 5, 1),
(179, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'ARR├èT PRODUCTION ECS VACANCES ', 'lors des cong├®s estivaux, pensez ├á arr├¬ter la production d Eau Chaude Sanitaire  afin de limiter les pertes de stockage. Lors de la remise en fonctionnement, purgez les canalisations. ', 1, NULL, 0, 1),
(180, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'MAINTENANCE ', 'Une installation de ventilation doit ├¬tre entretenue pour des raisons de performance et d hygi├¿ne. Instaurer une visite technique annuelle. ', 1, NULL, 1, 1),
(181, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '', 'Autre type d action concernant la maintenance', ' ', 1, NULL, 0, 0),
(182, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Utilisation', 'CONFORT ', 'Le local n est pas ou peu ventil├®. Au-del├á de l obligation r├®glementaire, l absence de ventilation g├®n├¿re un r├®el inconfort des usagers. Etudier et installer une ventilation, qui fera l objet de r├¿gles de fonctionnement -permanent, horloge, pr├®senceÔÇª- ', 1, NULL, 16, 1),
(183, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'ETUDE THERMIQUE ', 'Les besoins de chauffage sont importants. La performance du b├óti n est pas satisfaisante. Compte tenu de nos observations, il est n├®cessaire d ├®tudier de fa├ºon plus pr├®cise la qualit├® de l enveloppe et des ├®quipements en place, mais aussi leur conformit├® entre autre en terme de ventilation, avant d agir sur ces ├®l├®ments. R├®aliser une ├®tude thermique par un BET. Co├╗t hors investissement. ', 1, NULL, 0, 0),
(184, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'Autre type d etude ', ' ', 1, NULL, 0, 0),
(185, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'Gestion', 'AUTRE : Pr├®ciser en commentaire svp ', ' ', 1, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `actionengagee`
--

CREATE TABLE IF NOT EXISTS `actionengagee` (
  `ActionengageeID` int(11) NOT NULL AUTO_INCREMENT,
  `BatimentID` int(11) NOT NULL,
  `MouvrageID` int(11) NOT NULL,
  `BaseID` char(36) NOT NULL,
  `Date` date NOT NULL,
  `EvolutionID` int(11) NOT NULL,
  `Cout` decimal(11,2) DEFAULT NULL,
  `Surface` int(11) DEFAULT NULL,
  `Commentaire` text,
  PRIMARY KEY (`ActionengageeID`,`BaseID`),
  KEY `BatimentID` (`BatimentID`,`MouvrageID`,`BaseID`,`EvolutionID`),
  KEY `MouvrageID` (`MouvrageID`),
  KEY `BaseID` (`BaseID`),
  KEY `EvolutionID` (`EvolutionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `autreposte`
--

CREATE TABLE IF NOT EXISTS `autreposte` (
  `AutreposteID` int(11) NOT NULL AUTO_INCREMENT,
  `CategorieID` int(11) DEFAULT NULL,
  `Nom` varchar(45) DEFAULT NULL,
  `Anneeconstruction` int(4) DEFAULT NULL,
  `cadastre` varchar(45) DEFAULT NULL,
  `latitude` varchar(15) DEFAULT NULL,
  `longitude` varchar(15) DEFAULT NULL,
  `commentaire` text,
  `CoordonneeID` int(11) DEFAULT NULL,
  `adresse1` varchar(45) DEFAULT NULL,
  `adresse2` varchar(45) DEFAULT NULL,
  `adresse3` varchar(45) DEFAULT NULL,
  `codepostal` int(11) DEFAULT NULL,
  `Ville` varchar(45) DEFAULT NULL,
  `Pays` varchar(45) DEFAULT NULL,
  `MouvrageID` int(11) NOT NULL,
  `Puissance` decimal(11,2) DEFAULT NULL,
  `Descriptif` text,
  `BaseID` char(36) NOT NULL,
  PRIMARY KEY (`AutreposteID`,`BaseID`),
  KEY `belong_to_Base` (`BaseID`),
  KEY `MouvrageID` (`MouvrageID`),
  KEY `CoordonneeID` (`CoordonneeID`),
  KEY `CategorieID` (`CategorieID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `base`
--

CREATE TABLE IF NOT EXISTS `base` (
  `BaseID` char(36) NOT NULL,
  `BaseURL` varchar(70) NOT NULL,
  PRIMARY KEY (`BaseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `base`
--

INSERT INTO `base` (`BaseID`, `BaseURL`) VALUES
('8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '');

-- --------------------------------------------------------

--
-- Structure de la table `batiment`
--

CREATE TABLE IF NOT EXISTS `batiment` (
  `BatimentID` int(11) NOT NULL AUTO_INCREMENT,
  `MouvrageID` int(11) NOT NULL,
  `Nom` varchar(45) NOT NULL,
  `Anneeconstruction` int(4) DEFAULT NULL,
  `Patrimoine` int(11) DEFAULT '0',
  `Voisinage` int(11) DEFAULT '0',
  `Orientation` int(11) DEFAULT '0',
  `Exposition` int(11) DEFAULT '0',
  `altitude` int(11) DEFAULT NULL,
  `BaseID` char(36) NOT NULL,
  `Cadastre` varchar(45) DEFAULT NULL,
  `Latitude` varchar(15) DEFAULT NULL,
  `Longitude` varchar(15) DEFAULT NULL,
  `StationdjuID` int(11) DEFAULT NULL,
  `StationmeteoID` int(11) DEFAULT NULL,
  `Commentaire` text,
  `CoordonneeID` int(11) DEFAULT NULL,
  `Adresse1` varchar(45) DEFAULT NULL,
  `Adresse2` varchar(45) DEFAULT NULL,
  `Adresse3` varchar(45) DEFAULT NULL,
  `Codepostal` int(11) DEFAULT NULL,
  `Ville` varchar(45) DEFAULT NULL,
  `Pays` varchar(45) DEFAULT NULL,
  `NbrEtage` int(11) DEFAULT NULL,
  `Surface` int(11) DEFAULT NULL,
  `NbrEmployee` int(11) DEFAULT NULL,
  `Pv` int(11) DEFAULT NULL,
  `SystemeChauffageEau` int(11) DEFAULT NULL,
  `Ces` int(11) DEFAULT NULL,
  PRIMARY KEY (`BatimentID`,`BaseID`),
  KEY `belong_to_Base` (`BaseID`),
  KEY `MouvrageID` (`MouvrageID`),
  KEY `nom` (`Nom`),
  KEY `StationdjuID` (`StationdjuID`),
  KEY `StationmeteoID` (`StationmeteoID`),
  KEY `CoordonneeID` (`CoordonneeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `batiment`
--

INSERT INTO `batiment` (`BatimentID`, `MouvrageID`, `Nom`, `Anneeconstruction`, `Patrimoine`, `Voisinage`, `Orientation`, `Exposition`, `altitude`, `BaseID`, `Cadastre`, `Latitude`, `Longitude`, `StationdjuID`, `StationmeteoID`, `Commentaire`, `CoordonneeID`, `Adresse1`, `Adresse2`, `Adresse3`, `Codepostal`, `Ville`, `Pays`, `NbrEtage`, `Surface`, `NbrEmployee`, `Pv`, `SystemeChauffageEau`, `Ces`) VALUES
(2, 1, 'Mairie', 1970, 2, 2, 2, 2, 700, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2 avenue  Hassan II', NULL, NULL, 10050, 'Rabat', 'MAROC', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 'CARREFOUR', 1990, 2, 3, 4, 4, 400, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ' 114 Bab el hed  ', NULL, NULL, 10010, 'Rabat', 'MAROC', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 'IMMEUBLE', 2000, NULL, NULL, NULL, NULL, 280, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 2, 'espace vert 1', 1900, 1, 1, 1, 1, 200, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B.A ESPACE VERT FACE ANCIEN AEROPERT BEN', NULL, NULL, 81000, 'Agadir', 'Maroc', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 2, 'Stade al inbiaat', 1900, 1, NULL, NULL, NULL, 200, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'STADE AL INBIAAT AV HASSAN        ', NULL, NULL, 81000, 'Agadir', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 2, 'Royal tennis club', 1900, NULL, NULL, NULL, NULL, 3, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ROYAL TENNIS CLUB AV.HASSAN II    ', NULL, NULL, 81000, 'Agadir', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 2, 'marché municipal de poissons', 1900, 2, 1, 1, NULL, 200, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, '', '', NULL, NULL, NULL, NULL, 'MARCHE MUNICIPAL DE POISSONS AGADIR     ', '', '', 81000, 'Agadir', NULL, 0, 0, 0, 0, 0, 0),
(9, 2, 'camping municipal', 1900, 1, NULL, NULL, NULL, 200, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, '', '', NULL, NULL, NULL, NULL, 'CAMPING MUNICIPAL D''AGADIR BD.MED       ', '', '', 81000, 'Agadir', NULL, 0, 0, 0, 0, 0, 0),
(10, 2, 'qdqsdqsd', 1900, 1, 0, 0, 0, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, '', '', NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, 0, 0, 0, 0, 0, 0),
(11, 2, 'qdqsdq', 123, 1, 0, 0, 0, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, '', '', NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, 0, 0, 0, 0, 0, 0),
(12, 2, 'qdqsdq', 123, 3, 0, 0, 0, 12, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, '13', '15', NULL, NULL, NULL, NULL, 'jghjghjgj', 'hjhkh', 'hgjgj hgj', NULL, NULL, NULL, 200, 200, 200, 200, 200, 10),
(13, 2, 'qd', 120, 1, 0, 0, 0, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, '', '', NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `CategorieID` int(11) NOT NULL AUTO_INCREMENT,
  `CategorieparenteID` int(11) DEFAULT '0',
  `Libelle` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Description` varchar(250) DEFAULT NULL,
  `BaseID` char(36) NOT NULL,
  `Couleur` varchar(7) DEFAULT '#000000',
  PRIMARY KEY (`CategorieID`,`BaseID`),
  KEY `parentID` (`CategorieparenteID`),
  KEY `belong_to_Base` (`BaseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=149 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`CategorieID`, `CategorieparenteID`, `Libelle`, `Description`, `BaseID`, `Couleur`) VALUES
(1, 0, 'Batiments', 'liste des types de batiments', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#239178'),
(2, 1, 'Scolaire', 'Ecoles, Colleges', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#002DFF'),
(3, 1, 'Administratif', 'Mairie, Bureau', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#006A7F'),
(4, 1, 'Sportif', 'Gymnase, Vestaire, Stade', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#FF8A00'),
(5, 1, 'Agricole', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#0C4F00'),
(6, 1, 'Divers', 'Autres type de batiments', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(7, 0, 'Autres postes', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#F0D31A'),
(8, 0, 'Eclairage', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#290F2E'),
(9, 0, 'Poste Production', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#E35919'),
(12, 0, 'Vehicules', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#78162D'),
(13, 1, 'Culturel', 'Mediatheque, ecole de musique..', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#9300FF'),
(14, 1, 'Artisanat', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#5F0004'),
(15, 1, 'Culte', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#355F3B'),
(16, 1, 'Associatif', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#FF009A'),
(17, 8, 'Eclairage Voirie', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(18, 8, 'Signalisation', 'Feux tricolores', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(19, 8, 'Saisonnier', 'Fetes', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(20, 12, 'Transports de personne', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(21, 12, 'V├®hicule de fonction', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(24, 0, 'Ratio', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(25, 24, 'Ademe', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(26, 24, 'CEREN', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(27, 24, 'BE', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(28, 7, 'Divers', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(29, 7, 'Epuration', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(36, 0, 'Maitre d''ouvrage', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(37, 36, 'Commune', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#996699'),
(38, 36, 'Entreprise', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#339966'),
(39, 0, 'Carburants', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(40, 39, 'SP95', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(41, 39, 'SP98', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(42, 39, 'Gasoil', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(43, 1, 'Atelier', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#FF2A00'),
(44, 1, 'Logement', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#FF4200'),
(45, 7, 'Relevage', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(46, 7, 'Utilit├®s Ville', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(47, 7, 'Saisonnier', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(48, 7, 'Participation de la ville', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(49, 1, 'Piscine', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#00FFFA'),
(50, 1, 'Tourisme', 'hotel, centre de vacances', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#00FF82'),
(51, 1, 'Camping', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#00FF82'),
(52, 1, 'Temporaire', 'manifestation temporaire, mach├®', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#7F7F7F'),
(72, 1, 'Commerce', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#FF2A00'),
(73, 0, 'Usage', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(74, 73, 'Chauffage', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(75, 73, 'Eclairage', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(76, 73, 'Ascenceur(s)', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(77, 73, 'Ventilation', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(78, 73, 'Equipement speciaux', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(79, 73, 'Eau Chaude', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(80, 73, 'Refroidissement', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(81, 73, 'Auxilliaires', 'Pompes, Ventilateurs', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(82, 73, 'Divers (Prises..)', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(103, 1, 'Maison de retraite', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#8F8F8F'),
(104, 1, 'Piscine ext├®rieure', 'Piscine estivale en ext├®rieur', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#00FFFA'),
(108, 1, 'Espaces verts', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#00FF0B'),
(109, 36, 'Association', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#6699cc'),
(110, 7, 'Gestion de l''eau', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(111, 7, 'Camping', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(112, 12, 'V├®hicule de service', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(113, 12, 'Travaux / gros mat├®riel', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(115, 1, 'LNC', 'Locaux Non Chauff├®s', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(116, 1, 'Salle polyvalente', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(117, 39, 'Fioul', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(120, 8, 'Monuments', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(123, 1, 'Restauration collective', 'cuisine scolaire, sociale', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(124, 1, 'Industriel', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(125, 1, 'Entrepot', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(126, 7, 'Arrosage', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(127, 7, 'Sportif', 'Insallations sportives non baties', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(129, 36, 'R├®gie - Syndicat', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#cc9933'),
(130, 7, 'Chaufferie', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(131, 9, 'R├®seau de chaleur', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(132, 36, 'Particulier', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#663300'),
(133, 1, 'Mus├®e', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(136, 7, 'Agricole', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(137, 9, 'Electricit├®', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(138, 9, 'Eau potabilis├®e', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(139, 9, 'Eau ├®pur├®e', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(140, 7, 'Douches de plage', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(141, 0, 'Labels', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(144, 141, 'RT2005', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(145, 141, 'BBC', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(146, 141, 'RT2000', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(147, 141, 'RT2012', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000'),
(148, 141, 'PASSIVHAUS', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '#000000');

-- --------------------------------------------------------

--
-- Structure de la table `compteur`
--

CREATE TABLE IF NOT EXISTS `compteur` (
  `CompteurID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(45) DEFAULT NULL,
  `Reference` varchar(45) DEFAULT NULL,
  `Numero` varchar(45) DEFAULT NULL,
  `EnergieID` int(11) DEFAULT '1',
  `FournisseurID` int(11) DEFAULT NULL,
  `Localisation` varchar(250) DEFAULT NULL,
  `Nomprestataire` varchar(45) DEFAULT NULL,
  `Seuil` decimal(11,2) DEFAULT NULL,
  `Commentaire` text,
  `Caracteristique` varchar(45) DEFAULT NULL,
  `Objectif` decimal(11,2) DEFAULT NULL,
  `Estenergie` tinyint(1) DEFAULT NULL,
  `Clos` tinyint(1) DEFAULT '0',
  `BaseID` char(36) NOT NULL,
  `MouvrageID` int(11) NOT NULL,
  `Reference2` varchar(45) DEFAULT NULL,
  `Type` enum('CONSO','CONSOEAU','CONSOLIEPROD','MP','PROD','PRODEAU','FABRICATION') NOT NULL DEFAULT 'CONSO',
  `CompteurprodID` int(11) DEFAULT NULL,
  PRIMARY KEY (`CompteurID`,`BaseID`),
  KEY `Compteurs_belong_to_Energie` (`EnergieID`),
  KEY `indexNom` (`Nom`),
  KEY `belong_to_Base` (`BaseID`),
  KEY `MouvrageID` (`MouvrageID`),
  KEY `FournisseurID` (`FournisseurID`),
  KEY `CompteurprodID` (`CompteurprodID`),
  KEY `CompteurprodID_2` (`CompteurprodID`),
  KEY `Reference` (`Reference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `compteur`
--

INSERT INTO `compteur` (`CompteurID`, `Nom`, `Reference`, `Numero`, `EnergieID`, `FournisseurID`, `Localisation`, `Nomprestataire`, `Seuil`, `Commentaire`, `Caracteristique`, `Objectif`, `Estenergie`, `Clos`, `BaseID`, `MouvrageID`, `Reference2`, `Type`, `CompteurprodID`) VALUES
(2, 'C_eau espace vert 1 ', '090305', '000034116', 5, 3, 'B.A ESPACE VERT FACE ANCIEN AEROPERT BEN', NULL, NULL, NULL, NULL, NULL, 1, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, 'CONSOEAU', NULL),
(3, 'gaz (propane)', '1', '111111', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, NULL, 'CONSO', NULL),
(4, 'pdt conseil mu', '028783', '008300114', 5, 3, 'ROYAL TENIS CLUB AV.HASSAN II     ', NULL, NULL, NULL, NULL, NULL, 1, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, 'CONSO', NULL),
(5, 'stade inbiat', '028783', '008300114', 5, 3, 'STADE AL INBIAAT AV HASSAN     ', NULL, NULL, NULL, NULL, NULL, 1, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, 'CONSOEAU', NULL),
(6, 'marché mu poissons', '124515', '009000434', 5, 3, 'MARCHE MUNICIPAL DE POISSONS AGADIR     ', NULL, NULL, NULL, NULL, NULL, 1, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, 'CONSOEAU', NULL),
(7, 'camping mu', '111655', '204400095', 5, 3, 'CAMPING MUNICIPAL D''AGADIR BD.MED', NULL, NULL, NULL, NULL, NULL, 1, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, 'CONSOEAU', NULL),
(10, 'C_gas 109742 j', '1', '001', 9, 4, '109742 j', NULL, NULL, NULL, NULL, NULL, 1, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, 'CONSO', NULL),
(11, 'C_gas 116346 j', '2', '002', 9, 5, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, 'CONSO', NULL),
(12, 'C_gas 163698 j', '3', '003', 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, 'CONSO', NULL),
(13, 'C_gas 62379 j', '4', '004', 9, 4, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, 'CONSO', NULL),
(14, 'C_gas 79529 J', '5', '005', 9, 8, NULL, NULL, '9000.00', NULL, NULL, NULL, 1, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, 'CONSO', NULL),
(15, 'Cpt_ Av. Al Mouquaouama', '11', '0001', 1, 3, ' E.P marché gros Av. Al Mouquaouama', NULL, NULL, NULL, NULL, NULL, 1, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, 'CONSO', NULL),
(16, 'Cpt_E.P poste hôtel Mabrouk', '2400102', '0002', 1, 3, ' hôtel Mabrouk', NULL, NULL, NULL, NULL, NULL, 1, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, 'CONSO', NULL),
(17, 'Cpt_Jardin du parc commemoratif', '2663760', '0003', 1, 3, 'Jardin du parc commemoratif', NULL, NULL, NULL, NULL, NULL, 1, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, 'CONSO', NULL),
(18, 'Cpt_Marché poisson II', '3546287', '0004', 1, 3, 'Marché poisson II', NULL, NULL, NULL, NULL, NULL, 1, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, 'CONSO', NULL),
(19, 'Cpt_placetaxi', '2624332', '0005', 1, 3, 'Place des taxis', NULL, NULL, NULL, NULL, NULL, 1, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, 'CONSO', NULL),
(20, 'camping mu', NULL, NULL, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, 'CONSO', NULL),
(22, 'qsd', '', NULL, 22, 8, '', NULL, '0.00', '', NULL, '0.00', 0, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 13, '', 'CONSO', NULL),
(23, 'qsd', '', NULL, 22, 8, '', NULL, '0.00', '', NULL, '0.00', 0, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 13, '', 'CONSO', NULL),
(24, 'qsd', '', NULL, 22, 8, '', NULL, '0.00', '', NULL, '0.00', 0, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 13, '', 'CONSO', NULL),
(28, 'dqdqsd', '', NULL, 5, 8, '', NULL, '2000.00', 'dqsd\r\nqsdqsdqsd', NULL, '0.00', 1, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 13, '', 'CONSOEAU', NULL),
(29, 'sqdqsd', '', '', 15, 8, 'qsdqd', NULL, '0.00', '', NULL, '0.00', 0, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, '', 'CONSO', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `compteurautrepostes`
--

CREATE TABLE IF NOT EXISTS `compteurautrepostes` (
  `AutreposteID` int(11) NOT NULL DEFAULT '0',
  `CompteurID` int(11) NOT NULL DEFAULT '0',
  `BaseID` char(36) NOT NULL,
  `Pourcentage` int(11) DEFAULT '100',
  PRIMARY KEY (`AutreposteID`,`CompteurID`,`BaseID`),
  KEY `CompteurAutreposte_belong_to_Autreposte` (`AutreposteID`),
  KEY `CompteurAutreposte_belong_to_Compteur` (`CompteurID`),
  KEY `belong_to_Base` (`BaseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `compteurbatiments`
--

CREATE TABLE IF NOT EXISTS `compteurbatiments` (
  `BatimentID` int(11) NOT NULL DEFAULT '0',
  `CompteurID` int(11) NOT NULL DEFAULT '0',
  `BaseID` char(36) NOT NULL,
  `Pourcentage` int(11) DEFAULT '100',
  PRIMARY KEY (`BatimentID`,`CompteurID`,`BaseID`),
  KEY `CompteurBatiment_belong_to_Batiment` (`BatimentID`),
  KEY `CompteurBatiment_belong_to_Compteur` (`CompteurID`),
  KEY `belong_to_Base` (`BaseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `compteurbatiments`
--

INSERT INTO `compteurbatiments` (`BatimentID`, `CompteurID`, `BaseID`, `Pourcentage`) VALUES
(2, 3, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(5, 2, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(6, 5, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(7, 4, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(8, 6, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(9, 7, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(9, 29, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(12, 5, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(12, 6, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(12, 17, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(12, 20, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(12, 28, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(13, 2, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(13, 6, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(13, 11, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(13, 20, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100);

-- --------------------------------------------------------

--
-- Structure de la table `compteureclairages`
--

CREATE TABLE IF NOT EXISTS `compteureclairages` (
  `EclairageID` int(11) NOT NULL DEFAULT '0',
  `CompteurID` int(11) NOT NULL DEFAULT '0',
  `BaseID` char(36) NOT NULL,
  `Pourcentage` int(11) DEFAULT '100',
  PRIMARY KEY (`EclairageID`,`CompteurID`,`BaseID`),
  KEY `CompteurEclairage_belong_to_Eclairage` (`EclairageID`),
  KEY `CompteurEclairage_belong_to_Compteur` (`CompteurID`),
  KEY `belong_to_Base` (`BaseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `compteureclairages`
--

INSERT INTO `compteureclairages` (`EclairageID`, `CompteurID`, `BaseID`, `Pourcentage`) VALUES
(1, 19, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(2, 15, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(3, 16, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(4, 17, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(4, 28, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 50),
(5, 18, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100);

-- --------------------------------------------------------

--
-- Structure de la table `compteurespaceverts`
--

CREATE TABLE IF NOT EXISTS `compteurespaceverts` (
  `EspacevertID` int(11) NOT NULL DEFAULT '0',
  `CompteurID` int(11) NOT NULL DEFAULT '0',
  `BaseID` char(36) NOT NULL,
  `Pourcentage` int(11) DEFAULT '100',
  PRIMARY KEY (`EspacevertID`,`CompteurID`,`BaseID`),
  KEY `CompteurEspacevert_belong_to_Espacevert` (`EspacevertID`),
  KEY `CompteurEspacevert_belong_to_Compteur` (`CompteurID`),
  KEY `belong_to_Base` (`BaseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `compteurespaceverts`
--

INSERT INTO `compteurespaceverts` (`EspacevertID`, `CompteurID`, `BaseID`, `Pourcentage`) VALUES
(2, 3, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(2, 28, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(5, 2, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(6, 5, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(7, 4, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(8, 6, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(9, 7, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(12, 5, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(12, 6, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(12, 17, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(12, 20, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(12, 28, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(13, 2, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(13, 6, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(13, 11, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(13, 20, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(14, 2, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(14, 6, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(14, 16, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(14, 20, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100);

-- --------------------------------------------------------

--
-- Structure de la table `compteurposteproductions`
--

CREATE TABLE IF NOT EXISTS `compteurposteproductions` (
  `PosteproductionID` int(11) NOT NULL DEFAULT '0',
  `CompteurID` int(11) NOT NULL DEFAULT '0',
  `BaseID` char(36) NOT NULL,
  `Pourcentage` int(11) DEFAULT '100',
  PRIMARY KEY (`PosteproductionID`,`CompteurID`,`BaseID`),
  KEY `Compteurposteproduction_belong_to_posteproduction` (`PosteproductionID`),
  KEY `Compteurposteproduction_belong_to_Compteur` (`CompteurID`),
  KEY `belong_to_Base` (`BaseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `compteurposteproductions`
--

INSERT INTO `compteurposteproductions` (`PosteproductionID`, `CompteurID`, `BaseID`, `Pourcentage`) VALUES
(2, 15, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(2, 17, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(3, 16, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(3, 17, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100);

-- --------------------------------------------------------

--
-- Structure de la table `compteurvehicules`
--

CREATE TABLE IF NOT EXISTS `compteurvehicules` (
  `VehiculeID` int(11) NOT NULL DEFAULT '0',
  `CompteurID` int(11) NOT NULL DEFAULT '0',
  `BaseID` char(36) NOT NULL,
  `Pourcentage` int(11) DEFAULT '100',
  PRIMARY KEY (`VehiculeID`,`CompteurID`,`BaseID`),
  KEY `CompteurVehicule_belong_to_Vehicule` (`VehiculeID`),
  KEY `CompteurVehicule_belong_to_Compteur` (`CompteurID`),
  KEY `belong_to_Base` (`BaseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `compteurvehicules`
--

INSERT INTO `compteurvehicules` (`VehiculeID`, `CompteurID`, `BaseID`, `Pourcentage`) VALUES
(2, 11, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(3, 12, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(4, 13, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(5, 14, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100),
(6, 10, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 100);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `compteur_affecte`
--
CREATE TABLE IF NOT EXISTS `compteur_affecte` (
`MouvrageID` int(11)
,`Mouvrage` varchar(45)
,`Compteur` varchar(45)
,`Numero_Compteur` varchar(45)
,`ID_Compteur` int(11)
,`Pourcentage_Bat` int(11)
,`Batiment` varchar(45)
,`Pourcentage_Ecl` int(11)
,`Eclairage` varchar(45)
,`Pourcentage_Veh` int(11)
,`Vehicule` varchar(45)
,`Pourcentage_Prod` int(11)
,`Production` varchar(45)
,`Pourcentage_Autre` int(11)
,`Autre` varchar(45)
,`Localisation` varchar(250)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `compteur_affecte_autre`
--
CREATE TABLE IF NOT EXISTS `compteur_affecte_autre` (
`MouvrageID` int(11)
,`Mouvrage` varchar(45)
,`Compteur` varchar(45)
,`Numero_Compteur` varchar(45)
,`ID_Compteur` int(11)
,`Pourcentage_Autre` int(11)
,`Autre` varchar(45)
,`Localisation` varchar(250)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `compteur_affecte_batiment`
--
CREATE TABLE IF NOT EXISTS `compteur_affecte_batiment` (
`MouvrageID` int(11)
,`Mouvrage` varchar(45)
,`Compteur` varchar(45)
,`Numero_Compteur` varchar(45)
,`ID_Compteur` int(11)
,`Pourcentage_Bat` int(11)
,`Batiment` varchar(45)
,`Localisation` varchar(250)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `compteur_affecte_eclairage`
--
CREATE TABLE IF NOT EXISTS `compteur_affecte_eclairage` (
`MouvrageID` int(11)
,`Mouvrage` varchar(45)
,`Compteur` varchar(45)
,`Numero_Compteur` varchar(45)
,`ID_Compteur` int(11)
,`Pourcentage_Ecl` int(11)
,`Eclairage` varchar(45)
,`Localisation` varchar(250)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `compteur_affecte_production`
--
CREATE TABLE IF NOT EXISTS `compteur_affecte_production` (
`MouvrageID` int(11)
,`Mouvrage` varchar(45)
,`Compteur` varchar(45)
,`Numero_Compteur` varchar(45)
,`ID_Compteur` int(11)
,`Pourcentage_Prod` int(11)
,`Production` varchar(45)
,`Localisation` varchar(250)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `compteur_non_affecte`
--
CREATE TABLE IF NOT EXISTS `compteur_non_affecte` (
`MouvrageID` int(11)
,`Mouvrage_Nom` varchar(45)
,`CompteurID` int(11)
,`Compteur_Nom` varchar(45)
,`Compteur_Localisation` varchar(250)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `compteur_tarif`
--
CREATE TABLE IF NOT EXISTS `compteur_tarif` (
`MouvrageID` int(11)
,`Mouvrage` varchar(45)
,`Compteur` varchar(45)
,`Numero_Compteur` varchar(45)
,`ID_Compteur` int(11)
,`Localisation` varchar(250)
,`PsouscriteID` int(11)
,`Puissance` decimal(11,2)
,`Puissance2` decimal(11,2)
,`HCE` decimal(11,2)
,`HCH` decimal(11,2)
,`HPE` decimal(11,2)
,`HPH` decimal(11,2)
,`HPD` decimal(11,2)
,`HCD` decimal(11,2)
,`Reduite` decimal(11,2)
,`Debutcontrat` date
,`Fincontrat` date
,`Tarif` varchar(45)
,`ZoneTarif` varchar(255)
,`Commentaires` text
);
-- --------------------------------------------------------

--
-- Structure de la table `coordonnee`
--

CREATE TABLE IF NOT EXISTS `coordonnee` (
  `CoordonneeID` int(11) NOT NULL AUTO_INCREMENT,
  `Type` enum('MO','BE','Fournisseur','Utilisateur') NOT NULL,
  `Nom` varchar(45) DEFAULT NULL,
  `Prenom` varchar(45) DEFAULT NULL,
  `Societe` varchar(45) DEFAULT NULL,
  `Tel` varchar(45) DEFAULT NULL,
  `Portable` varchar(45) DEFAULT NULL,
  `Mail` varchar(45) DEFAULT NULL,
  `Adresse1` varchar(45) DEFAULT NULL,
  `Adresse2` varchar(45) DEFAULT NULL,
  `Adresse3` varchar(45) DEFAULT NULL,
  `Codepostal` int(11) DEFAULT NULL,
  `Ville` varchar(45) DEFAULT NULL,
  `Pays` varchar(45) DEFAULT NULL,
  `Site` varchar(45) DEFAULT NULL,
  `Logo` varchar(45) DEFAULT NULL,
  `Commentaire` text,
  `MouvrageID` int(11) DEFAULT NULL,
  `UtilisateurID` int(11) DEFAULT NULL,
  `BaseID` char(36) NOT NULL,
  PRIMARY KEY (`CoordonneeID`,`BaseID`),
  KEY `indexste` (`Societe`),
  KEY `indexNom` (`Nom`),
  KEY `belong_to_Base` (`BaseID`),
  KEY `MouvrageID` (`MouvrageID`),
  KEY `UtilisateurID` (`UtilisateurID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `coordonnee`
--

INSERT INTO `coordonnee` (`CoordonneeID`, `Type`, `Nom`, `Prenom`, `Societe`, `Tel`, `Portable`, `Mail`, `Adresse1`, `Adresse2`, `Adresse3`, `Codepostal`, `Ville`, `Pays`, `Site`, `Logo`, `Commentaire`, `MouvrageID`, `UtilisateurID`, `BaseID`) VALUES
(1, 'BE', 'ME TEST', 'ME TEST', 'ME TEST', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<span style="white-space: pre" class="Apple-tab-span">	</span>', NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2, 'MO', 'Contact 1 Societé 1', NULL, 'Société 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<span style="white-space: pre" class="Apple-tab-span">		</span>', 2, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(3, 'Fournisseur', 'Contact ONEE', NULL, 'ONEE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Agadir', 'Maroc', NULL, NULL, NULL, 2, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(4, 'Fournisseur', 'CONTACT PETROM', NULL, 'PETROM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Agadir', 'Maroc', NULL, NULL, NULL, 2, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(5, 'Fournisseur', 'CONTACT SHELL', NULL, 'SHELL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Agadir', 'Maroc', NULL, NULL, NULL, 2, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(8, 'Fournisseur', 'CONTACT OLIBYA', NULL, 'OLIBYA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f');

-- --------------------------------------------------------

--
-- Structure de la table `dataface__failed_logins`
--

CREATE TABLE IF NOT EXISTS `dataface__failed_logins` (
  `attempt_id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `time_of_attempt` int(11) NOT NULL,
  PRIMARY KEY (`attempt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `dataface__mtimes`
--

CREATE TABLE IF NOT EXISTS `dataface__mtimes` (
  `name` varchar(255) NOT NULL,
  `mtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `dataface__mtimes`
--

INSERT INTO `dataface__mtimes` (`name`, `mtime`) VALUES
('batiment', 1413917298),
('compteur', 1413918427),
('compteurbatiments', 1413805793),
('compteureclairages', 1413891792),
('compteurvehicules', 1413889066),
('coordonnee', 1413798062),
('descriptif', 1413805723),
('eclairage', 1413891351),
('exemplarite', 1409914094),
('facture', 1413892053),
('moan', 1413806080),
('mouvrage', 1409905131),
('psouscrite', 1413882122),
('roles', 1409903862),
('vehicule', 1413889171);

-- --------------------------------------------------------

--
-- Structure de la table `dataface__preferences`
--

CREATE TABLE IF NOT EXISTS `dataface__preferences` (
  `pref_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `table` varchar(128) NOT NULL,
  `record_id` varchar(255) NOT NULL,
  `key` varchar(128) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`pref_id`),
  KEY `username` (`username`),
  KEY `table` (`table`),
  KEY `record_id` (`record_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `dataface__record_mtimes`
--

CREATE TABLE IF NOT EXISTS `dataface__record_mtimes` (
  `recordhash` varchar(32) NOT NULL,
  `recordid` varchar(255) NOT NULL,
  `mtime` int(11) NOT NULL,
  PRIMARY KEY (`recordhash`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `dataface__record_mtimes`
--

INSERT INTO `dataface__record_mtimes` (`recordhash`, `recordid`, `mtime`) VALUES
('013c2cceb23b6501139f640888538bdc', 'batiment?BatimentID=4&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1409887119),
('07a3d91212c17f209c0a7feb9f9a9632', 'facture?FactureID=8&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413883690),
('0aa97a7b1f4c652761722850457ca3c6', 'facture?FactureID=7&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413882291),
('0b87a34d37890c2c6315ecbeaa601dd5', 'facture?FactureID=20&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413883500),
('1a2158220baabb06d4e990ef0e560491', 'vehicule?VehiculeID=4&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413889171),
('1eaacb1c549bc725a137a06607c8e94c', 'coordonnee?CoordonneeID=1&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1403769117),
('2e6d943c4b48a1c964f2ae702085f0ad', 'facture?FactureID=5&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413883645),
('354a2760e95b855c0d7ea0390f018f0f', 'facture?FactureID=48&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413890772),
('3cd3bad8d005dd94b91b87d51a8aca88', 'facture?FactureID=18&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413883199),
('3f6d8ab4ca3c69961c56360f9f6495ec', 'batiment?BatimentID=7&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413917298),
('476cf4315b0a51d20c15051ed52a2423', 'compteur?CompteurID=2&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413883931),
('47a80d7d1dd09eae538e677cabcf13c0', 'facture?FactureID=12&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413882738),
('4a70b86f54a59c71b5cb777771afa6fa', 'compteur?CompteurID=13&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413889196),
('4e6729b11ab0ca0010ad6f10f6cf975d', 'vehicule?VehiculeID=6&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413886618),
('56c620cfc789d2fb97a96b3c55bf0bf3', 'facture?FactureID=9&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413883793),
('5740be435342704cefad93657dc47e61', 'facture?FactureID=6&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413883025),
('5ce8feba347f1789fbd4a5258179e58e', 'roles?Username=cua&record_id=2&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1409903862),
('5e80a3ffe598a8ba16c1a3cf954014b7', 'vehicule?VehiculeID=5&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413822254),
('5fe1d3238dfd91c8d9852b13fed59966', 'mouvrage?MouvrageID=2&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1409692725),
('608782c0d7d1a8b1744d9a383881192b', 'facture?FactureID=21&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413883563),
('6501ac94f4bdbb8c7f8139a93fe16523', 'eclairage?EclairageID=5&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413891351),
('6b1fa9ea062afbc38c256200560006fd', 'compteur?CompteurID=1&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1409906973),
('6d9625cb0b7356bfc741a243fad68a40', 'facture?FactureID=22&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413883598),
('7a8d84fbf7cea531c7b52b5352f3b683', 'facture?FactureID=56&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413891574),
('7d444dd7d589336ad083d305de9dd1d6', 'facture?FactureID=10&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413883860),
('7f7d978ab681ffddddd62c2f8001b161', 'facture?FactureID=13&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413882771),
('7ffc516e9c3c4a126c10cd39f5154bdd', 'facture?FactureID=17&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413883083),
('82b6bfa1e6cb8e0710106adadd8b93d2', 'facture?FactureID=15&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413882372),
('868d806e7be2ec84b77c71ab7ac6ca17', 'compteur?CompteurID=11&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413887167),
('878fbd32e43de0d89a422c6f0dc68de9', 'vehicule?VehiculeID=2&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413887021),
('8c063b00b81da085004fcf284cfd6255', 'batiment?BatimentID=6&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413827464),
('9eb97024112243a0b356de57eb633d4b', 'facture?FactureID=19&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413883229),
('a51ed80ec07e0592c50eaf0fc5ee1908', 'facture?FactureID=14&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413882324),
('b2a52945b9a40a054de75b9ca07e0c8c', 'facture?FactureID=11&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413882692),
('b4fdc941d026a146182651fb2f633a78', 'coordonnee?CoordonneeID=3&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413796200),
('c0f6b4fb9abab3c93f5d00dae427e4f0', 'facture?FactureID=4&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413883451),
('c5c018f658dfe8c3c623150672a7e487', 'compteur?CompteurID=14&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413889106),
('cadebf090250886a88fb0fd1e5ebaf1c', 'moan?MoanID=1&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1409906522),
('cbac2cc1dbb1bde5ecc33e6c09495cd4', 'batiment?BatimentID=8&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413827409),
('d38e86f6accfb70684929186a95b3367', 'mouvrage?MouvrageID=1&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1409905131),
('e0a9a0386c2ec2bb319a5749dfe55ecd', 'facture?FactureID=3&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413882484),
('e0e16bf8876c8b151ae8e5cdd3bb14d4', 'descriptif?DescriptifID=2&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1409840172),
('e40724e363795c356d310d52e95d0eda', 'facture?FactureID=33&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413888456),
('e43fcb9352263d7b6a7491e4a25e3c62', 'compteur?CompteurID=17&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413891819),
('e85f958fd82213155991538fbf1988bb', 'facture?FactureID=16&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413882399),
('e962f95267cc70366694e8360c0c68d0', 'compteur?CompteurID=7&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413824782),
('f4b5d0cd7dee2af89af8a7ea57f97c2d', 'batiment?BatimentID=5&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413827384),
('fa67a525e16a1bf7c5de22d6d95cb7fd', 'batiment?BatimentID=9&BaseID=8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1413827349);

-- --------------------------------------------------------

--
-- Structure de la table `dataface__version`
--

CREATE TABLE IF NOT EXISTS `dataface__version` (
  `version` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `dataface__version`
--

INSERT INTO `dataface__version` (`version`) VALUES
(0);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_accueil_28027921ea3b08043d0e0d5372201f20`
--
CREATE TABLE IF NOT EXISTS `dataface__view_accueil_28027921ea3b08043d0e0d5372201f20` (
`accueil_id` int(11)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_actionengagee_0d4f97da70e2bc89fa5e91bca22ae619`
--
CREATE TABLE IF NOT EXISTS `dataface__view_actionengagee_0d4f97da70e2bc89fa5e91bca22ae619` (
`ActionengageeID` int(11)
,`BatimentID` int(11)
,`MouvrageID` int(11)
,`BaseID` char(36)
,`Date` date
,`EvolutionID` int(11)
,`Cout` decimal(11,2)
,`Surface` int(11)
,`Commentaire` text
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_actionengagee_712e1e78f6e1c4e13b93d6517c418be6`
--
CREATE TABLE IF NOT EXISTS `dataface__view_actionengagee_712e1e78f6e1c4e13b93d6517c418be6` (
`ActionengageeID` int(11)
,`BatimentID` int(11)
,`MouvrageID` int(11)
,`BaseID` char(36)
,`Date` date
,`EvolutionID` int(11)
,`Cout` decimal(11,2)
,`Surface` int(11)
,`Commentaire` text
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_autreposte_c1566a2a24da30de02d3828003944da1`
--
CREATE TABLE IF NOT EXISTS `dataface__view_autreposte_c1566a2a24da30de02d3828003944da1` (
`AutreposteID` int(11)
,`CategorieID` int(11)
,`Nom` varchar(45)
,`Anneeconstruction` int(4)
,`cadastre` varchar(45)
,`latitude` varchar(15)
,`longitude` varchar(15)
,`commentaire` text
,`CoordonneeID` int(11)
,`adresse1` varchar(45)
,`adresse2` varchar(45)
,`adresse3` varchar(45)
,`codepostal` int(11)
,`Ville` varchar(45)
,`Pays` varchar(45)
,`MouvrageID` int(11)
,`Puissance` decimal(11,2)
,`Descriptif` text
,`BaseID` char(36)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_autreposte_c421863e3d91d75472fac12f54abeb4f`
--
CREATE TABLE IF NOT EXISTS `dataface__view_autreposte_c421863e3d91d75472fac12f54abeb4f` (
`AutreposteID` int(11)
,`CategorieID` int(11)
,`Nom` varchar(45)
,`Anneeconstruction` int(4)
,`cadastre` varchar(45)
,`latitude` varchar(15)
,`longitude` varchar(15)
,`commentaire` text
,`CoordonneeID` int(11)
,`adresse1` varchar(45)
,`adresse2` varchar(45)
,`adresse3` varchar(45)
,`codepostal` int(11)
,`Ville` varchar(45)
,`Pays` varchar(45)
,`MouvrageID` int(11)
,`Puissance` decimal(11,2)
,`Descriptif` text
,`BaseID` char(36)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_batiment_4a3369a9c22eeeb49520da4b66c4a043`
--
CREATE TABLE IF NOT EXISTS `dataface__view_batiment_4a3369a9c22eeeb49520da4b66c4a043` (
`BatimentID` int(11)
,`MouvrageID` int(11)
,`Nom` varchar(45)
,`Anneeconstruction` int(4)
,`Patrimoine` int(11)
,`Voisinage` int(11)
,`Orientation` int(11)
,`Exposition` int(11)
,`altitude` int(11)
,`BaseID` char(36)
,`Cadastre` varchar(45)
,`Latitude` varchar(15)
,`Longitude` varchar(15)
,`StationdjuID` int(11)
,`StationmeteoID` int(11)
,`Commentaire` text
,`CoordonneeID` int(11)
,`Adresse1` varchar(45)
,`Adresse2` varchar(45)
,`Adresse3` varchar(45)
,`Codepostal` int(11)
,`Ville` varchar(45)
,`Pays` varchar(45)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_batiment_12c411a70a79a2bd94b7632c7837aab2`
--
CREATE TABLE IF NOT EXISTS `dataface__view_batiment_12c411a70a79a2bd94b7632c7837aab2` (
`BatimentID` int(11)
,`MouvrageID` int(11)
,`Nom` varchar(45)
,`Anneeconstruction` int(4)
,`Patrimoine` int(11)
,`Voisinage` int(11)
,`Orientation` int(11)
,`Exposition` int(11)
,`altitude` int(11)
,`BaseID` char(36)
,`Cadastre` varchar(45)
,`Latitude` varchar(15)
,`Longitude` varchar(15)
,`StationdjuID` int(11)
,`StationmeteoID` int(11)
,`Commentaire` text
,`CoordonneeID` int(11)
,`Adresse1` varchar(45)
,`Adresse2` varchar(45)
,`Adresse3` varchar(45)
,`Codepostal` int(11)
,`Ville` varchar(45)
,`Pays` varchar(45)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_batiment_434b21e9bf46389cd4e33fb6ce678939`
--
CREATE TABLE IF NOT EXISTS `dataface__view_batiment_434b21e9bf46389cd4e33fb6ce678939` (
`BatimentID` int(11)
,`MouvrageID` int(11)
,`Nom` varchar(45)
,`Anneeconstruction` int(4)
,`Patrimoine` int(11)
,`Voisinage` int(11)
,`Orientation` int(11)
,`Exposition` int(11)
,`altitude` int(11)
,`BaseID` char(36)
,`Cadastre` varchar(45)
,`Latitude` varchar(15)
,`Longitude` varchar(15)
,`StationdjuID` int(11)
,`StationmeteoID` int(11)
,`Commentaire` text
,`CoordonneeID` int(11)
,`Adresse1` varchar(45)
,`Adresse2` varchar(45)
,`Adresse3` varchar(45)
,`Codepostal` int(11)
,`Ville` varchar(45)
,`Pays` varchar(45)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_categorie_4f2d077f55396fbfc7eeb70cc930bbe9`
--
CREATE TABLE IF NOT EXISTS `dataface__view_categorie_4f2d077f55396fbfc7eeb70cc930bbe9` (
`CategorieID` int(11)
,`CategorieparenteID` int(11)
,`Libelle` varchar(50)
,`Description` varchar(250)
,`BaseID` char(36)
,`Couleur` varchar(7)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_compteur_8bf742c12cda589979d01913d7517953`
--
CREATE TABLE IF NOT EXISTS `dataface__view_compteur_8bf742c12cda589979d01913d7517953` (
`CompteurID` int(11)
,`Nom` varchar(45)
,`Reference` varchar(45)
,`Numero` varchar(45)
,`EnergieID` int(11)
,`FournisseurID` int(11)
,`Localisation` varchar(250)
,`Nomprestataire` varchar(45)
,`Seuil` decimal(11,2)
,`Commentaire` text
,`Caracteristique` varchar(45)
,`Objectif` decimal(11,2)
,`Estenergie` tinyint(1)
,`Clos` tinyint(1)
,`BaseID` char(36)
,`MouvrageID` int(11)
,`Reference2` varchar(45)
,`Type` enum('CONSO','CONSOEAU','CONSOLIEPROD','MP','PROD','PRODEAU','FABRICATION')
,`CompteurprodID` int(11)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_compteur_26c107b172a7ed615129b0259bdf6b17`
--
CREATE TABLE IF NOT EXISTS `dataface__view_compteur_26c107b172a7ed615129b0259bdf6b17` (
`CompteurID` int(11)
,`Nom` varchar(45)
,`Reference` varchar(45)
,`Numero` varchar(45)
,`EnergieID` int(11)
,`FournisseurID` int(11)
,`Localisation` varchar(250)
,`Nomprestataire` varchar(45)
,`Seuil` decimal(11,2)
,`Commentaire` text
,`Caracteristique` varchar(45)
,`Objectif` decimal(11,2)
,`Estenergie` tinyint(1)
,`Clos` tinyint(1)
,`BaseID` char(36)
,`MouvrageID` int(11)
,`Reference2` varchar(45)
,`Type` enum('CONSO','CONSOEAU','CONSOLIEPROD','MP','PROD','PRODEAU','FABRICATION')
,`CompteurprodID` int(11)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_compteur_898a1f385c185fc387c0f9c71721f4c7`
--
CREATE TABLE IF NOT EXISTS `dataface__view_compteur_898a1f385c185fc387c0f9c71721f4c7` (
`CompteurID` int(11)
,`Nom` varchar(45)
,`Reference` varchar(45)
,`Numero` varchar(45)
,`EnergieID` int(11)
,`FournisseurID` int(11)
,`Localisation` varchar(250)
,`Nomprestataire` varchar(45)
,`Seuil` decimal(11,2)
,`Commentaire` text
,`Caracteristique` varchar(45)
,`Objectif` decimal(11,2)
,`Estenergie` tinyint(1)
,`Clos` tinyint(1)
,`BaseID` char(36)
,`MouvrageID` int(11)
,`Reference2` varchar(45)
,`Type` enum('CONSO','CONSOEAU','CONSOLIEPROD','MP','PROD','PRODEAU','FABRICATION')
,`CompteurprodID` int(11)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_coordonnee_864c78aa1ccc92fe0e8519f381bcc312`
--
CREATE TABLE IF NOT EXISTS `dataface__view_coordonnee_864c78aa1ccc92fe0e8519f381bcc312` (
`CoordonneeID` int(11)
,`Type` enum('MO','BE','Fournisseur','Utilisateur')
,`Nom` varchar(45)
,`Prenom` varchar(45)
,`Societe` varchar(45)
,`Tel` varchar(45)
,`Portable` varchar(45)
,`Mail` varchar(45)
,`Adresse1` varchar(45)
,`Adresse2` varchar(45)
,`Adresse3` varchar(45)
,`Codepostal` int(11)
,`Ville` varchar(45)
,`Pays` varchar(45)
,`Site` varchar(45)
,`Logo` varchar(45)
,`Commentaire` text
,`MouvrageID` int(11)
,`UtilisateurID` int(11)
,`BaseID` char(36)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_coordonnee_885a4136bc1092cdfe6024ea2c611548`
--
CREATE TABLE IF NOT EXISTS `dataface__view_coordonnee_885a4136bc1092cdfe6024ea2c611548` (
`CoordonneeID` int(11)
,`Type` enum('MO','BE','Fournisseur','Utilisateur')
,`Nom` varchar(45)
,`Prenom` varchar(45)
,`Societe` varchar(45)
,`Tel` varchar(45)
,`Portable` varchar(45)
,`Mail` varchar(45)
,`Adresse1` varchar(45)
,`Adresse2` varchar(45)
,`Adresse3` varchar(45)
,`Codepostal` int(11)
,`Ville` varchar(45)
,`Pays` varchar(45)
,`Site` varchar(45)
,`Logo` varchar(45)
,`Commentaire` text
,`MouvrageID` int(11)
,`UtilisateurID` int(11)
,`BaseID` char(36)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_decoupagevirtuel_9b5ba870d89527015436db4093d58288`
--
CREATE TABLE IF NOT EXISTS `dataface__view_decoupagevirtuel_9b5ba870d89527015436db4093d58288` (
`DecoupagevirtuelID` int(11)
,`CompteurID` int(11)
,`Nom` varchar(45)
,`Usage1` varchar(45)
,`Pourcentage1` int(3)
,`Usage2` varchar(45)
,`Pourcentage2` int(3)
,`Usage3` varchar(45)
,`Pourcentage3` int(3)
,`Usage4` varchar(45)
,`Pourcentage4` int(3)
,`Usage5` varchar(45)
,`Pourcentage5` int(3)
,`Usage6` varchar(45)
,`Pourcentage6` int(3)
,`BaseID` char(36)
,`MouvrageID` int(11)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_decoupagevirtuel_460e77297c62819facea552b9350ec39`
--
CREATE TABLE IF NOT EXISTS `dataface__view_decoupagevirtuel_460e77297c62819facea552b9350ec39` (
`DecoupagevirtuelID` int(11)
,`CompteurID` int(11)
,`Nom` varchar(45)
,`Usage1` varchar(45)
,`Pourcentage1` int(3)
,`Usage2` varchar(45)
,`Pourcentage2` int(3)
,`Usage3` varchar(45)
,`Pourcentage3` int(3)
,`Usage4` varchar(45)
,`Pourcentage4` int(3)
,`Usage5` varchar(45)
,`Pourcentage5` int(3)
,`Usage6` varchar(45)
,`Pourcentage6` int(3)
,`BaseID` char(36)
,`MouvrageID` int(11)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_descriptif_ac371d52a1ed58a5890cc3bcc5eb0dc7`
--
CREATE TABLE IF NOT EXISTS `dataface__view_descriptif_ac371d52a1ed58a5890cc3bcc5eb0dc7` (
`DescriptifID` int(11)
,`BatimentID` int(11)
,`MouvrageID` int(11)
,`BaseID` char(36)
,`Date` date
,`Surface` int(11)
,`Surfacechauffee` int(11)
,`Nbrniveaux` int(11)
,`CategorieID` int(11)
,`Tempsusage` int(11)
,`Frequentation` int(11)
,`Commentaires` text
,`Toiture` int(11)
,`Toitureiso` int(11)
,`Mur` int(11)
,`Muriso` int(11)
,`Plancher` int(11)
,`Plancheriso` int(11)
,`Fenetre` int(11)
,`Vitrage` int(11)
,`Precisionbati` text
,`Chauffageener` int(11)
,`Chauffagesysteme` int(11)
,`Chauffagepuissance` int(11)
,`Programmation` tinyint(4)
,`Robinets` tinyint(4)
,`Climatisation` int(11)
,`Eauchaude` int(11)
,`Ventilation` int(11)
,`Eclairage` int(11)
,`Eclairagepuissance` int(11)
,`Electropuissance` int(11)
,`Industrielpuissance` int(11)
,`Precisionequipement` text
,`Photo` varchar(45)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_descriptif_f44ad248a637e15c6d0d3369eec833fd`
--
CREATE TABLE IF NOT EXISTS `dataface__view_descriptif_f44ad248a637e15c6d0d3369eec833fd` (
`DescriptifID` int(11)
,`BatimentID` int(11)
,`MouvrageID` int(11)
,`BaseID` char(36)
,`Date` date
,`Surface` int(11)
,`Surfacechauffee` int(11)
,`Nbrniveaux` int(11)
,`CategorieID` int(11)
,`Tempsusage` int(11)
,`Frequentation` int(11)
,`Commentaires` text
,`Toiture` int(11)
,`Toitureiso` int(11)
,`Mur` int(11)
,`Muriso` int(11)
,`Plancher` int(11)
,`Plancheriso` int(11)
,`Fenetre` int(11)
,`Vitrage` int(11)
,`Precisionbati` text
,`Chauffageener` int(11)
,`Chauffagesysteme` int(11)
,`Chauffagepuissance` int(11)
,`Programmation` tinyint(4)
,`Robinets` tinyint(4)
,`Climatisation` int(11)
,`Eauchaude` int(11)
,`Ventilation` int(11)
,`Eclairage` int(11)
,`Eclairagepuissance` int(11)
,`Electropuissance` int(11)
,`Industrielpuissance` int(11)
,`Precisionequipement` text
,`Photo` varchar(45)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_diagnostique_7a9576b3932313b8f0acb1204d4c93c1`
--
CREATE TABLE IF NOT EXISTS `dataface__view_diagnostique_7a9576b3932313b8f0acb1204d4c93c1` (
`DiagnostiqueID` int(11)
,`BureauetudeID` int(11)
,`BatimentID` int(11)
,`Date` date
,`BaseID` char(36)
,`MouvrageID` int(11)
,`Nom` varchar(45)
,`Prenom` varchar(45)
,`Toiture` tinyint(4)
,`Mur` tinyint(4)
,`Plancher` tinyint(4)
,`Menuiserie` tinyint(4)
,`Chauffage` tinyint(4)
,`Ecs` tinyint(4)
,`Ventilation` tinyint(4)
,`Climatisation` tinyint(4)
,`Eclairage` tinyint(4)
,`Qualiteair` tinyint(4)
,`Confortete` tinyint(4)
,`Conforthiver` tinyint(4)
,`Etancheite` tinyint(4)
,`Acoustique` tinyint(4)
,`Commentaire` text
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_diagnostique_a238feee333d75c0bc9e62c33f743fd0`
--
CREATE TABLE IF NOT EXISTS `dataface__view_diagnostique_a238feee333d75c0bc9e62c33f743fd0` (
`DiagnostiqueID` int(11)
,`BureauetudeID` int(11)
,`BatimentID` int(11)
,`Date` date
,`BaseID` char(36)
,`MouvrageID` int(11)
,`Nom` varchar(45)
,`Prenom` varchar(45)
,`Toiture` tinyint(4)
,`Mur` tinyint(4)
,`Plancher` tinyint(4)
,`Menuiserie` tinyint(4)
,`Chauffage` tinyint(4)
,`Ecs` tinyint(4)
,`Ventilation` tinyint(4)
,`Climatisation` tinyint(4)
,`Eclairage` tinyint(4)
,`Qualiteair` tinyint(4)
,`Confortete` tinyint(4)
,`Conforthiver` tinyint(4)
,`Etancheite` tinyint(4)
,`Acoustique` tinyint(4)
,`Commentaire` text
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_eclairage_6df0542b09f13aebeea9f123d8eacb98`
--
CREATE TABLE IF NOT EXISTS `dataface__view_eclairage_6df0542b09f13aebeea9f123d8eacb98` (
`EclairageID` int(11)
,`CategorieID` int(11)
,`Nom` varchar(45)
,`Puissance` decimal(11,2)
,`Puissancemesuree` decimal(11,2)
,`Nbrpointlumineux` int(11)
,`Kmeclaires` decimal(11,2)
,`NbrHeuresans` int(11)
,`Declencheur` varchar(250)
,`Luminosite` decimal(11,2)
,`Descriptif` text
,`BaseID` char(36)
,`MouvrageID` int(11)
,`Anneeconstruction` int(4)
,`StationdjuID` int(11)
,`StationmeteoID` int(11)
,`Commentaire` text
,`CoordonneeID` int(11)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_eclairage_55a4190ab5a25411019976e08dc97c7e`
--
CREATE TABLE IF NOT EXISTS `dataface__view_eclairage_55a4190ab5a25411019976e08dc97c7e` (
`EclairageID` int(11)
,`CategorieID` int(11)
,`Nom` varchar(45)
,`Puissance` decimal(11,2)
,`Puissancemesuree` decimal(11,2)
,`Nbrpointlumineux` int(11)
,`Kmeclaires` decimal(11,2)
,`NbrHeuresans` int(11)
,`Declencheur` varchar(250)
,`Luminosite` decimal(11,2)
,`Descriptif` text
,`BaseID` char(36)
,`MouvrageID` int(11)
,`Anneeconstruction` int(4)
,`StationdjuID` int(11)
,`StationmeteoID` int(11)
,`Commentaire` text
,`CoordonneeID` int(11)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_exemplarite_60692de20b116ba490381e70f631df0c`
--
CREATE TABLE IF NOT EXISTS `dataface__view_exemplarite_60692de20b116ba490381e70f631df0c` (
`ExemplariteID` int(11)
,`BaseID` char(36)
,`MouvrageID` int(11)
,`BatimentID` int(11)
,`UtilisateurID` int(11)
,`Date` date
,`AccordMO` tinyint(1)
,`Commentaire` text
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_exemplarite_d29e0375c1bcf991ebdddd32fd3b62e3`
--
CREATE TABLE IF NOT EXISTS `dataface__view_exemplarite_d29e0375c1bcf991ebdddd32fd3b62e3` (
`ExemplariteID` int(11)
,`BaseID` char(36)
,`MouvrageID` int(11)
,`BatimentID` int(11)
,`UtilisateurID` int(11)
,`Date` date
,`AccordMO` tinyint(1)
,`Commentaire` text
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_facture_340c3a19a66b6bac5536e40956430996`
--
CREATE TABLE IF NOT EXISTS `dataface__view_facture_340c3a19a66b6bac5536e40956430996` (
`FactureID` int(11)
,`CompteurID` int(11)
,`Nom` varchar(45)
,`FournisseurID` int(11)
,`Debutperiode` date
,`Finperiode` date
,`Abonnement` decimal(11,2)
,`Consommation` decimal(11,2)
,`Totalttc` decimal(11,2)
,`Commentaire` varchar(250)
,`Prixunitaire` decimal(11,2)
,`Estimation` tinyint(1)
,`Consokwh` decimal(11,2)
,`Coefficient` decimal(11,2)
,`Consohpleines` decimal(11,2)
,`Consohcreuses` decimal(11,2)
,`Consopete` decimal(11,2)
,`Consocete` decimal(11,2)
,`Consophiver` decimal(11,2)
,`Consochiver` float(11,2)
,`HN` decimal(11,2)
,`HPM` decimal(11,2)
,`Consopointe` decimal(11,2)
,`Hygro` decimal(11,2)
,`Patteintepointe` decimal(11,2)
,`Patteintehp` decimal(11,2)
,`Patteintehc` decimal(11,2)
,`Eactivehp` decimal(11,2)
,`Eactivehc` decimal(11,2)
,`Ereactive` decimal(11,2)
,`Tangeante` decimal(11,2)
,`BaseID` char(36)
,`MouvrageID` int(11)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_facture_c21410caa637c2c25a5a2ea2c181885f`
--
CREATE TABLE IF NOT EXISTS `dataface__view_facture_c21410caa637c2c25a5a2ea2c181885f` (
`FactureID` int(11)
,`CompteurID` int(11)
,`Nom` varchar(45)
,`FournisseurID` int(11)
,`Debutperiode` date
,`Finperiode` date
,`Abonnement` decimal(11,2)
,`Consommation` decimal(11,2)
,`Totalttc` decimal(11,2)
,`Commentaire` varchar(250)
,`Prixunitaire` decimal(11,2)
,`Estimation` tinyint(1)
,`Consokwh` decimal(11,2)
,`Coefficient` decimal(11,2)
,`Consohpleines` decimal(11,2)
,`Consohcreuses` decimal(11,2)
,`Consopete` decimal(11,2)
,`Consocete` decimal(11,2)
,`Consophiver` decimal(11,2)
,`Consochiver` float(11,2)
,`HN` decimal(11,2)
,`HPM` decimal(11,2)
,`Consopointe` decimal(11,2)
,`Hygro` decimal(11,2)
,`Patteintepointe` decimal(11,2)
,`Patteintehp` decimal(11,2)
,`Patteintehc` decimal(11,2)
,`Eactivehp` decimal(11,2)
,`Eactivehc` decimal(11,2)
,`Ereactive` decimal(11,2)
,`Tangeante` decimal(11,2)
,`BaseID` char(36)
,`MouvrageID` int(11)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_label_065cdced51be1d3a33be7acd689f5ba0`
--
CREATE TABLE IF NOT EXISTS `dataface__view_label_065cdced51be1d3a33be7acd689f5ba0` (
`LabelID` int(11)
,`CategorieID` int(11)
,`Date` date
,`Certifie` tinyint(1)
,`Coeff1` decimal(7,3)
,`Coeffref1` decimal(7,3)
,`Coeff2` decimal(7,3)
,`Coeffref2` decimal(7,3)
,`Coeff3` decimal(7,3)
,`Coeffref3` decimal(7,3)
,`Permeabilite` varchar(45)
,`Inertie` varchar(45)
,`Commentaire` text
,`BatimentID` int(11)
,`MouvrageID` int(11)
,`BaseID` char(36)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_label_9e52a3dc34e827b7932801e642c676bb`
--
CREATE TABLE IF NOT EXISTS `dataface__view_label_9e52a3dc34e827b7932801e642c676bb` (
`LabelID` int(11)
,`CategorieID` int(11)
,`Date` date
,`Certifie` tinyint(1)
,`Coeff1` decimal(7,3)
,`Coeffref1` decimal(7,3)
,`Coeff2` decimal(7,3)
,`Coeffref2` decimal(7,3)
,`Coeff3` decimal(7,3)
,`Coeffref3` decimal(7,3)
,`Permeabilite` varchar(45)
,`Inertie` varchar(45)
,`Commentaire` text
,`BatimentID` int(11)
,`MouvrageID` int(11)
,`BaseID` char(36)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_moan_3ed2c22553d1dfb24887652ccd30a144`
--
CREATE TABLE IF NOT EXISTS `dataface__view_moan_3ed2c22553d1dfb24887652ccd30a144` (
`MoanID` int(11)
,`MouvrageID` int(11)
,`Annee` year(4)
,`Frequentation` decimal(11,2)
,`Typefrequentation` enum('Habitants','Nuitees','Visiteurs','Salaries','Unites')
,`Budget` decimal(11,2)
,`Objectif` decimal(11,2)
,`BaseID` char(36)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_moan_6e6d9d8ec7c903b395635929da51cdaa`
--
CREATE TABLE IF NOT EXISTS `dataface__view_moan_6e6d9d8ec7c903b395635929da51cdaa` (
`MoanID` int(11)
,`MouvrageID` int(11)
,`Annee` year(4)
,`Frequentation` decimal(11,2)
,`Typefrequentation` enum('Habitants','Nuitees','Visiteurs','Salaries','Unites')
,`Budget` decimal(11,2)
,`Objectif` decimal(11,2)
,`BaseID` char(36)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_mouvrage_02faeb78a6d3d7b7f8fead5d15877ebf`
--
CREATE TABLE IF NOT EXISTS `dataface__view_mouvrage_02faeb78a6d3d7b7f8fead5d15877ebf` (
`MouvrageID` int(11)
,`CategorieID` int(11)
,`BureauetudeID` int(11)
,`Logo` varchar(90)
,`Commentaire` text
,`Societe` varchar(45)
,`Codepostal` int(11)
,`Ville` varchar(45)
,`BaseID` char(36)
,`StationdjuID` int(11)
,`StationmeteoID` int(11)
,`Estmodifie` tinyint(4)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_mouvrage_67c18b470d468662b4f3e4a62a66eb13`
--
CREATE TABLE IF NOT EXISTS `dataface__view_mouvrage_67c18b470d468662b4f3e4a62a66eb13` (
`MouvrageID` int(11)
,`CategorieID` int(11)
,`BureauetudeID` int(11)
,`Logo` varchar(90)
,`Commentaire` text
,`Societe` varchar(45)
,`Codepostal` int(11)
,`Ville` varchar(45)
,`BaseID` char(36)
,`StationdjuID` int(11)
,`StationmeteoID` int(11)
,`Estmodifie` tinyint(4)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_mouvrage_edec652162f8dc1f5ecf7839c9ef3423`
--
CREATE TABLE IF NOT EXISTS `dataface__view_mouvrage_edec652162f8dc1f5ecf7839c9ef3423` (
`MouvrageID` int(11)
,`CategorieID` int(11)
,`BureauetudeID` int(11)
,`Logo` varchar(90)
,`Commentaire` text
,`Societe` varchar(45)
,`Codepostal` int(11)
,`Ville` varchar(45)
,`BaseID` char(36)
,`StationdjuID` int(11)
,`StationmeteoID` int(11)
,`Estmodifie` tinyint(4)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_posteproduction_08575c5718b7bd6d41d3b49d8c6ed0a9`
--
CREATE TABLE IF NOT EXISTS `dataface__view_posteproduction_08575c5718b7bd6d41d3b49d8c6ed0a9` (
`PosteproductionID` int(11)
,`CategorieID` int(11)
,`MouvrageID` int(11)
,`Nom` varchar(45)
,`Description` text
,`Productiontheorique` decimal(11,2)
,`Coutinitial` int(11)
,`BaseID` char(36)
,`Anneeconstruction` int(4)
,`Cadastre` varchar(45)
,`Latitude` varchar(15)
,`Longitude` varchar(15)
,`StationdjuID` int(11)
,`StationmeteoID` int(11)
,`Commentaire` text
,`CoordonneeID` int(11)
,`Adresse1` varchar(45)
,`Adresse2` varchar(45)
,`Adresse3` varchar(45)
,`Codepostal` int(11)
,`Ville` varchar(45)
,`Pays` varchar(45)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_posteproduction_6583aefb8611bc459f58f9803bd032ea`
--
CREATE TABLE IF NOT EXISTS `dataface__view_posteproduction_6583aefb8611bc459f58f9803bd032ea` (
`PosteproductionID` int(11)
,`CategorieID` int(11)
,`MouvrageID` int(11)
,`Nom` varchar(45)
,`Description` text
,`Productiontheorique` decimal(11,2)
,`Coutinitial` int(11)
,`BaseID` char(36)
,`Anneeconstruction` int(4)
,`Cadastre` varchar(45)
,`Latitude` varchar(15)
,`Longitude` varchar(15)
,`StationdjuID` int(11)
,`StationmeteoID` int(11)
,`Commentaire` text
,`CoordonneeID` int(11)
,`Adresse1` varchar(45)
,`Adresse2` varchar(45)
,`Adresse3` varchar(45)
,`Codepostal` int(11)
,`Ville` varchar(45)
,`Pays` varchar(45)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_psouscrite_5bcb074267888ad422694477d9fe7c38`
--
CREATE TABLE IF NOT EXISTS `dataface__view_psouscrite_5bcb074267888ad422694477d9fe7c38` (
`PsouscriteID` int(11)
,`Puissance` decimal(11,2)
,`Puissancejaune` decimal(11,2)
,`Pointe` decimal(11,2)
,`Heurescreusesete` decimal(11,2)
,`Heurescreuseshiver` decimal(11,2)
,`Heurespleinesete` decimal(11,2)
,`Heurespleineshiver` decimal(11,2)
,`Heurespleinedemi` decimal(11,2)
,`Heurescreusesdemi` decimal(11,2)
,`Reduite` decimal(11,2)
,`BaseID` char(36)
,`MouvrageID` int(11)
,`CompteurID` int(11)
,`Debutcontrat` date
,`Fincontrat` date
,`Tarif` int(11)
,`Zonetarif` varchar(255)
,`Commentaires` text
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_psouscrite_9a0f14b892391b8abb60ed16b91f9691`
--
CREATE TABLE IF NOT EXISTS `dataface__view_psouscrite_9a0f14b892391b8abb60ed16b91f9691` (
`PsouscriteID` int(11)
,`Puissance` decimal(11,2)
,`Puissancejaune` decimal(11,2)
,`Pointe` decimal(11,2)
,`Heurescreusesete` decimal(11,2)
,`Heurescreuseshiver` decimal(11,2)
,`Heurespleinesete` decimal(11,2)
,`Heurespleineshiver` decimal(11,2)
,`Heurespleinedemi` decimal(11,2)
,`Heurescreusesdemi` decimal(11,2)
,`Reduite` decimal(11,2)
,`BaseID` char(36)
,`MouvrageID` int(11)
,`CompteurID` int(11)
,`Debutcontrat` date
,`Fincontrat` date
,`Tarif` int(11)
,`Zonetarif` varchar(255)
,`Commentaires` text
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_resultatbatiment_11f8ad56f45f303f6ab45f9ceb9171ac`
--
CREATE TABLE IF NOT EXISTS `dataface__view_resultatbatiment_11f8ad56f45f303f6ab45f9ceb9171ac` (
`Annee` year(4)
,`BatimentID` int(11)
,`MouvrageID` int(11)
,`CategorieID` int(11)
,`Surfacechauffee` int(11)
,`Consoef` decimal(11,2)
,`Consoep` decimal(11,2)
,`Ttc` decimal(11,2)
,`Consoeau` decimal(11,2)
,`Ttceau` decimal(11,2)
,`Emissionges` decimal(11,2)
,`Consoefm2` decimal(11,2)
,`Consoepm2` decimal(11,2)
,`Ttcm2` decimal(11,2)
,`Emissiongesm2` decimal(11,2)
,`Consoeaum2` decimal(11,2)
,`Ttceaum2` decimal(11,2)
,`Datemaj` timestamp
,`BaseID` char(36)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_resultatbatiment_cea84ec126486e1f648dbcb090d30ff3`
--
CREATE TABLE IF NOT EXISTS `dataface__view_resultatbatiment_cea84ec126486e1f648dbcb090d30ff3` (
`Annee` year(4)
,`BatimentID` int(11)
,`MouvrageID` int(11)
,`CategorieID` int(11)
,`Surfacechauffee` int(11)
,`Consoef` decimal(11,2)
,`Consoep` decimal(11,2)
,`Ttc` decimal(11,2)
,`Consoeau` decimal(11,2)
,`Ttceau` decimal(11,2)
,`Emissionges` decimal(11,2)
,`Consoefm2` decimal(11,2)
,`Consoepm2` decimal(11,2)
,`Ttcm2` decimal(11,2)
,`Emissiongesm2` decimal(11,2)
,`Consoeaum2` decimal(11,2)
,`Ttceaum2` decimal(11,2)
,`Datemaj` timestamp
,`BaseID` char(36)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_resultatbatiment_d4527356e7581dbf2706722a00c93c91`
--
CREATE TABLE IF NOT EXISTS `dataface__view_resultatbatiment_d4527356e7581dbf2706722a00c93c91` (
`Annee` year(4)
,`BatimentID` int(11)
,`MouvrageID` int(11)
,`CategorieID` int(11)
,`Surfacechauffee` int(11)
,`Consoef` decimal(11,2)
,`Consoep` decimal(11,2)
,`Ttc` decimal(11,2)
,`Consoeau` decimal(11,2)
,`Ttceau` decimal(11,2)
,`Emissionges` decimal(11,2)
,`Consoefm2` decimal(11,2)
,`Consoepm2` decimal(11,2)
,`Ttcm2` decimal(11,2)
,`Emissiongesm2` decimal(11,2)
,`Consoeaum2` decimal(11,2)
,`Ttceaum2` decimal(11,2)
,`Datemaj` timestamp
,`BaseID` char(36)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_souscompteur_2e41636f6cdaf32a67765d55afd11992`
--
CREATE TABLE IF NOT EXISTS `dataface__view_souscompteur_2e41636f6cdaf32a67765d55afd11992` (
`SouscompteurID` int(11)
,`CompteurID` int(11)
,`CategorieID` int(11)
,`Nom` varchar(45)
,`Localisation` varchar(45)
,`BaseID` char(36)
,`MouvrageID` int(11)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_souscompteur_3d2037567a2e7e2376b3c9a02cf0b4b8`
--
CREATE TABLE IF NOT EXISTS `dataface__view_souscompteur_3d2037567a2e7e2376b3c9a02cf0b4b8` (
`SouscompteurID` int(11)
,`CompteurID` int(11)
,`CategorieID` int(11)
,`Nom` varchar(45)
,`Localisation` varchar(45)
,`BaseID` char(36)
,`MouvrageID` int(11)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_vehicule_58e520bf1a0e7b40eb119fd90fb9ac41`
--
CREATE TABLE IF NOT EXISTS `dataface__view_vehicule_58e520bf1a0e7b40eb119fd90fb9ac41` (
`VehiculeID` int(11)
,`CategorieID` int(11)
,`MouvrageID` int(11)
,`Nom` varchar(45)
,`Anneeconstruction` int(4)
,`Marque` varchar(45)
,`Modele` varchar(45)
,`Carburant` varchar(45)
,`Puissance` varchar(45)
,`Conso` varchar(45)
,`Commentaire` text
,`CoordonneeID` int(11)
,`BaseID` char(36)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_vehicule_9087105cef5f5e6b6d6cd0dc89c42f46`
--
CREATE TABLE IF NOT EXISTS `dataface__view_vehicule_9087105cef5f5e6b6d6cd0dc89c42f46` (
`VehiculeID` int(11)
,`CategorieID` int(11)
,`MouvrageID` int(11)
,`Nom` varchar(45)
,`Anneeconstruction` int(4)
,`Marque` varchar(45)
,`Modele` varchar(45)
,`Carburant` varchar(45)
,`Puissance` varchar(45)
,`Conso` varchar(45)
,`Commentaire` text
,`CoordonneeID` int(11)
,`BaseID` char(36)
,`Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE')
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `dataface__view_vueexemplarite_df3b0fac98ee20098a8dab1746e8b9fc`
--
CREATE TABLE IF NOT EXISTS `dataface__view_vueexemplarite_df3b0fac98ee20098a8dab1746e8b9fc` (
`ExemplariteID` int(11)
,`BaseID` char(36)
,`MouvrageID` int(11)
,`BatimentID` int(11)
,`UtilisateurID` int(11)
,`Date` date
,`AccordMO` tinyint(1)
,`Commentairedescriptif` text
,`Annee` year(4)
,`CategorieID` int(11)
,`Surfacechauffee` int(11)
,`Consoepm2` decimal(11,2)
,`Consoefm2` decimal(11,2)
,`Ttcm2` decimal(11,2)
,`Emissiongesm2` decimal(11,2)
,`Consoeaum2` decimal(11,2)
,`Ttceaum2` decimal(11,2)
,`Datedescriptif` date
,`Surface` int(11)
,`Nbrniveaux` int(11)
,`Tempsusage` int(11)
,`Toiture` int(11)
,`Frequentation` int(11)
,`Commentaires` text
,`Toitureiso` int(11)
,`Mur` int(11)
,`Muriso` int(11)
,`Plancher` int(11)
,`Plancheriso` int(11)
,`Fenetre` int(11)
,`Vitrage` int(11)
,`Precisionbati` text
,`Chauffageener` int(11)
,`Chauffagesysteme` int(11)
,`Chauffagepuissance` int(11)
,`Programmation` tinyint(4)
,`Robinets` tinyint(4)
,`Climatisation` int(11)
,`Eauchaude` int(11)
,`Ventilation` int(11)
,`Eclairage` int(11)
,`Eclairagepuissance` int(11)
,`Electropuissance` int(11)
,`Industrielpuissance` int(11)
,`Precisionequipement` text
,`Photo` varchar(45)
,`Nom` varchar(45)
,`Anneeconstruction` int(4)
,`Voisinage` int(11)
,`Orientation` int(11)
,`Exposition` int(11)
,`altitude` int(11)
,`StationdjuID` int(11)
,`commentaire` text
);
-- --------------------------------------------------------

--
-- Structure de la table `decoupagevirtuel`
--

CREATE TABLE IF NOT EXISTS `decoupagevirtuel` (
  `DecoupagevirtuelID` int(11) NOT NULL AUTO_INCREMENT,
  `CompteurID` int(11) NOT NULL,
  `Nom` varchar(45) NOT NULL,
  `Usage1` varchar(45) DEFAULT NULL,
  `Pourcentage1` int(3) DEFAULT NULL,
  `Usage2` varchar(45) DEFAULT NULL,
  `Pourcentage2` int(3) DEFAULT NULL,
  `Usage3` varchar(45) DEFAULT NULL,
  `Pourcentage3` int(3) DEFAULT NULL,
  `Usage4` varchar(45) DEFAULT NULL,
  `Pourcentage4` int(3) DEFAULT NULL,
  `Usage5` varchar(45) DEFAULT NULL,
  `Pourcentage5` int(3) DEFAULT NULL,
  `Usage6` varchar(45) DEFAULT NULL,
  `Pourcentage6` int(3) DEFAULT NULL,
  `BaseID` char(36) NOT NULL,
  `MouvrageID` int(11) NOT NULL,
  PRIMARY KEY (`DecoupagevirtuelID`,`BaseID`),
  KEY `belong_to_Base` (`BaseID`),
  KEY `CompteurID` (`CompteurID`),
  KEY `MouvrageID` (`MouvrageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `descriptif`
--

CREATE TABLE IF NOT EXISTS `descriptif` (
  `DescriptifID` int(11) NOT NULL AUTO_INCREMENT,
  `BatimentID` int(11) NOT NULL,
  `MouvrageID` int(11) NOT NULL,
  `BaseID` char(36) NOT NULL,
  `Date` date DEFAULT NULL,
  `Surface` int(11) DEFAULT NULL,
  `Surfacechauffee` int(11) DEFAULT NULL,
  `Nbrniveaux` int(11) DEFAULT NULL,
  `CategorieID` int(11) NOT NULL,
  `Tempsusage` int(11) DEFAULT NULL,
  `Frequentation` int(11) DEFAULT NULL,
  `Commentaires` text,
  `Toiture` int(11) DEFAULT NULL,
  `Toitureiso` int(11) DEFAULT NULL,
  `Mur` int(11) DEFAULT NULL,
  `Muriso` int(11) DEFAULT NULL,
  `Plancher` int(11) DEFAULT NULL,
  `Plancheriso` int(11) DEFAULT NULL,
  `Fenetre` int(11) DEFAULT NULL,
  `Vitrage` int(11) DEFAULT NULL,
  `Precisionbati` text,
  `Chauffageener` int(11) DEFAULT NULL,
  `Chauffagesysteme` int(11) DEFAULT NULL,
  `Chauffagepuissance` int(11) DEFAULT NULL,
  `Programmation` tinyint(4) DEFAULT NULL,
  `Robinets` tinyint(4) DEFAULT NULL,
  `Climatisation` int(11) DEFAULT NULL,
  `Eauchaude` int(11) DEFAULT NULL,
  `Ventilation` int(11) DEFAULT NULL,
  `Eclairage` int(11) DEFAULT NULL,
  `Eclairagepuissance` int(11) DEFAULT NULL,
  `Electropuissance` int(11) DEFAULT NULL,
  `Industrielpuissance` int(11) DEFAULT NULL,
  `Precisionequipement` text,
  `Photo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`DescriptifID`,`BaseID`),
  KEY `BatimentID` (`BatimentID`),
  KEY `indexDate` (`Date`),
  KEY `belong_to_Base` (`BaseID`),
  KEY `MouvrageID` (`MouvrageID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `descriptif`
--

INSERT INTO `descriptif` (`DescriptifID`, `BatimentID`, `MouvrageID`, `BaseID`, `Date`, `Surface`, `Surfacechauffee`, `Nbrniveaux`, `CategorieID`, `Tempsusage`, `Frequentation`, `Commentaires`, `Toiture`, `Toitureiso`, `Mur`, `Muriso`, `Plancher`, `Plancheriso`, `Fenetre`, `Vitrage`, `Precisionbati`, `Chauffageener`, `Chauffagesysteme`, `Chauffagepuissance`, `Programmation`, `Robinets`, `Climatisation`, `Eauchaude`, `Ventilation`, `Eclairage`, `Eclairagepuissance`, `Electropuissance`, `Industrielpuissance`, `Precisionequipement`, `Photo`) VALUES
(2, 2, 1, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '1970-01-01', 800, 500, NULL, 3, 6000, 500, NULL, 117, 51, 66, 52, 82, 53, 104, 105, NULL, 7, 19, 300000, 2, 1, 35, 31, 42, 46, 12800, 98005, NULL, NULL, NULL),
(3, 3, 1, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '1990-01-01', 1000, 600, 3, 72, 8700, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 4, 1, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '2000-01-01', 300, 150, 11, 44, 8760, 100, NULL, 118, 51, 60, 52, 82, 53, 5, 105, NULL, 4, 54, NULL, 1, 2, 35, 31, 40, 46, 12800, 1000, 1000, NULL, NULL),
(5, 6, 2, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '1900-01-01', 4000, 1000, NULL, 4, NULL, 20000, NULL, 2, 7, 3, 8, 4, 9, 5, 6, NULL, 1, 10, NULL, 1, 1, 11, 12, 13, 50, NULL, NULL, NULL, NULL, NULL),
(6, 7, 2, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '1900-01-01', 2500, 700, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 8, 2, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '1900-01-01', 500, NULL, 1, 72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 9, 2, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '1900-01-01', 3000, NULL, NULL, 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `diagnostique`
--

CREATE TABLE IF NOT EXISTS `diagnostique` (
  `DiagnostiqueID` int(11) NOT NULL AUTO_INCREMENT,
  `BureauetudeID` int(11) NOT NULL,
  `BatimentID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `BaseID` char(36) NOT NULL,
  `MouvrageID` int(11) NOT NULL,
  `Nom` varchar(45) NOT NULL,
  `Prenom` varchar(45) NOT NULL,
  `Toiture` tinyint(4) DEFAULT NULL,
  `Mur` tinyint(4) DEFAULT NULL,
  `Plancher` tinyint(4) DEFAULT NULL,
  `Menuiserie` tinyint(4) DEFAULT NULL,
  `Chauffage` tinyint(4) DEFAULT NULL,
  `Ecs` tinyint(4) DEFAULT NULL,
  `Ventilation` tinyint(4) DEFAULT NULL,
  `Climatisation` tinyint(4) DEFAULT NULL,
  `Eclairage` tinyint(4) DEFAULT NULL,
  `Qualiteair` tinyint(4) DEFAULT NULL,
  `Confortete` tinyint(4) DEFAULT NULL,
  `Conforthiver` tinyint(4) DEFAULT NULL,
  `Etancheite` tinyint(4) DEFAULT NULL,
  `Acoustique` tinyint(4) DEFAULT NULL,
  `Commentaire` text,
  PRIMARY KEY (`DiagnostiqueID`,`BaseID`),
  KEY `Diagnostique_belong_to_Patrimoine` (`BatimentID`),
  KEY `Diagnostique_belong_to_be` (`BureauetudeID`),
  KEY `belong_to_Base` (`BaseID`),
  KEY `MouvrageID` (`MouvrageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `djuan`
--

CREATE TABLE IF NOT EXISTS `djuan` (
  `DjuanID` int(11) NOT NULL AUTO_INCREMENT,
  `StationdjuID` int(11) DEFAULT NULL,
  `Annee` year(4) DEFAULT NULL,
  `Somme` int(11) DEFAULT NULL,
  `Janvier` int(11) DEFAULT NULL,
  `Fevrier` int(11) DEFAULT NULL,
  `Mars` int(11) DEFAULT NULL,
  `Avril` int(11) DEFAULT NULL,
  `Mai` int(11) DEFAULT NULL,
  `Juin` int(11) DEFAULT NULL,
  `Juillet` int(11) DEFAULT NULL,
  `Aout` int(11) DEFAULT NULL,
  `Septembre` int(11) DEFAULT NULL,
  `Octobre` int(11) DEFAULT NULL,
  `Novembre` int(11) DEFAULT NULL,
  `Decembre` int(11) DEFAULT NULL,
  `Commentaire` varchar(255) DEFAULT NULL,
  `BaseID` char(36) NOT NULL,
  PRIMARY KEY (`DjuanID`,`BaseID`),
  KEY `djuans_belong_to_Stationsdju` (`StationdjuID`),
  KEY `indexAnnee` (`Annee`),
  KEY `belong_to_Base` (`BaseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `djutrentenaire`
--

CREATE TABLE IF NOT EXISTS `djutrentenaire` (
  `StationdjuID` int(11) NOT NULL DEFAULT '0',
  `Datedebutserie` year(4) NOT NULL,
  `Datefinserie` year(4) NOT NULL,
  `Somme` int(11) DEFAULT NULL,
  `Janvier` int(11) DEFAULT NULL,
  `Fevrier` int(11) DEFAULT NULL,
  `Mars` int(11) DEFAULT NULL,
  `Avril` int(11) DEFAULT NULL,
  `Mai` int(11) DEFAULT NULL,
  `Juin` int(11) DEFAULT NULL,
  `Juillet` int(11) DEFAULT NULL,
  `Aout` int(11) DEFAULT NULL,
  `Septembre` int(11) DEFAULT NULL,
  `Octobre` int(11) DEFAULT NULL,
  `Novembre` int(11) DEFAULT NULL,
  `Decembre` int(11) DEFAULT NULL,
  `Commentaire` varchar(255) DEFAULT NULL,
  `BaseID` char(36) NOT NULL,
  PRIMARY KEY (`StationdjuID`,`BaseID`),
  KEY `djutrentenaire_belong_to_Stationsdju` (`StationdjuID`),
  KEY `belong_to_Base` (`BaseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `eclairage`
--

CREATE TABLE IF NOT EXISTS `eclairage` (
  `EclairageID` int(11) NOT NULL AUTO_INCREMENT,
  `CategorieID` int(11) DEFAULT NULL,
  `Nom` varchar(45) NOT NULL,
  `Puissance` decimal(11,2) DEFAULT NULL,
  `Puissancemesuree` decimal(11,2) DEFAULT NULL,
  `Nbrpointlumineux` int(11) DEFAULT NULL,
  `Kmeclaires` decimal(11,2) DEFAULT NULL,
  `NbrHeuresans` int(11) DEFAULT NULL,
  `Declencheur` varchar(250) DEFAULT NULL,
  `Luminosite` decimal(11,2) DEFAULT NULL,
  `Descriptif` text,
  `BaseID` char(36) NOT NULL DEFAULT 'BASEZZ',
  `MouvrageID` int(11) NOT NULL,
  `Anneeconstruction` int(4) DEFAULT NULL,
  `StationdjuID` int(11) DEFAULT NULL,
  `StationmeteoID` int(11) DEFAULT NULL,
  `Commentaire` text,
  `CoordonneeID` int(11) DEFAULT NULL,
  `TypeTechnologie` int(11) NOT NULL,
  `MarqueLampe` varchar(200) NOT NULL,
  `NbrJourInterrupServ` int(11) NOT NULL,
  `NbrJourIntervServ` int(11) NOT NULL,
  PRIMARY KEY (`EclairageID`,`BaseID`),
  KEY `eclairages_bt_Categorie` (`CategorieID`),
  KEY `indexPuissance` (`Puissance`),
  KEY `belong_to_Base` (`BaseID`),
  KEY `NOM` (`Nom`),
  KEY `MouvrageID` (`MouvrageID`),
  KEY `MouvrageID_2` (`MouvrageID`),
  KEY `CoordonneeID` (`CoordonneeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `eclairage`
--

INSERT INTO `eclairage` (`EclairageID`, `CategorieID`, `Nom`, `Puissance`, `Puissancemesuree`, `Nbrpointlumineux`, `Kmeclaires`, `NbrHeuresans`, `Declencheur`, `Luminosite`, `Descriptif`, `BaseID`, `MouvrageID`, `Anneeconstruction`, `StationdjuID`, `StationmeteoID`, `Commentaire`, `CoordonneeID`, `TypeTechnologie`, `MarqueLampe`, `NbrJourInterrupServ`, `NbrJourIntervServ`) VALUES
(1, 17, 'Place des taxis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL, NULL, NULL, NULL, 0, '', 0, 0),
(2, 17, 'E.P marché gros Av. Al Mouquaouama', '0.00', NULL, 10, NULL, 0, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL, NULL, NULL, NULL, 1, '', 0, 0),
(3, 17, 'E.P poste hôtel Mabrouk	', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL, NULL, NULL, NULL, 0, '', 0, 0),
(4, 120, 'Jardin du parc commemoratif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL, NULL, NULL, NULL, 0, '', 0, 0),
(5, 17, 'Marché poisson II ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL, NULL, NULL, NULL, 0, '', 0, 0),
(6, 120, 'qsdqd', '200.00', '300.00', 10, '20.00', 2000, 'auto', NULL, 'qsdqsd\r\nqsd\r\nqsdqsdqsd', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, 1980, NULL, NULL, 'qsdq sdqsdqsd\r\nqsdqsdqs', 2, 0, '', 0, 0),
(7, 17, 'sdfs', '0.00', NULL, 0, NULL, 0, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL, NULL, NULL, NULL, 1, '', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `energie`
--

CREATE TABLE IF NOT EXISTS `energie` (
  `EnergieID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(45) DEFAULT NULL,
  `Unite` varchar(45) DEFAULT NULL,
  `Caracsouscrite` varchar(45) DEFAULT NULL,
  `Stock` tinyint(1) DEFAULT NULL,
  `Coefkwhpci` decimal(11,2) DEFAULT NULL,
  `Facteurges` decimal(5,3) DEFAULT NULL,
  `Facteurep` decimal(5,3) DEFAULT NULL,
  `Tauxnucleaire` decimal(5,3) DEFAULT NULL,
  `Tauxfossile` decimal(5,3) DEFAULT NULL,
  `Tauxenr` decimal(5,3) DEFAULT NULL,
  `Prixmaxkwhpci` decimal(11,2) DEFAULT NULL,
  `Seuil` int(11) DEFAULT NULL,
  `Source` varchar(45) DEFAULT NULL,
  `Commentaire` varchar(250) DEFAULT NULL,
  `Pcs` decimal(11,2) DEFAULT NULL,
  `BaseID` char(36) NOT NULL,
  `Est_energie` tinyint(1) NOT NULL DEFAULT '1',
  `Couleur` varchar(7) DEFAULT '#000000',
  PRIMARY KEY (`EnergieID`,`BaseID`),
  KEY `indexNom` (`Nom`),
  KEY `indexunite` (`Unite`),
  KEY `belong_to_Base` (`BaseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=25 ;

--
-- Contenu de la table `energie`
--

INSERT INTO `energie` (`EnergieID`, `Nom`, `Unite`, `Caracsouscrite`, `Stock`, `Coefkwhpci`, `Facteurges`, `Facteurep`, `Tauxnucleaire`, `Tauxfossile`, `Tauxenr`, `Prixmaxkwhpci`, `Seuil`, `Source`, `Commentaire`, `Pcs`, `BaseID`, `Est_energie`, `Couleur`) VALUES
(1, 'Electricit├®', 'kWh', NULL, 0, '1.00', '0.084', '2.580', '0.840', '0.090', '0.070', '0.13', 0, NULL, NULL, '0.00', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, '#FF2A00'),
(2, 'Gaz naturel', 'kWh PCS', NULL, 0, '0.90', '0.230', '1.000', '0.000', '1.000', '0.000', '0.00', 0, NULL, NULL, '0.00', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, '#25FF00'),
(3, 'Bois buches', 'st├¿re', NULL, 0, '1680.00', '0.010', '1.000', '0.000', '0.000', '1.000', '0.00', 0, NULL, NULL, '0.00', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, '#7F2D00'),
(4, 'Fioul', 'litre', NULL, 0, '9.97', '0.300', '1.000', '0.000', '1.000', '0.000', '0.00', 0, NULL, NULL, '0.00', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, '#7B00FF'),
(5, 'Eau', 'm3', NULL, 0, '0.00', '0.000', '0.000', '0.000', '0.000', '0.000', '0.00', 0, NULL, NULL, '0.00', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 0, '#0075FF'),
(6, 'Gaz naturel (m3)', 'm3', '', 0, '11.63', '0.230', '1.000', '0.000', '1.000', '0.000', '0.00', 0, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, '#25FF00'),
(7, 'Propane', 'tonne', '', 0, '13800.00', '0.270', '1.000', '0.000', '1.000', '0.000', '0.08', 0, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, '#158F00'),
(8, 'Butane', 'tonne', '', 0, '12780.00', '0.270', '1.000', '0.000', '1.000', '0.000', '0.00', 0, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, '#093F00'),
(9, 'Gasoil', 'litre', '', 0, '10.58', '0.270', '1.000', '0.000', '1.000', '0.000', '0.00', 0, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, '#000099'),
(10, 'Essence', 'litre', '', 0, '9.85', '0.260', '1.000', '0.000', '1.000', '0.000', '0.00', 0, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, '#000099'),
(11, 'GPL', 'litre', '', 0, '6.94', '0.230', '1.000', '0.000', '1.000', '0.000', '0.00', 0, 'aucune - a v├®rifier', NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, '#BF0B23'),
(12, 'Bois plaquette foresti├¿re t', 'tonne', '', 0, '2760.00', '0.010', '1.000', '0.000', '0.000', '1.000', '0.00', 0, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, '#7F2D00'),
(13, 'Bois plaquette industrie t', 'tonne', '', 0, '2200.00', '0.010', '1.000', '0.000', '0.000', '1.000', '0.00', 0, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, '#7F2D00'),
(14, 'Bois granul├®', 'tonne', '', 0, '4600.00', '0.010', '1.000', '0.000', '0.000', '1.000', '0.00', 0, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, '#7F2D00'),
(15, 'Eau Chaude Solaire', 'kWh PCI', NULL, 0, '1.00', '0.000', '1.000', '0.000', '0.000', '1.000', '0.00', 0, NULL, NULL, '0.00', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, '#FF8000'),
(16, 'Autre (production)', 'Divers', NULL, 0, '0.00', NULL, '0.000', '0.000', '0.000', '0.000', '0.00', 0, NULL, NULL, '0.00', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 0, '#000000'),
(17, 'Reseau de chaleur bois', 'kWh', NULL, 0, '1.00', '0.020', '1.000', '0.000', '0.000', '1.000', '0.00', 0, NULL, NULL, '0.00', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, '#FF6600'),
(18, 'Bois plaquette MAP', 'MAP', NULL, 0, '1080.00', '0.010', '1.000', '0.000', '0.000', '1.000', '0.00', 0, NULL, NULL, '0.00', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, '#000000'),
(19, 'Eau G├®othermique', 'kWh PCI', NULL, 0, '1.00', '0.000', '1.000', '0.000', '0.000', '1.000', '0.00', 0, NULL, NULL, '0.00', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, '#000000'),
(20, 'bouteille propane 13 kgs', 'bouteille', NULL, 0, '179.00', '0.270', '1.000', '0.000', '1.000', '0.000', '0.15', 0, NULL, NULL, '0.00', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, '#000000'),
(21, 'bouteille butane 13 kgs', 'bouteille', NULL, 0, '179.00', '0.270', '1.000', '0.000', '1.000', '0.000', '0.15', 0, NULL, NULL, '0.00', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, '#000000'),
(22, 'Autre (Consommation)', NULL, NULL, 0, '0.00', '0.000', '0.000', '0.000', '0.000', '0.000', '0.00', 0, NULL, NULL, '0.00', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 0, '#000000'),
(23, 'Electricit├® SLC', 'kWh', NULL, 0, '1.00', '0.080', '2.580', '0.840', '0.090', '0.070', '0.13', 0, NULL, NULL, '0.00', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, '#FF2A00'),
(24, 'Propane PCS', 'kWhPCS', NULL, 0, '0.92', '0.270', '1.000', '0.000', '1.000', '0.000', '0.08', 0, NULL, NULL, '0.00', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 1, '#000000');

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

CREATE TABLE IF NOT EXISTS `equipement` (
  `EquipementID` int(11) NOT NULL AUTO_INCREMENT,
  `BaseID` char(36) NOT NULL,
  `Type` enum('TOITURE','MUR','PLANCHER','FENETRE','VITRAGE','ISOLATIONTOITURE','ISOLATIONMUR','ISOLATIONPLANCHER','CHAUFFAGE','CLIMATISATION','ECS','VENTILATION','ECLAIRAGE') NOT NULL,
  `Nom` varchar(45) NOT NULL,
  `Description` text,
  `URL` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`EquipementID`),
  KEY `BaseID` (`BaseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=135 ;

--
-- Contenu de la table `equipement`
--

INSERT INTO `equipement` (`EquipementID`, `BaseID`, `Type`, `Nom`, `Description`, `URL`) VALUES
(2, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'TOITURE', 'Inconnu', NULL, NULL),
(3, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'MUR', 'Inconnu', NULL, NULL),
(4, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'PLANCHER', 'Inconnu', NULL, NULL),
(5, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'FENETRE', 'Inconnu', NULL, NULL),
(6, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'VITRAGE', 'Inconnu', NULL, NULL),
(7, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONTOITURE', 'Inconnu', NULL, NULL),
(8, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONMUR', 'Inconnu', NULL, NULL),
(9, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONPLANCHER', 'Inconnu', NULL, NULL),
(10, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CHAUFFAGE', 'Inconnu', NULL, NULL),
(11, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CLIMATISATION', 'Inconnu', NULL, NULL),
(12, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ECS', 'Inconnu', NULL, NULL),
(13, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'VENTILATION', 'Inconnu', NULL, NULL),
(14, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ECLAIRAGE', 'Inconnu', NULL, NULL),
(15, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CHAUFFAGE', 'Convecteur mobile', NULL, NULL),
(16, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CHAUFFAGE', 'Convecteur mural', NULL, NULL),
(17, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CHAUFFAGE', 'Ventilo-convecteur', NULL, NULL),
(18, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CHAUFFAGE', 'Chaudi├¿re ancienne', NULL, NULL),
(19, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CHAUFFAGE', 'Chaudi├¿re condensation', NULL, NULL),
(20, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CHAUFFAGE', 'Chaudi├¿re condensation BT', NULL, NULL),
(21, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CHAUFFAGE', 'VRV', NULL, NULL),
(22, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CHAUFFAGE', 'Climatiseur r├®versible', NULL, NULL),
(23, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CHAUFFAGE', 'rayonnant cassette', NULL, NULL),
(24, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CHAUFFAGE', 'rayonnant IR', NULL, NULL),
(25, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CHAUFFAGE', 'plancher', NULL, NULL),
(26, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CHAUFFAGE', 'plafond', NULL, NULL),
(27, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ECS', 'Electrique  50 L ou moins', NULL, NULL),
(28, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ECS', 'Electrique 200 L ou moins', NULL, NULL),
(29, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ECS', 'Electrique 300 L ou moins', NULL, NULL),
(30, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ECS', 'Electrique 500 L ou moins', NULL, NULL),
(31, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ECS', 'Electrique  plus de 500 L', NULL, NULL),
(32, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ECS', 'lie au chauffage', NULL, NULL),
(33, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ECS', 'production instantan├®e', NULL, NULL),
(34, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CLIMATISATION', 'Climatiseur gaz', NULL, NULL),
(35, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CLIMATISATION', 'Climatiseur individuel', NULL, NULL),
(36, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CLIMATISATION', 'VRV', NULL, NULL),
(37, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CLIMATISATION', 'plancher', NULL, NULL),
(38, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CLIMATISATION', 'Double flux rafraichissante', NULL, NULL),
(39, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'VENTILATION', 'Extracteur sanitaires', NULL, NULL),
(40, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'VENTILATION', 'Simple flux', NULL, NULL),
(41, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'VENTILATION', 'Simple flux avec introduction fenetres', NULL, NULL),
(42, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'VENTILATION', 'Simple flux avec renouvellement air neuf', NULL, NULL),
(43, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'VENTILATION', 'Simple flux avec renouvellement air neuf r├®g', NULL, NULL),
(44, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'VENTILATION', 'Double flux', NULL, NULL),
(45, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'VENTILATION', 'CTA', NULL, NULL),
(46, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ECLAIRAGE', 'ampoules traditionnelles', NULL, NULL),
(47, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ECLAIRAGE', 'basse consommation', NULL, NULL),
(48, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ECLAIRAGE', 'Led', NULL, NULL),
(49, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ECLAIRAGE', 'Neon T5', NULL, NULL),
(50, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ECLAIRAGE', 'Neon T8', NULL, NULL),
(51, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONTOITURE', 'Sans', NULL, NULL),
(52, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONMUR', 'Sans', NULL, NULL),
(53, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONPLANCHER', 'Sans', NULL, NULL),
(54, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CHAUFFAGE', 'Sans', NULL, NULL),
(55, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CLIMATISATION', 'Sans', NULL, NULL),
(56, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ECS', 'Sans', NULL, NULL),
(57, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'VENTILATION', 'Sans', NULL, NULL),
(58, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ECLAIRAGE', 'Sans', NULL, NULL),
(59, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'MUR', 'pierre + 50 cm', NULL, NULL),
(60, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'MUR', 'pierre 40 cm', NULL, NULL),
(61, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'MUR', 'pierre', NULL, NULL),
(62, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'MUR', 'bloc b├®ton 20 cm', NULL, NULL),
(63, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'MUR', 'b├®ton banch├®', NULL, NULL),
(64, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'MUR', 'brique non isol├®', NULL, NULL),
(65, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'MUR', 'brique pl├ótri├¿re 5 cm + enduit', NULL, NULL),
(66, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'MUR', 'brique + enduit', NULL, NULL),
(67, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'MUR', 'brique + lame d air + brique pl├ótri├¿re', NULL, NULL),
(68, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'MUR', 'brique + LV6cm + brique pl├ótri├¿re', NULL, NULL),
(69, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'MUR', 'Monomur 30', NULL, NULL),
(70, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'MUR', 'Monomur 37,5', NULL, NULL),
(71, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'MUR', 'Bois', NULL, NULL),
(72, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'MUR', 'Bois + Torchis / platre', NULL, NULL),
(73, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONMUR', 'int├®rieure 4 cm', NULL, NULL),
(74, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONMUR', 'int├®rieure 6 cm', NULL, NULL),
(75, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONMUR', 'int├®rieure 8 cm', NULL, NULL),
(76, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONMUR', 'int├®rieure 10 cm', NULL, NULL),
(77, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONMUR', 'exterieure', NULL, NULL),
(78, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONMUR', 'RT 82', NULL, NULL),
(79, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONMUR', 'RT 88', NULL, NULL),
(80, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONMUR', 'RT 2000', NULL, NULL),
(81, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONMUR', 'RT2005', NULL, NULL),
(82, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'PLANCHER', 'Dalle b├®ton sur terre-plein ', NULL, NULL),
(83, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'PLANCHER', 'Dalle b├®ton sur VS', NULL, NULL),
(84, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'PLANCHER', 'Poutrelles hourdis', NULL, NULL),
(85, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'PLANCHER', 'Pr├® dalles', NULL, NULL),
(86, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'PLANCHER', 'Coffrage acier', NULL, NULL),
(87, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'PLANCHER', 'b├®ton cellulaire', NULL, NULL),
(88, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'PLANCHER', 'poutres a treillis', NULL, NULL),
(89, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'PLANCHER', 'sur lattis', NULL, NULL),
(90, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'PLANCHER', 'Bois', NULL, NULL),
(91, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONPLANCHER', 'isol├® 10 cm', NULL, NULL),
(92, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONPLANCHER', 'chape seche', NULL, NULL),
(93, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONPLANCHER', 'chape beton allegee', NULL, NULL),
(94, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONPLANCHER', 'RT2005', NULL, NULL),
(95, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONPLANCHER', 'RT2000', NULL, NULL),
(96, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONPLANCHER', 'RT88', NULL, NULL),
(97, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONPLANCHER', 'RT82', NULL, NULL),
(98, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONPLANCHER', 'RT73', NULL, NULL),
(99, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'FENETRE', 'Bois ', NULL, NULL),
(100, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'FENETRE', 'PVC', NULL, NULL),
(101, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'FENETRE', 'Alu s├®rie froide', NULL, NULL),
(102, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'FENETRE', 'Alu rupture pont ', NULL, NULL),
(103, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'FENETRE', 'Double fen├¬tre', NULL, NULL),
(104, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'FENETRE', 'menuiserie acier', NULL, NULL),
(105, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'VITRAGE', 'SV - 4 mm', NULL, NULL),
(106, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'VITRAGE', 'DV - 4/6/4', NULL, NULL),
(107, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'VITRAGE', 'DV - 4/8/4', NULL, NULL),
(108, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'VITRAGE', 'DV - 4/10/4', NULL, NULL),
(109, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'VITRAGE', 'DV - 4/12/4', NULL, NULL),
(110, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'VITRAGE', 'DV - 4/16/4', NULL, NULL),
(111, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'VITRAGE', 'DV - 4/6/4 + argon', NULL, NULL),
(112, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'VITRAGE', 'DV - 4/8/4 + argon', NULL, NULL),
(113, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'VITRAGE', 'DV - 4/10/4 + argon', NULL, NULL),
(114, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'VITRAGE', 'DV - 4/12/4 + argon', NULL, NULL),
(115, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'VITRAGE', 'DV - 4/16/4 + argon', NULL, NULL),
(116, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'VITRAGE', 'Survitrage', NULL, NULL),
(117, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'TOITURE', 'Combles', NULL, NULL),
(118, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'TOITURE', 'Terrasse', NULL, NULL),
(119, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONTOITURE', 'Rigide - Polystyr├¿ne extrud├®', NULL, NULL),
(120, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONTOITURE', 'Rigide - Polystyr├¿ne expans├®', NULL, NULL),
(121, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONTOITURE', 'Rigide -Polyur├®thane', NULL, NULL),
(122, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONTOITURE', 'Rigide -Fibre de verre', NULL, NULL),
(123, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONTOITURE', 'Rouleaux - Laine de roche', NULL, NULL),
(124, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONTOITURE', 'Rouleaux -Laine de verre', NULL, NULL),
(125, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONTOITURE', 'Vrac - Polystyr├¿ne', NULL, NULL),
(126, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONTOITURE', 'Vrac - Fibre cellulosique', NULL, NULL),
(127, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONTOITURE', 'Vrac - Fibre de verre', NULL, NULL),
(128, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONTOITURE', 'Vrac - Laine min├®rale', NULL, NULL),
(129, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONTOITURE', 'Vrac -Vermiculite ', NULL, NULL),
(130, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONTOITURE', 'RT2005', NULL, NULL),
(131, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONTOITURE', 'RT2000', NULL, NULL),
(132, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONTOITURE', 'RT88', NULL, NULL),
(133, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONTOITURE', 'RT82', NULL, NULL),
(134, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'ISOLATIONTOITURE', 'RT73', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `espacevert`
--

CREATE TABLE IF NOT EXISTS `espacevert` (
  `EspacevertID` int(11) NOT NULL AUTO_INCREMENT,
  `MouvrageID` int(11) NOT NULL,
  `Nom` varchar(45) NOT NULL,
  `Anneeconstruction` int(4) DEFAULT NULL,
  `Patrimoine` int(11) DEFAULT '0',
  `Voisinage` int(11) DEFAULT '0',
  `Orientation` int(11) DEFAULT '0',
  `Exposition` int(11) DEFAULT '0',
  `altitude` int(11) DEFAULT NULL,
  `BaseID` char(36) NOT NULL,
  `Cadastre` varchar(45) DEFAULT NULL,
  `Latitude` varchar(15) DEFAULT NULL,
  `Longitude` varchar(15) DEFAULT NULL,
  `StationdjuID` int(11) DEFAULT NULL,
  `StationmeteoID` int(11) DEFAULT NULL,
  `Commentaire` text,
  `CoordonneeID` int(11) DEFAULT NULL,
  `Adresse1` varchar(45) DEFAULT NULL,
  `Adresse2` varchar(45) DEFAULT NULL,
  `Adresse3` varchar(45) DEFAULT NULL,
  `Codepostal` int(11) DEFAULT NULL,
  `Ville` varchar(45) DEFAULT NULL,
  `Pays` varchar(45) DEFAULT NULL,
  `NbrEtage` int(11) DEFAULT NULL,
  `Surface` int(11) DEFAULT NULL,
  `NbrEmployee` int(11) DEFAULT NULL,
  `Pv` int(11) DEFAULT NULL,
  `SystemeChauffageEau` int(11) DEFAULT NULL,
  `Ces` int(11) DEFAULT NULL,
  `SurfaceIrrigue` int(11) DEFAULT NULL,
  `Forage` int(1) DEFAULT NULL,
  `SystArrosage` int(1) DEFAULT NULL,
  PRIMARY KEY (`EspacevertID`,`BaseID`),
  KEY `belong_to_Base` (`BaseID`),
  KEY `MouvrageID` (`MouvrageID`),
  KEY `nom` (`Nom`),
  KEY `StationdjuID` (`StationdjuID`),
  KEY `StationmeteoID` (`StationmeteoID`),
  KEY `CoordonneeID` (`CoordonneeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `espacevert`
--

INSERT INTO `espacevert` (`EspacevertID`, `MouvrageID`, `Nom`, `Anneeconstruction`, `Patrimoine`, `Voisinage`, `Orientation`, `Exposition`, `altitude`, `BaseID`, `Cadastre`, `Latitude`, `Longitude`, `StationdjuID`, `StationmeteoID`, `Commentaire`, `CoordonneeID`, `Adresse1`, `Adresse2`, `Adresse3`, `Codepostal`, `Ville`, `Pays`, `NbrEtage`, `Surface`, `NbrEmployee`, `Pv`, `SystemeChauffageEau`, `Ces`, `SurfaceIrrigue`, `Forage`, `SystArrosage`) VALUES
(2, 2, 'Mairie', 1970, 2, 2, 2, 2, 700, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, '', '', NULL, NULL, NULL, NULL, '2 avenue  Hassan II', '', '', 10050, 'Rabat', 'MAROC', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1),
(3, 1, 'CARREFOUR', 1990, 2, 3, 4, 4, 400, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ' 114 Bab el hed  ', NULL, NULL, 10010, 'Rabat', 'MAROC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 'IMMEUBLE', 2000, NULL, NULL, NULL, NULL, 280, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 2, 'espace vert 1', 1900, 1, 1, 1, 1, 200, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B.A ESPACE VERT FACE ANCIEN AEROPERT BEN', NULL, NULL, 81000, 'Agadir', 'Maroc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 2, 'Stade al inbiaat', 1900, 1, NULL, NULL, NULL, 200, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'STADE AL INBIAAT AV HASSAN        ', NULL, NULL, 81000, 'Agadir', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 2, 'Royal tennis club', 1900, NULL, NULL, NULL, NULL, 3, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ROYAL TENNIS CLUB AV.HASSAN II    ', NULL, NULL, 81000, 'Agadir', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 2, 'marché municipal de poissons', 1900, 2, 1, 1, NULL, 200, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MARCHE MUNICIPAL DE POISSONS AGADIR     ', NULL, NULL, 81000, 'Agadir', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 2, 'camping municipal', 1900, NULL, NULL, NULL, NULL, 200, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, '', '', NULL, NULL, NULL, NULL, 'CAMPING MUNICIPAL D''AGADIR BD.MED       ', '', '', 81000, 'Agadir', NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 2),
(10, 2, 'qdqsdqsd', 1900, 1, 0, 0, 0, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, '', '', NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL),
(11, 2, 'qdqsdq', 123, 1, 0, 0, 0, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, '', '', NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL),
(12, 2, 'qdqsdq', 123, 3, 0, 0, 0, 12, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, '13', '15', NULL, NULL, NULL, NULL, 'jghjghjgj', 'hjhkh', 'hgjgj hgj', NULL, NULL, NULL, 200, 200, 200, 200, 200, 10, NULL, NULL, NULL),
(13, 2, 'qd', 120, 1, 0, 0, 0, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, '', '', NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL),
(14, 2, 'dqsdqsd', NULL, 0, 0, 0, 0, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, '', '', NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 4),
(15, 2, 'qsdqdqsdqsd', NULL, 0, 0, 0, 0, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, '', '', NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `etiquette`
--

CREATE TABLE IF NOT EXISTS `etiquette` (
  `EtiquetteID` int(11) NOT NULL AUTO_INCREMENT,
  `Type` varchar(45) NOT NULL,
  `Ratio` varchar(20) NOT NULL,
  `A` int(11) NOT NULL,
  `B` int(11) NOT NULL,
  `C` int(11) NOT NULL,
  `D` int(11) NOT NULL,
  `E` int(11) NOT NULL,
  `F` int(11) NOT NULL,
  `CategorieID` int(11) DEFAULT NULL,
  `BaseID` char(36) NOT NULL,
  `UrlimageA` varchar(50) NOT NULL,
  `UrlimageB` varchar(50) NOT NULL,
  `UrlimageC` varchar(50) NOT NULL,
  `UrlimageD` varchar(50) NOT NULL,
  `UrlimageE` varchar(50) NOT NULL,
  `UrlimageF` varchar(50) NOT NULL,
  `UrlimageG` varchar(50) NOT NULL,
  PRIMARY KEY (`EtiquetteID`),
  KEY `BaseID` (`BaseID`),
  KEY `CategorieID` (`CategorieID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `etiquette`
--

INSERT INTO `etiquette` (`EtiquetteID`, `Type`, `Ratio`, `A`, `B`, `C`, `D`, `E`, `F`, `CategorieID`, `BaseID`, `UrlimageA`, `UrlimageB`, `UrlimageC`, `UrlimageD`, `UrlimageE`, `UrlimageF`, `UrlimageG`) VALUES
(1, 'Public', 'kWhEP', 50, 110, 210, 350, 540, 750, 2, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'kWhEP_A.jpg', 'kWhEP_B.jpg', 'kWhEP_C.jpg', 'kWhEP_D.jpg', 'kWhEP_E.jpg', 'kWhEP_F.jpg', 'kWhEP_G.jpg'),
(2, 'Public', 'kWhEP', 50, 90, 150, 230, 330, 450, 44, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'kWhEP_A.jpg', 'kWhEP_B.jpg', 'kWhEP_C.jpg', 'kWhEP_D.jpg', 'kWhEP_E.jpg', 'kWhEP_F.jpg', 'kWhEP_G.jpg'),
(3, 'Public', 'kWhEP', 30, 90, 170, 270, 380, 510, 16, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'kWhEP_A.jpg', 'kWhEP_B.jpg', 'kWhEP_C.jpg', 'kWhEP_D.jpg', 'kWhEP_E.jpg', 'kWhEP_F.jpg', 'kWhEP_G.jpg'),
(4, 'Public', 'kWhEP', 30, 90, 170, 270, 380, 510, 50, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'kWhEP_A.jpg', 'kWhEP_B.jpg', 'kWhEP_C.jpg', 'kWhEP_D.jpg', 'kWhEP_E.jpg', 'kWhEP_F.jpg', 'kWhEP_G.jpg'),
(5, 'Public', 'kWhEP', 30, 90, 170, 270, 380, 510, 13, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'kWhEP_A.jpg', 'kWhEP_B.jpg', 'kWhEP_C.jpg', 'kWhEP_D.jpg', 'kWhEP_E.jpg', 'kWhEP_F.jpg', 'kWhEP_G.jpg'),
(6, 'Public', 'kWhEP', 30, 90, 170, 270, 380, 510, 4, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'kWhEP_A.jpg', 'kWhEP_B.jpg', 'kWhEP_C.jpg', 'kWhEP_D.jpg', 'kWhEP_E.jpg', 'kWhEP_F.jpg', 'kWhEP_G.jpg'),
(7, 'Public', 'kWhEP', 500, 2000, 3500, 5000, 6500, 8000, 49, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'kWhEP_A.jpg', 'kWhEP_B.jpg', 'kWhEP_C.jpg', 'kWhEP_D.jpg', 'kWhEP_E.jpg', 'kWhEP_F.jpg', 'kWhEP_G.jpg'),
(8, 'Public', 'CO2', 5, 15, 30, 60, 100, 145, 2, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CO2_A.jpg', 'CO2_B.jpg', 'CO2_C.jpg', 'CO2_D.jpg', 'CO2_E.jpg', 'CO2_F.jpg', 'CO2_G.jpg'),
(9, 'Public', 'CO2', 5, 10, 20, 35, 55, 80, 44, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CO2_A.jpg', 'CO2_B.jpg', 'CO2_C.jpg', 'CO2_D.jpg', 'CO2_E.jpg', 'CO2_F.jpg', 'CO2_G.jpg'),
(10, 'Public', 'CO2', 3, 10, 25, 45, 70, 95, 16, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CO2_A.jpg', 'CO2_B.jpg', 'CO2_C.jpg', 'CO2_D.jpg', 'CO2_E.jpg', 'CO2_F.jpg', 'CO2_G.jpg'),
(11, 'Public', 'CO2', 3, 10, 25, 45, 70, 95, 50, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CO2_A.jpg', 'CO2_B.jpg', 'CO2_C.jpg', 'CO2_D.jpg', 'CO2_E.jpg', 'CO2_F.jpg', 'CO2_G.jpg'),
(12, 'Public', 'CO2', 3, 10, 25, 45, 70, 95, 13, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CO2_A.jpg', 'CO2_B.jpg', 'CO2_C.jpg', 'CO2_D.jpg', 'CO2_E.jpg', 'CO2_F.jpg', 'CO2_G.jpg'),
(13, 'Public', 'CO2', 3, 10, 25, 45, 70, 95, 4, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CO2_A.jpg', 'CO2_B.jpg', 'CO2_C.jpg', 'CO2_D.jpg', 'CO2_E.jpg', 'CO2_F.jpg', 'CO2_G.jpg'),
(14, 'Public', 'CO2', 100, 400, 700, 1000, 1300, 1600, 49, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CO2_A.jpg', 'CO2_B.jpg', 'CO2_C.jpg', 'CO2_D.jpg', 'CO2_E.jpg', 'CO2_F.jpg', 'CO2_G.jpg'),
(15, 'Public', 'kWhEP', 50, 110, 210, 350, 540, 750, 3, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'kWhEP_A.jpg', 'kWhEP_B.jpg', 'kWhEP_C.jpg', 'kWhEP_D.jpg', 'kWhEP_E.jpg', 'kWhEP_F.jpg', 'kWhEP_G.jpg'),
(16, 'Public', 'CO2', 5, 15, 30, 60, 100, 145, 3, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'CO2_A.jpg', 'CO2_B.jpg', 'CO2_C.jpg', 'CO2_D.jpg', 'CO2_E.jpg', 'CO2_F.jpg', 'CO2_G.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `exemplarite`
--

CREATE TABLE IF NOT EXISTS `exemplarite` (
  `ExemplariteID` int(11) NOT NULL AUTO_INCREMENT,
  `BaseID` char(36) NOT NULL,
  `MouvrageID` int(11) NOT NULL,
  `BatimentID` int(11) NOT NULL,
  `UtilisateurID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `AccordMO` tinyint(1) NOT NULL,
  `Commentaire` text CHARACTER SET utf8 COLLATE utf8_bin,
  PRIMARY KEY (`ExemplariteID`,`BaseID`),
  KEY `BaseID` (`BaseID`),
  KEY `BatimentID` (`BatimentID`),
  KEY `UtilisateurID` (`UtilisateurID`),
  KEY `MouvrageID` (`MouvrageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE IF NOT EXISTS `facture` (
  `FactureID` int(11) NOT NULL AUTO_INCREMENT,
  `CompteurID` int(11) NOT NULL,
  `Nom` varchar(45) DEFAULT NULL,
  `FournisseurID` int(11) DEFAULT NULL,
  `Debutperiode` date DEFAULT NULL,
  `Finperiode` date DEFAULT NULL,
  `Abonnement` decimal(11,2) DEFAULT NULL,
  `Consommation` decimal(11,2) DEFAULT NULL,
  `Totalttc` decimal(11,2) DEFAULT NULL,
  `Commentaire` varchar(250) DEFAULT NULL,
  `Prixunitaire` decimal(11,2) DEFAULT NULL,
  `Estimation` tinyint(1) DEFAULT NULL,
  `Consokwh` decimal(11,2) DEFAULT NULL,
  `Coefficient` decimal(11,2) DEFAULT NULL,
  `Consohpleines` decimal(11,2) DEFAULT NULL,
  `Consohcreuses` decimal(11,2) DEFAULT NULL,
  `Consopete` decimal(11,2) DEFAULT NULL,
  `Consocete` decimal(11,2) DEFAULT NULL,
  `Consophiver` decimal(11,2) DEFAULT NULL,
  `Consochiver` float(11,2) DEFAULT NULL,
  `HN` decimal(11,2) DEFAULT NULL,
  `HPM` decimal(11,2) DEFAULT NULL,
  `Consopointe` decimal(11,2) DEFAULT NULL,
  `Hygro` decimal(11,2) DEFAULT NULL,
  `Patteintepointe` decimal(11,2) DEFAULT NULL,
  `Patteintehp` decimal(11,2) DEFAULT NULL,
  `Patteintehc` decimal(11,2) DEFAULT NULL,
  `Eactivehp` decimal(11,2) DEFAULT NULL,
  `Eactivehc` decimal(11,2) DEFAULT NULL,
  `Ereactive` decimal(11,2) DEFAULT NULL,
  `Tangeante` decimal(11,2) DEFAULT NULL,
  `BaseID` char(36) NOT NULL,
  `MouvrageID` int(11) NOT NULL,
  `ValeurObservation` int(11) DEFAULT NULL,
  `DateObservation` date DEFAULT NULL,
  PRIMARY KEY (`FactureID`,`BaseID`),
  KEY `Factures_belong_to_Compteur` (`CompteurID`),
  KEY `Factures_belong_to_Fournisseurs` (`FournisseurID`),
  KEY `indexdate` (`Finperiode`),
  KEY `indexconso` (`Consommation`),
  KEY `indextotal` (`Totalttc`),
  KEY `indexpu` (`Prixunitaire`),
  KEY `indexconsokwh` (`Consokwh`),
  KEY `belong_to_Base` (`BaseID`),
  KEY `MouvrageID` (`MouvrageID`),
  KEY `Nom` (`Nom`),
  KEY `Debutperiode` (`Debutperiode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Contenu de la table `facture`
--

INSERT INTO `facture` (`FactureID`, `CompteurID`, `Nom`, `FournisseurID`, `Debutperiode`, `Finperiode`, `Abonnement`, `Consommation`, `Totalttc`, `Commentaire`, `Prixunitaire`, `Estimation`, `Consokwh`, `Coefficient`, `Consohpleines`, `Consohcreuses`, `Consopete`, `Consocete`, `Consophiver`, `Consochiver`, `HN`, `HPM`, `Consopointe`, `Hygro`, `Patteintepointe`, `Patteintehp`, `Patteintehc`, `Eactivehp`, `Eactivehc`, `Ereactive`, `Tangeante`, `BaseID`, `MouvrageID`, `ValeurObservation`, `DateObservation`) VALUES
(3, 2, NULL, 3, '2010-01-01', '2010-12-31', NULL, '3251.00', '40278.70', NULL, NULL, 0, NULL, '1.00', '9.00', '9.00', '9.00', '9.00', '9.00', 9.00, '9.00', '9.00', '10.00', '9.00', '10.00', '10.00', '10.00', '10.00', '7.00', '8.00', '9.00', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(4, 4, NULL, 3, '2010-01-01', '2010-12-31', NULL, '2192.00', '27104.74', NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(5, 5, NULL, 3, '2010-01-01', '2010-12-31', NULL, '5317.00', '65979.74', NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(6, 6, NULL, 3, '2010-01-01', '2010-12-31', NULL, '2940.00', '36409.86', NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(7, 7, NULL, 3, '2010-01-01', '2010-12-31', NULL, '2487.00', '30774.54', NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(8, 5, NULL, 3, '2011-01-01', '2011-12-31', NULL, '15999.00', '198864.34', NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(9, 5, NULL, 3, '2012-01-01', '2012-12-31', NULL, '19612.00', '243810.06', NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(10, 5, NULL, 3, '2013-01-01', '2013-12-31', NULL, '13841.00', '172009.32', NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(11, 2, NULL, 3, '2011-01-01', '2011-12-31', NULL, '6393.00', '79365.70', NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(12, 2, NULL, 3, '2012-01-01', '2012-12-31', NULL, '4831.00', '59934.42', NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(13, 2, NULL, 3, '2013-01-01', '2013-12-31', NULL, '5902.00', '73256.24', NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(14, 7, NULL, 3, '2011-01-01', '2011-12-31', NULL, '23734.02', '1921.00', NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(15, 7, NULL, 3, '2012-01-01', '2012-12-31', NULL, '2672.00', '33076.46', NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(16, 7, NULL, 3, '2013-01-01', '2013-12-31', NULL, '6880.00', '85415.94', NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(17, 6, NULL, 3, '2011-01-01', '2011-12-31', NULL, '2087.00', '257999.06', NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(18, 6, NULL, 3, '2012-01-01', '2012-12-31', NULL, '1271.00', '15648.02', NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(19, 6, NULL, 3, '2013-01-01', '2013-12-31', NULL, '1019.00', '12511.72', NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(20, 4, NULL, 3, '2011-01-01', '2011-12-31', NULL, '3426.00', '42456.22', NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(21, 4, NULL, 3, '2012-01-01', '2012-12-31', NULL, '3241.00', '40154.82', NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(22, 4, NULL, 3, '2013-01-01', '2013-12-31', NULL, '2472.00', '30578.96', NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(23, 10, NULL, 4, '2010-01-01', '2010-12-31', NULL, '2240.00', '21728.00', NULL, NULL, NULL, NULL, '10.58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(24, 10, NULL, 4, '2011-01-01', '2011-12-31', NULL, '1960.00', '19012.00', NULL, NULL, NULL, NULL, '10.58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(25, 10, NULL, 4, '2012-01-01', '2012-12-31', NULL, '1120.00', '10864.00', NULL, NULL, NULL, NULL, '10.58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(26, 10, NULL, 4, '2013-01-01', '2013-12-31', NULL, '1400.00', '13580.00', NULL, NULL, NULL, NULL, '10.58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(27, 11, NULL, 5, '2010-01-01', '2010-12-31', NULL, '3600.00', '34920.00', NULL, NULL, NULL, NULL, '10.58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(28, 11, NULL, 5, '2011-01-01', '2011-12-31', NULL, '3330.00', '32301.00', NULL, NULL, NULL, NULL, '10.58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(29, 11, NULL, 5, '2012-01-01', '2012-12-31', NULL, '1710.00', '16587.00', NULL, NULL, NULL, NULL, '10.58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(30, 11, NULL, 5, '2013-01-01', '2013-12-31', NULL, '2160.00', '20952.00', NULL, NULL, NULL, NULL, '10.58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(31, 12, NULL, 8, '2010-01-01', '2010-12-31', NULL, '1554.00', '15073.80', NULL, NULL, NULL, NULL, '10.58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(32, 12, NULL, 8, '2011-01-01', '2011-12-31', NULL, '4440.00', '43068.00', NULL, NULL, NULL, NULL, '10.58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(33, 12, NULL, 8, '2013-01-01', '2013-12-31', NULL, '2516.00', '24405.20', NULL, NULL, NULL, NULL, '10.58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(34, 12, NULL, 8, '2012-01-01', '2012-12-31', NULL, '3626.00', '35172.20', NULL, NULL, NULL, NULL, '10.58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(36, 13, NULL, NULL, '2010-01-01', '2010-12-31', NULL, '7350.00', '71295.00', NULL, NULL, NULL, NULL, '10.58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(37, 13, NULL, NULL, '2011-01-01', '2011-12-31', NULL, '5250.00', '50925.00', NULL, NULL, NULL, NULL, '10.58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(38, 13, NULL, NULL, '2012-01-01', '2012-12-31', NULL, '12775.00', '123917.50', NULL, NULL, NULL, NULL, '10.58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(39, 13, NULL, NULL, '2013-01-01', '2013-12-31', NULL, '5950.00', '57715.00', NULL, NULL, NULL, NULL, '10.58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(40, 14, NULL, 8, '2010-01-01', '2010-12-31', NULL, '9125.00', '88512.50', NULL, NULL, NULL, NULL, '10.58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(41, 14, NULL, 8, '2011-01-01', '2011-12-31', NULL, '5000.00', '48500.00', NULL, NULL, NULL, NULL, '10.58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(42, 14, NULL, 8, '2012-01-01', '2012-12-31', NULL, '11250.00', '109125.00', NULL, NULL, NULL, NULL, '10.58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(43, 14, NULL, 8, '2013-01-01', '2013-12-31', NULL, '3750.00', '36375.00', NULL, NULL, NULL, NULL, '10.58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(44, 15, NULL, 3, '2010-01-01', '2010-12-31', NULL, '287.22', '430.83', NULL, NULL, NULL, NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(45, 15, NULL, 3, '2011-01-01', '2011-12-31', NULL, '400.00', '600.00', NULL, NULL, NULL, NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(46, 15, NULL, 3, '2012-01-01', '2012-12-31', NULL, '300.00', '450.00', NULL, NULL, NULL, NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(47, 15, NULL, 3, '2013-01-01', '2013-12-31', NULL, '466.67', '700.00', NULL, NULL, NULL, NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(48, 16, NULL, 3, '2010-01-01', '2010-12-31', NULL, '34021.06', '51031.59', NULL, NULL, NULL, NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(49, 16, NULL, 3, '2011-01-01', '2011-12-31', NULL, '26840.40', '40260.60', NULL, NULL, NULL, NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(50, 16, NULL, 3, '2012-01-01', '2012-12-31', NULL, '30000.00', '45000.00', NULL, NULL, NULL, NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(51, 16, NULL, 3, '2013-01-01', '2013-12-31', NULL, '23333.30', '35000.00', NULL, NULL, NULL, NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(52, 17, NULL, 3, '2010-01-01', '2010-12-31', NULL, '10425.36', '15638.04', NULL, NULL, NULL, NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(53, 17, NULL, 3, '2011-01-01', '2011-12-31', NULL, '9367.38', '14051.07', NULL, NULL, NULL, NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(54, 17, NULL, 3, '2012-01-01', '2012-12-31', NULL, '10666.70', '16000.00', NULL, NULL, NULL, NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(55, 17, NULL, 3, '2013-01-01', '2013-12-31', NULL, '8666.70', '13000.00', NULL, NULL, NULL, NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(56, 18, NULL, 3, '2010-01-01', '2010-12-31', NULL, '14580.54', '21870.81', NULL, NULL, NULL, NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(57, 18, NULL, 3, '2011-01-01', '2011-12-31', NULL, '18666.70', '28000.00', NULL, NULL, NULL, NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(58, 18, NULL, 3, '2012-01-01', '2012-12-31', NULL, '23333.30', '35000.00', NULL, NULL, NULL, NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(59, 18, NULL, 3, '2013-01-01', '2013-12-31', NULL, '26666.70', '40000.00', NULL, NULL, NULL, NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(60, 19, NULL, 3, '2010-01-01', '2010-12-31', NULL, '24217.01', '36325.52', NULL, NULL, NULL, NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(61, 19, NULL, 3, '2011-01-01', '2011-12-31', NULL, '26666.70', '40000.00', NULL, NULL, NULL, NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(62, 19, NULL, 3, '2012-01-01', '2012-12-31', NULL, '16666.70', '25000.00', NULL, NULL, NULL, NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(63, 19, NULL, 3, '2013-01-01', '2013-12-31', NULL, '20000.00', '30000.00', NULL, NULL, NULL, NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(64, 15, 'Test', 4, '2014-11-10', '2014-11-25', '100.00', '10.00', '11.00', 'sdqsdqsd', '200.00', 1, NULL, '200.00', '200.00', '2000.00', '2000.00', '2000.00', '2000.00', 2000.00, '2000.00', '2000.00', '200.00', '2000.00', '2000.00', '2000.00', '2000.00', '2000.00', '2000.00', '20000.00', '2000.00', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, NULL, NULL),
(65, 2, 'qdqsd / qdqsdqs', NULL, '2014-10-10', '2014-10-20', NULL, '2000.00', '200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 2, 20000, '2014-02-10');

-- --------------------------------------------------------

--
-- Structure de la table `label`
--

CREATE TABLE IF NOT EXISTS `label` (
  `LabelID` int(11) NOT NULL AUTO_INCREMENT,
  `CategorieID` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `Certifie` tinyint(1) DEFAULT NULL,
  `Coeff1` decimal(7,3) DEFAULT NULL,
  `Coeffref1` decimal(7,3) DEFAULT NULL,
  `Coeff2` decimal(7,3) DEFAULT NULL,
  `Coeffref2` decimal(7,3) DEFAULT NULL,
  `Coeff3` decimal(7,3) DEFAULT NULL,
  `Coeffref3` decimal(7,3) DEFAULT NULL,
  `Permeabilite` varchar(45) DEFAULT NULL,
  `Inertie` varchar(45) DEFAULT NULL,
  `Commentaire` text,
  `BatimentID` int(11) DEFAULT NULL,
  `MouvrageID` int(11) NOT NULL,
  `BaseID` char(36) NOT NULL,
  PRIMARY KEY (`LabelID`,`BaseID`),
  KEY `labels_belong_to_Batiment` (`BatimentID`),
  KEY `lables_belong_to_Categorie` (`CategorieID`),
  KEY `belong_to_Base` (`BaseID`),
  KEY `MouvrageID` (`MouvrageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `meteoan`
--

CREATE TABLE IF NOT EXISTS `meteoan` (
  `MeteoanID` int(11) NOT NULL AUTO_INCREMENT,
  `StationmeteoID` int(11) DEFAULT NULL,
  `Annee` int(4) DEFAULT NULL,
  `Moyenne` int(11) DEFAULT NULL,
  `Janvier` int(11) DEFAULT NULL,
  `Fevrier` int(11) DEFAULT NULL,
  `Mars` int(11) DEFAULT NULL,
  `Avril` int(11) DEFAULT NULL,
  `Mai` int(11) DEFAULT NULL,
  `Juin` int(11) DEFAULT NULL,
  `Juillet` int(11) DEFAULT NULL,
  `Aout` int(11) DEFAULT NULL,
  `Septembre` int(11) DEFAULT NULL,
  `Octobre` int(11) DEFAULT NULL,
  `Novembre` int(11) DEFAULT NULL,
  `Decembre` int(11) DEFAULT NULL,
  `Commentaire` varchar(255) DEFAULT NULL,
  `CategorieID` int(11) DEFAULT NULL,
  `BaseID` char(36) NOT NULL,
  PRIMARY KEY (`MeteoanID`,`BaseID`),
  KEY `meteoans_belong_to_Stationmeteo` (`StationmeteoID`),
  KEY `meteoans_belong_to_Categorie` (`CategorieID`),
  KEY `indexAnnee` (`Annee`),
  KEY `belong_to_Base` (`BaseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `moan`
--

CREATE TABLE IF NOT EXISTS `moan` (
  `MoanID` int(11) NOT NULL AUTO_INCREMENT,
  `MouvrageID` int(11) DEFAULT NULL,
  `Annee` year(4) DEFAULT NULL,
  `Frequentation` decimal(11,2) DEFAULT NULL,
  `Typefrequentation` enum('Habitants','Nuitees','Visiteurs','Salaries','Unites') NOT NULL DEFAULT 'Habitants',
  `Budget` decimal(11,2) DEFAULT NULL,
  `Objectif` decimal(11,2) DEFAULT NULL,
  `BaseID` char(36) NOT NULL,
  PRIMARY KEY (`MoanID`,`BaseID`),
  KEY `moans_belong_to_moeuvre` (`MouvrageID`),
  KEY `indexAnnee` (`Annee`),
  KEY `belong_to_Base` (`BaseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `moan`
--

INSERT INTO `moan` (`MoanID`, `MouvrageID`, `Annee`, `Frequentation`, `Typefrequentation`, `Budget`, `Objectif`, `BaseID`) VALUES
(1, 2, 2013, '1000000.00', 'Habitants', '100000000.00', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2, 2, 2014, '1000001.00', 'Visiteurs', '1000000.99', '10000000.00', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f');

-- --------------------------------------------------------

--
-- Structure de la table `mouvrage`
--

CREATE TABLE IF NOT EXISTS `mouvrage` (
  `MouvrageID` int(11) NOT NULL AUTO_INCREMENT,
  `CategorieID` int(11) DEFAULT NULL,
  `BureauetudeID` int(11) DEFAULT NULL,
  `Logo` varchar(90) DEFAULT NULL,
  `Commentaire` text,
  `Societe` varchar(45) DEFAULT NULL,
  `Codepostal` int(11) DEFAULT NULL,
  `Ville` varchar(45) DEFAULT NULL,
  `BaseID` char(36) NOT NULL,
  `StationdjuID` int(11) DEFAULT NULL,
  `StationmeteoID` int(11) DEFAULT NULL,
  `Estmodifie` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`MouvrageID`,`BaseID`),
  KEY `indexste` (`Societe`),
  KEY `Mouvrages_belong_to_Fournisseurs` (`BureauetudeID`),
  KEY `Mouvrages_belongto_Categorie` (`CategorieID`),
  KEY `belong_to_Base` (`BaseID`),
  KEY `StationdjuID` (`StationdjuID`),
  KEY `StationmeteoID` (`StationmeteoID`),
  KEY `Estmodifie` (`Estmodifie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `mouvrage`
--

INSERT INTO `mouvrage` (`MouvrageID`, `CategorieID`, `BureauetudeID`, `Logo`, `Commentaire`, `Societe`, `Codepostal`, `Ville`, `BaseID`, `StationdjuID`, `StationmeteoID`, `Estmodifie`) VALUES
(1, 37, 1, NULL, '', 'Commune urbaine 1', 10000, 'Rabat', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, NULL, 0),
(2, 37, 1, 'logo-agence-urbaine-agadir.png', '<p>&nbsp;Usdqsd qsdq dqsdqsdqsd qsdqsdqsdqsdqsd qsdqsd qsd qsd qsdqsd</p>\r\n<p>qsdqs dqs dqsdqsdqsd qs dq sd</p>\r\n<p>&nbsp;Usdqsd qsdq dqsdqsdqsd qsdqsdqsdqsdqsd qsdqsd qsd qsd qsdqsd</p>\r\n<p>qsdqs dqs dqsdqsdqsd qs dq sd</p>\r\n<p>&nbsp;Usdqsd qsdq dqsdqsdqsd qsdqsdqsdqsdqsd qsdqsd qsd qsd qsdqsd</p>\r\n<p>qsdqs dqs dqsdqsdqsd qs dq sd</p>\r\n<p>&nbsp;Usdqsd qsdq dqsdqsdqsd qsdqsdqsdqsdqsd qsdqsd qsd qsd qsdqsd</p>\r\n<p>qsdqs dqs dqsdqsdqsd qs dq sd</p>', 'Commune Urbaine Agadir', 14000, 'Agadir', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, NULL, 0),
(13, 38, 1, 'conseil_slider.png', 'qsdqsd qsdqsd', 'Coucou', 12333, 'Rabbbat', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `posteproduction`
--

CREATE TABLE IF NOT EXISTS `posteproduction` (
  `PosteproductionID` int(11) NOT NULL AUTO_INCREMENT,
  `CategorieID` int(11) DEFAULT NULL,
  `MouvrageID` int(11) NOT NULL,
  `Nom` varchar(45) NOT NULL,
  `Description` text,
  `Productiontheorique` decimal(11,2) DEFAULT NULL,
  `Coutinitial` int(11) DEFAULT NULL,
  `BaseID` char(36) NOT NULL,
  `Anneeconstruction` int(4) DEFAULT NULL,
  `Cadastre` varchar(45) DEFAULT NULL,
  `Latitude` varchar(15) DEFAULT NULL,
  `Longitude` varchar(15) DEFAULT NULL,
  `StationdjuID` int(11) DEFAULT NULL,
  `StationmeteoID` int(11) DEFAULT NULL,
  `Commentaire` text,
  `CoordonneeID` int(11) DEFAULT NULL,
  `Adresse1` varchar(45) DEFAULT NULL,
  `Adresse2` varchar(45) DEFAULT NULL,
  `Adresse3` varchar(45) DEFAULT NULL,
  `Codepostal` int(11) DEFAULT NULL,
  `Ville` varchar(45) DEFAULT NULL,
  `Pays` varchar(45) DEFAULT NULL,
  `Energie` int(11) DEFAULT NULL,
  PRIMARY KEY (`PosteproductionID`,`BaseID`),
  KEY `posteproductions_belongto_Categorie` (`CategorieID`),
  KEY `indexprod` (`Productiontheorique`),
  KEY `belong_to_Base` (`BaseID`),
  KEY `MouvrageID` (`MouvrageID`,`Nom`),
  KEY `StationmeteoID` (`StationmeteoID`),
  KEY `StationdjuID` (`StationdjuID`),
  KEY `CoordonneeID` (`CoordonneeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `posteproduction`
--

INSERT INTO `posteproduction` (`PosteproductionID`, `CategorieID`, `MouvrageID`, `Nom`, `Description`, `Productiontheorique`, `Coutinitial`, `BaseID`, `Anneeconstruction`, `Cadastre`, `Latitude`, `Longitude`, `StationdjuID`, `StationmeteoID`, `Commentaire`, `CoordonneeID`, `Adresse1`, `Adresse2`, `Adresse3`, `Codepostal`, `Ville`, `Pays`, `Energie`) VALUES
(1, 139, 1, 'qdqd qsdqsd', '', '0.00', 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 0, '', '', '', NULL, NULL, '', 2, '', '', '', 0, '', '', NULL),
(2, 138, 2, 'qdqdqsd', NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 8, NULL, '2', '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2),
(3, 137, 2, 'dqqsdqsdddqs qsdqsd qsdqsd', NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 20, NULL, '10', '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(4, 139, 2, 'qqdqdqsd', NULL, NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `preconisation`
--

CREATE TABLE IF NOT EXISTS `preconisation` (
  `PreconisationID` int(11) NOT NULL AUTO_INCREMENT,
  `BaseID` char(36) NOT NULL,
  `DiagnostiqueID` int(11) NOT NULL,
  `MouvrageID` int(11) NOT NULL,
  `EvolutionID` int(11) NOT NULL,
  `Priorite` tinyint(4) NOT NULL,
  `Quantitatif` decimal(11,2) DEFAULT NULL,
  `Investissement` decimal(11,2) DEFAULT NULL,
  `Gainannueleuro` decimal(11,2) DEFAULT NULL,
  `Gainannuelkwh` decimal(11,2) DEFAULT NULL,
  `Gainannuelges` decimal(11,2) DEFAULT NULL,
  `Tpsretourbrut` decimal(11,2) DEFAULT NULL,
  `Dureeinvest` decimal(11,2) DEFAULT NULL,
  `Gaindureevie` decimal(11,2) DEFAULT NULL,
  `Commentaire` text,
  PRIMARY KEY (`PreconisationID`,`BaseID`),
  KEY `DiagnostiqueID` (`DiagnostiqueID`),
  KEY `MouvrageID` (`MouvrageID`),
  KEY `BaseID` (`BaseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `psouscrite`
--

CREATE TABLE IF NOT EXISTS `psouscrite` (
  `PsouscriteID` int(11) NOT NULL AUTO_INCREMENT,
  `Puissance` decimal(11,2) DEFAULT NULL,
  `Puissancejaune` decimal(11,2) DEFAULT NULL,
  `Pointe` decimal(11,2) DEFAULT NULL,
  `Heurescreusesete` decimal(11,2) DEFAULT NULL,
  `Heurescreuseshiver` decimal(11,2) DEFAULT NULL,
  `Heurespleinesete` decimal(11,2) DEFAULT NULL,
  `Heurespleineshiver` decimal(11,2) DEFAULT NULL,
  `Heurespleinedemi` decimal(11,2) DEFAULT NULL,
  `Heurescreusesdemi` decimal(11,2) DEFAULT NULL,
  `Reduite` decimal(11,2) DEFAULT NULL,
  `BaseID` char(36) NOT NULL,
  `MouvrageID` int(11) NOT NULL,
  `CompteurID` int(11) NOT NULL,
  `Debutcontrat` date DEFAULT NULL,
  `Fincontrat` date DEFAULT NULL,
  `Tarif` int(11) DEFAULT NULL,
  `Zonetarif` varchar(255) DEFAULT NULL,
  `Commentaires` text,
  PRIMARY KEY (`PsouscriteID`,`BaseID`),
  KEY `belong_to_Base` (`BaseID`),
  KEY `CompteurID` (`CompteurID`),
  KEY `MouvrageID` (`MouvrageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ratio`
--

CREATE TABLE IF NOT EXISTS `ratio` (
  `RatioID` int(11) NOT NULL AUTO_INCREMENT,
  `CategorieID` int(11) DEFAULT NULL,
  `Nom` varchar(45) DEFAULT NULL,
  `Habitantmin` int(11) DEFAULT NULL,
  `Habitantmax` int(11) DEFAULT NULL,
  `Budgetener` decimal(11,2) DEFAULT NULL,
  `Consohab` int(11) DEFAULT NULL,
  `Couthab` decimal(11,2) DEFAULT NULL,
  `RepartBatiment` varchar(45) DEFAULT NULL,
  `Reparteclairage` int(11) DEFAULT NULL,
  `Repartvehicule` int(11) DEFAULT NULL,
  `Nbrptslumineux` int(11) DEFAULT NULL,
  `Kwptslumineux` decimal(11,2) DEFAULT NULL,
  `Heureseclairees` int(11) DEFAULT NULL,
  `BaseID` char(36) NOT NULL,
  PRIMARY KEY (`RatioID`,`BaseID`),
  KEY `belong_to_Base` (`BaseID`),
  KEY `CategorieID` (`CategorieID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `ratio`
--

INSERT INTO `ratio` (`RatioID`, `CategorieID`, `Nom`, `Habitantmin`, `Habitantmax`, `Budgetener`, `Consohab`, `Couthab`, `RepartBatiment`, `Reparteclairage`, `Repartvehicule`, `Nbrptslumineux`, `Kwptslumineux`, `Heureseclairees`, `BaseID`) VALUES
(1, 25, 'enqu├¬te nationale 2005', 1, 1999, '5.70', 412, '31.90', '74', 20, 6, 23, '82.00', 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2, 25, 'enqu├¬te nationale 2005', 2000, 9999, '4.60', 537, '37.20', '74', 20, 6, 33, '107.00', 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(3, 25, 'enqu├¬te nationale 2005', 10000, 49999, '3.40', 606, '40.00', '77', 16, 7, 43, '97.00', 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(4, 25, 'enqu├¬te nationale 2005', 500000, 5000000, '2.60', 500, '33.10', '76', 17, 7, 46, '85.00', 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f');

-- --------------------------------------------------------

--
-- Structure de la table `ratiosconso`
--

CREATE TABLE IF NOT EXISTS `ratiosconso` (
  `RatiosconsoID` int(11) NOT NULL AUTO_INCREMENT,
  `RatioID` int(11) DEFAULT NULL,
  `CategorieID` int(11) DEFAULT NULL,
  `Moyef` int(11) DEFAULT NULL,
  `DJU2494` int(11) DEFAULT NULL,
  `Moyep` int(11) DEFAULT NULL,
  `DJU1981` int(11) DEFAULT NULL,
  `Heures_mois` int(11) DEFAULT NULL,
  `BaseID` char(36) NOT NULL,
  PRIMARY KEY (`RatiosconsoID`,`BaseID`),
  KEY `ratiosconsos_belong_to_ratio` (`RatioID`),
  KEY `ratiosconsos_belong_to_Categorie` (`CategorieID`),
  KEY `belong_to_Base` (`BaseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `releve`
--

CREATE TABLE IF NOT EXISTS `releve` (
  `ReleveID` int(11) NOT NULL AUTO_INCREMENT,
  `SouscompteurID` int(11) DEFAULT NULL,
  `Datereleve` date DEFAULT NULL,
  `IndexCompteur` decimal(11,2) DEFAULT NULL,
  `Dateprecedent` date DEFAULT NULL,
  `Consommation` decimal(11,2) DEFAULT NULL,
  `BaseID` char(36) NOT NULL,
  `MouvrageID` int(11) NOT NULL,
  PRIMARY KEY (`ReleveID`,`BaseID`),
  KEY `releves_belong_to_sousCompteur` (`SouscompteurID`),
  KEY `indexdate` (`Datereleve`),
  KEY `indexconso` (`Consommation`),
  KEY `belong_to_Base` (`BaseID`),
  KEY `MouvrageID` (`MouvrageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `resultatbatiment`
--

CREATE TABLE IF NOT EXISTS `resultatbatiment` (
  `Annee` year(4) NOT NULL,
  `BatimentID` int(11) NOT NULL,
  `MouvrageID` int(11) NOT NULL,
  `CategorieID` int(11) NOT NULL,
  `Surfacechauffee` int(11) NOT NULL DEFAULT '0',
  `Consoef` decimal(11,2) NOT NULL DEFAULT '0.00',
  `Consoep` decimal(11,2) NOT NULL DEFAULT '0.00',
  `Ttc` decimal(11,2) NOT NULL DEFAULT '0.00',
  `Consoeau` decimal(11,2) NOT NULL DEFAULT '0.00',
  `Ttceau` decimal(11,2) NOT NULL DEFAULT '0.00',
  `Emissionges` decimal(11,2) NOT NULL DEFAULT '0.00',
  `Consoefm2` decimal(11,2) NOT NULL DEFAULT '0.00',
  `Consoepm2` decimal(11,2) NOT NULL DEFAULT '0.00',
  `Ttcm2` decimal(11,2) NOT NULL DEFAULT '0.00',
  `Emissiongesm2` decimal(11,2) NOT NULL DEFAULT '0.00',
  `Consoeaum2` decimal(11,2) NOT NULL DEFAULT '0.00',
  `Ttceaum2` decimal(11,2) NOT NULL DEFAULT '0.00',
  `Datemaj` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `BaseID` char(36) NOT NULL,
  PRIMARY KEY (`Annee`,`BatimentID`,`BaseID`),
  KEY `BaseID` (`BaseID`),
  KEY `MouvrageID` (`MouvrageID`),
  KEY `BatimentID` (`BatimentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `resultatbatiment`
--

INSERT INTO `resultatbatiment` (`Annee`, `BatimentID`, `MouvrageID`, `CategorieID`, `Surfacechauffee`, `Consoef`, `Consoep`, `Ttc`, `Consoeau`, `Ttceau`, `Emissionges`, `Consoefm2`, `Consoepm2`, `Ttcm2`, `Emissiongesm2`, `Consoeaum2`, `Ttceaum2`, `Datemaj`, `BaseID`) VALUES
(2013, 6, 2, 4, 1000, '0.00', '0.00', '0.00', '54032.78', '671514.03', '0.00', '0.00', '0.00', '0.00', '0.00', '54.03', '671.51', '2014-10-20 18:01:52', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2013, 7, 2, 4, 700, '0.00', '0.00', '138668.20', '0.00', '0.00', '0.00', '0.00', '0.00', '198.10', '0.00', '0.00', '0.00', '2014-10-20 18:01:52', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2014, 6, 2, 4, 1000, '0.00', '0.00', '0.00', '736.22', '9149.43', '0.00', '0.00', '0.00', '0.00', '0.00', '0.74', '9.15', '2014-10-20 18:01:52', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2014, 7, 2, 4, 700, '0.00', '0.00', '1626.54', '0.00', '0.00', '0.00', '0.00', '0.00', '2.32', '0.00', '0.00', '0.00', '2014-10-20 18:01:52', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f');

-- --------------------------------------------------------

--
-- Structure de la table `resultatcompteur`
--

CREATE TABLE IF NOT EXISTS `resultatcompteur` (
  `Annee` year(4) NOT NULL,
  `CompteurID` int(11) NOT NULL,
  `MouvrageID` int(11) NOT NULL,
  `Conso` decimal(11,2) DEFAULT '0.00',
  `Consoef` decimal(11,2) DEFAULT '0.00',
  `Consoep` decimal(11,2) DEFAULT '0.00',
  `Ttc` decimal(11,2) DEFAULT '0.00',
  `Emissionges` decimal(11,2) DEFAULT '0.00',
  `Datemaj` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `BaseID` char(36) NOT NULL,
  PRIMARY KEY (`Annee`,`CompteurID`,`BaseID`),
  KEY `BaseID` (`BaseID`),
  KEY `MouvrageID` (`MouvrageID`),
  KEY `CompteurID` (`CompteurID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `resultatcompteur`
--

INSERT INTO `resultatcompteur` (`Annee`, `CompteurID`, `MouvrageID`, `Conso`, `Consoef`, `Consoep`, `Ttc`, `Emissionges`, `Datemaj`, `BaseID`) VALUES
(2010, 2, 2, '3251.00', '0.00', '0.00', '40279.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2010, 4, 2, '2192.00', '0.00', '0.00', '27105.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2010, 5, 2, '5317.00', '0.00', '0.00', '65980.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2010, 6, 2, '2940.00', '0.00', '0.00', '36410.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2010, 7, 2, '2487.00', '0.00', '0.00', '30775.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2010, 10, 2, '2240.00', '23700.00', '23700.00', '21728.00', '6399.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2010, 11, 2, '3600.00', '38088.00', '38088.00', '34920.00', '10284.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2010, 12, 2, '1554.00', '16442.00', '16442.00', '15074.00', '4440.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2010, 13, 2, '7350.00', '77763.00', '77763.00', '71295.00', '20997.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2010, 14, 2, '9125.00', '96543.00', '96543.00', '88513.00', '26067.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2010, 15, 2, '288.00', '288.00', '742.00', '431.00', '25.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2010, 16, 2, '34022.00', '34022.00', '87775.00', '51032.00', '2858.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2010, 17, 2, '10426.00', '10426.00', '26898.00', '15639.00', '876.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2010, 18, 2, '14581.00', '14581.00', '37618.00', '21871.00', '1225.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2010, 19, 2, '24218.00', '24218.00', '62480.00', '36326.00', '2035.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2010, 20, 2, '0.00', '0.00', '0.00', '0.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2011, 2, 2, '6393.00', '0.00', '0.00', '79366.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2011, 4, 2, '3426.00', '0.00', '0.00', '42457.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2011, 5, 2, '15999.00', '0.00', '0.00', '198865.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2011, 6, 2, '2087.00', '0.00', '0.00', '258000.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2011, 7, 2, '23735.00', '0.00', '0.00', '1921.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2011, 10, 2, '1960.00', '20737.00', '20737.00', '19012.00', '5599.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2011, 11, 2, '3330.00', '35232.00', '35232.00', '32301.00', '9513.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2011, 12, 2, '4440.00', '46976.00', '46976.00', '43068.00', '12684.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2011, 13, 2, '5250.00', '55545.00', '55545.00', '50925.00', '14998.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2011, 14, 2, '5000.00', '52900.00', '52900.00', '48500.00', '14284.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2011, 15, 2, '400.00', '400.00', '1032.00', '600.00', '34.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2011, 16, 2, '26841.00', '26841.00', '69249.00', '40261.00', '2255.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2011, 17, 2, '9368.00', '9368.00', '24168.00', '14052.00', '787.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2011, 18, 2, '18667.00', '18667.00', '48161.00', '28000.00', '1569.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2011, 19, 2, '26667.00', '26667.00', '68801.00', '40000.00', '2241.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2011, 20, 2, '0.00', '0.00', '0.00', '0.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2012, 2, 2, '4831.00', '0.00', '0.00', '59935.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2012, 4, 2, '3241.00', '0.00', '0.00', '40155.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2012, 5, 2, '19612.00', '0.00', '0.00', '243811.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2012, 6, 2, '1271.00', '0.00', '0.00', '15649.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2012, 7, 2, '2672.00', '0.00', '0.00', '33077.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2012, 10, 2, '1120.00', '11850.00', '11850.00', '10864.00', '3200.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2012, 11, 2, '1710.00', '18092.00', '18092.00', '16587.00', '4885.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2012, 12, 2, '3626.00', '38364.00', '38364.00', '35173.00', '10359.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2012, 13, 2, '12775.00', '135160.00', '135160.00', '123918.00', '36494.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2012, 14, 2, '11250.00', '119025.00', '119025.00', '109125.00', '32137.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2012, 15, 2, '300.00', '300.00', '774.00', '450.00', '26.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2012, 16, 2, '30000.00', '30000.00', '77400.00', '45000.00', '2520.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2012, 17, 2, '10667.00', '10667.00', '27521.00', '16000.00', '897.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2012, 18, 2, '23334.00', '23334.00', '60200.00', '35000.00', '1960.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2012, 19, 2, '16667.00', '16667.00', '43001.00', '25000.00', '1401.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2012, 20, 2, '0.00', '0.00', '0.00', '0.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2013, 2, 2, '5902.00', '0.00', '0.00', '73257.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2013, 4, 2, '2472.00', '0.00', '0.00', '30579.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2013, 5, 2, '13841.00', '0.00', '0.00', '172010.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2013, 6, 2, '1019.00', '0.00', '0.00', '12512.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2013, 7, 2, '6880.00', '0.00', '0.00', '85416.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2013, 10, 2, '1400.00', '14812.00', '14812.00', '13580.00', '4000.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2013, 11, 2, '2160.00', '22853.00', '22853.00', '20952.00', '6171.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2013, 12, 2, '2516.00', '26620.00', '26620.00', '24406.00', '7188.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2013, 13, 2, '5950.00', '62951.00', '62951.00', '57715.00', '16997.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2013, 14, 2, '3750.00', '39675.00', '39675.00', '36375.00', '10713.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2013, 15, 2, '467.00', '467.00', '1205.00', '700.00', '40.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2013, 16, 2, '23334.00', '23334.00', '60200.00', '35000.00', '1960.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2013, 17, 2, '8667.00', '8667.00', '22361.00', '13000.00', '729.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2013, 18, 2, '26667.00', '26667.00', '68801.00', '40000.00', '2241.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2013, 19, 2, '20000.00', '20000.00', '51600.00', '30000.00', '1680.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2013, 20, 2, '0.00', '0.00', '0.00', '0.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2014, 2, 2, '0.00', '0.00', '0.00', '0.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2014, 4, 2, '0.00', '0.00', '0.00', '0.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2014, 5, 2, '0.00', '0.00', '0.00', '0.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2014, 6, 2, '0.00', '0.00', '0.00', '0.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2014, 7, 2, '0.00', '0.00', '0.00', '0.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2014, 10, 2, '0.00', '0.00', '0.00', '0.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2014, 11, 2, '0.00', '0.00', '0.00', '0.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2014, 12, 2, '0.00', '0.00', '0.00', '0.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2014, 13, 2, '0.00', '0.00', '0.00', '0.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2014, 14, 2, '0.00', '0.00', '0.00', '0.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2014, 15, 2, '0.00', '0.00', '0.00', '0.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2014, 16, 2, '0.00', '0.00', '0.00', '0.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2014, 17, 2, '0.00', '0.00', '0.00', '0.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2014, 18, 2, '0.00', '0.00', '0.00', '0.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2014, 19, 2, '0.00', '0.00', '0.00', '0.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2014, 20, 2, '0.00', '0.00', '0.00', '0.00', '0.00', '2014-10-29 09:25:03', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f');

-- --------------------------------------------------------

--
-- Structure de la table `resultatmo`
--

CREATE TABLE IF NOT EXISTS `resultatmo` (
  `Annee` year(4) NOT NULL,
  `MouvrageID` int(11) NOT NULL,
  `Consoenergie` int(11) DEFAULT '0',
  `Consoeau` int(11) DEFAULT '0',
  `Consoef` int(11) DEFAULT '0',
  `Consoep` int(11) DEFAULT '0',
  `Ttcenergie` int(11) DEFAULT '0',
  `Ttceau` int(11) DEFAULT '0',
  `Emissionges` int(11) DEFAULT '0',
  `Onucleaire` int(11) DEFAULT NULL,
  `Orenouvelable` int(11) DEFAULT NULL,
  `Ofossile` int(11) DEFAULT NULL,
  `Batsommeconsoef` int(11) DEFAULT '0',
  `Batsommeconsoep` int(11) DEFAULT '0',
  `Batsommettc` int(11) DEFAULT '0',
  `Batsommeges` int(11) DEFAULT '0',
  `Batsommeconsoeau` int(11) DEFAULT '0',
  `Batsommettceau` int(11) DEFAULT '0',
  `Epsommeconsoef` int(11) DEFAULT '0',
  `Epsommeconsoep` int(11) DEFAULT '0',
  `Epsommettc` int(11) DEFAULT '0',
  `Epsommeges` int(11) DEFAULT '0',
  `Epsommeconsoeau` int(11) DEFAULT '0',
  `Epsommettceau` int(11) DEFAULT '0',
  `Vehsommeconsoef` int(11) DEFAULT '0',
  `Vehsommeconsoep` int(11) DEFAULT '0',
  `Vehsommettc` int(11) DEFAULT '0',
  `Vehsommeges` int(11) DEFAULT '0',
  `Vehsommeconsoeau` int(11) DEFAULT '0',
  `Vehsommettceau` int(11) DEFAULT '0',
  `Apsommeconsoef` int(11) DEFAULT '0',
  `Apsommeconsoep` int(11) DEFAULT '0',
  `Apsommettc` int(11) DEFAULT '0',
  `Apsommeges` int(11) DEFAULT '0',
  `Apsommeconsoeau` int(11) DEFAULT '0',
  `Apsommettceau` int(11) DEFAULT '0',
  `Prodsommeconsoef` int(11) DEFAULT '0',
  `Prodsommeconsoep` int(11) DEFAULT '0',
  `Prodsommettc` int(11) DEFAULT '0',
  `Prodsommeges` int(11) DEFAULT '0',
  `Prodsommeconsoeau` int(11) DEFAULT '0',
  `Prodsommettceau` int(11) DEFAULT '0',
  `Datemaj` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `BaseID` char(36) NOT NULL,
  PRIMARY KEY (`Annee`,`MouvrageID`,`BaseID`),
  KEY `BaseID` (`BaseID`),
  KEY `MouvrageID` (`MouvrageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `resultatmo`
--

INSERT INTO `resultatmo` (`Annee`, `MouvrageID`, `Consoenergie`, `Consoeau`, `Consoef`, `Consoep`, `Ttcenergie`, `Ttceau`, `Emissionges`, `Onucleaire`, `Orenouvelable`, `Ofossile`, `Batsommeconsoef`, `Batsommeconsoep`, `Batsommettc`, `Batsommeges`, `Batsommeconsoeau`, `Batsommettceau`, `Epsommeconsoef`, `Epsommeconsoep`, `Epsommettc`, `Epsommeges`, `Epsommeconsoeau`, `Epsommettceau`, `Vehsommeconsoef`, `Vehsommeconsoep`, `Vehsommettc`, `Vehsommeges`, `Vehsommeconsoeau`, `Vehsommettceau`, `Apsommeconsoef`, `Apsommeconsoep`, `Apsommettc`, `Apsommeges`, `Apsommeconsoeau`, `Apsommettceau`, `Prodsommeconsoef`, `Prodsommeconsoep`, `Prodsommettc`, `Prodsommeges`, `Prodsommeconsoeau`, `Prodsommettceau`, `Datemaj`, `BaseID`) VALUES
(2013, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2014-12-02 17:43:36', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2013, 2, 97383, 27642, 246046, 371078, 302307, 343195, 51719, 66473, 5539, 174033, 31520, 45214, 64531, 6900, 27642, 343195, 79135, 204167, 118700, 6650, 0, 0, 166911, 166911, 153028, 45069, 0, 0, 0, 0, 0, 0, 0, 0, 32468, 83766, 48700, 2729, 0, 0, '2014-12-03 13:27:23', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(2013, 13, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2014-12-02 17:43:36', '8e0910e0-cdee-70a1-55c3-b0f48ee8127f');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `RoleID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(32) NOT NULL,
  `Role` enum('OPERATEUR','SUPERUTILISATEUR','BE','BATIMENT','ESPACEVERT','ECLAIRAGE','VEHICULE','POSTEPRODUCTION','AUTREPOSTE','COMPTEUR','FACTURE') NOT NULL DEFAULT 'OPERATEUR',
  `record_id` int(11) NOT NULL,
  `BaseID` char(36) NOT NULL,
  PRIMARY KEY (`RoleID`),
  KEY `BaseID` (`BaseID`),
  KEY `record_id` (`record_id`),
  KEY `roles_ibfk_2` (`Username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`RoleID`, `Username`, `Role`, `record_id`, `BaseID`) VALUES
(1, 'aaa', 'OPERATEUR', 1, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(5, 'aaa', 'BATIMENT', 2, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(7, 'aaa', 'OPERATEUR', 13, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f'),
(10, 'cua', 'OPERATEUR', 2, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f');

-- --------------------------------------------------------

--
-- Structure de la table `souscompteur`
--

CREATE TABLE IF NOT EXISTS `souscompteur` (
  `SouscompteurID` int(11) NOT NULL AUTO_INCREMENT,
  `CompteurID` int(11) DEFAULT NULL,
  `CategorieID` int(11) DEFAULT NULL,
  `Nom` varchar(45) DEFAULT NULL,
  `Localisation` varchar(45) DEFAULT NULL,
  `BaseID` char(36) NOT NULL,
  `MouvrageID` int(11) NOT NULL,
  PRIMARY KEY (`SouscompteurID`,`BaseID`),
  KEY `sousCompteurs_belong_to_Compteur` (`CompteurID`),
  KEY `sousCompteurs_belongto_Categorie` (`CategorieID`),
  KEY `indexNom` (`Nom`),
  KEY `belong_to_Base` (`BaseID`),
  KEY `MouvrageID` (`MouvrageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `stationdju`
--

CREATE TABLE IF NOT EXISTS `stationdju` (
  `StationdjuID` int(11) NOT NULL AUTO_INCREMENT,
  `StationdjuparenteID` int(11) DEFAULT NULL,
  `Ville` varchar(45) DEFAULT NULL,
  `Codepostal` int(11) DEFAULT NULL,
  `Jourchauffe` int(11) DEFAULT NULL,
  `Reference` int(20) DEFAULT NULL,
  `Source` varchar(250) DEFAULT NULL,
  `Actif` tinyint(1) NOT NULL DEFAULT '1',
  `BaseID` char(36) NOT NULL,
  `TEBhiver` tinyint(4) DEFAULT NULL,
  `TEBete` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`StationdjuID`,`BaseID`),
  KEY `indexVille` (`Ville`),
  KEY `belong_to_Base` (`BaseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `stationmeteo`
--

CREATE TABLE IF NOT EXISTS `stationmeteo` (
  `StationmeteoID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(45) DEFAULT NULL,
  `Ville` varchar(45) DEFAULT NULL,
  `Codepostal` int(11) DEFAULT NULL,
  `BaseID` char(36) NOT NULL,
  PRIMARY KEY (`StationmeteoID`,`BaseID`),
  KEY `indexVille` (`Ville`),
  KEY `belong_to_Base` (`BaseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tarifsreglemente`
--

CREATE TABLE IF NOT EXISTS `tarifsreglemente` (
  `TarifsreglementeID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(45) DEFAULT NULL,
  `Codetarif` varchar(45) DEFAULT NULL,
  `Option` varchar(45) DEFAULT NULL,
  `Puissance` varchar(45) DEFAULT NULL,
  `Disjoncteur` varchar(45) DEFAULT NULL,
  `Zonetarif` varchar(45) DEFAULT NULL,
  `Commentaires` varchar(45) DEFAULT NULL,
  `BaseID` char(36) NOT NULL,
  PRIMARY KEY (`TarifsreglementeID`,`BaseID`),
  KEY `indexNom` (`Nom`),
  KEY `indexoption` (`Option`),
  KEY `belong_to_Base` (`BaseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `UtilisateurID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(32) NOT NULL,
  `password` varchar(60) NOT NULL,
  `Mail` varchar(100) DEFAULT NULL,
  `Menucomplet` tinyint(4) DEFAULT NULL,
  `isadmin` tinyint(1) NOT NULL DEFAULT '0',
  `isbe` tinyint(4) NOT NULL DEFAULT '0',
  `BaseID` char(36) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`UtilisateurID`,`BaseID`),
  UNIQUE KEY `identifiant` (`Username`),
  KEY `belong_to_Base` (`BaseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`UtilisateurID`, `Username`, `password`, `Mail`, `Menucomplet`, `isadmin`, `isbe`, `BaseID`, `remember_token`) VALUES
(1, 'Admin', '85aac14e99386ee8f68c89372821b1ca', NULL, 1, 1, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'RzRvGVlFdqyPEj9SkJJQzVPqeu1dq1hleH9yrv1HSUwCPaCjITjh2dDqr8NL'),
(2, 'Utilisateur_test', 'd8578edf8458ce06fbc5bb76a58c5ca4', NULL, NULL, 0, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL),
(3, 'cua', 'c8520774f9240cfe9d240d2ee7b9fb1f', '', NULL, 0, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 'TGaeCtBlSoGDwUfuPIZkhka4kInQESweKa9HWSvd5Rb82FwgLR4BcuUPZ6WR'),
(5, 'test', '', NULL, NULL, 0, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL),
(7, 'test1', '', 'me@test.com', NULL, 0, 0, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL),
(8, 'test2', '', 'me@test.com', NULL, 1, 1, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL),
(9, 'aaa', '08f8e0260c64418510cefb2b06eee5cd', 'me@test.com', NULL, 1, 1, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', '9CxfWZG5NdGVN2ZEkEBnQgF7TF7LdJ6f4wTXaEuxqI6kPRRasrA6FkQiQpLQ'),
(10, 'Tree lll mmo', '361228d0a65bd2355b029b2fe0aad7c6', 'tree@tree.com', NULL, 0, 1, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE IF NOT EXISTS `vehicule` (
  `VehiculeID` int(11) NOT NULL AUTO_INCREMENT,
  `CategorieID` int(11) DEFAULT NULL,
  `MouvrageID` int(11) NOT NULL,
  `Nom` varchar(45) NOT NULL,
  `Anneeconstruction` int(4) DEFAULT NULL,
  `Marque` varchar(45) DEFAULT NULL,
  `Modele` varchar(45) DEFAULT NULL,
  `Carburant` varchar(45) DEFAULT NULL,
  `Puissance` varchar(45) DEFAULT NULL,
  `Conso` varchar(45) DEFAULT NULL,
  `Commentaire` text,
  `CoordonneeID` int(11) DEFAULT NULL,
  `BaseID` char(36) NOT NULL,
  `NbrJrReparation` int(11) DEFAULT NULL,
  `DistanceParcourue` int(11) DEFAULT NULL,
  `Service` int(11) DEFAULT NULL,
  `Taille` int(11) DEFAULT NULL,
  PRIMARY KEY (`VehiculeID`,`BaseID`),
  KEY `vehicules_belong_to_Categorie` (`CategorieID`),
  KEY `belong_to_Base` (`BaseID`),
  KEY `MouvrageID` (`MouvrageID`),
  KEY `CoordonneeID` (`CoordonneeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `vehicule`
--

INSERT INTO `vehicule` (`VehiculeID`, `CategorieID`, `MouvrageID`, `Nom`, `Anneeconstruction`, `Marque`, `Modele`, `Carburant`, `Puissance`, `Conso`, `Commentaire`, `CoordonneeID`, `BaseID`, `NbrJrReparation`, `DistanceParcourue`, `Service`, `Taille`) VALUES
(1, 21, 2, 'chevrolet', 2008, 'sss', 'optra', '42', '9', '2323', 'qsdqsd', 2, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 0, 0, 42, 0),
(2, 113, 2, '116346 J', NULL, NULL, 'Benne Tasseuse', '42', NULL, '9', NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 0, 0, 0, 0),
(3, 113, 2, '163698 J', NULL, ' Benne Satellite Toyota', NULL, '42', NULL, '7.4', NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 0, 0, 0, 0),
(4, 113, 2, '62379 J', NULL, NULL, 'Camion citerne ', '42', NULL, '35', '<p>v&eacute;hicule en &nbsp;mauvais &eacute;tat</p>', NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 0, 0, 0, 0),
(5, 113, 2, '79529 J', NULL, NULL, 'Camion nacelle', '42', NULL, '25', NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 0, 0, 0, 0),
(6, 113, 2, '109742 J', NULL, ' Messersi', 'Dumper', '42', NULL, '5.6', NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 0, 0, 0, 0),
(7, 20, 1, 'qsdqdqsd qsdqsdqsd', 0, '', '', '117', '', NULL, '', 2, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 0, 0, 0, 0),
(8, 20, 2, 'qsdqsd', NULL, '', '', '117', '', '', NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 0, 0, 117, 0),
(9, 20, 2, 'qdq', NULL, '', '', '117', '', '', NULL, NULL, '8e0910e0-cdee-70a1-55c3-b0f48ee8127f', 0, 0, 117, 0);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vueexemplarite`
--
CREATE TABLE IF NOT EXISTS `vueexemplarite` (
`ExemplariteID` int(11)
,`BaseID` char(36)
,`MouvrageID` int(11)
,`BatimentID` int(11)
,`UtilisateurID` int(11)
,`Date` date
,`AccordMO` tinyint(1)
,`Commentairedescriptif` text
,`Annee` year(4)
,`CategorieID` int(11)
,`Surfacechauffee` int(11)
,`Consoepm2` decimal(11,2)
,`Consoefm2` decimal(11,2)
,`Ttcm2` decimal(11,2)
,`Emissiongesm2` decimal(11,2)
,`Consoeaum2` decimal(11,2)
,`Ttceaum2` decimal(11,2)
,`Datedescriptif` date
,`Surface` int(11)
,`Nbrniveaux` int(11)
,`Tempsusage` int(11)
,`Toiture` int(11)
,`Frequentation` int(11)
,`Commentaires` text
,`Toitureiso` int(11)
,`Mur` int(11)
,`Muriso` int(11)
,`Plancher` int(11)
,`Plancheriso` int(11)
,`Fenetre` int(11)
,`Vitrage` int(11)
,`Precisionbati` text
,`Chauffageener` int(11)
,`Chauffagesysteme` int(11)
,`Chauffagepuissance` int(11)
,`Programmation` tinyint(4)
,`Robinets` tinyint(4)
,`Climatisation` int(11)
,`Eauchaude` int(11)
,`Ventilation` int(11)
,`Eclairage` int(11)
,`Eclairagepuissance` int(11)
,`Electropuissance` int(11)
,`Industrielpuissance` int(11)
,`Precisionequipement` text
,`Photo` varchar(45)
,`Nom` varchar(45)
,`Anneeconstruction` int(4)
,`Voisinage` int(11)
,`Orientation` int(11)
,`Exposition` int(11)
,`altitude` int(11)
,`StationdjuID` int(11)
,`commentaire` text
);
-- --------------------------------------------------------

--
-- Structure de la vue `compteur_affecte`
--
DROP TABLE IF EXISTS `compteur_affecte`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `compteur_affecte` AS select `c`.`MouvrageID` AS `MouvrageID`,`m`.`Societe` AS `Mouvrage`,`c`.`Nom` AS `Compteur`,`c`.`Reference` AS `Numero_Compteur`,`c`.`CompteurID` AS `ID_Compteur`,`cb`.`Pourcentage` AS `Pourcentage_Bat`,`b`.`Nom` AS `Batiment`,`ce`.`Pourcentage` AS `Pourcentage_Ecl`,`e`.`Nom` AS `Eclairage`,`cv`.`Pourcentage` AS `Pourcentage_Veh`,`v`.`Nom` AS `Vehicule`,`cp`.`Pourcentage` AS `Pourcentage_Prod`,`p`.`Nom` AS `Production`,`ca`.`Pourcentage` AS `Pourcentage_Autre`,`a`.`Nom` AS `Autre`,`c`.`Localisation` AS `Localisation` from (((((((((((`compteur` `c` left join `compteurbatiments` `cb` on((`c`.`CompteurID` = `cb`.`CompteurID`))) left join `compteureclairages` `ce` on((`c`.`CompteurID` = `ce`.`CompteurID`))) left join `compteurautrepostes` `ca` on((`c`.`CompteurID` = `ca`.`CompteurID`))) left join `compteurposteproductions` `cp` on((`c`.`CompteurID` = `cp`.`CompteurID`))) left join `compteurvehicules` `cv` on((`c`.`CompteurID` = `cv`.`CompteurID`))) left join `mouvrage` `m` on((`c`.`MouvrageID` = `m`.`MouvrageID`))) left join `batiment` `b` on((`cb`.`BatimentID` = `b`.`BatimentID`))) left join `autreposte` `a` on((`ca`.`AutreposteID` = `a`.`AutreposteID`))) left join `posteproduction` `p` on((`cp`.`PosteproductionID` = `p`.`PosteproductionID`))) left join `eclairage` `e` on((`ce`.`EclairageID` = `e`.`EclairageID`))) left join `vehicule` `v` on((`cv`.`VehiculeID` = `v`.`VehiculeID`))) order by `m`.`Societe`;

-- --------------------------------------------------------

--
-- Structure de la vue `compteur_affecte_autre`
--
DROP TABLE IF EXISTS `compteur_affecte_autre`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `compteur_affecte_autre` AS select `c`.`MouvrageID` AS `MouvrageID`,`m`.`Societe` AS `Mouvrage`,`c`.`Nom` AS `Compteur`,`c`.`Reference` AS `Numero_Compteur`,`c`.`CompteurID` AS `ID_Compteur`,`ca`.`Pourcentage` AS `Pourcentage_Autre`,`a`.`Nom` AS `Autre`,`c`.`Localisation` AS `Localisation` from (((`compteur` `c` left join `compteurautrepostes` `ca` on((`c`.`CompteurID` = `ca`.`CompteurID`))) left join `mouvrage` `m` on((`c`.`MouvrageID` = `m`.`MouvrageID`))) left join `autreposte` `a` on((`ca`.`AutreposteID` = `a`.`AutreposteID`))) order by `m`.`Societe`;

-- --------------------------------------------------------

--
-- Structure de la vue `compteur_affecte_batiment`
--
DROP TABLE IF EXISTS `compteur_affecte_batiment`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `compteur_affecte_batiment` AS select `c`.`MouvrageID` AS `MouvrageID`,`m`.`Societe` AS `Mouvrage`,`c`.`Nom` AS `Compteur`,`c`.`Reference` AS `Numero_Compteur`,`c`.`CompteurID` AS `ID_Compteur`,`cb`.`Pourcentage` AS `Pourcentage_Bat`,`b`.`Nom` AS `Batiment`,`c`.`Localisation` AS `Localisation` from (((`compteur` `c` left join `compteurbatiments` `cb` on((`c`.`CompteurID` = `cb`.`CompteurID`))) left join `mouvrage` `m` on((`c`.`MouvrageID` = `m`.`MouvrageID`))) left join `batiment` `b` on((`cb`.`BatimentID` = `b`.`BatimentID`))) order by `m`.`Societe`;

-- --------------------------------------------------------

--
-- Structure de la vue `compteur_affecte_eclairage`
--
DROP TABLE IF EXISTS `compteur_affecte_eclairage`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `compteur_affecte_eclairage` AS select `c`.`MouvrageID` AS `MouvrageID`,`m`.`Societe` AS `Mouvrage`,`c`.`Nom` AS `Compteur`,`c`.`Reference` AS `Numero_Compteur`,`c`.`CompteurID` AS `ID_Compteur`,`ce`.`Pourcentage` AS `Pourcentage_Ecl`,`e`.`Nom` AS `Eclairage`,`c`.`Localisation` AS `Localisation` from (((`compteur` `c` left join `compteureclairages` `ce` on((`c`.`CompteurID` = `ce`.`CompteurID`))) left join `mouvrage` `m` on((`c`.`MouvrageID` = `m`.`MouvrageID`))) left join `eclairage` `e` on((`ce`.`EclairageID` = `e`.`EclairageID`))) order by `m`.`Societe`;

-- --------------------------------------------------------

--
-- Structure de la vue `compteur_affecte_production`
--
DROP TABLE IF EXISTS `compteur_affecte_production`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `compteur_affecte_production` AS select `c`.`MouvrageID` AS `MouvrageID`,`m`.`Societe` AS `Mouvrage`,`c`.`Nom` AS `Compteur`,`c`.`Reference` AS `Numero_Compteur`,`c`.`CompteurID` AS `ID_Compteur`,`cp`.`Pourcentage` AS `Pourcentage_Prod`,`p`.`Nom` AS `Production`,`c`.`Localisation` AS `Localisation` from (((`compteur` `c` left join `compteurposteproductions` `cp` on((`c`.`CompteurID` = `cp`.`CompteurID`))) left join `mouvrage` `m` on((`c`.`MouvrageID` = `m`.`MouvrageID`))) left join `posteproduction` `p` on((`cp`.`PosteproductionID` = `p`.`PosteproductionID`))) order by `m`.`Societe`;

-- --------------------------------------------------------

--
-- Structure de la vue `compteur_non_affecte`
--
DROP TABLE IF EXISTS `compteur_non_affecte`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `compteur_non_affecte` AS select `c`.`MouvrageID` AS `MouvrageID`,`m`.`Societe` AS `Mouvrage_Nom`,`c`.`CompteurID` AS `CompteurID`,`c`.`Nom` AS `Compteur_Nom`,`c`.`Localisation` AS `Compteur_Localisation` from ((((((`compteur` `c` left join `compteurbatiments` `cb` on((`c`.`CompteurID` = `cb`.`CompteurID`))) left join `compteureclairages` `ce` on((`c`.`CompteurID` = `ce`.`CompteurID`))) left join `compteurautrepostes` `ca` on((`c`.`CompteurID` = `ca`.`CompteurID`))) left join `compteurposteproductions` `cp` on((`c`.`CompteurID` = `cp`.`CompteurID`))) left join `compteurvehicules` `cv` on((`c`.`CompteurID` = `cv`.`CompteurID`))) left join `mouvrage` `m` on((`c`.`MouvrageID` = `m`.`MouvrageID`))) where (isnull(`cb`.`CompteurID`) and isnull(`ce`.`CompteurID`) and isnull(`ca`.`CompteurID`) and isnull(`cp`.`CompteurID`) and isnull(`cv`.`CompteurID`)) order by `m`.`Societe`;

-- --------------------------------------------------------

--
-- Structure de la vue `compteur_tarif`
--
DROP TABLE IF EXISTS `compteur_tarif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `compteur_tarif` AS select `c`.`MouvrageID` AS `MouvrageID`,`m`.`Societe` AS `Mouvrage`,`c`.`Nom` AS `Compteur`,`c`.`Reference` AS `Numero_Compteur`,`c`.`CompteurID` AS `ID_Compteur`,`c`.`Localisation` AS `Localisation`,`p`.`PsouscriteID` AS `PsouscriteID`,`p`.`Puissance` AS `Puissance`,`p`.`Puissancejaune` AS `Puissance2`,`p`.`Heurescreusesete` AS `HCE`,`p`.`Heurescreuseshiver` AS `HCH`,`p`.`Heurespleinesete` AS `HPE`,`p`.`Heurespleineshiver` AS `HPH`,`p`.`Heurespleinedemi` AS `HPD`,`p`.`Heurescreusesdemi` AS `HCD`,`p`.`Reduite` AS `Reduite`,`p`.`Debutcontrat` AS `Debutcontrat`,`p`.`Fincontrat` AS `Fincontrat`,`tar`.`Nom` AS `Tarif`,`p`.`Zonetarif` AS `ZoneTarif`,`p`.`Commentaires` AS `Commentaires` from (((`psouscrite` `p` left join `compteur` `c` on((`p`.`CompteurID` = `c`.`CompteurID`))) left join `mouvrage` `m` on((`c`.`MouvrageID` = `m`.`MouvrageID`))) left join `tarifsreglemente` `tar` on((`p`.`Tarif` = `tar`.`TarifsreglementeID`))) order by `m`.`Societe`;

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_accueil_28027921ea3b08043d0e0d5372201f20`
--
DROP TABLE IF EXISTS `dataface__view_accueil_28027921ea3b08043d0e0d5372201f20`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_accueil_28027921ea3b08043d0e0d5372201f20` AS select `accueil`.`accueil_id` AS `accueil_id` from `accueil`;

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_actionengagee_0d4f97da70e2bc89fa5e91bca22ae619`
--
DROP TABLE IF EXISTS `dataface__view_actionengagee_0d4f97da70e2bc89fa5e91bca22ae619`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_actionengagee_0d4f97da70e2bc89fa5e91bca22ae619` AS select `actionengagee`.`ActionengageeID` AS `ActionengageeID`,`actionengagee`.`BatimentID` AS `BatimentID`,`actionengagee`.`MouvrageID` AS `MouvrageID`,`actionengagee`.`BaseID` AS `BaseID`,`actionengagee`.`Date` AS `Date`,`actionengagee`.`EvolutionID` AS `EvolutionID`,`actionengagee`.`Cout` AS `Cout`,`actionengagee`.`Surface` AS `Surface`,`actionengagee`.`Commentaire` AS `Commentaire`,`roles`.`Role` AS `Role` from (`actionengagee` left join `roles` on(((`actionengagee`.`MouvrageID` = `roles`.`record_id`) and (`actionengagee`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'cua'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_actionengagee_712e1e78f6e1c4e13b93d6517c418be6`
--
DROP TABLE IF EXISTS `dataface__view_actionengagee_712e1e78f6e1c4e13b93d6517c418be6`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_actionengagee_712e1e78f6e1c4e13b93d6517c418be6` AS select `actionengagee`.`ActionengageeID` AS `ActionengageeID`,`actionengagee`.`BatimentID` AS `BatimentID`,`actionengagee`.`MouvrageID` AS `MouvrageID`,`actionengagee`.`BaseID` AS `BaseID`,`actionengagee`.`Date` AS `Date`,`actionengagee`.`EvolutionID` AS `EvolutionID`,`actionengagee`.`Cout` AS `Cout`,`actionengagee`.`Surface` AS `Surface`,`actionengagee`.`Commentaire` AS `Commentaire`,`roles`.`Role` AS `Role` from (`actionengagee` left join `roles` on(((`actionengagee`.`MouvrageID` = `roles`.`record_id`) and (`actionengagee`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'Admin'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_autreposte_c1566a2a24da30de02d3828003944da1`
--
DROP TABLE IF EXISTS `dataface__view_autreposte_c1566a2a24da30de02d3828003944da1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_autreposte_c1566a2a24da30de02d3828003944da1` AS select `autreposte`.`AutreposteID` AS `AutreposteID`,`autreposte`.`CategorieID` AS `CategorieID`,`autreposte`.`Nom` AS `Nom`,`autreposte`.`Anneeconstruction` AS `Anneeconstruction`,`autreposte`.`cadastre` AS `cadastre`,`autreposte`.`latitude` AS `latitude`,`autreposte`.`longitude` AS `longitude`,`autreposte`.`commentaire` AS `commentaire`,`autreposte`.`CoordonneeID` AS `CoordonneeID`,`autreposte`.`adresse1` AS `adresse1`,`autreposte`.`adresse2` AS `adresse2`,`autreposte`.`adresse3` AS `adresse3`,`autreposte`.`codepostal` AS `codepostal`,`autreposte`.`Ville` AS `Ville`,`autreposte`.`Pays` AS `Pays`,`autreposte`.`MouvrageID` AS `MouvrageID`,`autreposte`.`Puissance` AS `Puissance`,`autreposte`.`Descriptif` AS `Descriptif`,`autreposte`.`BaseID` AS `BaseID`,`roles`.`Role` AS `Role` from (`autreposte` left join `roles` on(((`autreposte`.`MouvrageID` = `roles`.`record_id`) and (`autreposte`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'Admin'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_autreposte_c421863e3d91d75472fac12f54abeb4f`
--
DROP TABLE IF EXISTS `dataface__view_autreposte_c421863e3d91d75472fac12f54abeb4f`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_autreposte_c421863e3d91d75472fac12f54abeb4f` AS select `autreposte`.`AutreposteID` AS `AutreposteID`,`autreposte`.`CategorieID` AS `CategorieID`,`autreposte`.`Nom` AS `Nom`,`autreposte`.`Anneeconstruction` AS `Anneeconstruction`,`autreposte`.`cadastre` AS `cadastre`,`autreposte`.`latitude` AS `latitude`,`autreposte`.`longitude` AS `longitude`,`autreposte`.`commentaire` AS `commentaire`,`autreposte`.`CoordonneeID` AS `CoordonneeID`,`autreposte`.`adresse1` AS `adresse1`,`autreposte`.`adresse2` AS `adresse2`,`autreposte`.`adresse3` AS `adresse3`,`autreposte`.`codepostal` AS `codepostal`,`autreposte`.`Ville` AS `Ville`,`autreposte`.`Pays` AS `Pays`,`autreposte`.`MouvrageID` AS `MouvrageID`,`autreposte`.`Puissance` AS `Puissance`,`autreposte`.`Descriptif` AS `Descriptif`,`autreposte`.`BaseID` AS `BaseID`,`roles`.`Role` AS `Role` from (`autreposte` left join `roles` on(((`autreposte`.`MouvrageID` = `roles`.`record_id`) and (`autreposte`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'cua'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_batiment_4a3369a9c22eeeb49520da4b66c4a043`
--
DROP TABLE IF EXISTS `dataface__view_batiment_4a3369a9c22eeeb49520da4b66c4a043`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_batiment_4a3369a9c22eeeb49520da4b66c4a043` AS select `batiment`.`BatimentID` AS `BatimentID`,`batiment`.`MouvrageID` AS `MouvrageID`,`batiment`.`Nom` AS `Nom`,`batiment`.`Anneeconstruction` AS `Anneeconstruction`,`batiment`.`Patrimoine` AS `Patrimoine`,`batiment`.`Voisinage` AS `Voisinage`,`batiment`.`Orientation` AS `Orientation`,`batiment`.`Exposition` AS `Exposition`,`batiment`.`altitude` AS `altitude`,`batiment`.`BaseID` AS `BaseID`,`batiment`.`Cadastre` AS `Cadastre`,`batiment`.`Latitude` AS `Latitude`,`batiment`.`Longitude` AS `Longitude`,`batiment`.`StationdjuID` AS `StationdjuID`,`batiment`.`StationmeteoID` AS `StationmeteoID`,`batiment`.`Commentaire` AS `Commentaire`,`batiment`.`CoordonneeID` AS `CoordonneeID`,`batiment`.`Adresse1` AS `Adresse1`,`batiment`.`Adresse2` AS `Adresse2`,`batiment`.`Adresse3` AS `Adresse3`,`batiment`.`Codepostal` AS `Codepostal`,`batiment`.`Ville` AS `Ville`,`batiment`.`Pays` AS `Pays`,`roles`.`Role` AS `Role` from (`batiment` left join `roles` on(((`batiment`.`MouvrageID` = `roles`.`record_id`) and (`batiment`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'Admin')))) order by `batiment`.`Nom`;

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_batiment_12c411a70a79a2bd94b7632c7837aab2`
--
DROP TABLE IF EXISTS `dataface__view_batiment_12c411a70a79a2bd94b7632c7837aab2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_batiment_12c411a70a79a2bd94b7632c7837aab2` AS select `batiment`.`BatimentID` AS `BatimentID`,`batiment`.`MouvrageID` AS `MouvrageID`,`batiment`.`Nom` AS `Nom`,`batiment`.`Anneeconstruction` AS `Anneeconstruction`,`batiment`.`Patrimoine` AS `Patrimoine`,`batiment`.`Voisinage` AS `Voisinage`,`batiment`.`Orientation` AS `Orientation`,`batiment`.`Exposition` AS `Exposition`,`batiment`.`altitude` AS `altitude`,`batiment`.`BaseID` AS `BaseID`,`batiment`.`Cadastre` AS `Cadastre`,`batiment`.`Latitude` AS `Latitude`,`batiment`.`Longitude` AS `Longitude`,`batiment`.`StationdjuID` AS `StationdjuID`,`batiment`.`StationmeteoID` AS `StationmeteoID`,`batiment`.`Commentaire` AS `Commentaire`,`batiment`.`CoordonneeID` AS `CoordonneeID`,`batiment`.`Adresse1` AS `Adresse1`,`batiment`.`Adresse2` AS `Adresse2`,`batiment`.`Adresse3` AS `Adresse3`,`batiment`.`Codepostal` AS `Codepostal`,`batiment`.`Ville` AS `Ville`,`batiment`.`Pays` AS `Pays`,`roles`.`Role` AS `Role` from (`batiment` left join `roles` on(((`batiment`.`MouvrageID` = `roles`.`record_id`) and (`batiment`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'cua')))) order by `batiment`.`Nom`;

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_batiment_434b21e9bf46389cd4e33fb6ce678939`
--
DROP TABLE IF EXISTS `dataface__view_batiment_434b21e9bf46389cd4e33fb6ce678939`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_batiment_434b21e9bf46389cd4e33fb6ce678939` AS select `batiment`.`BatimentID` AS `BatimentID`,`batiment`.`MouvrageID` AS `MouvrageID`,`batiment`.`Nom` AS `Nom`,`batiment`.`Anneeconstruction` AS `Anneeconstruction`,`batiment`.`Patrimoine` AS `Patrimoine`,`batiment`.`Voisinage` AS `Voisinage`,`batiment`.`Orientation` AS `Orientation`,`batiment`.`Exposition` AS `Exposition`,`batiment`.`altitude` AS `altitude`,`batiment`.`BaseID` AS `BaseID`,`batiment`.`Cadastre` AS `Cadastre`,`batiment`.`Latitude` AS `Latitude`,`batiment`.`Longitude` AS `Longitude`,`batiment`.`StationdjuID` AS `StationdjuID`,`batiment`.`StationmeteoID` AS `StationmeteoID`,`batiment`.`Commentaire` AS `Commentaire`,`batiment`.`CoordonneeID` AS `CoordonneeID`,`batiment`.`Adresse1` AS `Adresse1`,`batiment`.`Adresse2` AS `Adresse2`,`batiment`.`Adresse3` AS `Adresse3`,`batiment`.`Codepostal` AS `Codepostal`,`batiment`.`Ville` AS `Ville`,`batiment`.`Pays` AS `Pays`,`roles`.`Role` AS `Role` from (`batiment` left join `roles` on(((`batiment`.`MouvrageID` = `roles`.`record_id`) and (`batiment`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = '')))) order by `batiment`.`Nom`;

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_categorie_4f2d077f55396fbfc7eeb70cc930bbe9`
--
DROP TABLE IF EXISTS `dataface__view_categorie_4f2d077f55396fbfc7eeb70cc930bbe9`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_categorie_4f2d077f55396fbfc7eeb70cc930bbe9` AS select `categorie`.`CategorieID` AS `CategorieID`,`categorie`.`CategorieparenteID` AS `CategorieparenteID`,`categorie`.`Libelle` AS `Libelle`,`categorie`.`Description` AS `Description`,`categorie`.`BaseID` AS `BaseID`,`categorie`.`Couleur` AS `Couleur` from `categorie` where (`categorie`.`CategorieparenteID` <> 0) order by `categorie`.`CategorieparenteID`,`categorie`.`Libelle`;

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_compteur_8bf742c12cda589979d01913d7517953`
--
DROP TABLE IF EXISTS `dataface__view_compteur_8bf742c12cda589979d01913d7517953`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_compteur_8bf742c12cda589979d01913d7517953` AS select `compteur`.`CompteurID` AS `CompteurID`,`compteur`.`Nom` AS `Nom`,`compteur`.`Reference` AS `Reference`,`compteur`.`Numero` AS `Numero`,`compteur`.`EnergieID` AS `EnergieID`,`compteur`.`FournisseurID` AS `FournisseurID`,`compteur`.`Localisation` AS `Localisation`,`compteur`.`Nomprestataire` AS `Nomprestataire`,`compteur`.`Seuil` AS `Seuil`,`compteur`.`Commentaire` AS `Commentaire`,`compteur`.`Caracteristique` AS `Caracteristique`,`compteur`.`Objectif` AS `Objectif`,`compteur`.`Estenergie` AS `Estenergie`,`compteur`.`Clos` AS `Clos`,`compteur`.`BaseID` AS `BaseID`,`compteur`.`MouvrageID` AS `MouvrageID`,`compteur`.`Reference2` AS `Reference2`,`compteur`.`Type` AS `Type`,`compteur`.`CompteurprodID` AS `CompteurprodID`,`roles`.`Role` AS `Role` from (`compteur` left join `roles` on(((`compteur`.`MouvrageID` = `roles`.`record_id`) and (`compteur`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = '')))) order by `compteur`.`Nom`;

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_compteur_26c107b172a7ed615129b0259bdf6b17`
--
DROP TABLE IF EXISTS `dataface__view_compteur_26c107b172a7ed615129b0259bdf6b17`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_compteur_26c107b172a7ed615129b0259bdf6b17` AS select `compteur`.`CompteurID` AS `CompteurID`,`compteur`.`Nom` AS `Nom`,`compteur`.`Reference` AS `Reference`,`compteur`.`Numero` AS `Numero`,`compteur`.`EnergieID` AS `EnergieID`,`compteur`.`FournisseurID` AS `FournisseurID`,`compteur`.`Localisation` AS `Localisation`,`compteur`.`Nomprestataire` AS `Nomprestataire`,`compteur`.`Seuil` AS `Seuil`,`compteur`.`Commentaire` AS `Commentaire`,`compteur`.`Caracteristique` AS `Caracteristique`,`compteur`.`Objectif` AS `Objectif`,`compteur`.`Estenergie` AS `Estenergie`,`compteur`.`Clos` AS `Clos`,`compteur`.`BaseID` AS `BaseID`,`compteur`.`MouvrageID` AS `MouvrageID`,`compteur`.`Reference2` AS `Reference2`,`compteur`.`Type` AS `Type`,`compteur`.`CompteurprodID` AS `CompteurprodID`,`roles`.`Role` AS `Role` from (`compteur` left join `roles` on(((`compteur`.`MouvrageID` = `roles`.`record_id`) and (`compteur`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'Admin')))) order by `compteur`.`Nom`;

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_compteur_898a1f385c185fc387c0f9c71721f4c7`
--
DROP TABLE IF EXISTS `dataface__view_compteur_898a1f385c185fc387c0f9c71721f4c7`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_compteur_898a1f385c185fc387c0f9c71721f4c7` AS select `compteur`.`CompteurID` AS `CompteurID`,`compteur`.`Nom` AS `Nom`,`compteur`.`Reference` AS `Reference`,`compteur`.`Numero` AS `Numero`,`compteur`.`EnergieID` AS `EnergieID`,`compteur`.`FournisseurID` AS `FournisseurID`,`compteur`.`Localisation` AS `Localisation`,`compteur`.`Nomprestataire` AS `Nomprestataire`,`compteur`.`Seuil` AS `Seuil`,`compteur`.`Commentaire` AS `Commentaire`,`compteur`.`Caracteristique` AS `Caracteristique`,`compteur`.`Objectif` AS `Objectif`,`compteur`.`Estenergie` AS `Estenergie`,`compteur`.`Clos` AS `Clos`,`compteur`.`BaseID` AS `BaseID`,`compteur`.`MouvrageID` AS `MouvrageID`,`compteur`.`Reference2` AS `Reference2`,`compteur`.`Type` AS `Type`,`compteur`.`CompteurprodID` AS `CompteurprodID`,`roles`.`Role` AS `Role` from (`compteur` left join `roles` on(((`compteur`.`MouvrageID` = `roles`.`record_id`) and (`compteur`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'cua')))) order by `compteur`.`Nom`;

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_coordonnee_864c78aa1ccc92fe0e8519f381bcc312`
--
DROP TABLE IF EXISTS `dataface__view_coordonnee_864c78aa1ccc92fe0e8519f381bcc312`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_coordonnee_864c78aa1ccc92fe0e8519f381bcc312` AS select `coordonnee`.`CoordonneeID` AS `CoordonneeID`,`coordonnee`.`Type` AS `Type`,`coordonnee`.`Nom` AS `Nom`,`coordonnee`.`Prenom` AS `Prenom`,`coordonnee`.`Societe` AS `Societe`,`coordonnee`.`Tel` AS `Tel`,`coordonnee`.`Portable` AS `Portable`,`coordonnee`.`Mail` AS `Mail`,`coordonnee`.`Adresse1` AS `Adresse1`,`coordonnee`.`Adresse2` AS `Adresse2`,`coordonnee`.`Adresse3` AS `Adresse3`,`coordonnee`.`Codepostal` AS `Codepostal`,`coordonnee`.`Ville` AS `Ville`,`coordonnee`.`Pays` AS `Pays`,`coordonnee`.`Site` AS `Site`,`coordonnee`.`Logo` AS `Logo`,`coordonnee`.`Commentaire` AS `Commentaire`,`coordonnee`.`MouvrageID` AS `MouvrageID`,`coordonnee`.`UtilisateurID` AS `UtilisateurID`,`coordonnee`.`BaseID` AS `BaseID`,`roles`.`Role` AS `Role` from (`coordonnee` left join `roles` on(((`coordonnee`.`MouvrageID` = `roles`.`record_id`) and (`coordonnee`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'cua'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_coordonnee_885a4136bc1092cdfe6024ea2c611548`
--
DROP TABLE IF EXISTS `dataface__view_coordonnee_885a4136bc1092cdfe6024ea2c611548`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_coordonnee_885a4136bc1092cdfe6024ea2c611548` AS select `coordonnee`.`CoordonneeID` AS `CoordonneeID`,`coordonnee`.`Type` AS `Type`,`coordonnee`.`Nom` AS `Nom`,`coordonnee`.`Prenom` AS `Prenom`,`coordonnee`.`Societe` AS `Societe`,`coordonnee`.`Tel` AS `Tel`,`coordonnee`.`Portable` AS `Portable`,`coordonnee`.`Mail` AS `Mail`,`coordonnee`.`Adresse1` AS `Adresse1`,`coordonnee`.`Adresse2` AS `Adresse2`,`coordonnee`.`Adresse3` AS `Adresse3`,`coordonnee`.`Codepostal` AS `Codepostal`,`coordonnee`.`Ville` AS `Ville`,`coordonnee`.`Pays` AS `Pays`,`coordonnee`.`Site` AS `Site`,`coordonnee`.`Logo` AS `Logo`,`coordonnee`.`Commentaire` AS `Commentaire`,`coordonnee`.`MouvrageID` AS `MouvrageID`,`coordonnee`.`UtilisateurID` AS `UtilisateurID`,`coordonnee`.`BaseID` AS `BaseID`,`roles`.`Role` AS `Role` from (`coordonnee` left join `roles` on(((`coordonnee`.`MouvrageID` = `roles`.`record_id`) and (`coordonnee`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'Admin'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_decoupagevirtuel_9b5ba870d89527015436db4093d58288`
--
DROP TABLE IF EXISTS `dataface__view_decoupagevirtuel_9b5ba870d89527015436db4093d58288`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_decoupagevirtuel_9b5ba870d89527015436db4093d58288` AS select `decoupagevirtuel`.`DecoupagevirtuelID` AS `DecoupagevirtuelID`,`decoupagevirtuel`.`CompteurID` AS `CompteurID`,`decoupagevirtuel`.`Nom` AS `Nom`,`decoupagevirtuel`.`Usage1` AS `Usage1`,`decoupagevirtuel`.`Pourcentage1` AS `Pourcentage1`,`decoupagevirtuel`.`Usage2` AS `Usage2`,`decoupagevirtuel`.`Pourcentage2` AS `Pourcentage2`,`decoupagevirtuel`.`Usage3` AS `Usage3`,`decoupagevirtuel`.`Pourcentage3` AS `Pourcentage3`,`decoupagevirtuel`.`Usage4` AS `Usage4`,`decoupagevirtuel`.`Pourcentage4` AS `Pourcentage4`,`decoupagevirtuel`.`Usage5` AS `Usage5`,`decoupagevirtuel`.`Pourcentage5` AS `Pourcentage5`,`decoupagevirtuel`.`Usage6` AS `Usage6`,`decoupagevirtuel`.`Pourcentage6` AS `Pourcentage6`,`decoupagevirtuel`.`BaseID` AS `BaseID`,`decoupagevirtuel`.`MouvrageID` AS `MouvrageID`,`roles`.`Role` AS `Role` from (`decoupagevirtuel` left join `roles` on(((`decoupagevirtuel`.`MouvrageID` = `roles`.`record_id`) and (`decoupagevirtuel`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'cua'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_decoupagevirtuel_460e77297c62819facea552b9350ec39`
--
DROP TABLE IF EXISTS `dataface__view_decoupagevirtuel_460e77297c62819facea552b9350ec39`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_decoupagevirtuel_460e77297c62819facea552b9350ec39` AS select `decoupagevirtuel`.`DecoupagevirtuelID` AS `DecoupagevirtuelID`,`decoupagevirtuel`.`CompteurID` AS `CompteurID`,`decoupagevirtuel`.`Nom` AS `Nom`,`decoupagevirtuel`.`Usage1` AS `Usage1`,`decoupagevirtuel`.`Pourcentage1` AS `Pourcentage1`,`decoupagevirtuel`.`Usage2` AS `Usage2`,`decoupagevirtuel`.`Pourcentage2` AS `Pourcentage2`,`decoupagevirtuel`.`Usage3` AS `Usage3`,`decoupagevirtuel`.`Pourcentage3` AS `Pourcentage3`,`decoupagevirtuel`.`Usage4` AS `Usage4`,`decoupagevirtuel`.`Pourcentage4` AS `Pourcentage4`,`decoupagevirtuel`.`Usage5` AS `Usage5`,`decoupagevirtuel`.`Pourcentage5` AS `Pourcentage5`,`decoupagevirtuel`.`Usage6` AS `Usage6`,`decoupagevirtuel`.`Pourcentage6` AS `Pourcentage6`,`decoupagevirtuel`.`BaseID` AS `BaseID`,`decoupagevirtuel`.`MouvrageID` AS `MouvrageID`,`roles`.`Role` AS `Role` from (`decoupagevirtuel` left join `roles` on(((`decoupagevirtuel`.`MouvrageID` = `roles`.`record_id`) and (`decoupagevirtuel`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'Admin'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_descriptif_ac371d52a1ed58a5890cc3bcc5eb0dc7`
--
DROP TABLE IF EXISTS `dataface__view_descriptif_ac371d52a1ed58a5890cc3bcc5eb0dc7`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_descriptif_ac371d52a1ed58a5890cc3bcc5eb0dc7` AS select `descriptif`.`DescriptifID` AS `DescriptifID`,`descriptif`.`BatimentID` AS `BatimentID`,`descriptif`.`MouvrageID` AS `MouvrageID`,`descriptif`.`BaseID` AS `BaseID`,`descriptif`.`Date` AS `Date`,`descriptif`.`Surface` AS `Surface`,`descriptif`.`Surfacechauffee` AS `Surfacechauffee`,`descriptif`.`Nbrniveaux` AS `Nbrniveaux`,`descriptif`.`CategorieID` AS `CategorieID`,`descriptif`.`Tempsusage` AS `Tempsusage`,`descriptif`.`Frequentation` AS `Frequentation`,`descriptif`.`Commentaires` AS `Commentaires`,`descriptif`.`Toiture` AS `Toiture`,`descriptif`.`Toitureiso` AS `Toitureiso`,`descriptif`.`Mur` AS `Mur`,`descriptif`.`Muriso` AS `Muriso`,`descriptif`.`Plancher` AS `Plancher`,`descriptif`.`Plancheriso` AS `Plancheriso`,`descriptif`.`Fenetre` AS `Fenetre`,`descriptif`.`Vitrage` AS `Vitrage`,`descriptif`.`Precisionbati` AS `Precisionbati`,`descriptif`.`Chauffageener` AS `Chauffageener`,`descriptif`.`Chauffagesysteme` AS `Chauffagesysteme`,`descriptif`.`Chauffagepuissance` AS `Chauffagepuissance`,`descriptif`.`Programmation` AS `Programmation`,`descriptif`.`Robinets` AS `Robinets`,`descriptif`.`Climatisation` AS `Climatisation`,`descriptif`.`Eauchaude` AS `Eauchaude`,`descriptif`.`Ventilation` AS `Ventilation`,`descriptif`.`Eclairage` AS `Eclairage`,`descriptif`.`Eclairagepuissance` AS `Eclairagepuissance`,`descriptif`.`Electropuissance` AS `Electropuissance`,`descriptif`.`Industrielpuissance` AS `Industrielpuissance`,`descriptif`.`Precisionequipement` AS `Precisionequipement`,`descriptif`.`Photo` AS `Photo`,`roles`.`Role` AS `Role` from (`descriptif` left join `roles` on(((`descriptif`.`MouvrageID` = `roles`.`record_id`) and (`descriptif`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'cua'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_descriptif_f44ad248a637e15c6d0d3369eec833fd`
--
DROP TABLE IF EXISTS `dataface__view_descriptif_f44ad248a637e15c6d0d3369eec833fd`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_descriptif_f44ad248a637e15c6d0d3369eec833fd` AS select `descriptif`.`DescriptifID` AS `DescriptifID`,`descriptif`.`BatimentID` AS `BatimentID`,`descriptif`.`MouvrageID` AS `MouvrageID`,`descriptif`.`BaseID` AS `BaseID`,`descriptif`.`Date` AS `Date`,`descriptif`.`Surface` AS `Surface`,`descriptif`.`Surfacechauffee` AS `Surfacechauffee`,`descriptif`.`Nbrniveaux` AS `Nbrniveaux`,`descriptif`.`CategorieID` AS `CategorieID`,`descriptif`.`Tempsusage` AS `Tempsusage`,`descriptif`.`Frequentation` AS `Frequentation`,`descriptif`.`Commentaires` AS `Commentaires`,`descriptif`.`Toiture` AS `Toiture`,`descriptif`.`Toitureiso` AS `Toitureiso`,`descriptif`.`Mur` AS `Mur`,`descriptif`.`Muriso` AS `Muriso`,`descriptif`.`Plancher` AS `Plancher`,`descriptif`.`Plancheriso` AS `Plancheriso`,`descriptif`.`Fenetre` AS `Fenetre`,`descriptif`.`Vitrage` AS `Vitrage`,`descriptif`.`Precisionbati` AS `Precisionbati`,`descriptif`.`Chauffageener` AS `Chauffageener`,`descriptif`.`Chauffagesysteme` AS `Chauffagesysteme`,`descriptif`.`Chauffagepuissance` AS `Chauffagepuissance`,`descriptif`.`Programmation` AS `Programmation`,`descriptif`.`Robinets` AS `Robinets`,`descriptif`.`Climatisation` AS `Climatisation`,`descriptif`.`Eauchaude` AS `Eauchaude`,`descriptif`.`Ventilation` AS `Ventilation`,`descriptif`.`Eclairage` AS `Eclairage`,`descriptif`.`Eclairagepuissance` AS `Eclairagepuissance`,`descriptif`.`Electropuissance` AS `Electropuissance`,`descriptif`.`Industrielpuissance` AS `Industrielpuissance`,`descriptif`.`Precisionequipement` AS `Precisionequipement`,`descriptif`.`Photo` AS `Photo`,`roles`.`Role` AS `Role` from (`descriptif` left join `roles` on(((`descriptif`.`MouvrageID` = `roles`.`record_id`) and (`descriptif`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'Admin'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_diagnostique_7a9576b3932313b8f0acb1204d4c93c1`
--
DROP TABLE IF EXISTS `dataface__view_diagnostique_7a9576b3932313b8f0acb1204d4c93c1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_diagnostique_7a9576b3932313b8f0acb1204d4c93c1` AS select `diagnostique`.`DiagnostiqueID` AS `DiagnostiqueID`,`diagnostique`.`BureauetudeID` AS `BureauetudeID`,`diagnostique`.`BatimentID` AS `BatimentID`,`diagnostique`.`Date` AS `Date`,`diagnostique`.`BaseID` AS `BaseID`,`diagnostique`.`MouvrageID` AS `MouvrageID`,`diagnostique`.`Nom` AS `Nom`,`diagnostique`.`Prenom` AS `Prenom`,`diagnostique`.`Toiture` AS `Toiture`,`diagnostique`.`Mur` AS `Mur`,`diagnostique`.`Plancher` AS `Plancher`,`diagnostique`.`Menuiserie` AS `Menuiserie`,`diagnostique`.`Chauffage` AS `Chauffage`,`diagnostique`.`Ecs` AS `Ecs`,`diagnostique`.`Ventilation` AS `Ventilation`,`diagnostique`.`Climatisation` AS `Climatisation`,`diagnostique`.`Eclairage` AS `Eclairage`,`diagnostique`.`Qualiteair` AS `Qualiteair`,`diagnostique`.`Confortete` AS `Confortete`,`diagnostique`.`Conforthiver` AS `Conforthiver`,`diagnostique`.`Etancheite` AS `Etancheite`,`diagnostique`.`Acoustique` AS `Acoustique`,`diagnostique`.`Commentaire` AS `Commentaire`,`roles`.`Role` AS `Role` from (`diagnostique` left join `roles` on(((`diagnostique`.`MouvrageID` = `roles`.`record_id`) and (`diagnostique`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'cua'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_diagnostique_a238feee333d75c0bc9e62c33f743fd0`
--
DROP TABLE IF EXISTS `dataface__view_diagnostique_a238feee333d75c0bc9e62c33f743fd0`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_diagnostique_a238feee333d75c0bc9e62c33f743fd0` AS select `diagnostique`.`DiagnostiqueID` AS `DiagnostiqueID`,`diagnostique`.`BureauetudeID` AS `BureauetudeID`,`diagnostique`.`BatimentID` AS `BatimentID`,`diagnostique`.`Date` AS `Date`,`diagnostique`.`BaseID` AS `BaseID`,`diagnostique`.`MouvrageID` AS `MouvrageID`,`diagnostique`.`Nom` AS `Nom`,`diagnostique`.`Prenom` AS `Prenom`,`diagnostique`.`Toiture` AS `Toiture`,`diagnostique`.`Mur` AS `Mur`,`diagnostique`.`Plancher` AS `Plancher`,`diagnostique`.`Menuiserie` AS `Menuiserie`,`diagnostique`.`Chauffage` AS `Chauffage`,`diagnostique`.`Ecs` AS `Ecs`,`diagnostique`.`Ventilation` AS `Ventilation`,`diagnostique`.`Climatisation` AS `Climatisation`,`diagnostique`.`Eclairage` AS `Eclairage`,`diagnostique`.`Qualiteair` AS `Qualiteair`,`diagnostique`.`Confortete` AS `Confortete`,`diagnostique`.`Conforthiver` AS `Conforthiver`,`diagnostique`.`Etancheite` AS `Etancheite`,`diagnostique`.`Acoustique` AS `Acoustique`,`diagnostique`.`Commentaire` AS `Commentaire`,`roles`.`Role` AS `Role` from (`diagnostique` left join `roles` on(((`diagnostique`.`MouvrageID` = `roles`.`record_id`) and (`diagnostique`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'Admin'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_eclairage_6df0542b09f13aebeea9f123d8eacb98`
--
DROP TABLE IF EXISTS `dataface__view_eclairage_6df0542b09f13aebeea9f123d8eacb98`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_eclairage_6df0542b09f13aebeea9f123d8eacb98` AS select `eclairage`.`EclairageID` AS `EclairageID`,`eclairage`.`CategorieID` AS `CategorieID`,`eclairage`.`Nom` AS `Nom`,`eclairage`.`Puissance` AS `Puissance`,`eclairage`.`Puissancemesuree` AS `Puissancemesuree`,`eclairage`.`Nbrpointlumineux` AS `Nbrpointlumineux`,`eclairage`.`Kmeclaires` AS `Kmeclaires`,`eclairage`.`NbrHeuresans` AS `NbrHeuresans`,`eclairage`.`Declencheur` AS `Declencheur`,`eclairage`.`Luminosite` AS `Luminosite`,`eclairage`.`Descriptif` AS `Descriptif`,`eclairage`.`BaseID` AS `BaseID`,`eclairage`.`MouvrageID` AS `MouvrageID`,`eclairage`.`Anneeconstruction` AS `Anneeconstruction`,`eclairage`.`StationdjuID` AS `StationdjuID`,`eclairage`.`StationmeteoID` AS `StationmeteoID`,`eclairage`.`Commentaire` AS `Commentaire`,`eclairage`.`CoordonneeID` AS `CoordonneeID`,`roles`.`Role` AS `Role` from (`eclairage` left join `roles` on(((`eclairage`.`MouvrageID` = `roles`.`record_id`) and (`eclairage`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'cua')))) order by `eclairage`.`Nom`;

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_eclairage_55a4190ab5a25411019976e08dc97c7e`
--
DROP TABLE IF EXISTS `dataface__view_eclairage_55a4190ab5a25411019976e08dc97c7e`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_eclairage_55a4190ab5a25411019976e08dc97c7e` AS select `eclairage`.`EclairageID` AS `EclairageID`,`eclairage`.`CategorieID` AS `CategorieID`,`eclairage`.`Nom` AS `Nom`,`eclairage`.`Puissance` AS `Puissance`,`eclairage`.`Puissancemesuree` AS `Puissancemesuree`,`eclairage`.`Nbrpointlumineux` AS `Nbrpointlumineux`,`eclairage`.`Kmeclaires` AS `Kmeclaires`,`eclairage`.`NbrHeuresans` AS `NbrHeuresans`,`eclairage`.`Declencheur` AS `Declencheur`,`eclairage`.`Luminosite` AS `Luminosite`,`eclairage`.`Descriptif` AS `Descriptif`,`eclairage`.`BaseID` AS `BaseID`,`eclairage`.`MouvrageID` AS `MouvrageID`,`eclairage`.`Anneeconstruction` AS `Anneeconstruction`,`eclairage`.`StationdjuID` AS `StationdjuID`,`eclairage`.`StationmeteoID` AS `StationmeteoID`,`eclairage`.`Commentaire` AS `Commentaire`,`eclairage`.`CoordonneeID` AS `CoordonneeID`,`roles`.`Role` AS `Role` from (`eclairage` left join `roles` on(((`eclairage`.`MouvrageID` = `roles`.`record_id`) and (`eclairage`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'Admin')))) order by `eclairage`.`Nom`;

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_exemplarite_60692de20b116ba490381e70f631df0c`
--
DROP TABLE IF EXISTS `dataface__view_exemplarite_60692de20b116ba490381e70f631df0c`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_exemplarite_60692de20b116ba490381e70f631df0c` AS select `exemplarite`.`ExemplariteID` AS `ExemplariteID`,`exemplarite`.`BaseID` AS `BaseID`,`exemplarite`.`MouvrageID` AS `MouvrageID`,`exemplarite`.`BatimentID` AS `BatimentID`,`exemplarite`.`UtilisateurID` AS `UtilisateurID`,`exemplarite`.`Date` AS `Date`,`exemplarite`.`AccordMO` AS `AccordMO`,`exemplarite`.`Commentaire` AS `Commentaire`,`roles`.`Role` AS `Role` from (`exemplarite` left join `roles` on(((`exemplarite`.`MouvrageID` = `roles`.`record_id`) and (`exemplarite`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'cua'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_exemplarite_d29e0375c1bcf991ebdddd32fd3b62e3`
--
DROP TABLE IF EXISTS `dataface__view_exemplarite_d29e0375c1bcf991ebdddd32fd3b62e3`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_exemplarite_d29e0375c1bcf991ebdddd32fd3b62e3` AS select `exemplarite`.`ExemplariteID` AS `ExemplariteID`,`exemplarite`.`BaseID` AS `BaseID`,`exemplarite`.`MouvrageID` AS `MouvrageID`,`exemplarite`.`BatimentID` AS `BatimentID`,`exemplarite`.`UtilisateurID` AS `UtilisateurID`,`exemplarite`.`Date` AS `Date`,`exemplarite`.`AccordMO` AS `AccordMO`,`exemplarite`.`Commentaire` AS `Commentaire`,`roles`.`Role` AS `Role` from (`exemplarite` left join `roles` on(((`exemplarite`.`MouvrageID` = `roles`.`record_id`) and (`exemplarite`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'Admin'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_facture_340c3a19a66b6bac5536e40956430996`
--
DROP TABLE IF EXISTS `dataface__view_facture_340c3a19a66b6bac5536e40956430996`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_facture_340c3a19a66b6bac5536e40956430996` AS select `facture`.`FactureID` AS `FactureID`,`facture`.`CompteurID` AS `CompteurID`,`facture`.`Nom` AS `Nom`,`facture`.`FournisseurID` AS `FournisseurID`,`facture`.`Debutperiode` AS `Debutperiode`,`facture`.`Finperiode` AS `Finperiode`,`facture`.`Abonnement` AS `Abonnement`,`facture`.`Consommation` AS `Consommation`,`facture`.`Totalttc` AS `Totalttc`,`facture`.`Commentaire` AS `Commentaire`,`facture`.`Prixunitaire` AS `Prixunitaire`,`facture`.`Estimation` AS `Estimation`,`facture`.`Consokwh` AS `Consokwh`,`facture`.`Coefficient` AS `Coefficient`,`facture`.`Consohpleines` AS `Consohpleines`,`facture`.`Consohcreuses` AS `Consohcreuses`,`facture`.`Consopete` AS `Consopete`,`facture`.`Consocete` AS `Consocete`,`facture`.`Consophiver` AS `Consophiver`,`facture`.`Consochiver` AS `Consochiver`,`facture`.`HN` AS `HN`,`facture`.`HPM` AS `HPM`,`facture`.`Consopointe` AS `Consopointe`,`facture`.`Hygro` AS `Hygro`,`facture`.`Patteintepointe` AS `Patteintepointe`,`facture`.`Patteintehp` AS `Patteintehp`,`facture`.`Patteintehc` AS `Patteintehc`,`facture`.`Eactivehp` AS `Eactivehp`,`facture`.`Eactivehc` AS `Eactivehc`,`facture`.`Ereactive` AS `Ereactive`,`facture`.`Tangeante` AS `Tangeante`,`facture`.`BaseID` AS `BaseID`,`facture`.`MouvrageID` AS `MouvrageID`,`roles`.`Role` AS `Role` from (`facture` left join `roles` on(((`facture`.`MouvrageID` = `roles`.`record_id`) and (`facture`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'Admin')))) order by `facture`.`Debutperiode` desc;

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_facture_c21410caa637c2c25a5a2ea2c181885f`
--
DROP TABLE IF EXISTS `dataface__view_facture_c21410caa637c2c25a5a2ea2c181885f`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_facture_c21410caa637c2c25a5a2ea2c181885f` AS select `facture`.`FactureID` AS `FactureID`,`facture`.`CompteurID` AS `CompteurID`,`facture`.`Nom` AS `Nom`,`facture`.`FournisseurID` AS `FournisseurID`,`facture`.`Debutperiode` AS `Debutperiode`,`facture`.`Finperiode` AS `Finperiode`,`facture`.`Abonnement` AS `Abonnement`,`facture`.`Consommation` AS `Consommation`,`facture`.`Totalttc` AS `Totalttc`,`facture`.`Commentaire` AS `Commentaire`,`facture`.`Prixunitaire` AS `Prixunitaire`,`facture`.`Estimation` AS `Estimation`,`facture`.`Consokwh` AS `Consokwh`,`facture`.`Coefficient` AS `Coefficient`,`facture`.`Consohpleines` AS `Consohpleines`,`facture`.`Consohcreuses` AS `Consohcreuses`,`facture`.`Consopete` AS `Consopete`,`facture`.`Consocete` AS `Consocete`,`facture`.`Consophiver` AS `Consophiver`,`facture`.`Consochiver` AS `Consochiver`,`facture`.`HN` AS `HN`,`facture`.`HPM` AS `HPM`,`facture`.`Consopointe` AS `Consopointe`,`facture`.`Hygro` AS `Hygro`,`facture`.`Patteintepointe` AS `Patteintepointe`,`facture`.`Patteintehp` AS `Patteintehp`,`facture`.`Patteintehc` AS `Patteintehc`,`facture`.`Eactivehp` AS `Eactivehp`,`facture`.`Eactivehc` AS `Eactivehc`,`facture`.`Ereactive` AS `Ereactive`,`facture`.`Tangeante` AS `Tangeante`,`facture`.`BaseID` AS `BaseID`,`facture`.`MouvrageID` AS `MouvrageID`,`roles`.`Role` AS `Role` from (`facture` left join `roles` on(((`facture`.`MouvrageID` = `roles`.`record_id`) and (`facture`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'cua')))) order by `facture`.`Debutperiode` desc;

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_label_065cdced51be1d3a33be7acd689f5ba0`
--
DROP TABLE IF EXISTS `dataface__view_label_065cdced51be1d3a33be7acd689f5ba0`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_label_065cdced51be1d3a33be7acd689f5ba0` AS select `label`.`LabelID` AS `LabelID`,`label`.`CategorieID` AS `CategorieID`,`label`.`Date` AS `Date`,`label`.`Certifie` AS `Certifie`,`label`.`Coeff1` AS `Coeff1`,`label`.`Coeffref1` AS `Coeffref1`,`label`.`Coeff2` AS `Coeff2`,`label`.`Coeffref2` AS `Coeffref2`,`label`.`Coeff3` AS `Coeff3`,`label`.`Coeffref3` AS `Coeffref3`,`label`.`Permeabilite` AS `Permeabilite`,`label`.`Inertie` AS `Inertie`,`label`.`Commentaire` AS `Commentaire`,`label`.`BatimentID` AS `BatimentID`,`label`.`MouvrageID` AS `MouvrageID`,`label`.`BaseID` AS `BaseID`,`roles`.`Role` AS `Role` from (`label` left join `roles` on(((`label`.`MouvrageID` = `roles`.`record_id`) and (`label`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'cua'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_label_9e52a3dc34e827b7932801e642c676bb`
--
DROP TABLE IF EXISTS `dataface__view_label_9e52a3dc34e827b7932801e642c676bb`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_label_9e52a3dc34e827b7932801e642c676bb` AS select `label`.`LabelID` AS `LabelID`,`label`.`CategorieID` AS `CategorieID`,`label`.`Date` AS `Date`,`label`.`Certifie` AS `Certifie`,`label`.`Coeff1` AS `Coeff1`,`label`.`Coeffref1` AS `Coeffref1`,`label`.`Coeff2` AS `Coeff2`,`label`.`Coeffref2` AS `Coeffref2`,`label`.`Coeff3` AS `Coeff3`,`label`.`Coeffref3` AS `Coeffref3`,`label`.`Permeabilite` AS `Permeabilite`,`label`.`Inertie` AS `Inertie`,`label`.`Commentaire` AS `Commentaire`,`label`.`BatimentID` AS `BatimentID`,`label`.`MouvrageID` AS `MouvrageID`,`label`.`BaseID` AS `BaseID`,`roles`.`Role` AS `Role` from (`label` left join `roles` on(((`label`.`MouvrageID` = `roles`.`record_id`) and (`label`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'Admin'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_moan_3ed2c22553d1dfb24887652ccd30a144`
--
DROP TABLE IF EXISTS `dataface__view_moan_3ed2c22553d1dfb24887652ccd30a144`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_moan_3ed2c22553d1dfb24887652ccd30a144` AS select `moan`.`MoanID` AS `MoanID`,`moan`.`MouvrageID` AS `MouvrageID`,`moan`.`Annee` AS `Annee`,`moan`.`Frequentation` AS `Frequentation`,`moan`.`Typefrequentation` AS `Typefrequentation`,`moan`.`Budget` AS `Budget`,`moan`.`Objectif` AS `Objectif`,`moan`.`BaseID` AS `BaseID`,`roles`.`Role` AS `Role` from (`moan` left join `roles` on(((`moan`.`MouvrageID` = `roles`.`record_id`) and (`moan`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'Admin'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_moan_6e6d9d8ec7c903b395635929da51cdaa`
--
DROP TABLE IF EXISTS `dataface__view_moan_6e6d9d8ec7c903b395635929da51cdaa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_moan_6e6d9d8ec7c903b395635929da51cdaa` AS select `moan`.`MoanID` AS `MoanID`,`moan`.`MouvrageID` AS `MouvrageID`,`moan`.`Annee` AS `Annee`,`moan`.`Frequentation` AS `Frequentation`,`moan`.`Typefrequentation` AS `Typefrequentation`,`moan`.`Budget` AS `Budget`,`moan`.`Objectif` AS `Objectif`,`moan`.`BaseID` AS `BaseID`,`roles`.`Role` AS `Role` from (`moan` left join `roles` on(((`moan`.`MouvrageID` = `roles`.`record_id`) and (`moan`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'cua'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_mouvrage_02faeb78a6d3d7b7f8fead5d15877ebf`
--
DROP TABLE IF EXISTS `dataface__view_mouvrage_02faeb78a6d3d7b7f8fead5d15877ebf`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_mouvrage_02faeb78a6d3d7b7f8fead5d15877ebf` AS select `mouvrage`.`MouvrageID` AS `MouvrageID`,`mouvrage`.`CategorieID` AS `CategorieID`,`mouvrage`.`BureauetudeID` AS `BureauetudeID`,`mouvrage`.`Logo` AS `Logo`,`mouvrage`.`Commentaire` AS `Commentaire`,`mouvrage`.`Societe` AS `Societe`,`mouvrage`.`Codepostal` AS `Codepostal`,`mouvrage`.`Ville` AS `Ville`,`mouvrage`.`BaseID` AS `BaseID`,`mouvrage`.`StationdjuID` AS `StationdjuID`,`mouvrage`.`StationmeteoID` AS `StationmeteoID`,`mouvrage`.`Estmodifie` AS `Estmodifie`,`roles`.`Role` AS `Role` from (`mouvrage` left join `roles` on(((`mouvrage`.`MouvrageID` = `roles`.`record_id`) and (`mouvrage`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'cua')))) order by `roles`.`Role`;

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_mouvrage_67c18b470d468662b4f3e4a62a66eb13`
--
DROP TABLE IF EXISTS `dataface__view_mouvrage_67c18b470d468662b4f3e4a62a66eb13`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_mouvrage_67c18b470d468662b4f3e4a62a66eb13` AS select `mouvrage`.`MouvrageID` AS `MouvrageID`,`mouvrage`.`CategorieID` AS `CategorieID`,`mouvrage`.`BureauetudeID` AS `BureauetudeID`,`mouvrage`.`Logo` AS `Logo`,`mouvrage`.`Commentaire` AS `Commentaire`,`mouvrage`.`Societe` AS `Societe`,`mouvrage`.`Codepostal` AS `Codepostal`,`mouvrage`.`Ville` AS `Ville`,`mouvrage`.`BaseID` AS `BaseID`,`mouvrage`.`StationdjuID` AS `StationdjuID`,`mouvrage`.`StationmeteoID` AS `StationmeteoID`,`mouvrage`.`Estmodifie` AS `Estmodifie`,`roles`.`Role` AS `Role` from (`mouvrage` left join `roles` on(((`mouvrage`.`MouvrageID` = `roles`.`record_id`) and (`mouvrage`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'Admin')))) order by `roles`.`Role`;

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_mouvrage_edec652162f8dc1f5ecf7839c9ef3423`
--
DROP TABLE IF EXISTS `dataface__view_mouvrage_edec652162f8dc1f5ecf7839c9ef3423`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_mouvrage_edec652162f8dc1f5ecf7839c9ef3423` AS select `mouvrage`.`MouvrageID` AS `MouvrageID`,`mouvrage`.`CategorieID` AS `CategorieID`,`mouvrage`.`BureauetudeID` AS `BureauetudeID`,`mouvrage`.`Logo` AS `Logo`,`mouvrage`.`Commentaire` AS `Commentaire`,`mouvrage`.`Societe` AS `Societe`,`mouvrage`.`Codepostal` AS `Codepostal`,`mouvrage`.`Ville` AS `Ville`,`mouvrage`.`BaseID` AS `BaseID`,`mouvrage`.`StationdjuID` AS `StationdjuID`,`mouvrage`.`StationmeteoID` AS `StationmeteoID`,`mouvrage`.`Estmodifie` AS `Estmodifie`,`roles`.`Role` AS `Role` from (`mouvrage` left join `roles` on(((`mouvrage`.`MouvrageID` = `roles`.`record_id`) and (`mouvrage`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = '')))) order by `roles`.`Role`;

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_posteproduction_08575c5718b7bd6d41d3b49d8c6ed0a9`
--
DROP TABLE IF EXISTS `dataface__view_posteproduction_08575c5718b7bd6d41d3b49d8c6ed0a9`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_posteproduction_08575c5718b7bd6d41d3b49d8c6ed0a9` AS select `posteproduction`.`PosteproductionID` AS `PosteproductionID`,`posteproduction`.`CategorieID` AS `CategorieID`,`posteproduction`.`MouvrageID` AS `MouvrageID`,`posteproduction`.`Nom` AS `Nom`,`posteproduction`.`Description` AS `Description`,`posteproduction`.`Productiontheorique` AS `Productiontheorique`,`posteproduction`.`Coutinitial` AS `Coutinitial`,`posteproduction`.`BaseID` AS `BaseID`,`posteproduction`.`Anneeconstruction` AS `Anneeconstruction`,`posteproduction`.`Cadastre` AS `Cadastre`,`posteproduction`.`Latitude` AS `Latitude`,`posteproduction`.`Longitude` AS `Longitude`,`posteproduction`.`StationdjuID` AS `StationdjuID`,`posteproduction`.`StationmeteoID` AS `StationmeteoID`,`posteproduction`.`Commentaire` AS `Commentaire`,`posteproduction`.`CoordonneeID` AS `CoordonneeID`,`posteproduction`.`Adresse1` AS `Adresse1`,`posteproduction`.`Adresse2` AS `Adresse2`,`posteproduction`.`Adresse3` AS `Adresse3`,`posteproduction`.`Codepostal` AS `Codepostal`,`posteproduction`.`Ville` AS `Ville`,`posteproduction`.`Pays` AS `Pays`,`roles`.`Role` AS `Role` from (`posteproduction` left join `roles` on(((`posteproduction`.`MouvrageID` = `roles`.`record_id`) and (`posteproduction`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'Admin')))) order by `posteproduction`.`Nom`;

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_posteproduction_6583aefb8611bc459f58f9803bd032ea`
--
DROP TABLE IF EXISTS `dataface__view_posteproduction_6583aefb8611bc459f58f9803bd032ea`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_posteproduction_6583aefb8611bc459f58f9803bd032ea` AS select `posteproduction`.`PosteproductionID` AS `PosteproductionID`,`posteproduction`.`CategorieID` AS `CategorieID`,`posteproduction`.`MouvrageID` AS `MouvrageID`,`posteproduction`.`Nom` AS `Nom`,`posteproduction`.`Description` AS `Description`,`posteproduction`.`Productiontheorique` AS `Productiontheorique`,`posteproduction`.`Coutinitial` AS `Coutinitial`,`posteproduction`.`BaseID` AS `BaseID`,`posteproduction`.`Anneeconstruction` AS `Anneeconstruction`,`posteproduction`.`Cadastre` AS `Cadastre`,`posteproduction`.`Latitude` AS `Latitude`,`posteproduction`.`Longitude` AS `Longitude`,`posteproduction`.`StationdjuID` AS `StationdjuID`,`posteproduction`.`StationmeteoID` AS `StationmeteoID`,`posteproduction`.`Commentaire` AS `Commentaire`,`posteproduction`.`CoordonneeID` AS `CoordonneeID`,`posteproduction`.`Adresse1` AS `Adresse1`,`posteproduction`.`Adresse2` AS `Adresse2`,`posteproduction`.`Adresse3` AS `Adresse3`,`posteproduction`.`Codepostal` AS `Codepostal`,`posteproduction`.`Ville` AS `Ville`,`posteproduction`.`Pays` AS `Pays`,`roles`.`Role` AS `Role` from (`posteproduction` left join `roles` on(((`posteproduction`.`MouvrageID` = `roles`.`record_id`) and (`posteproduction`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'cua')))) order by `posteproduction`.`Nom`;

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_psouscrite_5bcb074267888ad422694477d9fe7c38`
--
DROP TABLE IF EXISTS `dataface__view_psouscrite_5bcb074267888ad422694477d9fe7c38`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_psouscrite_5bcb074267888ad422694477d9fe7c38` AS select `psouscrite`.`PsouscriteID` AS `PsouscriteID`,`psouscrite`.`Puissance` AS `Puissance`,`psouscrite`.`Puissancejaune` AS `Puissancejaune`,`psouscrite`.`Pointe` AS `Pointe`,`psouscrite`.`Heurescreusesete` AS `Heurescreusesete`,`psouscrite`.`Heurescreuseshiver` AS `Heurescreuseshiver`,`psouscrite`.`Heurespleinesete` AS `Heurespleinesete`,`psouscrite`.`Heurespleineshiver` AS `Heurespleineshiver`,`psouscrite`.`Heurespleinedemi` AS `Heurespleinedemi`,`psouscrite`.`Heurescreusesdemi` AS `Heurescreusesdemi`,`psouscrite`.`Reduite` AS `Reduite`,`psouscrite`.`BaseID` AS `BaseID`,`psouscrite`.`MouvrageID` AS `MouvrageID`,`psouscrite`.`CompteurID` AS `CompteurID`,`psouscrite`.`Debutcontrat` AS `Debutcontrat`,`psouscrite`.`Fincontrat` AS `Fincontrat`,`psouscrite`.`Tarif` AS `Tarif`,`psouscrite`.`Zonetarif` AS `Zonetarif`,`psouscrite`.`Commentaires` AS `Commentaires`,`roles`.`Role` AS `Role` from (`psouscrite` left join `roles` on(((`psouscrite`.`MouvrageID` = `roles`.`record_id`) and (`psouscrite`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'cua'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_psouscrite_9a0f14b892391b8abb60ed16b91f9691`
--
DROP TABLE IF EXISTS `dataface__view_psouscrite_9a0f14b892391b8abb60ed16b91f9691`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_psouscrite_9a0f14b892391b8abb60ed16b91f9691` AS select `psouscrite`.`PsouscriteID` AS `PsouscriteID`,`psouscrite`.`Puissance` AS `Puissance`,`psouscrite`.`Puissancejaune` AS `Puissancejaune`,`psouscrite`.`Pointe` AS `Pointe`,`psouscrite`.`Heurescreusesete` AS `Heurescreusesete`,`psouscrite`.`Heurescreuseshiver` AS `Heurescreuseshiver`,`psouscrite`.`Heurespleinesete` AS `Heurespleinesete`,`psouscrite`.`Heurespleineshiver` AS `Heurespleineshiver`,`psouscrite`.`Heurespleinedemi` AS `Heurespleinedemi`,`psouscrite`.`Heurescreusesdemi` AS `Heurescreusesdemi`,`psouscrite`.`Reduite` AS `Reduite`,`psouscrite`.`BaseID` AS `BaseID`,`psouscrite`.`MouvrageID` AS `MouvrageID`,`psouscrite`.`CompteurID` AS `CompteurID`,`psouscrite`.`Debutcontrat` AS `Debutcontrat`,`psouscrite`.`Fincontrat` AS `Fincontrat`,`psouscrite`.`Tarif` AS `Tarif`,`psouscrite`.`Zonetarif` AS `Zonetarif`,`psouscrite`.`Commentaires` AS `Commentaires`,`roles`.`Role` AS `Role` from (`psouscrite` left join `roles` on(((`psouscrite`.`MouvrageID` = `roles`.`record_id`) and (`psouscrite`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'Admin'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_resultatbatiment_11f8ad56f45f303f6ab45f9ceb9171ac`
--
DROP TABLE IF EXISTS `dataface__view_resultatbatiment_11f8ad56f45f303f6ab45f9ceb9171ac`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_resultatbatiment_11f8ad56f45f303f6ab45f9ceb9171ac` AS select `resultatbatiment`.`Annee` AS `Annee`,`resultatbatiment`.`BatimentID` AS `BatimentID`,`resultatbatiment`.`MouvrageID` AS `MouvrageID`,`resultatbatiment`.`CategorieID` AS `CategorieID`,`resultatbatiment`.`Surfacechauffee` AS `Surfacechauffee`,`resultatbatiment`.`Consoef` AS `Consoef`,`resultatbatiment`.`Consoep` AS `Consoep`,`resultatbatiment`.`Ttc` AS `Ttc`,`resultatbatiment`.`Consoeau` AS `Consoeau`,`resultatbatiment`.`Ttceau` AS `Ttceau`,`resultatbatiment`.`Emissionges` AS `Emissionges`,`resultatbatiment`.`Consoefm2` AS `Consoefm2`,`resultatbatiment`.`Consoepm2` AS `Consoepm2`,`resultatbatiment`.`Ttcm2` AS `Ttcm2`,`resultatbatiment`.`Emissiongesm2` AS `Emissiongesm2`,`resultatbatiment`.`Consoeaum2` AS `Consoeaum2`,`resultatbatiment`.`Ttceaum2` AS `Ttceaum2`,`resultatbatiment`.`Datemaj` AS `Datemaj`,`resultatbatiment`.`BaseID` AS `BaseID`,`roles`.`Role` AS `Role` from (`resultatbatiment` left join `roles` on(((`resultatbatiment`.`MouvrageID` = `roles`.`record_id`) and (`resultatbatiment`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'cua')))) order by `resultatbatiment`.`Annee` desc,`resultatbatiment`.`Consoepm2`;

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_resultatbatiment_cea84ec126486e1f648dbcb090d30ff3`
--
DROP TABLE IF EXISTS `dataface__view_resultatbatiment_cea84ec126486e1f648dbcb090d30ff3`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_resultatbatiment_cea84ec126486e1f648dbcb090d30ff3` AS select `resultatbatiment`.`Annee` AS `Annee`,`resultatbatiment`.`BatimentID` AS `BatimentID`,`resultatbatiment`.`MouvrageID` AS `MouvrageID`,`resultatbatiment`.`CategorieID` AS `CategorieID`,`resultatbatiment`.`Surfacechauffee` AS `Surfacechauffee`,`resultatbatiment`.`Consoef` AS `Consoef`,`resultatbatiment`.`Consoep` AS `Consoep`,`resultatbatiment`.`Ttc` AS `Ttc`,`resultatbatiment`.`Consoeau` AS `Consoeau`,`resultatbatiment`.`Ttceau` AS `Ttceau`,`resultatbatiment`.`Emissionges` AS `Emissionges`,`resultatbatiment`.`Consoefm2` AS `Consoefm2`,`resultatbatiment`.`Consoepm2` AS `Consoepm2`,`resultatbatiment`.`Ttcm2` AS `Ttcm2`,`resultatbatiment`.`Emissiongesm2` AS `Emissiongesm2`,`resultatbatiment`.`Consoeaum2` AS `Consoeaum2`,`resultatbatiment`.`Ttceaum2` AS `Ttceaum2`,`resultatbatiment`.`Datemaj` AS `Datemaj`,`resultatbatiment`.`BaseID` AS `BaseID`,`roles`.`Role` AS `Role` from (`resultatbatiment` left join `roles` on(((`resultatbatiment`.`MouvrageID` = `roles`.`record_id`) and (`resultatbatiment`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'Admin')))) order by `resultatbatiment`.`Annee` desc,`resultatbatiment`.`Consoepm2`;

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_resultatbatiment_d4527356e7581dbf2706722a00c93c91`
--
DROP TABLE IF EXISTS `dataface__view_resultatbatiment_d4527356e7581dbf2706722a00c93c91`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_resultatbatiment_d4527356e7581dbf2706722a00c93c91` AS select `resultatbatiment`.`Annee` AS `Annee`,`resultatbatiment`.`BatimentID` AS `BatimentID`,`resultatbatiment`.`MouvrageID` AS `MouvrageID`,`resultatbatiment`.`CategorieID` AS `CategorieID`,`resultatbatiment`.`Surfacechauffee` AS `Surfacechauffee`,`resultatbatiment`.`Consoef` AS `Consoef`,`resultatbatiment`.`Consoep` AS `Consoep`,`resultatbatiment`.`Ttc` AS `Ttc`,`resultatbatiment`.`Consoeau` AS `Consoeau`,`resultatbatiment`.`Ttceau` AS `Ttceau`,`resultatbatiment`.`Emissionges` AS `Emissionges`,`resultatbatiment`.`Consoefm2` AS `Consoefm2`,`resultatbatiment`.`Consoepm2` AS `Consoepm2`,`resultatbatiment`.`Ttcm2` AS `Ttcm2`,`resultatbatiment`.`Emissiongesm2` AS `Emissiongesm2`,`resultatbatiment`.`Consoeaum2` AS `Consoeaum2`,`resultatbatiment`.`Ttceaum2` AS `Ttceaum2`,`resultatbatiment`.`Datemaj` AS `Datemaj`,`resultatbatiment`.`BaseID` AS `BaseID`,`roles`.`Role` AS `Role` from (`resultatbatiment` left join `roles` on(((`resultatbatiment`.`MouvrageID` = `roles`.`record_id`) and (`resultatbatiment`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = '')))) order by `resultatbatiment`.`Annee` desc,`resultatbatiment`.`Consoepm2`;

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_souscompteur_2e41636f6cdaf32a67765d55afd11992`
--
DROP TABLE IF EXISTS `dataface__view_souscompteur_2e41636f6cdaf32a67765d55afd11992`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_souscompteur_2e41636f6cdaf32a67765d55afd11992` AS select `souscompteur`.`SouscompteurID` AS `SouscompteurID`,`souscompteur`.`CompteurID` AS `CompteurID`,`souscompteur`.`CategorieID` AS `CategorieID`,`souscompteur`.`Nom` AS `Nom`,`souscompteur`.`Localisation` AS `Localisation`,`souscompteur`.`BaseID` AS `BaseID`,`souscompteur`.`MouvrageID` AS `MouvrageID`,`roles`.`Role` AS `Role` from (`souscompteur` left join `roles` on(((`souscompteur`.`MouvrageID` = `roles`.`record_id`) and (`souscompteur`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'Admin'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_souscompteur_3d2037567a2e7e2376b3c9a02cf0b4b8`
--
DROP TABLE IF EXISTS `dataface__view_souscompteur_3d2037567a2e7e2376b3c9a02cf0b4b8`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_souscompteur_3d2037567a2e7e2376b3c9a02cf0b4b8` AS select `souscompteur`.`SouscompteurID` AS `SouscompteurID`,`souscompteur`.`CompteurID` AS `CompteurID`,`souscompteur`.`CategorieID` AS `CategorieID`,`souscompteur`.`Nom` AS `Nom`,`souscompteur`.`Localisation` AS `Localisation`,`souscompteur`.`BaseID` AS `BaseID`,`souscompteur`.`MouvrageID` AS `MouvrageID`,`roles`.`Role` AS `Role` from (`souscompteur` left join `roles` on(((`souscompteur`.`MouvrageID` = `roles`.`record_id`) and (`souscompteur`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'cua'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_vehicule_58e520bf1a0e7b40eb119fd90fb9ac41`
--
DROP TABLE IF EXISTS `dataface__view_vehicule_58e520bf1a0e7b40eb119fd90fb9ac41`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_vehicule_58e520bf1a0e7b40eb119fd90fb9ac41` AS select `vehicule`.`VehiculeID` AS `VehiculeID`,`vehicule`.`CategorieID` AS `CategorieID`,`vehicule`.`MouvrageID` AS `MouvrageID`,`vehicule`.`Nom` AS `Nom`,`vehicule`.`Anneeconstruction` AS `Anneeconstruction`,`vehicule`.`Marque` AS `Marque`,`vehicule`.`Modele` AS `Modele`,`vehicule`.`Carburant` AS `Carburant`,`vehicule`.`Puissance` AS `Puissance`,`vehicule`.`Conso` AS `Conso`,`vehicule`.`Commentaire` AS `Commentaire`,`vehicule`.`CoordonneeID` AS `CoordonneeID`,`vehicule`.`BaseID` AS `BaseID`,`roles`.`Role` AS `Role` from (`vehicule` left join `roles` on(((`vehicule`.`MouvrageID` = `roles`.`record_id`) and (`vehicule`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'Admin'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_vehicule_9087105cef5f5e6b6d6cd0dc89c42f46`
--
DROP TABLE IF EXISTS `dataface__view_vehicule_9087105cef5f5e6b6d6cd0dc89c42f46`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_vehicule_9087105cef5f5e6b6d6cd0dc89c42f46` AS select `vehicule`.`VehiculeID` AS `VehiculeID`,`vehicule`.`CategorieID` AS `CategorieID`,`vehicule`.`MouvrageID` AS `MouvrageID`,`vehicule`.`Nom` AS `Nom`,`vehicule`.`Anneeconstruction` AS `Anneeconstruction`,`vehicule`.`Marque` AS `Marque`,`vehicule`.`Modele` AS `Modele`,`vehicule`.`Carburant` AS `Carburant`,`vehicule`.`Puissance` AS `Puissance`,`vehicule`.`Conso` AS `Conso`,`vehicule`.`Commentaire` AS `Commentaire`,`vehicule`.`CoordonneeID` AS `CoordonneeID`,`vehicule`.`BaseID` AS `BaseID`,`roles`.`Role` AS `Role` from (`vehicule` left join `roles` on(((`vehicule`.`MouvrageID` = `roles`.`record_id`) and (`vehicule`.`BaseID` = `roles`.`BaseID`) and (`roles`.`Username` = 'cua'))));

-- --------------------------------------------------------

--
-- Structure de la vue `dataface__view_vueexemplarite_df3b0fac98ee20098a8dab1746e8b9fc`
--
DROP TABLE IF EXISTS `dataface__view_vueexemplarite_df3b0fac98ee20098a8dab1746e8b9fc`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `dataface__view_vueexemplarite_df3b0fac98ee20098a8dab1746e8b9fc` AS select `vueexemplarite`.`ExemplariteID` AS `ExemplariteID`,`vueexemplarite`.`BaseID` AS `BaseID`,`vueexemplarite`.`MouvrageID` AS `MouvrageID`,`vueexemplarite`.`BatimentID` AS `BatimentID`,`vueexemplarite`.`UtilisateurID` AS `UtilisateurID`,`vueexemplarite`.`Date` AS `Date`,`vueexemplarite`.`AccordMO` AS `AccordMO`,`vueexemplarite`.`Commentairedescriptif` AS `Commentairedescriptif`,`vueexemplarite`.`Annee` AS `Annee`,`vueexemplarite`.`CategorieID` AS `CategorieID`,`vueexemplarite`.`Surfacechauffee` AS `Surfacechauffee`,`vueexemplarite`.`Consoepm2` AS `Consoepm2`,`vueexemplarite`.`Consoefm2` AS `Consoefm2`,`vueexemplarite`.`Ttcm2` AS `Ttcm2`,`vueexemplarite`.`Emissiongesm2` AS `Emissiongesm2`,`vueexemplarite`.`Consoeaum2` AS `Consoeaum2`,`vueexemplarite`.`Ttceaum2` AS `Ttceaum2`,`vueexemplarite`.`Datedescriptif` AS `Datedescriptif`,`vueexemplarite`.`Surface` AS `Surface`,`vueexemplarite`.`Nbrniveaux` AS `Nbrniveaux`,`vueexemplarite`.`Tempsusage` AS `Tempsusage`,`vueexemplarite`.`Toiture` AS `Toiture`,`vueexemplarite`.`Frequentation` AS `Frequentation`,`vueexemplarite`.`Commentaires` AS `Commentaires`,`vueexemplarite`.`Toitureiso` AS `Toitureiso`,`vueexemplarite`.`Mur` AS `Mur`,`vueexemplarite`.`Muriso` AS `Muriso`,`vueexemplarite`.`Plancher` AS `Plancher`,`vueexemplarite`.`Plancheriso` AS `Plancheriso`,`vueexemplarite`.`Fenetre` AS `Fenetre`,`vueexemplarite`.`Vitrage` AS `Vitrage`,`vueexemplarite`.`Precisionbati` AS `Precisionbati`,`vueexemplarite`.`Chauffageener` AS `Chauffageener`,`vueexemplarite`.`Chauffagesysteme` AS `Chauffagesysteme`,`vueexemplarite`.`Chauffagepuissance` AS `Chauffagepuissance`,`vueexemplarite`.`Programmation` AS `Programmation`,`vueexemplarite`.`Robinets` AS `Robinets`,`vueexemplarite`.`Climatisation` AS `Climatisation`,`vueexemplarite`.`Eauchaude` AS `Eauchaude`,`vueexemplarite`.`Ventilation` AS `Ventilation`,`vueexemplarite`.`Eclairage` AS `Eclairage`,`vueexemplarite`.`Eclairagepuissance` AS `Eclairagepuissance`,`vueexemplarite`.`Electropuissance` AS `Electropuissance`,`vueexemplarite`.`Industrielpuissance` AS `Industrielpuissance`,`vueexemplarite`.`Precisionequipement` AS `Precisionequipement`,`vueexemplarite`.`Photo` AS `Photo`,`vueexemplarite`.`Nom` AS `Nom`,`vueexemplarite`.`Anneeconstruction` AS `Anneeconstruction`,`vueexemplarite`.`Voisinage` AS `Voisinage`,`vueexemplarite`.`Orientation` AS `Orientation`,`vueexemplarite`.`Exposition` AS `Exposition`,`vueexemplarite`.`altitude` AS `altitude`,`vueexemplarite`.`StationdjuID` AS `StationdjuID`,`vueexemplarite`.`commentaire` AS `commentaire` from `vueexemplarite` order by `vueexemplarite`.`Annee` desc;

-- --------------------------------------------------------

--
-- Structure de la vue `vueexemplarite`
--
DROP TABLE IF EXISTS `vueexemplarite`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsidgroup7`@`%` SQL SECURITY DEFINER VIEW `vueexemplarite` AS select `exemplarite`.`ExemplariteID` AS `ExemplariteID`,`exemplarite`.`BaseID` AS `BaseID`,`exemplarite`.`MouvrageID` AS `MouvrageID`,`exemplarite`.`BatimentID` AS `BatimentID`,`exemplarite`.`UtilisateurID` AS `UtilisateurID`,`exemplarite`.`Date` AS `Date`,`exemplarite`.`AccordMO` AS `AccordMO`,`exemplarite`.`Commentaire` AS `Commentairedescriptif`,`resultatbatiment`.`Annee` AS `Annee`,`resultatbatiment`.`CategorieID` AS `CategorieID`,`resultatbatiment`.`Surfacechauffee` AS `Surfacechauffee`,`resultatbatiment`.`Consoepm2` AS `Consoepm2`,`resultatbatiment`.`Consoefm2` AS `Consoefm2`,`resultatbatiment`.`Ttcm2` AS `Ttcm2`,`resultatbatiment`.`Emissiongesm2` AS `Emissiongesm2`,`resultatbatiment`.`Consoeaum2` AS `Consoeaum2`,`resultatbatiment`.`Ttceaum2` AS `Ttceaum2`,`descriptif`.`Date` AS `Datedescriptif`,`descriptif`.`Surface` AS `Surface`,`descriptif`.`Nbrniveaux` AS `Nbrniveaux`,`descriptif`.`Tempsusage` AS `Tempsusage`,`descriptif`.`Toiture` AS `Toiture`,`descriptif`.`Frequentation` AS `Frequentation`,`descriptif`.`Commentaires` AS `Commentaires`,`descriptif`.`Toitureiso` AS `Toitureiso`,`descriptif`.`Mur` AS `Mur`,`descriptif`.`Muriso` AS `Muriso`,`descriptif`.`Plancher` AS `Plancher`,`descriptif`.`Plancheriso` AS `Plancheriso`,`descriptif`.`Fenetre` AS `Fenetre`,`descriptif`.`Vitrage` AS `Vitrage`,`descriptif`.`Precisionbati` AS `Precisionbati`,`descriptif`.`Chauffageener` AS `Chauffageener`,`descriptif`.`Chauffagesysteme` AS `Chauffagesysteme`,`descriptif`.`Chauffagepuissance` AS `Chauffagepuissance`,`descriptif`.`Programmation` AS `Programmation`,`descriptif`.`Robinets` AS `Robinets`,`descriptif`.`Climatisation` AS `Climatisation`,`descriptif`.`Eauchaude` AS `Eauchaude`,`descriptif`.`Ventilation` AS `Ventilation`,`descriptif`.`Eclairage` AS `Eclairage`,`descriptif`.`Eclairagepuissance` AS `Eclairagepuissance`,`descriptif`.`Electropuissance` AS `Electropuissance`,`descriptif`.`Industrielpuissance` AS `Industrielpuissance`,`descriptif`.`Precisionequipement` AS `Precisionequipement`,`descriptif`.`Photo` AS `Photo`,`batiment`.`Nom` AS `Nom`,`batiment`.`Anneeconstruction` AS `Anneeconstruction`,`batiment`.`Voisinage` AS `Voisinage`,`batiment`.`Orientation` AS `Orientation`,`batiment`.`Exposition` AS `Exposition`,`batiment`.`altitude` AS `altitude`,`batiment`.`StationdjuID` AS `StationdjuID`,`batiment`.`Commentaire` AS `commentaire` from (((`resultatbatiment` left join `exemplarite` on(((`exemplarite`.`BatimentID` = `resultatbatiment`.`BatimentID`) and (`exemplarite`.`BaseID` = `resultatbatiment`.`BaseID`)))) left join `batiment` on(((`batiment`.`BatimentID` = `resultatbatiment`.`BatimentID`) and (`batiment`.`BaseID` = `batiment`.`BaseID`)))) left join `descriptif` on(((`resultatbatiment`.`BatimentID` = `descriptif`.`BatimentID`) and (`resultatbatiment`.`BaseID` = `descriptif`.`BaseID`) and (`descriptif`.`Date` = (select max(`descriptif`.`Date`) AS `MAX(Date)` from `descriptif` where ((year(`descriptif`.`Date`) <= `resultatbatiment`.`Annee`) and (`resultatbatiment`.`BatimentID` = `descriptif`.`BatimentID`) and (`resultatbatiment`.`BaseID` = `descriptif`.`BaseID`))))))) where ((`exemplarite`.`BatimentID` = `resultatbatiment`.`BatimentID`) and (`exemplarite`.`BaseID` = `resultatbatiment`.`BaseID`)) order by `resultatbatiment`.`Consoepm2`;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `action`
--
ALTER TABLE `action`
  ADD CONSTRAINT `action_ibfk_1` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `actionengagee`
--
ALTER TABLE `actionengagee`
  ADD CONSTRAINT `actionengagee_ibfk_1` FOREIGN KEY (`BatimentID`) REFERENCES `batiment` (`BatimentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `actionengagee_ibfk_2` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `actionengagee_ibfk_3` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `autreposte`
--
ALTER TABLE `autreposte`
  ADD CONSTRAINT `autreposte_ibfk_3` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `autreposte_ibfk_4` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `autreposte_ibfk_5` FOREIGN KEY (`CoordonneeID`) REFERENCES `coordonnee` (`CoordonneeID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `batiment`
--
ALTER TABLE `batiment`
  ADD CONSTRAINT `batiment_ibfk_5` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `batiment_ibfk_7` FOREIGN KEY (`CoordonneeID`) REFERENCES `coordonnee` (`CoordonneeID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `batiment_ibfk_8` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `categorie_ibfk_1` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `compteur`
--
ALTER TABLE `compteur`
  ADD CONSTRAINT `compteur_ibfk_1` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `compteur_ibfk_2` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compteur_ibfk_3` FOREIGN KEY (`CompteurprodID`) REFERENCES `compteur` (`CompteurID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `compteurautrepostes`
--
ALTER TABLE `compteurautrepostes`
  ADD CONSTRAINT `compteurautrepostes_ibfk_4` FOREIGN KEY (`AutreposteID`) REFERENCES `autreposte` (`AutreposteID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compteurautrepostes_ibfk_5` FOREIGN KEY (`CompteurID`) REFERENCES `compteur` (`CompteurID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compteurautrepostes_ibfk_6` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `compteurbatiments`
--
ALTER TABLE `compteurbatiments`
  ADD CONSTRAINT `compteurbatiments_ibfk_4` FOREIGN KEY (`BatimentID`) REFERENCES `batiment` (`BatimentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compteurbatiments_ibfk_5` FOREIGN KEY (`CompteurID`) REFERENCES `compteur` (`CompteurID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compteurbatiments_ibfk_6` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `compteureclairages`
--
ALTER TABLE `compteureclairages`
  ADD CONSTRAINT `compteureclairages_ibfk_6` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `compteureclairages_ibfk_7` FOREIGN KEY (`EclairageID`) REFERENCES `eclairage` (`EclairageID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compteureclairages_ibfk_8` FOREIGN KEY (`CompteurID`) REFERENCES `compteur` (`CompteurID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `compteurespaceverts`
--
ALTER TABLE `compteurespaceverts`
  ADD CONSTRAINT `compteurespaceverts_ibfk_4` FOREIGN KEY (`EspacevertID`) REFERENCES `espacevert` (`EspacevertID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compteurespaceverts_ibfk_5` FOREIGN KEY (`CompteurID`) REFERENCES `compteur` (`CompteurID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compteurespaceverts_ibfk_6` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `compteurposteproductions`
--
ALTER TABLE `compteurposteproductions`
  ADD CONSTRAINT `compteurposteproductions_ibfk_4` FOREIGN KEY (`PosteproductionID`) REFERENCES `posteproduction` (`PosteproductionID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compteurposteproductions_ibfk_5` FOREIGN KEY (`CompteurID`) REFERENCES `compteur` (`CompteurID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compteurposteproductions_ibfk_6` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `compteurvehicules`
--
ALTER TABLE `compteurvehicules`
  ADD CONSTRAINT `compteurvehicules_ibfk_1` FOREIGN KEY (`VehiculeID`) REFERENCES `vehicule` (`VehiculeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compteurvehicules_ibfk_2` FOREIGN KEY (`CompteurID`) REFERENCES `compteur` (`CompteurID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compteurvehicules_ibfk_3` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `coordonnee`
--
ALTER TABLE `coordonnee`
  ADD CONSTRAINT `coordonnee_ibfk_1` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `coordonnee_ibfk_2` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coordonnee_ibfk_3` FOREIGN KEY (`UtilisateurID`) REFERENCES `utilisateur` (`UtilisateurID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `decoupagevirtuel`
--
ALTER TABLE `decoupagevirtuel`
  ADD CONSTRAINT `decoupagevirtuel_ibfk_4` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `decoupagevirtuel_ibfk_5` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `decoupagevirtuel_ibfk_6` FOREIGN KEY (`CompteurID`) REFERENCES `compteur` (`CompteurID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `descriptif`
--
ALTER TABLE `descriptif`
  ADD CONSTRAINT `descriptif_ibfk_1` FOREIGN KEY (`BatimentID`) REFERENCES `batiment` (`BatimentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `descriptif_ibfk_2` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `descriptif_ibfk_3` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `diagnostique`
--
ALTER TABLE `diagnostique`
  ADD CONSTRAINT `diagnostique_ibfk_5` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `diagnostique_ibfk_6` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `diagnostique_ibfk_8` FOREIGN KEY (`BatimentID`) REFERENCES `batiment` (`BatimentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `diagnostique_ibfk_9` FOREIGN KEY (`BureauetudeID`) REFERENCES `coordonnee` (`CoordonneeID`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `djuan`
--
ALTER TABLE `djuan`
  ADD CONSTRAINT `djuan_ibfk_1` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `djuan_ibfk_2` FOREIGN KEY (`StationdjuID`) REFERENCES `stationdju` (`StationdjuID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `djutrentenaire`
--
ALTER TABLE `djutrentenaire`
  ADD CONSTRAINT `djutrentenaire_ibfk_1` FOREIGN KEY (`StationdjuID`) REFERENCES `stationdju` (`StationdjuID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `djutrentenaire_ibfk_2` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `eclairage`
--
ALTER TABLE `eclairage`
  ADD CONSTRAINT `eclairage_ibfk_3` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `eclairage_ibfk_6` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eclairage_ibfk_7` FOREIGN KEY (`CoordonneeID`) REFERENCES `coordonnee` (`CoordonneeID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `energie`
--
ALTER TABLE `energie`
  ADD CONSTRAINT `energie_ibfk_1` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `equipement`
--
ALTER TABLE `equipement`
  ADD CONSTRAINT `equipement_ibfk_1` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `espacevert`
--
ALTER TABLE `espacevert`
  ADD CONSTRAINT `espacevert_ibfk_5` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `espacevert_ibfk_7` FOREIGN KEY (`CoordonneeID`) REFERENCES `coordonnee` (`CoordonneeID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `espacevert_ibfk_8` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `etiquette`
--
ALTER TABLE `etiquette`
  ADD CONSTRAINT `etiquette_ibfk_1` FOREIGN KEY (`CategorieID`) REFERENCES `categorie` (`CategorieID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `etiquette_ibfk_2` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `exemplarite`
--
ALTER TABLE `exemplarite`
  ADD CONSTRAINT `exemplarite_ibfk_2` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `exemplarite_ibfk_3` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `exemplarite_ibfk_4` FOREIGN KEY (`BatimentID`) REFERENCES `batiment` (`BatimentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exemplarite_ibfk_5` FOREIGN KEY (`UtilisateurID`) REFERENCES `utilisateur` (`UtilisateurID`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `facture_ibfk_4` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `facture_ibfk_5` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `facture_ibfk_6` FOREIGN KEY (`CompteurID`) REFERENCES `compteur` (`CompteurID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `label`
--
ALTER TABLE `label`
  ADD CONSTRAINT `label_ibfk_1` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `label_ibfk_2` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `label_ibfk_3` FOREIGN KEY (`BatimentID`) REFERENCES `batiment` (`BatimentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `meteoan`
--
ALTER TABLE `meteoan`
  ADD CONSTRAINT `meteoan_ibfk_1` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `meteoan_ibfk_2` FOREIGN KEY (`StationmeteoID`) REFERENCES `stationmeteo` (`StationmeteoID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meteoan_ibfk_3` FOREIGN KEY (`CategorieID`) REFERENCES `categorie` (`CategorieID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `moan`
--
ALTER TABLE `moan`
  ADD CONSTRAINT `moan_ibfk_1` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `moan_ibfk_2` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `mouvrage`
--
ALTER TABLE `mouvrage`
  ADD CONSTRAINT `mouvrage_ibfk_1` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `mouvrage_ibfk_2` FOREIGN KEY (`CategorieID`) REFERENCES `categorie` (`CategorieID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `posteproduction`
--
ALTER TABLE `posteproduction`
  ADD CONSTRAINT `posteproduction_ibfk_3` FOREIGN KEY (`StationdjuID`) REFERENCES `stationdju` (`StationdjuID`),
  ADD CONSTRAINT `posteproduction_ibfk_4` FOREIGN KEY (`StationmeteoID`) REFERENCES `stationmeteo` (`StationmeteoID`),
  ADD CONSTRAINT `posteproduction_ibfk_5` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `posteproduction_ibfk_6` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posteproduction_ibfk_7` FOREIGN KEY (`CoordonneeID`) REFERENCES `coordonnee` (`CoordonneeID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `preconisation`
--
ALTER TABLE `preconisation`
  ADD CONSTRAINT `preconisation_ibfk_1` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `preconisation_ibfk_2` FOREIGN KEY (`DiagnostiqueID`) REFERENCES `diagnostique` (`DiagnostiqueID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `preconisation_ibfk_3` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `psouscrite`
--
ALTER TABLE `psouscrite`
  ADD CONSTRAINT `psouscrite_ibfk_3` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `psouscrite_ibfk_5` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `psouscrite_ibfk_6` FOREIGN KEY (`CompteurID`) REFERENCES `compteur` (`CompteurID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ratio`
--
ALTER TABLE `ratio`
  ADD CONSTRAINT `ratio_ibfk_1` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratio_ibfk_2` FOREIGN KEY (`CategorieID`) REFERENCES `categorie` (`CategorieID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `ratiosconso`
--
ALTER TABLE `ratiosconso`
  ADD CONSTRAINT `ratiosconso_ibfk_1` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ratiosconso_ibfk_2` FOREIGN KEY (`RatioID`) REFERENCES `ratio` (`RatioID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `releve`
--
ALTER TABLE `releve`
  ADD CONSTRAINT `releve_ibfk_1` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `releve_ibfk_2` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `releve_ibfk_3` FOREIGN KEY (`SouscompteurID`) REFERENCES `souscompteur` (`SouscompteurID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `resultatbatiment`
--
ALTER TABLE `resultatbatiment`
  ADD CONSTRAINT `resultatbatiment_ibfk_1` FOREIGN KEY (`BatimentID`) REFERENCES `batiment` (`BatimentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resultatbatiment_ibfk_2` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `resultatbatiment_ibfk_3` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `resultatcompteur`
--
ALTER TABLE `resultatcompteur`
  ADD CONSTRAINT `resultatcompteur_ibfk_1` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `resultatcompteur_ibfk_2` FOREIGN KEY (`CompteurID`) REFERENCES `compteur` (`CompteurID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resultatcompteur_ibfk_3` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `resultatmo`
--
ALTER TABLE `resultatmo`
  ADD CONSTRAINT `resultatmo_ibfk_1` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `resultatmo_ibfk_2` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resultatmo_ibfk_3` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_ibfk_2` FOREIGN KEY (`Username`) REFERENCES `utilisateur` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `roles_ibfk_3` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `roles_ibfk_4` FOREIGN KEY (`record_id`) REFERENCES `mouvrage` (`MouvrageID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `souscompteur`
--
ALTER TABLE `souscompteur`
  ADD CONSTRAINT `souscompteur_ibfk_3` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `souscompteur_ibfk_4` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `souscompteur_ibfk_5` FOREIGN KEY (`CompteurID`) REFERENCES `compteur` (`CompteurID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `stationdju`
--
ALTER TABLE `stationdju`
  ADD CONSTRAINT `stationdju_ibfk_1` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `stationmeteo`
--
ALTER TABLE `stationmeteo`
  ADD CONSTRAINT `stationmeteo_ibfk_1` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tarifsreglemente`
--
ALTER TABLE `tarifsreglemente`
  ADD CONSTRAINT `tarifsreglemente_ibfk_1` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD CONSTRAINT `vehicule_ibfk_3` FOREIGN KEY (`BaseID`) REFERENCES `base` (`BaseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `vehicule_ibfk_5` FOREIGN KEY (`MouvrageID`) REFERENCES `mouvrage` (`MouvrageID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehicule_ibfk_6` FOREIGN KEY (`CoordonneeID`) REFERENCES `coordonnee` (`CoordonneeID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
