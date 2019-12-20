<?php 
require_once '../../../core/init.php';

$db = DB::getInstance();
$orts = $db->query("SELECT * FROM `city` ORDER BY id ASC")->results();
$results['orts'] = $orts;
echo json_encode($results);
