<?php
namespace DataStorage;

class DataStorageStacked implements iDataStorage {
    private $config;
    private $backingStorage;

    public function __construct($configFile) {
	$config=Utils::getConfig($configFile);
	
	if (count($config)==0) die("Could not load config file");

        $required=array("BACKINGSTORAGE","PIPELINE");
        foreach ($required as $testField) {
            if (!isset($config[$testField])) die("No $testField variable set");
        }

	$backingStorageClass="DataStorage\\".$config["BACKINGSTORAGE"];
	$this->backingStorage=new $backingStorageClass($configFile);
	$this->config=$config;
    }
    
    public function Create($key,$data) {
	return $this->backingStorage->Create($key,$this->EncodePipeline($data));
    }
    
    public function Read($key) {
	$data=$this->backingStorage->Read($key);
	if ($data===false)  return false;
	
	return $this->DecodePipeline($data);
    }
    
    public function Update($key,$data) {
	return $this->backingStorage->Update($key,$this->EncodePipeline($data));
    }
    
    public function Delete($key) {
	return $this->backingStorage->Delete($key);
    }


    private function getPipelineClass($dataProcessorId) {
	$DPClass="DataStorage\\".trim($dataProcessorId);
	$DP=new $DPClass;
	 return $DP;
    }
    private function EncodePipeline($data) {
	foreach(explode(",",$this->config["PIPELINE"]) as $dataProcessorId) {
	    $data=$this->getPipelineClass($dataProcessorId)->Encode($data);
	}
	
	return $data;
    }
    
    private function DecodePipeline($data) {
	foreach(array_reverse(explode(",",$this->config["PIPELINE"])) as $dataProcessorId) {
	    $data=$this->getPipelineClass($dataProcessorId)->Decode($data);
	}
	
	return $data;
    }
}
?>