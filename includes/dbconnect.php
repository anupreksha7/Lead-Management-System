<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "stockmarket";

$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error());