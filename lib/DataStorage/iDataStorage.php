<?php
namespace DataStorage;
interface iDataStorage {
    public function __construct($configFile);
    public function Create($key,$data);
    public function Read($key);
    public function Update($key,$data);
    public function Delete($key);
}
?>