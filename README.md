# Manage Student Cli

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/df1ed0cf2b5a46e68a822e674ca8e671)](https://www.codacy.com/gh/bfoujols/manage-student-cli/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=bfoujols/manage-student-cli&amp;utm_campaign=Badge_Grade)
![CI](https://github.com/bfoujols/manage-student-cli/actions/workflows/codacy.yml/badge.svg)

![CI](https://img.shields.io/badge/php-7.4%20to%208.1-777bb3.svg?logo=php&logoColor=white&labelColor=555555)
![CI](https://github.com/bfoujols/manage-student-cli/actions/workflows/testing.yml/badge.svg)
![CI](https://github.com/bfoujols/manage-student-cli/actions/workflows/testing-php80.yml/badge.svg)
![CI](https://github.com/bfoujols/manage-student-cli/actions/workflows/testing-php81.yml/badge.svg)

Création d'un invité de commande pour faciliter la gestion des étudiants.
A partir de fichier source (XLS, CVS, JSON ...), on peut effectuer des taches comme la création des dossiers d'étudiant
ou d'autres fichiers template (comme la création des fiches d'examen)

## Features

### Last release

[MANAGE STUDENT v0.4.0-alpha : Liste des releases](https://github.com/bfoujols/manage-student-cli/blob/main/CHANGELOG.md)

### Liste des features

* (new) Importation des étudiants à partir d'un export Ecole Directe
* Commande "student:dir" : Creation des répertoires (alias dir) de chaque étudiant dans l'arborescence
* Commande "file:default" : Creation d'un fichier XLSX vide afin d'utiliser la commande "student:dir"
* Mise en place d'une nomenclature nom-prenom-datenaissance(aaaammjj) pour éviter les problemes homonyme
* Importation des étudiants à partir d'un template au format XLSX

## Basic Usage

Pour savoir la liste des commandes disponibles :

``` shell
php mstud.phar list
```

## Installation

Pour installer la commande, ouvrez un terminal :

``` shell
curl -fsS https://raw.githubusercontent.com/bfoujols/manage-student-cli/main/dist/installer.php | php
```

### Prerequis

| Version | Service    |
|:--------|:-----------|
| ^10.11  | MAC OS     |
| ^4.11   | LINUX      |
| ^7.4    | PHP Engine | 
| ^7.4    | PHP CLI    |
| ^7.6    | CURL       |

## Develop

Je vous invite à participer au projet pour corriger, améliorer ce client CLI. Pour cela il faut suivre la procedure
ci-dessous :

```shell
$ git clone git@github.com:bfoujols/cli-manage-student.git
$ cd cli-manage-student
$ composer install
$ php bin/mstud 
```

## Testing

Le projet est testé par PHPUnit via le CI Github Action. Vous pouvez lancer les tests via cette demande :

```shell
composer test
```

le raccourcie via composer execute : php vendor/bin/phpunit

## Package

Package du projet via une archive .phar via clue/phar-composer

``` shell
$ curl -JOL https://clue.engineering/phar-composer-latest.phar
$ git clone git@github.com:bfoujols/cli-manage-student.git
$ cli-manage-student
$ composer install --no-dev
$ cd ..
$ php -d phar.readonly=off phar-composer.phar build cli-manage-student
[1/1] Creating phar mstud.phar
  - Adding main package "bfoujols/mstud"
  - Adding composer base files
  [...]
  - Setting main/stub
    Using referenced shebang "#!/usr/bin/env php"
    Using referenced chmod 0644
    Applying chmod 0644
    OK - Creating mstud.phar (1091.6 KiB) completed after 0.1s
$ php mstud.phar --version
  Manage Student CLI <<version>>
```

### AUTEUR

Benoit Foujols - ORT Sup Montreuil - AC Creteil

![signature](https://github.com/bfoujols/bfoujols/blob/main/assets/bfoujols-sign-all-fine.png?raw=true)
