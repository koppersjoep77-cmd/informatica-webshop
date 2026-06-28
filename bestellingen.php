<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);

    $voornaam   = $data['voornaam'] ?? 'Onbekend';
    $achternaam = $data['achternaam'] ?? 'Onbekend';
    $tussen     = $data['tussenvoegsel'] ?? '';
    $email      = $data['email'] ?? '';
    $straat     = $data['straat'] ?? '';
    $huisnummer = $data['huisnummer'] ?? '';
    $postcode   = $data['postcode'] ?? '';
    $woonplaats = $data['woonplaats'] ?? '';
    $producten  = $data['producten_lijst'] ?? '';
    $totaal     = $data['totaal_bedrag'] ?? '0.00';

    $naam_vol = trim("$voornaam $tussen $achternaam");

    // E-mail aan klant
    $onderwerp = "Bevestiging van jouw MusicMedia bestelling";
    $bericht = "
Hoi $voornaam,

Bedankt voor je bestelling bij MusicMedia! 🎵

━━━━━━━━━━━━━━━━━━━━━━
JOUW BESTELLING
━━━━━━━━━━━━━━━━━━━━━━
$producten

Totaal betaald: €$totaal

━━━━━━━━━━━━━━━━━━━━━━
BEZORGADRES
━━━━━━━━━━━━━━━━━━━━━━
$naam_vol
$straat $huisnummer
$postcode $woonplaats

Je bestelling wordt zo snel mogelijk verwerkt.

Met muzikale groet,
Team MusicMedia
    ";

    $headers = "From: noreply@musicmedia.nl\r\nReply-To: noreply@musicmedia.nl";
    $klant_mail = mail($email, $onderwerp, $bericht, $headers);

    // Notificatie aan jezelf (vul je eigen e-mail in)
    $admin_email = "jouwemail@gmail.com";
    $admin_bericht = "Nieuwe bestelling van $naam_vol ($email)\n\n$producten\n\nTotaal: €$totaal\n\nAdres: $straat $huisnummer, $postcode $woonplaats";
    mail($admin_email, "Nieuwe bestelling MusicMedia", $admin_bericht, $headers);

    echo json_encode(['success' => true, 'mail_verstuurd' => $klant_mail]);
} else {
    echo json_encode(['success' => false, 'error' => 'Geen POST data']);
}
?>