<?php
include 'admin-includes/admin-header.php';
if (!$admin->isLoggedIn()) {
  Redirect::to('admin-login.php');
}
if (Input::exists('post') || Input::exists('get')) {
  $rides = new Rides();
  $rides->setStatus(Input::get('ride_id'), 'fresh-assigned');
  $rides->db()->update('rides', Input::get('ride_id'), array(
    'drivers_id' => Input::get('drivers'),
    'admins_id' => Input::get('admin')
  ));
  $driver = $rides->db()->get('drivers', array(
    'id', '=',
    Input::get('drivers')
  ))->first()->email;
  $rideId = Input::get('ride_id');
  $ride = $rides->db()->query("SELECT rides.name, rides.mobile, rides.email, rides.time, rides.from_to, rides.flight_number, rides.number_of_people, rides.suitcases, rides.child_seats, rides.comment, rides.street_number, rides.distance, rides.price, district.name AS disName, streets.name AS strName FROM rides JOIN district ON rides.district_id = district.id JOIN streets ON rides.streets_id = streets.id WHERE rides.id = $rideId")->first();
$token = Token::generate();

  $email_to = $driver;
  $email_subject = "Neue Fahrt";

  $fromTo = $ride->from_to;
  $name = $ride->name;
  $mobile = $ride->mobile;
  $email = $ride->email;
  $date = $ride->time;
  $address = $ride->disName . ', ' . $ride->strName . ', ' . $ride->street_number;
  $numOffPassengers = $ride->number_of_people;
  $suitcases = $ride->suitcases;
  $childSeats = $ride->child_seats;
  $comment = $ride->comment;
  $distance = $ride->distance;
  $price = $ride->price;

  $email_message = '<html>';
  $email_message .= '<body>';
  $email_message .= '<head>';
  $email_message .= '<title>Neue Fahrt</title>';
  $email_message .= '</head>';
  $email_message .= '<h1>Neue Fahrt</h1>';
  $email_message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
  $email_message .= "<tr><td><strong>Name:</strong> </td><td><span style= \"color:red; font-weight:bold;\">" . strip_tags($name) . "</span></td></tr>";
  $email_message .= "<tr><td><strong> Telefon:</strong> </td><td>" . strip_tags($mobile) . "</td></tr>";
  $email_message .= "<tr><td><strong> Email:</strong> </td><td>" . strip_tags($email) . "</td></tr>";
  $email_message .= "<tr><td><strong> Datum und Uhrzeit:</strong> </td><td>" . strip_tags($date) . "</td></tr>";
  $email_message .= "<tr><td><strong> Vom Adresse:</strong> </td><td>" . strip_tags($fromTo) . "</td></tr>";
  $email_message .= "<tr><td><strong> Zum Addresse:</strong> </td><td>" . strip_tags($address) . "</td></tr>";
  $email_message .= "<tr><td><strong> Personenzahl:</strong> </td><td>" . strip_tags($numOffPassengers) . "</td></tr>";
  $email_message .= "<tr><td><strong> Anzahl der Koffer:</strong> </td><td>" . strip_tags($suitcases) . "</td></tr>";
  $email_message .= "<tr><td><strong> Kindersitz:</strong> </td><td>" . strip_tags($childSeats) . "</td></tr>";
  $email_message .= "<tr><td><strong> Entfernung:</strong> </td><td>" . strip_tags($distance) . "</td></tr>";
  $email_message .= "<tr><td><strong> Preis:</strong> </td><td>" . strip_tags($price) . "</td></tr>";
  $email_message .= "</table>";
  $email_message .= "<a style='background:green; color:white; padding:10px; font-size:26px; font-weight:bold; border-radius:3px; text-align:center; display:block; margin-top:20px; width:350px;' href='https://taxiflughafenat.com/source/driver/ajax/accept-decline-ride.php?status=new-accepted&id=".$rideId."&token=".$token." '>Bestätigung</a>";
  $email_message .= "<a style='background:red; color:white; padding:10px; font-size:26px; font-weight:bold; border-radius:3px; text-align:center; display:block; margin-top:20px; width:350px;' href='https://taxiflughafenat.com/source/driver/ajax/accept-decline-ride.php?status=new-declined&id=".$rideId."&token=".$token." '>Stornieren</a>";
  $email_message .= "<a style='background:blue; color:white; padding:10px; font-size:26px; font-weight:bold; border-radius:3px; text-align:center; display:block; margin-top:40px; width:350px;' href='https://taxiflughafenat.com/source/driver/driver-login.php'>Gehe zu App:</a>";
  $email_message .= '</body>';
  $email_message .= '</html>';


  $headers = "From: office@taxiflughafenat.com \r\n";
  $headers .= "Reply-To: office@taxiflughafenat.com \r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

  mail($email_to, $email_subject, $email_message, $headers);
  $rides->db()->query("INSERT INTO ad_tokens (ride_id, token) VALUES(".$rideId.", '".$token."')");
}
