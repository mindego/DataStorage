<?php
spl_autoload_register(function($class) {
    $SILENT=true;
    $PWD=__DIR__;
    $filename=$PWD.DIRECTORY_SEPARATOR."lib".DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR,explode("\\",$class)).".php";
    if (!$SILENT) {
	echo sprintf("Including %s from %s\n",$class,$filename);
	include_once($filename);
    } else {
        @include_once($filename);
    }
});
?>