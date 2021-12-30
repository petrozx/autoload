<?
$dir = $_SERVER['DOCUMENT_ROOT'] . "/actions/";
$files = scandir($dir);
foreach($files as $file){
    if(($file !== '.') AND ($file !== '..')){
    include_once($dir .''. $file);
    }
}