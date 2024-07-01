<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

require_once dirname(__FILE__) . '/../../config/config.php';
require_once dirname(__FILE__) . '/../../config/ekl_config.php';
try {
  $bdd = new PDO('mysql:host=' . getDBHost() . ';dbname=EKL_Stipendium', getDBUsername(), getDBPassword(), array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"));
} catch (Exception $e) {
  exit('Erreur while connecting to database: ' . $e->getMessage());
}
// Démarrage de la session
session_start();

echo '<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bewerbungsformular - Elsie Kühn-Leitz Stipendium</title>
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

</head>
<body>

  <div class="container-contact100">
    <div class="wrap-contact100">
      <h1>Ende der Bewerbungsfrist</h1>
      <p>Die Bewerbungsfrist für das Elsie Kühn-Leitz Stipendium 2024 ist abgelaufen. Wir bedanken uns bei allen Bewerberinnen und Bewerbern für Ihr Interesse und Ihre Bewerbungen. Die Bewerberinnen und Bewerber werden im Anschluss über das Ergebnis informiert.</p>
      <br><h4><a href="https://www.elsie-kuehn-leitz-stipendium.de">Zurück zur Startseite</a></h4>
    </div>
  </div>

  <footer>
    <p><center>Diese Website ist ehrenamtlich von der <a target="_blank" href="https://www.groupe-minaste.org">Groupe MINASTE</a> gehostet.</center></p>
    <p><center>Betreiber: Wetzlarer Kulturgemeinschaft e.V. – Postfach 2945, 35539 Wetzlar – <a target="_blank" href="https://wetzlarer-kulturgemeinschaft.de">www.wetzlarer-kulturgemeinschaft.de</a> – <a target="_blank" href="https://www.elsie-kuehn-leitz-stipendium.de/impressum/">Impressum</a> – <a target="_blank" href="https://www.elsie-kuehn-leitz-stipendium.de/privacy-policy/">Datenschutz</a><center></p>
  </footer>

  <script>

  function initiateUpload() {
    if (document.querySelector("form").checkValidity() === false) {
      const elements = document.querySelectorAll("input, select, textarea");
      for (let i = 0; i < elements.length; i++) {
        if (!elements[i].checkValidity()) {
          elements[i].reportValidity();
          elements[i].parentElement.classList.add("alert-validate");
        } else {
          elements[i].parentElement.classList.remove("alert-validate");
        }
      }
      document.querySelector("form").reportValidity();
      return;
    }
    removeEventListener("beforeunload", beforeUnloadHandler);
    document.querySelector("form").submit();
  }

  function abortConfirm() {
    if (confirm("Sind Sie sicher, dass Sie das Formular verlassen möchten? Ihre Daten werden nicht gespeichert.")) {
      removeEventListener("beforeunload", beforeUnloadHandler);
      window.location.href = "https://www.elsie-kuehn-leitz-stipendium.de";
    }
  }

  const beforeUnloadHandler = (event) => {
    // Recommended
    event.preventDefault();

    // Included for legacy support, e.g. Chrome/Edge < 119
    event.returnValue = true;
  };

  addEventListener("beforeunload", beforeUnloadHandler);
  </script>

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

  <script>
    flatpickr("#date", {
      enableTime: false,
      dateFormat: "Y-m-d",
      minDate: "today"});
  </script>

  <!-- Global site tag (gtag.js) - Google Analytics -->


</body>
</html>
';
