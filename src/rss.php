<?php
// TODO: Everything xD

require_once("_autoloader.php");

$conn = ConnectionFactory::getFactory()->getConnection();
$data = $conn->select("rss", "*");

echo $data;
