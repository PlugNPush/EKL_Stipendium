<?php

if ((!isset($_GET['username']) || $_GET['username'] == "") && (!isset($_GET['proof']) || $_GET['proof'] == "")){
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
    <link rel="stylesheet" type="text/css" href="css/upload.css">
  <!--===============================================================================================-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
flatpickr("#date", {
});
  </script>

  </head>
  <body>

  	<div class="container-contact100">
  		<div class="wrap-contact100">
      <form class="contact100-form validate-form dropzone">
      <a href="https://www.airpodsfc.fr"><span class="contact100-form-title">
        AirPods FC
      </span></a>
      <div class="wrap-input100 validate-input">
        <span class="label-input100">Entrez le nom d\'utilisateur Twitter</span>
        <input class="input100" type="text" name="username" placeholder="Nom d\'utilisateur Twitter" required=yes>
        <span class="focus-input100"></span>
      </div>
      <div class="wrap-input100 input100-select">
        <span class="label-input100">Type de licence</span>
        <div>
          <select class="selection-2" name="number">
            <option>Basique</option>
            <option>VIP</option>
            <option>RED</option>
          </select>
        </div>
        <span class="focus-input100"></span>
      </div>
      <div class="wrap-input100 validate-input">
        <span class="label-input100">Preuve d\'achat : lien <a href="https://pasteboard.co"><font color="blue">pasteboard.co</font></a></span>
        <input class="input100" type="text" name="proof" placeholder="Lien pasteboard.co" required=yes>
        <span class="focus-input100"></span>
      </div>
      <div class="wrap-input100 validate-input">
        <span class="label-input100">Date d\'achat</span>
        <input class="input100" type="text" id="date" name="date" placeholder="AAAA-MM-JJ" required=yes>
        <span class="focus-input100"></span>
      </div>
      <div class="wrap-input100 input100-select">
        <span class="label-input100">Preuve d\'achat PDF - scan intelligent automatique (inactif)</span>
        <div class="upload-box">
          <input type="file" class="file-input" name="file1">
          <label for="file1"><span class="file-icon">&#128196;</span> Choose a file or drag it here</label>
        </div>
        <span class="focus-input100"></span>
      </div>
      <div class="wrap-input100 input100-select">
        <span class="label-input100">Preuve d\'achat PDF - scan intelligent automatique (inactif)</span>
        <div class="upload-box">
          <input type="file" class="file-input" name="file2">
          <label for="file2"><span class="file-icon">&#128196;</span> Choose a file or drag it here</label>
        </div>
        <span class="focus-input100"></span>
      </div>
      <div class="container-contact100-form-btn">
        <div class="wrap-contact100-form-btn">
          <div class="contact100-form-bgbtn"></div>
          <button class="contact100-form-btn">
            <span>
              Envoyer la demande
              <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
            </span>
          </button>
        </div>
      </div>
    </form>
        <br><h4><center><a href=index.php>Vérifier le statut de la licence</a></center></h4>
        <br><h4><center><a href=rules.php>Prenez connaissance du réglement</a></center></h4>
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
    <script src="js/upload.js"></script>

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
  $req = $bdd->prepare('INSERT INTO requests(user, date) VALUES(:user, :date)');
  //$req->execute(array($_GET['username']));
  $select = $bdd->prepare('SELECT * FROM requests WHERE user = ?');
  $select->execute(array(str_replace("@", "", $_GET['username'])));
  $test = $select->fetch();

  $sel = $bdd->prepare('SELECT * FROM licences WHERE user = ?');
  $sel->execute(array(str_replace("@", "", $_GET['username'])));
  $test2 = $sel->fetch();

  $att = $bdd->prepare('UPDATE requests SET attempts = ? WHERE user = ?');

  if (isset($test2['id'])){
    echo '<div class="container-contact100">
      <div class="wrap-contact100">
        <h1>Licence déjà enregistrée.</h1>
        <p>Votre licence a déjà été signée. Rendez-vous sur la page d\'accueil pour la consulter.</p>
        <br><h4><a href=index.php>Vérifier le statut de la licence</a></h4>';
  }

  else if (isset($test['id'])){
    if ($test['attempts'] >= 5 && $test['status'] != "banned"){
      $ban = $bdd->prepare('UPDATE requests SET status = ? WHERE user = ?');
      $ban->execute(array("banned", str_replace("@", "", $_GET['username'])));
    }

    if ($test['status'] == "banned"){
      echo '<div class="container-contact100">
        <div class="wrap-contact100">
          <h1>Utilisateur banni.</h1>
          <p>Suite à un nombre trop élevé de demandes, vous avez été banni du AirPods FC de manière définitive. Aucune licence ne vous sera attribuée.<br><b>On vous avait pourtant prévenu... Vous avez délibérément enfreint le réglement du AirPods FC en plus de générer du trafic inutile contraire au positionnement écologique d\'Apple. Vous ne méritez donc pas votre licence.</b></p>
          <br><h4><a href=index.php>Retour à l\'accueil</a></h4>';
    }
      else{
        $att->execute(array($test['attempts'] + 1, str_replace("@", "", $_GET['username'])));
        echo '<div class="container-contact100">
      		<div class="wrap-contact100">
      			<h1>Demande déjà en cours...</h1>
            <p>Une demande pour cet utilisateur est déjà en attente. Veuillez ne pas re-demander la signature de la licence. En cas de non-signature après 72h, contactez les administrateurs.<br><b>IMPORTANT : NE RAFRAICHISSEZ PAS CETTE PAGE. POUR CONSULTER VOTRE LICENCE, UTILISEZ LE LIEN CI-DESSOUS.</b></p>
            <br><h4><a href=index.php>Vérifier le statut de la licence</a></h4>';
      }

  } else {
echo '
  	<div class="container-contact100">
  		<div class="wrap-contact100">
  			<h1>Demande en attente de validation...</h1>
        <p>Veullez patienter jusqu\'à 72h qu\'un administrateur du AirPods FC signe votre licence. Afin de ne pas ralentir le processus de validation des autres licences, veuillez ne pas re-soumettre votre demande avant un délai de 72h. Merci.<br><b>IMPORTANT : NE RAFRAICHISSEZ PAS CETTE PAGE. POUR CONSULTER VOTRE LICENCE, UTILISEZ LE LIEN CI-DESSOUS.</b></p>
        <br><h4><a href=index.php>Vérifier le statut de la licence</a></h4>';
$date = date('Y-m-d H:i:s');
$req->execute(array(
'user' => str_replace("@", "", $_GET['username']),
'date' => $date
));

        $to  = 'fcairpods@gmail.com'; // notez la virgule

     // Sujet
     $subject = 'Demande de licence AirPods FC';

     $user = str_replace("@", "", $_GET['username']);
     $type = 'undefined';
     if (strcasecmp($_GET['number'], 'Basique') == 0) {
       $type = 'basic';
     }
     else if (strcasecmp($_GET['number'], 'VIP') == 0) {
       $type = 'vip';
     }
     else if (strcasecmp($_GET['number'], 'RED') == 0){
       $type = 'red';
     }

     // message




       if ($type != 'undefined' && $_GET['date'] != ''){
         $message = '
         <html>
          <body>
           <h1>Une demande d\'Immatriculation de licence est en attente.</h1>
           <p>Nom d\'utilisateur Twitter:</p>
           <h4>@' . $user . '</h4>
           <br>
           <p>Type de licence demandee:</p>
           <h4>' . $type . '</h4>
           <p>Preuve d\'achat</p><br>
           <img src=' . $_GET['proof'] . '><br><p>' . $_GET['proof'] . '</p>
           <p>Date d\'achat indiquee:</p>
           <h4>' . $_GET['date'] . '</h4>
         <h3><a href="https://admin.airpodsfc.fr/pages/forms/fastsign.php?username2C=' . $user . '&type=' . $type . '&date=' . $_GET['date'] . '">Valider avec FASTSIGN</a></h3>
         <h3><a href="https://admin.airpodsfc.fr/pages/forms/create.php">Si une erreur est presente, validez manuellement la licence ici</a></h3>
         <h4>ALPHA - RAPPORT D\'ANALYSE AUTOMATIQUE PDF</h4>
         <p>' . $_GET['filepond'] . '</p>
        </body>
       </html>
       ';
     } else {
       $message = '
       <html>
        <body>
        <h1>Une demande d\'Immatriculation de licence est en attente.</h1>
        <p>Nom d\'utilisateur Twitter:</p>
        <h4>' . $_GET['username'] . '</h4>
        <br>
        <p>Type de licence demandee:</p>
        <h4>' . $_GET['number'] . '</h4>
        <p>Preuve d\'achat</p><br>
         <img src=' . $_GET['proof'] . '><br><p>' . $_GET['proof'] . '</p>
         <p>Date d\'achat indiquee:</p>
         <h4>' . $_GET['date'] . '</h4>
       <h3><a href="https://admin.airpodsfc.fr/pages/forms/create.php">FASTSIGN indisponible, validez manuellement la licence</a></h3>
       <h2>ALPHA - RAPPORT D\'ANALYSE AUTOMATIQUE PDF</h2>
       <p>' . $_GET['filepond'] . '</p>
      </body>
     </html>
     ';
     }


     // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
     $headers[] = 'MIME-Version: 1.0';
     $headers[] = 'Content-type: text/html; charset=iso-8859-1';

     // En-têtes additionnels
     $headers[] = 'To: AirPods FC<fcairpods@gmail.com>';
     $headers[] = 'From: Systeme AirPods FC <noreply@airpodsfc.fr>';

     // Envoi
     mail($to, $subject, $message, implode("\r\n", $headers));
}
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
