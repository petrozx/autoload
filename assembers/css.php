<?
header("Content-type: text/css");
if(file_exists(ROOT."/css/style.css")) {
    echo file_get_contents(ROOT."/css/style.css");
}
if (file_exists(ROOT."/components/".$class."/css/style.css")){
    echo file_get_contents(ROOT."/components/".$class."/css/style.css");
}