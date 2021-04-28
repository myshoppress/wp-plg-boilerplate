<?php

namespace MyPackage\WP\Plugin;

use MyShoppress\WP\Core\AbstractPlugin;

define('CHANGETHIS_VERSION', '1.0.0');
define('CHANGETHIS_NAME', 'PLUGIN NAME');
define('CHANGETHIS_PLUGIN_ID', 'PLUGIN SLUG');
define('CHANGETHIS_TEXTDOMAIN', SI_PLUGIN_ID);
define('CHANGETHIS_PLUGIN_DIRECTORY', plugin_dir_path(__FILE__));

class Plugin extends AbstractPlugin
{
    public function getName(): string
    {
        return CHANGETHIS_NAME;
    }

    public function getId(): string
    {
        return CHANGETHIS_PLUGIN_ID;
    }

    public function getVersion(): string
    {
        return CHANGETHIS_VERSION;
    }

    public function getDirectoryPath(): string
    {
        return CHANGETHIS_PLUGIN_DIRECTORY;
    }
}