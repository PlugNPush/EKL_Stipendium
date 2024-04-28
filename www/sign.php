<?php

require_once dirname(__FILE__).'/../../../config/config.php';
try {
  $bdd = new PDO('mysql:host='.getDBHost().';dbname=AirPodsFC', getDBUsername(), getDBPassword(), array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"));
} catch(Exception $e) {
  exit ('Erreur while connecting to database: '.$e->getMessage());
}

// Démarrage de la session
session_start();


if(!isset($_GET['id']) && $_GET['id'] == ""){
  //Set the Content Type
  header('Content-type: image/jpeg');

  // Create Image From Existing File
  $jpg_image = imagecreatefromjpeg('images/error.jpg');

  // Allocate A Color For The Text
  $white = imagecolorallocate($jpg_image, 255, 255, 255);

  // Set Path to Font File
  $font_path = 'images/arial.ttf';

  // Set Text to Be Printed On Image
  $text = "Licence non-signée. Sans immatriculation, une licence n'est pas valable.";

  // Print Text On Image
  imagettftext($jpg_image, 40, 0, 3060, 1560, $white, $font_path, $text);

  // Send Image to Browser
  imagejpeg($jpg_image);

  // Clear Memory
  imagedestroy($jpg_image);

} else {
  $req = $bdd->prepare('SELECT * FROM licences WHERE user = ?;');
  $req->execute(array($_GET['id']));
  $test = $req->fetch();

  $date = date('Y-m-d H:i:s');

  $compareddate = new DateTime($test["purchase"]);
  $now = new DateTime();

  if (isset($test['id'])){
  $dd = $compareddate->diff($now)->format("%y");
  if ($test['status'] == "basic"){
    if ($dd < 1){
      header('Content-type: image/jpeg');
      $jpg_image = imagecreatefromjpeg('images/basique_gris.jpg');
      $white = imagecolorallocate($jpg_image, 255, 255, 255);
      $font_path = 'images/arial.ttf';
      $text = "Licence AirPods FC grise. Propriétaire : @" . $test['user'] . " | Immatriculation de licence : " . $test['number'];

      $dimensions = imagettfbbox(40, 0, $font_path, $text);
      $textWidth = abs($dimensions[4] - $dimensions[0]);
      $x = imagesx($jpg_image) - $textWidth;

      imagettftext($jpg_image, 40, 0, $x - 40, 1560, $white, $font_path, $text);
      imagejpeg($jpg_image);
      imagedestroy($jpg_image);
    } else if ($dd < 2){
      header('Content-type: image/jpeg');
      $jpg_image = imagecreatefromjpeg('images/basique_bronze.jpg');
      $white = imagecolorallocate($jpg_image, 255, 255, 255);
      $font_path = 'images/arial.ttf';
      $text = "Licence AirPods FC bronze. Propriétaire : @" . $test['user'] . " | Immatriculation de licence : " . $test['number'];

      $dimensions = imagettfbbox(40, 0, $font_path, $text);
      $textWidth = abs($dimensions[4] - $dimensions[0]);
      $x = imagesx($jpg_image) - $textWidth;

      imagettftext($jpg_image, 40, 0, $x - 40, 1560, $white, $font_path, $text);
      imagejpeg($jpg_image);
      imagedestroy($jpg_image);
    }
   else if ($dd < 3){
     header('Content-type: image/jpeg');
     $jpg_image = imagecreatefromjpeg('images/basique_argent.jpg');
     $white = imagecolorallocate($jpg_image, 255, 255, 255);
     $font_path = 'images/arial.ttf';
     $text = "Licence AirPods FC argent. Propriétaire : @" . $test['user'] . " | Immatriculation de licence : " . $test['number'];

     $dimensions = imagettfbbox(40, 0, $font_path, $text);
     $textWidth = abs($dimensions[4] - $dimensions[0]);
     $x = imagesx($jpg_image) - $textWidth;

     imagettftext($jpg_image, 40, 0, $x - 40, 1560, $white, $font_path, $text);
     imagejpeg($jpg_image);
     imagedestroy($jpg_image);
  }
   else if ($dd < 4){
     header('Content-type: image/jpeg');
     $jpg_image = imagecreatefromjpeg('images/basique_or.jpg');
     $white = imagecolorallocate($jpg_image, 255, 255, 255);
     $font_path = 'images/arial.ttf';
     $text = "Licence AirPods FC or. Propriétaire : @" . $test['user'] . " | Immatriculation de licence : " . $test['number'];

     $dimensions = imagettfbbox(40, 0, $font_path, $text);
     $textWidth = abs($dimensions[4] - $dimensions[0]);
     $x = imagesx($jpg_image) - $textWidth;

     imagettftext($jpg_image, 40, 0, $x - 40, 1560, $white, $font_path, $text);
     imagejpeg($jpg_image);
     imagedestroy($jpg_image);
  }
   else if ($dd >= 4){
     header('Content-type: image/jpeg');
     $jpg_image = imagecreatefromjpeg('images/basique_platine.jpg');
     $white = imagecolorallocate($jpg_image, 255, 255, 255);
     $font_path = 'images/arial.ttf';
     $text = "Licence AirPods FC platine. Propriétaire : @" . $test['user'] . " | Immatriculation de licence : " . $test['number'];

     $dimensions = imagettfbbox(40, 0, $font_path, $text);
     $textWidth = abs($dimensions[4] - $dimensions[0]);
     $x = imagesx($jpg_image) - $textWidth;

     imagettftext($jpg_image, 40, 0, $x - 40, 1560, $white, $font_path, $text);
     imagejpeg($jpg_image);
     imagedestroy($jpg_image);
  }}
  else if ($test['status'] == "vip"){
    //echo '<br><h2>LICENCE AIRPODS FC VIP DÉLIVRÉE</h2>';
    header('Content-type: image/jpeg');
    $jpg_image = imagecreatefromjpeg('images/vip.jpg');
    $white = imagecolorallocate($jpg_image, 255, 255, 255);
    $font_path = 'images/arial.ttf';
    $text = "SÉRIE SPÉCIALE AirPods FC VIP. Propriétaire : @" . $test['user'] . " | Numéro d'immatriculation : " . $test['number'];

    $dimensions = imagettfbbox(40, 0, $font_path, $text);
    $textWidth = abs($dimensions[4] - $dimensions[0]);
    $x = imagesx($jpg_image) - $textWidth;

    imagettftext($jpg_image, 40, 0, $x - 40, 1560, $white, $font_path, $text);
    imagejpeg($jpg_image);
    imagedestroy($jpg_image);
  }
  else if ($test['status'] == "red"){
    header('Content-type: image/jpeg');
    $jpg_image = imagecreatefromjpeg('images/red.jpg');
    $white = imagecolorallocate($jpg_image, 255, 255, 255);
    $font_path = 'images/arial.ttf';
    $text = "SÉRIE SPÉCIALE AirPods FC (RED)™. Propriétaire : @" . $test['user'] . " | Numéro d'immatriculation : " . $test['number'];

    $dimensions = imagettfbbox(40, 0, $font_path, $text);
    $textWidth = abs($dimensions[4] - $dimensions[0]);
    $x = imagesx($jpg_image) - $textWidth;

    imagettftext($jpg_image, 40, 0, $x - 40, 1560, $white, $font_path, $text);
    imagejpeg($jpg_image);
    imagedestroy($jpg_image);
  }
  else if ($test['status'] == "banned"){
    header('Content-type: image/jpeg');
    $jpg_image = imagecreatefromjpeg('images/banned.jpg');
    $white = imagecolorallocate($jpg_image, 255, 255, 255);
    $font_path = 'images/arial.ttf';
    $text = "Membre banni : @" . $test['user'] . " | Numéro d'immatriculation : " . $test['number'];

    $dimensions = imagettfbbox(40, 0, $font_path, $text);
    $textWidth = abs($dimensions[4] - $dimensions[0]);
    $x = imagesx($jpg_image) - $textWidth;

    imagettftext($jpg_image, 40, 0, $x - 40, 1560, $white, $font_path, $text);
    imagejpeg($jpg_image);
    imagedestroy($jpg_image);
  }
  }
  else {
    header('Content-type: image/jpeg');

    // Create Image From Existing File
    $jpg_image = imagecreatefromjpeg('images/error.jpg');

    // Allocate A Color For The Text
    $white = imagecolorallocate($jpg_image, 255, 255, 255);

    // Set Path to Font File
    $font_path = 'images/arial.ttf';

    // Set Text to Be Printed On Image
    $text = "Licence non-signée. Sans immatriculation, une licence n'est pas valable.";

    // Print Text On Image
    imagettftext($jpg_image, 40, 0, 3060, 1560, $white, $font_path, $text);

    // Send Image to Browser
    imagejpeg($jpg_image);

    // Clear Memory
    imagedestroy($jpg_image);
  }





}

?>
