<?php
namespace DataStorage;
class DataStorageFile implements iDataStorage {
//class DataStorageFile {
    private $config=array();
    public function __construct($configFile) {
	$config=Utils::getConfig($configFile);
	if (count($config)==0) die("Could not load config file");

	$required=array("DATADIR","CHUNK");
	foreach ($required as $testField) {
	    if (!isset($config[$testField])) die("No $testField variable set");
	}

	$this->config=$config;
    }
    
    private function genFilename($key) {
	
	$hash=hash("md5",$key);
	
	$filename=$this->config["DATADIR"].DIRECTORY_SEPARATOR.substr($hash,0,$this->config["CHUNK"]).DIRECTORY_SEPARATOR.$hash;
	
	return $filename;
    }
    
    public function Create($key,$data) {
	$filename=$this->genFilename($key);
	if (file_exists($filename)) return false;

	$dir=dirname($filename);

	if (!file_exists($dir)) mkdir($dir,0777,true);
	if (!is_dir($dir)) return false;
	
	return file_put_contents($filename,$data) ? true:false;
    }
    
    public function Read($key) {
	$filename=$this->genFilename($key);
	
	if (!file_exists($filename)) return false;
	if (!is_file($filename)) return false;
	
	return file_get_contents($filename);
    }
    
    public function Update($key,$data) {
	$filename=$this->genFilename($key);
	if (!file_exists($filename)) return false;
	if (!is_file($filename)) return false;

	return file_put_contents($filename,$data) ? true:false;
    }
    
    public function Delete($key) {
	$filename=$this->genFilename($key);
	if (!file_exists($filename)) return false;
	if (!is_file($filename)) return false;
	
	return unlink($filename);
    }
}
?>