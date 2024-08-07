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

$query = $bdd->prepare('SELECT * FROM candidates WHERE finalist = 0');
$query->execute();

while ($data = $query->fetch()) {

    echo "=========== will send email to " . $data['email'] . " (" . $data['surname'] . ' ' . $data['name'] . ") ===========<br><br>";

    $email_body_introduction = ($data["gender"] == 1 ? 'Sehr geehrter Herr ' : ($data["gender"] == 2 ? 'Sehr geehrte Frau ' : 'Sehr geehrte/r ')) . $data['name'] . ',<br><br>';
    $email_body = $email_body_introduction . "wir möchten Ihnen noch einmal herzlich für Ihre Bewerbung für das Elsie Kühn-Leitz Stipendium danken. In den letzten vier Wochen hat unsere achtköpfige internationale Auswahlkommission in einem mehrstufigen Prozess alle Bewerbungen eingehend gesichtet und diskutiert; dabei hat uns die ausgesprochen hohe Qualität nahezu aller Profile sehr beeindruckt.<br><br>
    Leider müssen wir Ihnen mitteilen, dass Sie nach gründlicher Abwägung nicht zu den drei Musikern/Musikerinnen gehören, die zum Vorspiel nach Wetzlar eingeladen werden. Wir wünschen Ihnen dennoch viel Glück und Erfolg bei Ihrem weiteren Werdegang. Vielleicht überschneiden sich dabei doch einmal die Wege mit der Wetzlarer Kulturgemeinschaft? Nach der gegenwärtigen Planung sollen übrigens Klavier, Harfe und Gesang in drei Jahren wieder ausgeschrieben werden.<br><br>
    Die Auswahlkommission<br>
    Elsie Kühn-Leitz Stipendium 2024/5<br><br>
    Wetzlarer Kulturgemeinschaft e.V.<br>
    <a href=\"info@wetzlarer-kulturgemeinschaft.de\">info@wetzlarer-kulturgemeinschaft.de</a>";
    echo $email_body;

    echo "<br><br>=========== end of email ============<br><br>";

    // $mail = new PHPMailer(true);
    // $mail->CharSet = 'UTF-8';
    // $mail->setLanguage('de', 'PHPMailer/language/');
    // $mail->Encoding = 'base64';
    // $mail->isSMTP();
    // $mail->Host = getEKLMailHost();
    // $mail->SMTPAuth = true;
    // $mail->Username = getEKLMailUsername();
    // $mail->Password = getEKLMailPassword();
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    // $mail->Port = 587;
    // $mail->setFrom('noreply@elsie-kuehn-leitz-stipendium.de', 'Elsie Kühn-Leitz Stipendium');
    // $mail->addAddress($data['email'], $data['surname'] . ' ' . $data['name']);
    // $mail->isHTML(true);
    // $mail->Subject = 'Ihre Bewerbung für das Elsie Kühn-Leitz Stipendium';
    // $mail->Body = $email_body;
    // $mail->send();

}
