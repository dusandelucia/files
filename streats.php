<?php 
require_once '../../../core/init.php';

$db = DB::getInstance();
$districts = $db->query("SELECT * FROM district WHERE city_id = " . Input::get('ort_id'))->results();
$results['districts'] = $districts;
$results['streets'] = [];
if (Input::get('district_id') != '') {
  $streets = $db->query("SELECT * FROM streets WHERE district_id = " . Input::get('district_id'))->results();
  $results['streets'] = $streets;
}
echo json_encode($results);
?>