<?php
// Version
define('VERSION', '2.3.0.2.2');

// Configuration
if (is_file('config.php')) {
	require_once('config.php');
}

// Install
if (!defined('DIR_APPLICATION')) {
	header('Location: install/index.php');
	exit;
}


 if($_SERVER['REQUEST_URI'] == "/sitemap.xml") {
     header("Location: /index.php?route=sitemap/sitemap",TRUE,301);
     exit();
 }
if($_SERVER['REQUEST_URI'] == "/laminat/laminat-agt/") {
    header("Location: /laminat/agt/",TRUE,301);
    exit();
}
if($_SERVER['REQUEST_URI'] == "/laminat/laminat-balterio/") {
    header("Location: /laminat/balterio/",TRUE,301);
    exit();
}
if($_SERVER['REQUEST_URI'] == "/laminat/laminat-mystyle/") {
    header("Location: /laminat/mystyle/",TRUE,301);
    exit();
}
if($_SERVER['REQUEST_URI'] == "/laminat/laminat-eurohome/") {
    header("Location: /laminat/eurohome/",TRUE,301);
    exit();
}
if($_SERVER['REQUEST_URI'] == "/laminat/laminat-quick-step/") {
    header("Location: /laminat/quick-step/",TRUE,301);
    exit();
}
if($_SERVER['REQUEST_URI'] == "/laminat/laminat-egger/") {
    header("Location: /laminat/egger/",TRUE,301);
    exit();
}
if($_SERVER['REQUEST_URI'] == "/laminat/laminat-kaindl/") {
    header("Location: /laminat/kaindl/",TRUE,301);
    exit();
}
if($_SERVER['REQUEST_URI'] == "/laminat/laminat-krono-original/") {
    header("Location: /laminat/krono-original/",TRUE,301);
    exit();
}
if($_SERVER['REQUEST_URI'] == "/laminat/laminat-classen/") {
    header("Location: /laminat/classen/",TRUE,301);
    exit();
}
if($_SERVER['REQUEST_URI'] == "/laminat/laminat-kronopol/") {
    header("Location: /laminat/kronopol/",TRUE,301);
    exit();
}
if($_SERVER['REQUEST_URI'] == "/laminat/laminat-vitality/") {
    header("Location: /laminat/vitality/",TRUE,301);
    exit();
}
if($_SERVER['REQUEST_URI'] == "/laminat/laminat-grandeco/") {
    header("Location: /laminat/grandeco/",TRUE,301);
    exit();
}

// Startup
require_once(DIR_SYSTEM . 'startup.php');

start('catalog');