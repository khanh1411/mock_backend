<?php

// spl_autoload_register(function($className){
//     require_once "../libraries/".$className.".php";
    
// });

// defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR); // ký tự '\'
defined('DS') ? null : define('DS', "/"); // defined() -> xác định constant đã tồn tại chưa

$folder = getcwd();
define("SITE_ROOT", $folder);

require_once "libraries/Database.php";
require_once "libraries/Model.php";
require_once "libraries/Session.php";

require_once "components/User.php";
require_once "components/Post.php";
require_once "components/Image.php";


function redirect($location)
{  
    header("Location: $location");
}
