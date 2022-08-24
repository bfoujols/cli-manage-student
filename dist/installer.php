<?php

namespace Studoo\Installer;

// Check le minimun requis

if (version_compare(PHP_VERSION, '7.4', '<')) {
    /** @noinspection PhpUnhandledExceptionInspection */
    throw new \Exception(sprintf('La version de PHP est %s, 7.4 est au minimun dans les prérequis.', PHP_VERSION));
}

// PHP CLI est installé ou activé
if (PHP_SAPI !== 'cli') {
    throw new \RuntimeException('PHP CLI n est pas installé sur votre environnement');
}

// Procedure installation
(new Installer())->execute();

class Installer
{
    private string $executable;
    private string $executableName;
    private string $rootDir;
    private string $manifest;
    private string $nameCommand;

    public function __construct()
    {
        $setup = array(
            "executable" => "studoo",
            "rootDir" => ".studoo",
            "manifest" => "https://dist.studoo.app/manifest.json",
            "nameCommand" => "Studoo"
        );

        foreach ($setup as $key => $value) {
            if (\property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }

        $this->executableName = $this->executable . ".phar";
    }

    /**
     * @throws \JsonException
     */
    public function execute()
    {
        error_reporting(E_ALL);
        ini_set('log_errors', 0);
        ini_set('display_errors', 1);

        $this->output($this->nameCommand . " installer", 'heading', false);
        $this->output($this->nameCommand . " installer", 'heading');

        $manifest = $this->getManifest();

        $this->output(PHP_EOL . "Environment check", 'heading');
        $this->checkExtension('json');
        $this->checkExtension('phar');
        $this->checkExtension('openssl');
        $this->checkExtension('pcre');

        if ($manifest[0]["php"]["min"] <= PHP_VERSION) {
            $this->output("  [*] La version de PHP est OK (" . PHP_VERSION . ")", 'success');
        } else {
            $this->output("  [X] La version de PHP n'est pas valide (" . $manifest[0]["php"]["min"] . " <= " . PHP_VERSION . ")", 'error');
            exit(1);
        }

        // Installation du bin
        $this->output(PHP_EOL . 'Téléchargement', 'heading');
        // Téléchargement
        $url = $manifest[0]["url"];
        $contents = \file_get_contents($url, false);
        if ($contents === false) {
            $this->output("  [X] Le téléchargement a échoué", 'error');
        }
        $pathPhar = $this->executableName;
        if (!file_put_contents($pathPhar, $contents)) {
            $this->output("  [X] L'écriture n'a pas reussi: " . $pathPhar, 'error');
            exit(1);
        }
        $this->output("  [*] Le téléchargement est réussi", 'success');

        // Check intégrité
        if ($manifest[0]['sha256'] !== hash_file('sha256', $pathPhar)) {
            unlink($pathPhar);
            $this->output("  [X] Le check d'intégrité est corrompu", 'error');
            exit(1);
        }
        $this->output("  [*] Le check d'intégrité est OK", 'success');

        // Check si le PHAR est valide
        try {
            new \Phar($pathPhar);
        } catch (\Exception $e) {
            unlink($pathPhar);
            $this->output("  [X] Le Phar n'est pas valide" . "\n" . $e->getMessage(), 'error');
            exit(1);
        }
        $this->output("  [*] Le Phar est valide", 'success');

        // Installation
        $this->output(PHP_EOL . "Installation", 'heading');
        if (!chmod($pathPhar, 0755)) {
            $this->output("  [X] N'arrive pas à rendre le Phar executable", 'error');
        }
        $this->output("  [*] Le Phar est executable", 'success');

        if ($pathUser = $this->getHomeDirectory()) {
            $binDir = $pathUser . DIRECTORY_SEPARATOR . $this->rootDir . DIRECTORY_SEPARATOR . 'bin';

            if (!@mkdir($binDir, 0700, true) && is_dir($binDir)) {
                $this->output("  [X] La création du dossier n'est pas possible: " . $binDir . " (File exists)", 'error');
            } else {
                $this->output("  [*] La création du dossier est OK: " . $binDir, 'success');
            }

            $destination = $binDir . DIRECTORY_SEPARATOR . $this->executable;
            if (!rename($pathPhar, $destination)) {
                $this->output("  [X] Le déplcement n'est pas possible: " . $destination, 'error');
            }
            $this->output("  [*] Déplacement Phar OK: " . $destination, 'success');
        }

        $this->output(PHP_EOL . "Action à faire", 'heading');
        $this->output("  Mettre dans votre fichier configuration shell, la ligne suivante :", 'heading', false);
        $this->output('  export PATH=$HOME/.studoo/bin:$PATH' . PHP_EOL, 'heading', false);
        $this->output("  Après l'installation de cette ligne, vous pouvez ouvrir une autre session de terminal" . PHP_EOL, 'heading', false);
        $this->output("  La commande studoo est disponible :)" . PHP_EOL, 'heading', false);

        $this->output("  Si vous avez un problème, https://github.com/bfoujols/studoo/discussions" . PHP_EOL . PHP_EOL, 'heading', false);
    }

    /**
     * @throws \JsonException
     */
    private function getManifest()
    {
        if ($url = file_get_contents($this->manifest)) {
            $this->output("  [*] Success to download Manifest ", 'success');
            return json_decode($url, true, 512, JSON_THROW_ON_ERROR);
        } else {
            $this->output("  [X] Failed to download Manifest ", 'error');
            return false;
        }
    }


    private function getHomeDirectory()
    {
        $vars = ['HOME', 'USERPROFILE'];
        foreach ($vars as $var) {
            if ($home = getenv($var)) {
                return realpath($home) ?: $home;
            }
        }

        return false;
    }

    private function output($text, $color = null, $newLine = true)
    {
        static $styles = [
            'success' => "\033[0;32m%s\033[0m",
            'error' => "\033[31;31m%s\033[0m",
            'info' => "\033[33m%s\033[39m",
            'warning' => "\033[33m%s\033[39m",
            'heading' => "\033[1;33m%s\033[22;39m",
        ];

        $format = '%s';

        if (isset($styles[$color])) {
            $format = $styles[$color];
        }

        if ($newLine) {
            $format .= PHP_EOL;
        }

        printf($format, $text);
    }


    private function checkExtension($extension)
    {
        if (\extension_loaded($extension)) {
            $this->output('  [*] The "' . $extension . '" PHP extension est installé.', 'success');
            return;
        }
        $this->output('  [X] The ' . $extension . ' PHP extension est recommandé.', 'error');
        $extFilename = DIRECTORY_SEPARATOR === '\\' ? 'php_' . $extension . '.dll' : $extension . '.so';
        $extDirs = [
            PHP_EXTENSION_DIR,
            dirname(PHP_BINARY) . DIRECTORY_SEPARATOR . 'ext',
        ];
        foreach ($extDirs as $dir) {
            $extPath = $dir . DIRECTORY_SEPARATOR . $extFilename;
            if (!\file_exists($extPath)) {
                continue;
            }
            $this->output("L'extension existe dans : $extPath");
            if (!empty(PHP_CONFIG_FILE_SCAN_DIR) && \is_dir(PHP_CONFIG_FILE_SCAN_DIR)) {
                $this->output(
                    "\nActiver l'extension dans le fichier de configuration : " . PHP_CONFIG_FILE_SCAN_DIR . DIRECTORY_SEPARATOR . "$extension.ini"
                    . "\ndécocher la ligne suivante :"
                    . "\nextension=$extPath"
                );
            } else {
                $this->output(
                    "\nPour l'activer, éditez votre fichier de configuration php.ini et ajoutez la ligne :"
                    . "\nextension=$extPath"
                );
            }
            break;
        }
        exit(1);
    }
}