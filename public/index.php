<?php

require '../vendor/autoload.php';
use Smarty\Smarty;
$smarty = new Smarty();

$smarty->setTemplateDir('../tpl/');
$smarty->setCompileDir('../tpl/compiled/');
$smarty->setConfigDir('../tpl/config/');
$smarty->setCacheDir('../tpl/cache/');
$smarty->setEscapeHtml(true);
$smarty->testInstall();

$smarty->display('index.tpl');