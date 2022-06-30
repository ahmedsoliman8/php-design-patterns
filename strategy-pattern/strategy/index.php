<?php

require 'vendor/autoload.php';

$config = new \App\Config\Config(
	new \App\Config\Parser\ArrayParser
);

$config->load('config/database.php');

echo $config->get('mysql.host');
