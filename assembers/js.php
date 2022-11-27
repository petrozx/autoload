<?
global $class;
global $method;
header("Content-type: application/javascript");
        echo "(async()=>{";
        if(file_exists(ROOT."/js/script.js")) {
            echo file_get_contents(ROOT."/js/script.js");
        }
        if (file_exists(ROOT."/components/".$class."/".$method."/js/script.js")){
            echo file_get_contents(ROOT."/components/".$class."/".$method."/js/script.js");
        }
        echo "})()";