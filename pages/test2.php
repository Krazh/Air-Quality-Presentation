<?php
$root = $_SERVER['DOCUMENT_ROOT'] . "/airquality/";
require_once $root . 'includes/functions.php';
require_once $root . 'includes/global_variables.php';
require_once $root . 'assets/php-wrapper/fusioncharts.php';
echo GetLimitValue($_POST['data'][1]['value']);