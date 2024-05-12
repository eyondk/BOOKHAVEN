<?php

function show($message)
{
    echo "<pre>";
    print_r($message);
    echo "</pre>";
}

function esc($str)
{
	return htmlspecialchars($str);
}


function redirect($path)
{
	header("Location: " . ROOT."/".$path);
	die;
}