<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(
	"PARAMETERS" => array(
		"AJAX_MODE" => array(),
		"CACHE_TIME"  =>  array("DEFAULT"=>36000000),
        "PAGE_ELEMENTS" => array(
            "PARENTS" => "BASE",
            "NAME" => GetMessage("PAGE_ELEMENTS"),
            "TYPE" => "STRING",
            "DEFAULT" => "10"
        ),
	),
);