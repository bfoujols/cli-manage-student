# Manage Student Cli
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/df1ed0cf2b5a46e68a822e674ca8e671)](https://www.codacy.com/gh/bfoujols/manage-student-cli/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=bfoujols/manage-student-cli&amp;utm_campaign=Badge_Grade)

Création d'un invité de commande pour faciliter la gestion des étudiants. 
A partir de fichier source (XLS, CVS, JSON ...), on peut effectuer des taches comme la création des dossiers d'étudiant ou d'autres fichiers template (comme la création des fiches d'examen)

## Features

### Last release

[MANAGE STUDENT v0.1.0-alpha : Liste des releases](https://github.com/bfoujols/manage-student-cli/blob/main/CHANGELOG.md)

### Liste des features
  *  Commande "student:dir" : Creation des répertoires (alias dir) de chaque étudiant dans l'arborescence
  *  Mise en place d'une nomenclature nom-prenom-datenaissance(aaaammjj) pour éviter les problemes homonyme
  *  Importation des étudiants à partir d'un template au format XLSX

## Basic Usage

Pour savoir la liste des commandes disponibles :
``` shell
# php mstud.phar list
```

### Prerequis
| Version | Service                                                             |
|:--------|:--------------------------------------------------------------------|
| ^7.4    | PHP Engine                                                          | 
| ^2.0    | Composer Dependency Manager                                         |


## Develop

Package du projet via une archive .phar via clue/phar-composer
``` shell
# curl -JOL https://clue.engineering/phar-composer-latest.phar
# git clone git@github.com:bfoujols/cli-manage-student.git
# php -d phar.readonly=off phar-composer.phar build cli-manage-student
[1/1] Creating phar manage-student.phar
  - Adding main package "bfoujols/manage-student"
  - Adding composer base files
  - Adding dependency "psr/container" from "vendor/psr/container/"
  - Adding dependency "roave/security-advisories" from "vendor/roave/security-advisories/"
  - Adding dependency "symfony/console" from "vendor/symfony/console/"
  - Adding dependency "symfony/polyfill-ctype" from "vendor/symfony/polyfill-ctype/"
  - Adding dependency "symfony/polyfill-intl-grapheme" from "vendor/symfony/polyfill-intl-grapheme/"
  - Adding dependency "symfony/polyfill-intl-normalizer" from "vendor/symfony/polyfill-intl-normalizer/"
  - Adding dependency "symfony/polyfill-mbstring" from "vendor/symfony/polyfill-mbstring/"
  - Adding dependency "symfony/service-contracts" from "vendor/symfony/service-contracts/"
  - Adding dependency "symfony/string" from "vendor/symfony/string/"
  - Setting main/stub
    Using referenced shebang "#!/usr/bin/env php"
    Using referenced chmod 0644
    Applying chmod 0644
    OK - Creating manage-student.phar (1091.6 KiB) completed after 0.1s
# php manage-student.phar --version
  Manage Student CLI <<version>>
```

