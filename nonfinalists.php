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

$instrument_query = $bdd->query('SELECT id, instrument_name FROM instruments ORDER BY id ASC');
$all_instruments = $instrument_query->fetchAll(PDO::FETCH_ASSOC);

$formatInstrumentList = function (array $instruments) {
  $names = array_values(array_filter(array_map(function ($instrument) {
    return isset($instrument['instrument_name']) ? trim((string) $instrument['instrument_name']) : '';
  }, $instruments)));

  if (count($names) <= 1) {
    return '';
  }

  $last_name = array_pop($names);

  if (count($names) === 1) {
    return ' sowie ' . $names[0] . ' und ' . $last_name;
  }

  return ' sowie ' . implode(', ', $names) . ' und ' . $last_name;
};

$query = $bdd->prepare('SELECT candidates.*, instruments.instrument_name FROM candidates LEFT JOIN instruments ON candidates.instrument = instruments.id WHERE finalist = 0 AND nonfinalist_sent = 0');
$query->execute();

while ($data = $query->fetch()) {
    $instrument_name = isset($data['instrument_name']) && trim((string) $data['instrument_name']) !== '' ? $data['instrument_name'] : 'Ihr Instrument';
    $other_instruments = array_filter($all_instruments, function ($instrument) use ($data) {
      return isset($instrument['id']) && (string) $instrument['id'] !== (string) $data['instrument'];
    });
    $instrument_name_with_others = $instrument_name . $formatInstrumentList($other_instruments);

    $email_body_introduction = ($data["gender"] == 1 ? 'Sehr geehrter Herr ' : ($data["gender"] == 2 ? 'Sehr geehrte Frau ' : 'Sehr geehrte/r ')) . $data['surname'] . ',<br><br>';
    $email_body = $email_body_introduction . "wir möchten Ihnen noch einmal herzlich für Ihre Bewerbung für das Elsie Kühn-Leitz Stipendium danken. In den letzten Wochen hat unsere achtköpfige internationale Auswahlkommission in einem mehrstufigen Prozess alle Bewerbungen eingehend gesichtet und diskutiert; dabei hat uns die ausgesprochen hohe Qualität nahezu aller Profile sehr beeindruckt.<br><br>
    Leider müssen wir Ihnen mitteilen, dass Sie nach gründlicher Abwägung nicht zu den drei Musikern/Musikerinnen gehören, die zum Vorspiel nach Wetzlar eingeladen werden. Wir wünschen Ihnen dennoch viel Glück und Erfolg bei Ihrem weiteren Werdegang. Vielleicht überschneiden sich dabei doch einmal die Wege mit der Wetzlarer Kulturgemeinschaft? Nach der gegenwärtigen Planung sollen übrigens " . $instrument_name_with_others . " in drei Jahren wieder ausgeschrieben werden.<br><br>
    Die Auswahlkommission<br>
    Elsie Kühn-Leitz Stipendium<br><br>
    Wetzlarer Kulturgemeinschaft e.V.<br>
    <a href=\"mailto:info@wetzlarer-kulturgemeinschaft.de\">info@wetzlarer-kulturgemeinschaft.de</a>";

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
    $mail->addReplyTo('contact@elsie-kuehn-leitz-stipendium.de', 'Elsie Kühn-Leitz Stipendium');
    $mail->addAddress($data['email'], $data['name'] . ' ' . $data['surname']);
    $mail->isHTML(true);
    $mail->Subject = 'Ihre Bewerbung für das Elsie Kühn-Leitz Stipendium';
    $mail->Body = $email_body;
    $result = $mail->send();

    if (!$result) {
        echo 'Mailer Error: ' . $mail->ErrorInfo . '<br>';
    } else {
        $query2 = $bdd->prepare('UPDATE candidates SET nonfinalist_sent = 1 WHERE id = :id');
        $query2->execute(array('id' => $data['id']));
        echo 'Email sent to ' . $data['name'] . ' ' . $data['surname'] . ' (' . $data['email'] . ') successfully.<br>';
    }

}

echo 'All emails are now sent or have been attempted to be sent.';
