<?php


if ((!isset($_GET['service']) || $_GET['service'] == "") || ((!isset($_GET['username']) || $_GET['username'] == "") && $_GET['service'] == "Twitter") || ((!isset($_GET['number']) || $_GET['number'] == "") && $_GET['service'] == "Immatriculation")){
  echo '<!DOCTYPE html>
  <html lang="en">
  <head>
  	<title>AirPods FC</title>
  	<meta charset="UTF-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
  <!--===============================================================================================-->
  	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
  <!--===============================================================================================-->
  	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
  	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
  <!--===============================================================================================-->
  	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
  <!--===============================================================================================-->
  	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
  <!--===============================================================================================-->
  	<link rel="stylesheet" type="text/css" href="css/util.css">
  	<link rel="stylesheet" type="text/css" href="css/main.css">
  <!--===============================================================================================-->
  </head>
  <body>


  <div class="container-contact100">
  <div class="wrap-contact100">
  <span class="contact100-form-title">
    Fermeture actée du AirPods FC.
  </span>
  C\'est avec une grande tristesse que nous vous informons que la fermeture officielle du site web du AirPods FC aura lieu le 1er janvier 2020. Le site n\'aura pas de successeur ni d\'alternative. Vous retrouverez la communauté du AirPods FC sur Twitter: <a href="https://www.twitter.com/AirPodsFC">@AirPodsFC</a>. Conformément à nos engagements, convictions et notre vision d\'un web plus libre, nous n\'avons pas vendu vos données et n\'avons recolleté que les données que vous avez vous-même saisi sur ce site Internet. La date de suppression définitive de toutes les données du site Internet <a href="https://www.airpodsfc.fr">airpodsfc.fr</a> est prévue d\'ici le 31 janvier 2020. À compter de cette date, plus aucune demande de droit d\'accès, portabilité ou suppression ne pourra être traitée, car vos données auront été supprimées. Nous remercions la communauté du AirPods FC de nous avoir fait confiance et espérons vous revoir bientôt.  Si toutefois vous souhaitez exercer un droit d\'accès, de portabilité ou de suppression anticipée (à envoyer avant le 1er janvier 2020 00h01 CET), vous pouvez nous contacter à l\'adresse email <a href=mailto:contact@groupe-minaste.org>contact@groupe-minaste.org</a>. En attendant la fermeture du site, vous pouvez continuer à l\'utiliser en scrollant vers le bas. Merci d\'avoir suivi cette aventure avec nous. - L\'équipe du Groupe MINASTE et du AirPods FC.<br><a href="https://www.groupe-minaste.org"><img src="https://www.groupe-minaste.org/img/logo-bigger.png" width="150" height="150"></a><a href="https://www.extopy.com"><img src="https://www.extopy.com/images/logo.png" width="100" height="100"></a><a href="https://www.twitter.com/AirPodsFC"><img src=/images/logo.png width="120" height="120"></a>
  </div>
  </div>

  	<div class="container-contact100">
  		<div class="wrap-contact100">
  			<form class="contact100-form validate-form">
  				<span class="contact100-form-title">
  					AirPods FC
  				</span>

  				<div class="wrap-input100 input">
  					<span class="label-input100">Entrez le nom d\'utilisateur Twitter à vérifier</span>
  					<input class="input100" type="text" name="username" placeholder="Nom d\'utilisateur Twitter">
  					<span class="focus-input100"></span>
  				</div>

          <div>
            <p><center><font color="grey">---- OU ----</font></center></p>
            <br>
          </div>

  				<div class="wrap-input100 input">
  					<span class="label-input100">Entrez le numéro d\'immatriculation à vérifier</span>
  					<input class="input100" type="text" name="number" placeholder="Numéro d\'immatriculation de licence">
  					<span class="focus-input100"></span>
  				</div>


  				<div class="wrap-input100 input100-select">
  					<span class="label-input100">Rechercher avec</span>
  					<div>
  						<select class="selection-2" name="service">
  							<option>Twitter</option>
  							<option>Immatriculation</option>
  						</select>
  					</div>
  					<span class="focus-input100"></span>
  				</div>

  				<div class="container-contact100-form-btn">
  					<div class="wrap-contact100-form-btn">
  						<div class="contact100-form-bgbtn"></div>
  						<button class="contact100-form-btn">
  							<span>
  								Rechercher la licence
  								<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
  							</span>
  						</button>
  					</div>
  				</div>
  			</form>
        <br><h4><center><strong><font color="red">Enregistrement indisponible</font></strong></center></h4>
        <br><h4><center><a href=rules.php>Réglement du site et des licences</a></center></h4>
  		</div>
  	</div>

    <footer>
      <p><center>Plateforme réalisée par <a href="https://www.plugn.fr">Michaël Nass</a> en collaboration avec le AirPods FC - Hébergé bénévolement par le <a href="https://www.groupe-minaste.org">Groupe MINASTE</a> - <a href=/mentions-legales.html>Mentions légales</a></center></p>
      <p><center>AirPods est une marque déposée d\'Apple Inc. Cette plateforme est à but ludique et non-lucratif, et n\'est pas affiliée à Apple Inc.<center></p>
    </footer>

  	<div id="dropDownSelect1"></div>

  <!--===============================================================================================-->
  	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  	<script src="vendor/animsition/js/animsition.min.js"></script>
  <!--===============================================================================================-->
  	<script src="vendor/bootstrap/js/popper.js"></script>
  	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  	<script src="vendor/select2/select2.min.js"></script>
  	<script>
  		$(".selection-2").select2({
  			minimumResultsForSearch: 20,
  			dropdownParent: $(\'#dropDownSelect1\')
  		});
  	</script>
  <!--===============================================================================================-->
  	<script src="vendor/daterangepicker/moment.min.js"></script>
  	<script src="vendor/daterangepicker/daterangepicker.js"></script>
  <!--===============================================================================================-->
  	<script src="vendor/countdowntime/countdowntime.js"></script>
  <!--===============================================================================================-->
  	<script src="js/main.js"></script>

  	<!-- Global site tag (gtag.js) - Google Analytics -->


  </body>
  </html>
 ';
}

else{
  echo '<!DOCTYPE html>
  <html lang="en">
  <head>
  	<title>AirPods FC</title>
  	<meta charset="UTF-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
  <!--===============================================================================================-->
  	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
  <!--===============================================================================================-->
  	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
  	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
  <!--===============================================================================================-->
  	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
  <!--===============================================================================================-->
  	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
  <!--===============================================================================================-->
  	<link rel="stylesheet" type="text/css" href="css/util.css">
  	<link rel="stylesheet" type="text/css" href="css/main.css">
  <!--===============================================================================================-->
  </head>
  <body>';
  require_once dirname(__FILE__).'/../../../config/config.php';
  try {
    $bdd = new PDO('mysql:host='.getDBHost().';dbname=AirPodsFC', getDBUsername(), getDBPassword(), array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"));
  } catch(Exception $e) {
    exit ('Erreur while connecting to database: '.$e->getMessage());
  }
  // Démarrage de la session
  session_start();

echo '
  	<div class="container-contact100">
  		<div class="wrap-contact100">
  			<h1>Votre licence AirPods FC authentique</h1>';

        if ($_GET['service'] == "Twitter") {
          if(isset($_GET['username']) && $_GET['username'] != ""){
            $req = $bdd->prepare('SELECT * FROM licences WHERE user = ?;');
            $req->execute(array(str_replace("@", "", $_GET['username'])));
            $test = $req->fetch();

            $date = date('Y-m-d H:i:s');

            $compareddate = new DateTime($test["purchase"]);
            $now = new DateTime();

            if (isset($test['id'])){
            echo '<br><p>Titulaire de la licence :</p> <h3>@' . $test['user'] . '</h3>';
            echo '<br>IMMATRICULATION DE LA LICENCE : <h4>' . ltrim($test['number'], '0') . '</h4>';
            echo '<br><p>Titulaire depuis ' . $compareddate->diff($now)->format("%y ans, %m mois, %d jours, %h heures et %i minutes</p>");
            echo '<br><a href="sign.php?id=' . $test['user'] . '"><img src="sign.php?id=' . $test['user'] . '" height="50%" width="100%" style="border-radius: 7px; overflow:hidden;"></a>';
          }
          else {
            // echo '<br><h2>LICENCE NON TROUVÉE !</h2>';
            echo '<br><p>Aucune licence n\'a été délivrée par l\'équipe de validation du AirPods FC à @' . str_replace("@", "", $_GET['username']) . '.</p>';
            echo '<br><a href="sign.php?id=' . str_replace("@", "", $_GET['username']) . '"><img src="sign.php?id=' . str_replace("@", "", $_GET['username']) . '" height="50%" width="100%" style="border-radius: 7px; overflow:hidden;"></a>
            <br><br>
            <br><h4><center><strong><font color="red">Enregistrement indisponible</font></strong></center></h4>';
          }
echo '<br><p><a href="index.php">< retour</a></p> ';
          }
        }

        else if ($_GET['service'] == "Immatriculation") {
          if(isset($_GET['number']) && $_GET['number'] != ""){
            $req = $bdd->prepare('SELECT * FROM licences WHERE number = ?;');
            $req->execute(array($_GET['number']));
            $test = $req->fetch();

            $date = date('Y-m-d H:i:s');

            $compareddate = new DateTime($test["purchase"]);
            $now = new DateTime();
            if (isset($test['id'])){
            echo '<br><p>Titulaire de la licence :</p> <h3>@' . $test['user'] . '</h3>';
            echo '<br>IMMATRICULATION DE LA LICENCE : <h4>' . ltrim($test['number'], '0') . '</h4>';
            echo '<br><p>Titulaire depuis ' . $compareddate->diff($now)->format("%y ans, %m mois, %d jours, %h heures et %i minutes</p>");
            echo '<br><a href="sign.php?id=' . $test['user'] . '"><img src="sign.php?id=' . $test['user'] . '" height="50%" width="100%" style="border-radius: 7px; overflow:hidden;"></a>';
          }
          else {
            // echo '<br><h2>LICENCE NON TROUVÉE !</h2>';
            echo '<br><p>Aucune licence n\'a été délivrée par l\'équipe de validation du AirPods FC à @' . str_replace("@", "", $_GET['username']) . '.</p>';
            echo '<br><a href="sign.php?id=' . str_replace("@", "", $_GET['username']) . '"><img src="sign.php?id=' . str_replace("@", "", $_GET['username']) . '" height="50%" width="100%" style="border-radius: 7px; overflow:hidden;"></a>';
          }
            echo '<br><br><p><a href="index.php">< retour</a></p> ';
        } else { echo 'error in licence transfer.';}}

        echo '

  		</div>
  	</div>
    <footer>
      <p><center>Plateforme réalisée par <a href="https://www.plugn.fr">Michaël Nass</a> en collaboration avec le AirPods FC - Hébergé bénévolement par le <a href="https://www.groupe-minaste.org">Groupe MINASTE</a> - <a href=/mentions-legales.html>Mentions légales</a></center></p>
      <p><center>AirPods est une marque déposée d\'Apple Inc. Cette plateforme est à but ludique et non-lucratif, et n\'est pas affiliée à Apple Inc.<center></p>
    </footer>



  	<div id="dropDownSelect1"></div>

  <!--===============================================================================================-->
  	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  	<script src="vendor/animsition/js/animsition.min.js"></script>
  <!--===============================================================================================-->
  	<script src="vendor/bootstrap/js/popper.js"></script>
  	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  	<script src="vendor/select2/select2.min.js"></script>
  	<script>
  		$(".selection-2").select2({
  			minimumResultsForSearch: 20,
  			dropdownParent: $(\'#dropDownSelect1\')
  		});
  	</script>
  <!--===============================================================================================-->
  	<script src="vendor/daterangepicker/moment.min.js"></script>
  	<script src="vendor/daterangepicker/daterangepicker.js"></script>
  <!--===============================================================================================-->
  	<script src="vendor/countdowntime/countdowntime.js"></script>
  <!--===============================================================================================-->
  	<script src="js/main.js"></script>

  	<!-- Global site tag (gtag.js) - Google Analytics -->


  </body>
  </html>
 ';
}

?>
