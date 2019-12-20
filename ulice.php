<?php 
require_once '../../../core/init.php';

$db = DB::getInstance();
$plz = $db->query("SELECT * FROM district WHERE city_id = " . Input::get('ort_id'))->results();
$results['plz'] = $plz;
$results['streets'] = [];
if (Input::get('plz_id') != '') {
  $streets = $db->query("SELECT * FROM streets WHERE district_id = " . Input::get('plz_id'))->results();
  $results['streets'] = $streets;
}
echo json_encode($results);
?>