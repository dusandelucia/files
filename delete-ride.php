<?php 
require_once '../../../core/init.php';
$admin = new Admin();
if (!$admin->isLoggedIn()) {
    Redirect::to('admin-login.php');
}
if (Input::exists('post')) {
    $rides = new Rides();
    switch (Input::get('type')) {
        case 'delete':
            $rides->deleteRide(Input::get('id'));
            break;
        case 'trash':
            $rides->trashRide(Input::get('id'));
            break;
        case 'restore':
            $rides->restoreRide(Input::get('id'));
            break;
    }
    $results['token'] = Token::generate();
    echo json_encode($results);
}
?>