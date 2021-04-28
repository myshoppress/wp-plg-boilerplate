<?php

namespace BoilerPlate\WP\Plugin;

use MyShoppress\WP\Core\Command\PluginCommand;

class CustomCommand extends PluginCommand
{

    public function getName(): string
    {
        return 'package:command-name';
    }

    public function __invoke(): void
    {

    }
}