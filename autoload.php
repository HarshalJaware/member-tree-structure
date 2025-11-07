<?php
spl_autoload_register(function($class){
    $fileName = __DIR__."/classes/$class.php";
    
    //check file is exist or not and then include it if exist
    if(file_exists($fileName)){
        require_once($fileName);
    } 
});

?>