<?php

namespace BoilerPlate\WP\Plugin;

use MyShoppress\WP\Core\AbstractPlugin;

define('BOILERPLATE_VERSION', '1.0.0');
define('BOILERPLATE_NAME', 'Boiler Plate');
define('BOILERPLATE_PLUGIN_ID', 'boilerplate');
define('BOILERPLATE_TEXTDOMAIN', BOILERPLATE_PLUGIN_ID);
define('BOILERPLATE_PLUGIN_DIRECTORY', plugin_dir_path(__FILE__));

class Plugin extends AbstractPlugin
{
    public function getName(): string
    {
        return BOILERPLATE_NAME;
    }

    public function getId(): string
    {
        return BOILERPLATE_PLUGIN_ID;
    }

    public function getVersion(): string
    {
        return BOILERPLATE_TEXTDOMAIN;
    }

    public function getDirectoryPath(): string
    {
        return BOILERPLATE_PLUGIN_DIRECTORY;
    }
}