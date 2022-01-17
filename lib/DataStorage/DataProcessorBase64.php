<?php
namespace DataStorage;

class DataProcessorBase64 implements iDataProcessor{
    public function Encode($data) {
	return base64_encode($data);
    }
    public function Decode($data) {
	return base64_decode($data);
    }
}
?>