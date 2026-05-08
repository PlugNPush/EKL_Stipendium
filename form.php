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
  exit('Error while connecting to database: ' . $e->getMessage());
}
// Démarrage de la session
session_start();

function normalizeAsciiToken($value)
{
  $value = strtolower(trim((string) $value));
  if (function_exists('iconv')) {
    $transliterated = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value);
    if ($transliterated !== false) {
      $value = $transliterated;
    }
  }
  $value = preg_replace('/[^a-z0-9]+/', '-', $value);
  $value = trim($value, '-');

  return $value === '' ? 'kandidat' : $value;
}

function buildNormalizedUploadFilename($lastname, $firstname, $documentType, $originalFilename)
{
  $extension = strtolower(pathinfo((string) $originalFilename, PATHINFO_EXTENSION));
  if (!in_array($extension, array('pdf', 'doc', 'docx'), true)) {
    return null;
  }

  return normalizeAsciiToken($lastname) . '-' . normalizeAsciiToken($firstname) . '-' . $documentType . '.' . $extension;
}

function isInternationalPhoneNumber($phone)
{
  return preg_match('/^\+[1-9][0-9]{0,3}[0-9\s\-\/]{4,20}$/', trim((string) $phone)) === 1;
}

function isAllowedVideoPlatformUrl($url)
{
  $url = trim((string) $url);
  if ($url === '' || preg_match('/[\s,;]/', $url) === 1) {
    return false;
  }
  if (!filter_var($url, FILTER_VALIDATE_URL)) {
    return false;
  }

  $parts = parse_url($url);
  $host = isset($parts['host']) ? strtolower($parts['host']) : '';
  $allowedHosts = array(
    'youtube.com',
    'www.youtube.com',
    'm.youtube.com',
    'youtu.be',
    'youtube-nocookie.com',
    'www.youtube-nocookie.com',
    'vimeo.com',
    'www.vimeo.com',
    'player.vimeo.com'
  );

  return in_array($host, $allowedHosts, true);
}

