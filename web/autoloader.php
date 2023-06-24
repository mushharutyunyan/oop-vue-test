<?php
use Server\Autoloader;
require_once '../server/Autoloader.php';
new Autoloader('System', '/../system/');
new Autoloader('App\\Controllers', '/../app/Controllers');
new Autoloader('App\\Requests', '/../app/Requests');
new Autoloader('App\\Errors', '/../app/Errors');
new Autoloader('App\\Responses', '/../app/Responses');
new Autoloader('App\\ValueObjects', '/../app/ValueObjects');
new Autoloader('App\\Services', '/../app/Services');
new Autoloader('App\\Services\\Scraping', '/../app/Services/Scraping');
new Autoloader('App\\Services\\File', '/../app/Services/File');

new Autoloader('Helpers', '/../helpers');

