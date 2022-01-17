<?php
namespace DataStorage;

class DataProcessorGzip implements iDataProcessor{
    public function Encode($data) {
	return gzencode($data);
    }
    public function Decode($data) {
	return gzdecode($data);
    }
}
?>