<?php
namespace DataStorage;
class Utils {
    public static function getConfig($configFile) {
	$config=array();
	if (!file_exists($configFile)) return $config;
	
	foreach (explode("\n",file_get_contents($configFile)) as $configLine) {
	    $configItem=explode("=",$configLine,2);
	    $config[$configItem[0]]=$configItem[1];
	}
	return $config;
    }
}
?>