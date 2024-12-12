<?php
function my_custom_autoloader($path_to_class ){
//    $namespace=str_replace("\\","/",__NAMESPACE__);
//    $className=str_replace("\\","/",$className);
//    $class=CORE_PATH."/classes/".(empty($namespace)?"":$namespace."/")."{$className}.class.php";
//    include_once($class);
    $path_to_class = str_replace('\\','/',$path_to_class);
    $file = __DIR__.'/'.$path_to_class.'.php';

    if ( file_exists($file) ) {
        require_once $file;
    }
}

// add a new autoloader by passing a callable into spl_autoload_register()
spl_autoload_register( 'my_custom_autoloader' );