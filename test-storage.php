<?php
include ("autoloader.php");

$DS=new DataStorage\DataStorageStacked("config/configStacked.ini");

$actions=[
    ["Create new","Create","pop1","У попа была собака",true],
    ["Create new","Create","pop3","У попа была собака",false],
    ["Create over existing","Create","pop1","У попа была собака1",false],
    ["Read existing","Read","pop1",NULL,"У попа была собака"],
    ["Read non-existing","Read",NULL,"pop2",false],
    ["Update existing","Update","pop1","У попа была собака, он её любил",true],
    ["Update non-existing","Update","pop2","У попа была собака, он её любил",false],
    ["Delete existing","Delete","pop1",NULL,true],
    ["Delete non-existing","Delete","pop2",NULL,false]
    
];

foreach ($actions as $action) {
    $method=$action[1];
    if (!method_exists($DS,$method)) {
	echo "[$method] not exists in storage class\n";
	continue;
    }
    if (!is_null($action[3])) {
	$res=$DS->$method($action[2],$action[3]);
    } else {
	$res=$DS->$method($action[2]);
    }
    echo sprintf("\"%s\"\tresult [%s]: [%s:%s]\n",$action[0],$res==$action[4] ? "Expected":"Unexpected",$action[4],$res);
}
var_dump($DS);
?>