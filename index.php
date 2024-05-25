<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

require_once dirname(__FILE__).'/../../config/config.php';
require_once dirname(__FILE__).'/../../config/ekl_config.php';
  try {
    $bdd = new PDO('mysql:host='.getDBHost().';dbname=EKL_Stipendium', getDBUsername(), getDBPassword(), array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"));
  } catch(Exception $e) {
    exit ('Erreur while connecting to database: '.$e->getMessage());
  }
  // Démarrage de la session
  session_start();

if (!isset($_POST['email']) || !isset($_POST['lastname']) || !isset($_POST['firstname']) || !isset($_POST["gender"]) || !isset($_POST["age"]) || !isset($_POST["citizenship"]) || !isset($_POST["instrument"]) || !isset($_POST["school"]) || !isset($_POST["edu_level"]) || !isset($_POST["video"]) || !isset($_FILES["file_cover_letter"]) || !isset($_FILES["file_resume"]) || !isset($_FILES["file_recommendations"]) || !isset($_FILES["file_program"])) {
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
      <form class="contact100-form validate-form" action="/" method="post" enctype="multipart/form-data">
      <span class="contact100-form-title">
        Elsie Kühn-Leitz Stipendium Bewerbungs&shy;formular
      </span>

      <!-- E-Mail-Adresse -->
      <div class="wrap-input100 validate-input">
        <span class="label-input100">Bitte geben Sie Ihre E-Mail-Adresse ein</span>
        <input class="input100" type="email" name="email" placeholder="E-Mail-Adresse" required>
        <span class="focus-input100"></span>
      </div>

      <!-- Name -->
      <div class="wrap-input100 validate-input">
        <span class="label-input100">Bitte geben Sie Ihren Namen ein</span>
        <input class="input100" type="text" name="lastname" placeholder="Name" required>
        <span class="focus-input100"></span>
      </div>

      <!-- Vorname -->
      <div class="wrap-input100 validate-input">
        <span class="label-input100">Bitte geben Sie Ihren Vornamen ein</span>
        <input class="input100" type="text" name="firstname" placeholder="Vorname" required>
        <span class="focus-input100"></span>
      </div>

      <!-- Geschlecht -->
      <div class="wrap-input100 input100-select">
        <span class="label-input100">Geschlecht</span>
        <div>
          <select class="selection-2" name="gender" required>
            <option hidden disabled selected value> -- Bitte auswählen -- </option>';

            $query = $bdd->query('SELECT * FROM genders');
            while ($data = $query->fetch()){
              echo '<option value="' . $data['id'] . '">' . $data['gender_name'] . '</option>';
            }

            echo '
          </select>
        </div>
        <span class="focus-input100"></span>
      </div>

      <!-- Alter -->
      <div class="wrap-input100 input100-select">
        <span class="label-input100">Alter (zum Zeitpunkt der Bewerbung)</span>
        <div>
          <select class="selection-2" name="age" required>
            <option hidden disabled selected value> -- Bitte auswählen -- </option>';

            $query = $bdd->query('SELECT * FROM ages');
            while ($data = $query->fetch()){
              echo '<option value="' . $data['id'] . '">' . $data['age'] . '</option>';
            }

            echo '
          </select>
        </div>
        <span class="focus-input100"></span>
      </div>
      <div class="hinweis">Hinweis: Nur in dieser Altersklasse wird das Stipendium vergeben.</div>

      <!-- Staatsbürgerschaft -->
      <div class="wrap-input100 input100-select">
        <span class="label-input100">Staatsbürgerschaft</span>
        <div>
          <select class="selection-2" name="citizenship" required>
            <option hidden disabled selected value> -- Bitte auswählen -- </option>';

            $query = $bdd->query('SELECT * FROM countries');
            while ($data = $query->fetch()){
              echo '<option value="' . $data['id'] . '">' . $data['country_name'] . '</option>';
            }

            echo '
          </select>
        </div>
        <span class="focus-input100"></span>
      </div>

      <!-- Staatsbürgerschaft 2 -->
      <div class="wrap-input100 input100-select">
        <span class="label-input100">Zweite Staatsbürgerschaft (optional)</span>
        <div>
          <select class="selection-2" name="citizenship2">
            <option selected value>Ohne zweite Staatsbürgerschaft</option>';

            $query = $bdd->query('SELECT * FROM countries');
            while ($data = $query->fetch()){
              echo '<option value="' . $data['id'] . '">' . $data['country_name'] . '</option>';
            }

            echo '
          </select>
        </div>
        <span class="focus-input100"></span>
      </div>

      <!-- Instrument -->
      <div class="wrap-input100 input100-select">
        <span class="label-input100">Instrument</span>
        <div>
          <select class="selection-2" name="instrument" required>
            <option hidden disabled selected value> -- Bitte auswählen -- </option>';

            $query = $bdd->query('SELECT * FROM instruments');
            while ($data = $query->fetch()){
              echo '<option value="' . $data['id'] . '">' . $data['instrument_name'] . '</option>';
            }

            echo '
          </select>
        </div>
        <span class="focus-input100"></span>
      </div>

      <!-- Musikhochschule -->
      <div class="wrap-input100 validate-input">
        <span class="label-input100">Bitte geben Sie Ihre Musikhochschule ein</span>
        <input class="input100" type="text" name="school" placeholder="Musikhochschule" required>
        <span class="focus-input100"></span>
      </div>

      <!-- Gegenwärtiger Studiengang -->
      <div class="wrap-input100 input100-select">
        <span class="label-input100">Gegenwärtiger Studiengang</span>
        <div>
          <select class="selection-2" name="edu_level" required>
            <option hidden disabled selected value> -- Bitte auswählen -- </option>';

            $query = $bdd->query('SELECT * FROM edu_levels');
            while ($data = $query->fetch()){
              echo '<option value="' . $data['id'] . '">' . $data['edu_level'] . '</option>';
            }

            echo '
          </select>
        </div>
        <span class="focus-input100"></span>
      </div>

      <!-- Bewerbungsschreiben -->
      <div class="">
        <span class="label-input100">Bewerbungsschreiben</span>
        <div class="upload-box">
          <input type="file" class="file-input" name="file_cover_letter" required accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf">
          <label for="file_cover_letter"><span class="file-icon"><i class="fa fa-upload"></i></span> Wählen Sie eine Datei aus oder ziehen Sie sie hierher</label>
        </div>
        <span class="focus-input100"></span>
      </div>
      <div class="hinweis">Hinweis: Nur PDF- oder Word-Dokumente sind erlaubt.</div>

      <!-- Lebenslauf -->
      <div class="">
        <span class="label-input100">Lebenslauf</span>
        <div class="upload-box">
          <input type="file" class="file-input" name="file_resume" required accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf">
          <label for="file_resume"><span class="file-icon"><i class="fa fa-upload"></i></span> Wählen Sie eine Datei aus oder ziehen Sie sie hierher</label>
        </div>
        <span class="focus-input100"></span>
      </div>
      <div class="hinweis">Hinweis: Nur PDF- oder Word-Dokumente sind erlaubt.</div>

      <!-- Empfehlungsschreiben -->
      <div class="">
        <span class="label-input100">Empfehlungsschreiben</span>
        <div class="upload-box">
          <input type="file" class="file-input" name="file_recommendations" required accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf">
          <label for="file_recommendations"><span class="file-icon"><i class="fa fa-upload"></i></span> Wählen Sie eine Datei aus oder ziehen Sie sie hierher</label>
        </div>
        <span class="focus-input100"></span>
      </div>
      <div class="hinweis">Hinweis: Nur PDF- oder Word-Dokumente sind erlaubt.</div>

      <!-- Programm im Falle eines Vorspiels in Wetzlar -->
      <div class="">
        <span class="label-input100">Programm im Falle eines Vorspiels in Wetzlar</span>
        <div class="upload-box">
          <input type="file" class="file-input" name="file_program" required accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf">
          <label for="file_program"><span class="file-icon"><i class="fa fa-upload"></i></span> Wählen Sie eine Datei aus oder ziehen Sie sie hierher</label>
        </div>
        <span class="focus-input100"></span>
      </div>
      <div class="hinweis">Hinweis: Nur PDF- oder Word-Dokumente sind erlaubt.</div>

      <!-- Vorstellungsfilm -->
      <div class="wrap-input100 validate-input">
        <span class="label-input100">Vorstellungsfilm: <a href="https://www.youtube.com">YouTube</a>, <a href="https://www.vimeo.com">Vimeo</a> oder ähnliches</span>
        <input class="input100" type="url" name="video" placeholder="Link zu YouTube, Vimeo oder ähnliches" required>
        <span class="focus-input100"></span>
      </div>
      <div class="hinweis">Hinweis: Der Link muss öffentlich zugänglich sein und direkt zum Online-Video führen (keine Downloads oder Passwörter)</div>

      <!-- Kommentar -->
      <div class="wrap-input100 validate-input">
        <span class="label-input100">Kommentar</span>
        <textarea class="input100" name="comments" placeholder="Kommentar"></textarea>
        <span class="focus-input100"></span>
      </div>

      <!-- Formular absenden -->
      <div class="container-contact100-form-btn">
        <div class="wrap-contact100-form-btn">
          <div class="contact100-form-bgbtn"></div>
          <button class="contact100-form-btn">
            <span>
              Jetzt bewerben!
              <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
            </span>
          </button>
        </div>
      </div>
    </form>
        <br><h4><center><span onclick="abortConfirm()">Formular verlassen</span></center></h4>
  		</div>
  	</div>

    <footer>
      <p><center>Diese Website ist ehrenamtlich von der <a href="https://www.groupe-minaste.org">Groupe MINASTE</a> gehostet.</center></p>
      <p><center>Betreiber: Wetzlarer Kulturgemeinschaft e.V. – Postfach 2945, 35539 Wetzlar – <a href="https://wetzlarer-kulturgemeinschaft.de">www.wetzlarer-kulturgemeinschaft.de</a> – <a href="https://www.elsie-kuehn-leitz-stipendium.de/impressum/">Impressum</a> – <a href="https://www.elsie-kuehn-leitz-stipendium.de/privacy-policy/">Datenschutz</a><center></p>
    </footer>

  	<div id="dropDownSelect1"></div>

    <script>
    function abortConfirm() {
      if (confirm("Sind Sie sicher, dass Sie das Formular verlassen möchten? Ihre Daten werden nicht gespeichert.")) {
        window.location.href = "https://www.elsie-kuehn-leitz-stipendium.de";
      }
    }

    addEventListener("beforeunload", function (event) {
      event.preventDefault();
      event.returnValue = true;
    });
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
}

else {
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
  <!--===============================================================================================-->
  </head>
  <body>';

  $select = $bdd->prepare('SELECT * FROM candidates WHERE email = ?');
  $select->execute(array($_POST['email']));
  $test = $select->fetch();

  if (isset($test['id'])){
    echo '<div class="container-contact100">
      <div class="wrap-contact100">
        <h1>Sie haben bereits eine Bewerbung eingereicht.</h1>
        <p>Bitte warten Sie auf die Antwort des Stipendiums und reichen Sie keine weiteren Bewerbungen ein. Vielen Dank.</p>
        <br><h4><a href=index.php>Zurück zur Startseite</a></h4>';
  } else {
echo '
  	<div class="container-contact100">
  		<div class="wrap-contact100">
  			<h1>Ihre Bewerbung wurde erfolgreich eingereicht.</h1>
        <p>Viel Glück bei Ihrer Bewerbung!</p>
        <br><h4><a href=index.php>Zurück zur Startseite</a></h4>';

        $query = $bdd->prepare('INSERT INTO candidates(email, name, surname, gender, age, citizenship, citizenship2, instrument, edu_university, edu_level, video_url, cover_letter_url, resume_url, recommendations_url, program_url, comments) VALUES(:email, :name, :surname, :gender, :age, :citizenship, :citizenship2, :instrument, :edu_university, :edu_level, :video_url, :cover_letter_url, :resume_url, :recommendations_url, :program_url, :comments)');

        $cover_letter = 'https://uploads.elsie-kuehn-leitz-stipendium.de/' . md5($_POST['email']) . '/';

        $target_dir = "../uploads/" . md5($_POST['email']) . '/';
        if (!file_exists($target_dir)){
          mkdir($target_dir);
        }

        if (isset($_FILES['file_cover_letter'])){
          $target_file = $target_dir . basename($_FILES["file_cover_letter"]["name"]);
          move_uploaded_file($_FILES["file_cover_letter"]["tmp_name"], $target_file);
          $cover_letter = $cover_letter . basename($_FILES["file_cover_letter"]["name"]);
        }

        $resume = 'https://uploads.elsie-kuehn-leitz-stipendium.de/';

        if (isset($_FILES['file_resume'])){
          $target_file = $target_dir . basename($_FILES["file_resume"]["name"]);
          move_uploaded_file($_FILES["file_resume"]["tmp_name"], $target_file);
          $resume = $resume . basename($_FILES["file_resume"]["name"]);
        }

        $recommendations = 'https://uploads.elsie-kuehn-leitz-stipendium.de/';

        if (isset($_FILES['file_recommendations'])){
          $target_file = $target_dir . basename($_FILES["file_recommendations"]["name"]);
          move_uploaded_file($_FILES["file_recommendations"]["tmp_name"], $target_file);
          $recommendations = $recommendations . basename($_FILES["file_recommendations"]["name"]);
        }

        $program = 'https://uploads.elsie-kuehn-leitz-stipendium.de/';

        if (isset($_FILES['file_program'])){
          $target_file = $target_dir . basename($_FILES["file_program"]["name"]);
          move_uploaded_file($_FILES["file_program"]["tmp_name"], $target_file);
          $program = $program . basename($_FILES["file_program"]["name"]);
        }

        $query->execute(array(
          'email' => $_POST['email'],
          'name' => $_POST['lastname'],
          'surname' => $_POST['firstname'],
          'gender' => $_POST['gender'],
          'age' => $_POST['age'],
          'citizenship' => $_POST['citizenship'],
          'citizenship2' => $_POST['citizenship2'],
          'instrument' => $_POST['instrument'],
          'edu_university' => $_POST['school'],
          'edu_level' => $_POST['edu_level'],
          'video_url' => $_POST['video'],
          'cover_letter_url' => $cover_letter,
          'resume_url' => $resume,
          'recommendations_url' => $recommendations,
          'program_url' => $program,
          'comments' => $_POST['comments']
        ));

        // Send an email to the candidate
        // PHPMailer

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = getEKLMailHost();
        $mail->SMTPAuth = true;
        $mail->Username = getEKLMailUsername();
        $mail->Password = getEKLMailPassword();
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom('noreply@elsie-kuehn-leitz-stipendium.de', 'Elsie Kuehn-Leitz Stipendium');
        $mail->addAddress($_POST['email'], $_POST['firstname'] . ' ' . $_POST['lastname']);
        $mail->isHTML(true);
        $mail->Subject = 'Ihre Bewerbung für das Elsie Kühn-Leitz Stipendium';
        $mail->Body = 'Sehr geehrte/r ' . $_POST['firstname'] . ' ' . $_POST['lastname'] . ',<br><br>
        wir haben Ihre Bewerbung für das Elsie Kühn-Leitz Stipendium erhalten. Vielen Dank für Ihre Bewerbung.<br><br>
        Mit freundlichen Grüßen,<br>
        Das Elsie Kühn-Leitz Stipendium';
        $mail->send();

      }

        echo '

  		</div>
  	</div>
    <footer>
      <p><center>Diese Website ist ehrenamtlich von der <a href="https://www.groupe-minaste.org">Groupe MINASTE</a> gehostet.</center></p>
      <p><center>Betreiber: Wetzlarer Kulturgemeinschaft e.V. – Postfach 2945, 35539 Wetzlar – <a href="https://wetzlarer-kulturgemeinschaft.de">www.wetzlarer-kulturgemeinschaft.de</a> – <a href="https://www.elsie-kuehn-leitz-stipendium.de/impressum/">Impressum</a> – <a href="https://www.elsie-kuehn-leitz-stipendium.de/privacy-policy/">Datenschutz</a><center></p>
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
