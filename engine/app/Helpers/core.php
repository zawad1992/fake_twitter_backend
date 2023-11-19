<?php
function pr($data = array())
{
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

function prd($data = array())
{
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	die;
}