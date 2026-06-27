<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // We pakken de namen exact zoals ze in jouw HTML <input name="..."> staan
    $voornaam = $_POST['voornaam'] ?? 'Onbekend';
    $tussenvoegsel = $_POST['tussenvoegsel'] ?? '';
    $achternaam = $_POST['achternaam'] ?? 'Onbekend';
    $email = $_POST['email'] ?? 'Onbekend';
    $straat = $_POST['straat'] ?? 'Onbekend';
    $huisnummer = $_POST['huisnummer'] ?? 'Onbekend';
    $woonplaats = $_POST['woonplaats'] ?? 'Onbekend';

    // LET OP: Deze namen moeten matchen met je hidden inputs in de checkout
    $producten = $_POST['producten_lijst'] ?? 'Geen producten gevonden in formulier';
    $totaal = $_POST['totaal_bedrag'] ?? '0.00';

    ?>
    <!DOCTYPE html>
    <html lang="nl">
    <head>
        <meta charset="UTF-8">
        <title>Order Ontvangen</title>
        <style>
            body { font-family: Arial, sans-serif; background: #f5f3ef; padding: 40px; }
            .order-box { background: white; padding: 20px; border-radius: 12px; border: 1px solid #e7aa3d; max-width: 500px; margin: auto; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
            h1 { color: #5a3b00; border-bottom: 2px solid #e7aa3d; padding-bottom: 10px; }
            .item { margin: 10px 0; border-bottom: 1px solid #eee; padding-bottom: 5px; }
            strong { color: #333; }
        </style>
    </head>
    <body>
        <div class="order-box">
            <h1>Bestelling Geslaagd!</h1>
            <p>De volgende gegevens zijn ontvangen:</p>
            
            <div class="item"><strong>Klant:</strong> <?php echo htmlspecialchars("$voornaam $tussenvoegsel $achternaam"); ?></div>
            <div class="item"><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></div>
            <div class="item"><strong>Adres:</strong> <?php echo htmlspecialchars("$straat $huisnummer, $woonplaats"); ?></div>
            <hr>
            <div class="item"><strong>Producten:</strong> <?php echo htmlspecialchars($producten); ?></div>
            <div class="item"><strong>Totaal:</strong> €<?php echo htmlspecialchars($totaal); ?></div>
            
            <br>
            <a href="homepage.html" style="color: #e7aa3d;">← Terug naar MusicMedia</a>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "Geen POST data ontvangen.";
}
?>