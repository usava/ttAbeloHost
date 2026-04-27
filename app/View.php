<?php

namespace App;

use Smarty\Smarty;

class View
{
    private static ?View $instance = null;
    public Smarty $smarty;

    private function __construct() {
        $this->initSmarty();
    }

    public static function getInstance(): View
    {
        if (self::$instance === null) {
            return new self();
        }

        return self::$instance;
    }

    protected function initSmarty(): void
    {
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir('../tpl/');
        $this->smarty->setCompileDir('../tpl/compiled/');
        $this->smarty->setConfigDir('../tpl/config/');
        $this->smarty->setCacheDir('../tpl/cache/');
        $this->smarty->setEscapeHtml(true);
    }
}