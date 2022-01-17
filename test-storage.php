<?php
include ("autoloader.php");

$DS=new DataStorage\DataStorageStacked("config/configStacked.ini");

var_dump($DS->Create("pop1","У попа была собака"));
var_dump($DS->Create("pop1","У попа была собака1"));
var_dump($DS->Read("pop1"));
var_dump($DS->Read("pop2"));
var_dump($DS->Update("pop1","У попа была собака, он её любил"));
var_dump($DS->Update("pop2","У попа была собака, он её любил"));
//var_dump($DS->Delete("pop1"));
var_dump($DS->Delete("pop2"));

var_dump($DS);
?>