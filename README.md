```

    __  ___                                _____ __            __
   /  |/  /___ _____  ____ _____ ____     / ___// /___  ______/ /
  / /|_/ / __ `/ __ \/ __ `/ __ `/ _ \    \__ \/ __/ / / / __  / 
 / /  / / /_/ / / / / /_/ / /_/ /  __/   ___/ / /_/ /_/ / /_/ /  
/_/  /_/\__,_/_/ /_/\__,_/\__, /\___/   /____/\__/\__,_/\__,_/   
                         /____/                                  

```
# Manage Student Cli

## Features

* Creation des repertoires par étudiant via un source XLS
* Source fichier CSV ou export 'Ecole directe'

## Basic Usage

Pour savoir la liste des commandes disponibles :
```
# php manage-student.phar
```


## Develop

Package du projet via une archive .phar via clue/phar-composer
```
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