if (!isset($_POST['email']) || !isset($_POST['lastname']) || !isset($_POST['firstname']) || !isset($_POST['phone']) || !isset($_POST["gender"]) || !isset($_POST["age"]) || !isset($_POST["citizenship"]) || !isset($_POST["instrument"]) || !isset($_POST["edu_university"]) || !isset($_POST["edu_level"]) || !isset($_POST["video_url"]) || !isset($_FILES["file_cover_letter"]) || !isset($_FILES["file_resume"]) || !isset($_FILES["file_recommendations"]) || !isset($_FILES["file_program"])) {
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

      <!-- Telefonnummer -->
      <div class="wrap-input100 validate-input">
        <span class="label-input100">Telefonnummer (mit Ländervorwahl, z. B. +49 ...)</span>
        <input class="input100" type="tel" name="phone" placeholder="+49 1512 3456789" pattern="\+[1-9][0-9]{0,3}[0-9\s\-\/]{4,20}" title="Bitte geben Sie eine gültige Telefonnummer mit internationaler Ländervorwahl ein (z. B. +49, +33, +41)." required>
        <span class="focus-input100"></span>
      </div>

      <!-- Geschlecht -->
      <div class="wrap-input100 input100-select">
        <span class="label-input100">Geschlecht</span>
        <div>
          <select class="selection-2" name="gender" required>
            <option hidden disabled selected value> -- Bitte auswählen -- </option>';

  $query = $bdd->query('SELECT * FROM genders');
  while ($data = $query->fetch()) {
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
  while ($data = $query->fetch()) {
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
  while ($data = $query->fetch()) {
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
  while ($data = $query->fetch()) {
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
  while ($data = $query->fetch()) {
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
        <input class="input100" type="text" name="edu_university" placeholder="Musikhochschule" required>
        <span class="focus-input100"></span>
      </div>

      <!-- Gegenwärtiger Studiengang -->
      <div class="wrap-input100 input100-select">
        <span class="label-input100">Gegenwärtiger Studiengang</span>
        <div>
          <select class="selection-2" name="edu_level" required>
            <option hidden disabled selected value> -- Bitte auswählen -- </option>';

  $query = $bdd->query('SELECT * FROM edu_levels');
  while ($data = $query->fetch()) {
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

      <!-- Bewerbungsvideo -->
      <div class="wrap-input100 validate-input">
        <span class="label-input100">Bewerbungsvideo: nur <a target="_blank" href="https://www.youtube.com">YouTube</a> oder <a target="_blank" href="https://www.vimeo.com">Vimeo</a> (eine URL pro Feld)</span>
        <input class="input100" type="url" name="video_url" placeholder="https://www.youtube.com/watch?v=... oder https://vimeo.com/..." required>
        <span class="focus-input100"></span>
      </div>
      <div class="hinweis">Hinweis: Der Link muss öffentlich zugänglich sein und direkt zum Online-Video führen (keine Downloads oder Passwörter). Erlaubt sind nur YouTube- und Vimeo-Links.</div>

      <!-- Kommentar -->
      <div class="wrap-input100 validate-input">
        <span class="label-input100">Kommentar (optional)</span>
        <textarea class="input100" name="comments" placeholder="Kommentar"></textarea>
        <span class="focus-input100"></span>
      </div>
      <div class="hinweis">Hinweis: Zusätzliche Links bitte im Feld "Kommentar" angeben.</div>

      <!-- Formular absenden -->
      <div class="container-contact100-form-btn">
        <div class="wrap-contact100-form-btn">
          <div class="contact100-form-bgbtn"></div>
          <button class="contact100-form-btn" onclick="initiateUpload()">
            <span>
              Jetzt bewerben!
              <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
            </span>
          </button>
        </div>
      </div>
    </form>
        <br><a href="javascript:void(0)"><center><span onclick="abortConfirm()">Formular verlassen</span></center></a>
  		</div>
  	</div>

    <footer>
      <p><center>Diese Website ist ehrenamtlich von der <a target="_blank" href="https://www.groupe-minaste.org">Groupe MINASTE</a> gehostet.</center></p>
      <p><center>Betreiber: Wetzlarer Kulturgemeinschaft e.V. – Postfach 2945, 35539 Wetzlar – <a target="_blank" href="https://wetzlarer-kulturgemeinschaft.de">www.wetzlarer-kulturgemeinschaft.de</a> – <a target="_blank" href="https://www.elsie-kuehn-leitz-stipendium.de/impressum/">Impressum</a> – <a target="_blank" href="https://www.elsie-kuehn-leitz-stipendium.de/privacy-policy/">Datenschutz</a><center></p>
    </footer>

  	<div id="dropDownSelect1"></div>

    <script>

    function initiateUpload() {
      if (phoneInput) {
        validatePhone();
      }
      if (videoInput) {
        validateVideoUrl();
      }
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

    const phoneInput = document.querySelector("input[name=\'phone\']");
    const validatePhone = () => {
      if (!phoneInput) {
        return;
      }
      const value = phoneInput.value.trim();
      if (value === "") {
        phoneInput.setCustomValidity("");
        if (phoneInput.parentElement) {
          phoneInput.parentElement.classList.remove("alert-validate");
        }
        phoneInput.removeAttribute("aria-invalid");
        return;
      }
      if (!/^\+[1-9][0-9]{0,3}[0-9\s\-\/]{4,20}$/.test(value)) {
        phoneInput.setCustomValidity("Bitte geben Sie eine Telefonnummer mit internationaler Ländervorwahl ein (z. B. +49, +33, +41).");
        if (phoneInput.parentElement) {
          phoneInput.parentElement.classList.add("alert-validate");
        }
        phoneInput.setAttribute("aria-invalid", "true");
        return;
      }
      phoneInput.setCustomValidity("");
      if (phoneInput.parentElement) {
        phoneInput.parentElement.classList.remove("alert-validate");
      }
      phoneInput.removeAttribute("aria-invalid");
    };

    if (phoneInput) {
      phoneInput.addEventListener("input", validatePhone);
      phoneInput.addEventListener("blur", validatePhone);
    }

    const videoInput = document.querySelector("input[name=\'video_url\']");
    let validateVideoUrl = () => {};
    if (videoInput) {
      const allowedVideoHosts = [
        "youtube.com",
        "www.youtube.com",
        "m.youtube.com",
        "youtu.be",
        "youtube-nocookie.com",
        "www.youtube-nocookie.com",
        "vimeo.com",
        "www.vimeo.com",
        "player.vimeo.com"
      ];

      validateVideoUrl = () => {
        const value = videoInput.value.trim();
        if (value === "") {
          videoInput.setCustomValidity("");
          if (videoInput.parentElement) {
            videoInput.parentElement.classList.remove("alert-validate");
          }
          videoInput.removeAttribute("aria-invalid");
          return;
        }
        if (/[,;\s]/.test(value)) {
          videoInput.setCustomValidity("Bitte geben Sie genau eine URL ein (keine Leerzeichen oder mehrere Links).");
          if (videoInput.parentElement) {
            videoInput.parentElement.classList.add("alert-validate");
          }
          videoInput.setAttribute("aria-invalid", "true");
          return;
        }
        let parsedUrl;
        try {
          parsedUrl = new URL(value);
        } catch (error) {
          videoInput.setCustomValidity("Bitte geben Sie eine gültige URL ein.");
          return;
        }
        if (!allowedVideoHosts.includes(parsedUrl.hostname.toLowerCase())) {
          videoInput.setCustomValidity("Bitte verwenden Sie ausschließlich YouTube- oder Vimeo-Links.");
          if (videoInput.parentElement) {
            videoInput.parentElement.classList.add("alert-validate");
          }
          videoInput.setAttribute("aria-invalid", "true");
          return;
        }
        videoInput.setCustomValidity("");
        if (videoInput.parentElement) {
          videoInput.parentElement.classList.remove("alert-validate");
        }
        videoInput.removeAttribute("aria-invalid");
      };

      videoInput.addEventListener("input", validateVideoUrl);
      videoInput.addEventListener("blur", validateVideoUrl);
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
  			minimumResultsForSearch: 20
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
} else {
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

  $phone = trim($_POST['phone']);
  $video_url = trim($_POST['video_url']);
  $comments = isset($_POST['comments']) ? trim($_POST['comments']) : '';
  if (!isInternationalPhoneNumber($phone) || !isAllowedVideoPlatformUrl($video_url)) {
    echo '<div class="container-contact100">
      <div class="wrap-contact100">
        <h1>Ungültige Angaben im Formular</h1>
        <p>Bitte prüfen Sie Telefonnummer (mit internationaler Ländervorwahl, z. B. +49) und Video-Link (nur YouTube oder Vimeo, genau eine URL pro Feld).</p>
        <br><h4><a href="javascript:history.back()">Zurück zum Formular</a></h4>
      </div>
    </div>';
  } else {

  $select = $bdd->prepare('SELECT * FROM candidates WHERE email = ?');
  $select->execute(array($_POST['email']));
  $test = $select->fetch();

  if (isset($test['id'])) {
    echo '<div class="container-contact100">
      <div class="wrap-contact100">
        <h1>Sie haben bereits eine Bewerbung eingereicht.</h1>
        <p>Bitte warten Sie auf die Antwort des Stipendiums und reichen Sie keine weiteren Bewerbungen ein. Vielen Dank.</p>
        <br><h4><a href="https://www.elsie-kuehn-leitz-stipendium.de">Zurück zur Startseite</a></h4>';
  } else {
    echo '
  	<div class="container-contact100">
  		<div class="wrap-contact100">
  			<h1>Ihre Bewerbung wurde erfolgreich eingereicht.</h1>
        <p>Viel Glück bei Ihrer Bewerbung!</p>
        <br><h4><a href="https://www.elsie-kuehn-leitz-stipendium.de">Zurück zur Startseite</a></h4>';

    $query = $bdd->prepare('INSERT INTO candidates(email, name, surname, phone, gender, age, citizenship, citizenship2, instrument, edu_university, edu_level, video_url, cover_letter_url, resume_url, recommendations_url, program_url, comments) VALUES(:email, :name, :surname, :phone, :gender, :age, :citizenship, :citizenship2, :instrument, :edu_university, :edu_level, :video_url, :cover_letter_url, :resume_url, :recommendations_url, :program_url, :comments)');

    $target_dir = "../uploads/" . md5($_POST['email']) . '/';
    if (!file_exists($target_dir)) {
      mkdir($target_dir);
    }

    $cover_letter_url = 'https://uploads.elsie-kuehn-leitz-stipendium.de/' . md5($_POST['email']) . '/';

    if (isset($_FILES['file_cover_letter'])) {
      $normalized_cover_letter_name = buildNormalizedUploadFilename($_POST['lastname'], $_POST['firstname'], 'coverletter', $_FILES['file_cover_letter']['name']);
      if ($normalized_cover_letter_name !== null) {
        $target_file = $target_dir . $normalized_cover_letter_name;
        move_uploaded_file($_FILES['file_cover_letter']['tmp_name'], $target_file);
        $cover_letter_url = $cover_letter_url . $normalized_cover_letter_name;
      }
    }

    $resume_url = 'https://uploads.elsie-kuehn-leitz-stipendium.de/' . md5($_POST['email']) . '/';

    if (isset($_FILES['file_resume'])) {
      $normalized_resume_name = buildNormalizedUploadFilename($_POST['lastname'], $_POST['firstname'], 'resume', $_FILES['file_resume']['name']);
      if ($normalized_resume_name !== null) {
        $target_file = $target_dir . $normalized_resume_name;
        move_uploaded_file($_FILES['file_resume']['tmp_name'], $target_file);
        $resume_url = $resume_url . $normalized_resume_name;
      }
    }

    $recommendations_url = 'https://uploads.elsie-kuehn-leitz-stipendium.de/' . md5($_POST['email']) . '/';

    if (isset($_FILES['file_recommendations'])) {
      $normalized_recommendations_name = buildNormalizedUploadFilename($_POST['lastname'], $_POST['firstname'], 'recommendations', $_FILES['file_recommendations']['name']);
      if ($normalized_recommendations_name !== null) {
        $target_file = $target_dir . $normalized_recommendations_name;
        move_uploaded_file($_FILES['file_recommendations']['tmp_name'], $target_file);
        $recommendations_url = $recommendations_url . $normalized_recommendations_name;
      }
    }

    $program_url = 'https://uploads.elsie-kuehn-leitz-stipendium.de/' . md5($_POST['email']) . '/';

    if (isset($_FILES['file_program'])) {
      $normalized_program_name = buildNormalizedUploadFilename($_POST['lastname'], $_POST['firstname'], 'program', $_FILES['file_program']['name']);
      if ($normalized_program_name !== null) {
        $target_file = $target_dir . $normalized_program_name;
        move_uploaded_file($_FILES['file_program']['tmp_name'], $target_file);
        $program_url = $program_url . $normalized_program_name;
      }
    }

    $query->execute(array(
      'email' => $_POST['email'],
      'name' => $_POST['lastname'],
      'surname' => $_POST['firstname'],
      'phone' => $phone,
      'gender' => $_POST['gender'],
      'age' => $_POST['age'],
      'citizenship' => $_POST['citizenship'],
      'citizenship2' => intval($_POST['citizenship2']) == 0 ? NULL : $_POST['citizenship2'],
      'instrument' => $_POST['instrument'],
      'edu_university' => $_POST['edu_university'],
      'edu_level' => $_POST['edu_level'],
      'video_url' => $video_url,
      'cover_letter_url' => $cover_letter_url,
      'resume_url' => $resume_url,
      'recommendations_url' => $recommendations_url,
      'program_url' => $program_url,
      'comments' => $comments
    ));

    // Send an email to the candidate
    // PHPMailer

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->setLanguage('de', 'PHPMailer/language/');
    $mail->Encoding = 'base64';
    $mail->isSMTP();
    $mail->Host = getEKLMailHost();
    $mail->SMTPAuth = true;
    $mail->Username = getEKLMailUsername();
    $mail->Password = getEKLMailPassword();
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->setFrom('noreply@elsie-kuehn-leitz-stipendium.de', 'Elsie Kühn-Leitz Stipendium');
    $mail->addAddress($_POST['email'], $_POST['firstname'] . ' ' . $_POST['lastname']);
    $mail->isHTML(true);
    $mail->Subject = 'Ihre Bewerbung für das Elsie Kühn-Leitz Stipendium';
    $email_body_introduction = ($_POST["gender"] == 1 ? 'Sehr geehrter Herr ' : ($_POST["gender"] == 2 ? 'Sehr geehrte Frau ' : 'Sehr geehrte/r ')) . $_POST['lastname'] . ',<br><br>';
    $mail->Body = $email_body_introduction .
        'wir haben Ihre Unterlagen für das Elsie Kühn-Leitz Stipendium erhalten. Vielen Dank für Ihre Bewerbung.<br><br>
        Mit freundlichen Grüßen,<br><br>
        Die Auswahlkommission<br>
        Elsie Kühn-Leitz Stipendium';
    $mail->send();
  }
  }

  echo '

  		</div>
  	</div>
    <footer>
      <p><center>Diese Website ist ehrenamtlich von der <a target="_blank" href="https://www.groupe-minaste.org">Groupe MINASTE</a> gehostet.</center></p>
      <p><center>Betreiber: Wetzlarer Kulturgemeinschaft e.V. – Postfach 2945, 35539 Wetzlar – <a target="_blank" href="https://wetzlarer-kulturgemeinschaft.de">www.wetzlarer-kulturgemeinschaft.de</a> – <a target="_blank" href="https://www.elsie-kuehn-leitz-stipendium.de/impressum/">Impressum</a> – <a target="_blank" href="https://www.elsie-kuehn-leitz-stipendium.de/privacy-policy/">Datenschutz</a><center></p>
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
  			minimumResultsForSearch: 20
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
