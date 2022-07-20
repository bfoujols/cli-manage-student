# Changelog

## 0.5.0-alpha

#### New feature :

* Nouveau fichier d'importation. A partir des fichiers export Academique (cyclable), vous pouvez jouer avec les
  commandes
* Mise en place d'un installer pour mettre la commande dans votre systeme (compatible Linux / MacOs)

## 0.4.0-alpha

#### New feature :

* Nouveau fichier d'importation. A partir des fichiers export Ecole Direct, vous pouvez jouer avec les commandes

#### Fix bug :

* Refactoring de class by Codacy

## 0.3.1-alpha

#### Fix bug :

* Probleme sur la nomenclature en cas d'espace avant / après les noms et prénoms
* Refactoring de class modele et dir service

## 0.3.0-alpha

#### New feature :

* Test unitaire sur la simulation des commandes
* Refactoring Test FileExtension
* Finalisation du modele par defaut

#### Fix bug :

* Correction sur le path

## 0.2.0-alpha

#### New feature :

* Commande "file:default" : Creation d'un fichier XLSX vide afin d'utiliser la commande "student:dir"
* Mise en place des tests unitaires

#### Fix bug :

* Correction pour utliser mstud avec la version PHP 7.4

## 0.1.0-alpha

New feature :

* Commande "student:dir" : Creation des répertoires (alias dir) de chaque étudiant dans l'arborescence
* Mise en place d'une nomenclature nom-prenom-datenaissance(aammjj) pour éviter les problemes homonyme
* Importation des étudiants à partir d'un template au format XLSX
