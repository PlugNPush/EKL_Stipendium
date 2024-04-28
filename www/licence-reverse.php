<?php
// Connexion à la base de données
require_once dirname(__FILE__).'/../../../config/config.php';
try {
  $bdd = new PDO('mysql:host='.getDBHost().';dbname=AirPodsFC', getDBUsername(), getDBPassword(), array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"));
} catch(Exception $e) {
  exit ('Erreur while connecting to database: '.$e->getMessage());
}
// Démarrage de la session
session_start();

    // Zone de menu statique
echo '<h1><b><font size="15" face="verdana">AirPods FC </font></b></h1>';
echo '<p align="right"> <a href=/administration.php?view>Administration</a></p>';

if(isset($_POST['licence'])){
  $req = $bdd->prepare('SELECT * FROM licences WHERE number = ?;');
  $req->execute(array($_POST['licence']));
  $test = $req->fetch();

  $date = date('Y-m-d H:i:s');

  $compareddate = new DateTime($test["purchase"]);
  $now = new DateTime();
  
if (isset($test["id"])){
  echo '<h1><center>LICENCE AUTHENTIQUE AIRPODS FC</center></h1>';
  echo '<p>Titulaire de la licence : @' . $test['user'];
  echo '<br>Titulaire depuis ' . $compareddate->diff($now)->format("%y ans, %m mois, %d jours, %h heures et %i minutes");
  echo '<br> IMMATRUCULATION DE LA LICENCE : ' . ltrim($test['number'], '0');
  echo '<br> Statut de la licence : ' . $test['status'];
  $dd = $compareddate->diff($now)->format("%y");

  if ($test['status'] == "basic"){
    if ($dd < 1){
      echo '<br><h2>LICENCE AIRPODS FC GRISE DÉLIVRÉE</h2>';
    } else if ($dd < 2){
      echo '<br><h2>LICENCE AIRPODS FC BRONZE DÉLIVRÉE</h2>';
    }
   else if ($dd < 3){
    echo '<br><h2>LICENCE AIRPODS FC ARGENT DÉLIVRÉE</h2>';
  }
   else if ($dd < 4){
    echo '<br><h2>LICENCE AIRPODS FC OR DÉLIVRÉE</h2>';
  }
   else if ($dd >= 4){
    echo '<br><h2>LICENCE AIRPODS FC PLATINE DÉLIVRÉE</h2>';
  }}
  else if ($test['status'] == "vip"){
    echo '<br><h2>LICENCE AIRPODS FC VIP DÉLIVRÉE</h2>';
  }
  else if ($test['status'] == "red"){
    echo '<br><h2>LICENCE AIRPODS FC (RED) DÉLIVRÉE</h2>';
  }
  else if ($test['status'] == "banned"){
    echo '<br><h2>MEMBRE BANNI DU AIRPODS FC</h2>';
  }}
  else {
    echo '<br><h2>LICENCE NON TROUVÉE !</h2>';
    echo '<br><p>Aucune licence n\'a été délivrée par l\'équipe de validation du AirPods FC avec le numéro ' . ltrim($_POST['licence'], '0') . '.</p>';
  }




} else {
  echo'<br><br><center><form action="licence-reverse.php" method="post">
      <p>
      <input type="text" name="licence" placeholder="Numéro de licence" required="yes"/>
      <input type="submit" value="Vérifier la licence" />
      </p>
      </form></center>';
}
  function dateDifference($date_1, $date_2, $differenceFormat = '%a' )
  {
      //$datetime1 = date_create($date_1);
      //$datetime2 = date_create($date_1);

      $interval = date_diff($date_1, $date_2);

      return $interval->format($differenceFormat);

  }
?>
