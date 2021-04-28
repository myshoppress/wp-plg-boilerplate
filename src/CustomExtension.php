<?php

namespace MyPackage\WP\Plugin;

use MyShoppress\WP\Core\Extension\Context;
use MyShoppress\WP\Core\Extension\PluginExtension;

class CustomExtension extends PluginExtension
{
    public function registerHooks(Context $context): void
    {
        //register your hooks here
        add_action('get_footer', function(){
            $this->plugin->renderTemplate(['template','file']);
        });
    }
}