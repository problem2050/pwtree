<?php

set_include_path($_SERVER['Root_Path'] . '/libs' . PATH_SEPARATOR .
                 $_SERVER['Root_Path'] . '/lib' . PATH_SEPARATOR .
                 get_include_path() );

if (!function_exists('__autoload')) {
    function __autoload($className)
    {
        @include_once implode('/', explode('_', $className)) . '.php';
    }
}

if (!function_exists('getSiteConfig')) {
    $SITE_CONFIGS = array();
    function addSiteConfigs($confs)
    {
        global $SITE_CONFIGS;
        $SITE_CONFIGS += $confs;
    }
    if (is_file($_SERVER['Root_Path'] . '/site.configs.php')) {
        include_once($_SERVER['Root_Path'] . '/site.configs.php');
    }
    addSiteConfigs($_SERVER);
    function getSiteConfig($id, $def=null)
    {
        global $SITE_CONFIGS;
        return isset($SITE_CONFIGS[$id]) ? $SITE_CONFIGS[$id] : $def;
    }
}

if (extension_loaded('apc'))
{
    function eaccelerator_put($key,$value,$ttl=0)
    {
        return apc_store($key,$value,$ttl);
    }
    function eaccelerator_get($key)
    {
        $tmp = apc_fetch($key);
        if($tmp !== false)
        {
            return $tmp;
        }
        else{
            return null; 
        }
    }
    function eaccelerator_rm($key)
    {
        return apc_delete($key);
    }
    
}

?>
