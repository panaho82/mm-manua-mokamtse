<?php
// Script qui envoie directement un email sans passer par un formulaire
// Utile pour tester si le problème vient des formulaires ou de la fonction mail()

// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Informations pour l'email
$to = "reservation@mm-locationvoitureraiatea.shop";
$subject = "Test direct d'envoi d'email - " . date("Y-m-d H:i:s");
$message = "Ceci est un test direct d'envoi d'email sans passer par un formulaire.\n";
$message .= "Date et heure: " . date("Y-m-d H:i:s") . "\n";
$message .= "Script: " . __FILE__ . "\n";

// En-têtes
$headers = "From: reservation@mm-locationvoitureraiatea.shop\r\n";
$headers .= "Reply-To: reservation@mm-locationvoitureraiatea.shop\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Paramètre supplémentaire
$additional_parameters = "-f reservation@mm-locationvoitureraiatea.shop";

// Tentative d'envoi d'email
$success = mail($to, $subject, $message, $headers, $additional_parameters);

// Afficher le résultat
echo "<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Test direct d'envoi d'email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .success {
            color: green;
            padding: 15px;
            background-color: #e8f5e9;
            border: 1px solid #c8e6c9;
            margin-bottom: 20px;
        }
        .error {
            color: red;
            padding: 15px;
            background-color: #ffebee;
            border: 1px solid #ffcdd2;
            margin-bottom: 20px;
        }
        pre {
            background-color: #f5f5f5;
            padding: 15px;
            overflow: auto;
        }
        h1, h2 {
            color: #333;
        }
        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Test direct d'envoi d'email</h1>";

if ($success) {
    echo "<div class='success'>
        <p><strong>Succès!</strong> L'email a été envoyé correctement.</p>
    </div>";
} else {
    echo "<div class='error'>
        <p><strong>Erreur!</strong> L'email n'a pas pu être envoyé.</p>";
    
    if (error_get_last()) {
        echo "<p>Détails de l'erreur:</p>
        <pre>" . print_r(error_get_last(), true) . "</pre>";
    }
    
    echo "</div>";
}

// Afficher les détails de l'email
echo "<h2>Détails de l'email</h2>
<pre>
À: $to
Sujet: $subject
Message: $message
En-têtes: 
" . str_replace("\r\n", "\n", $headers) . "
Paramètres supplémentaires: $additional_parameters
</pre>";

// Afficher les informations de configuration PHP
echo "<h2>Informations de configuration PHP</h2>
<pre>
Version PHP: " . phpversion() . "
Fonction mail() disponible: " . (function_exists('mail') ? 'Oui' : 'Non') . "
</pre>";

// Afficher les variables serveur
echo "<h2>Variables serveur</h2>
<pre>";
$server_vars = ['HTTP_HOST', 'HTTP_REFERER', 'REMOTE_ADDR', 'REQUEST_URI', 'SCRIPT_NAME', 'PHP_SELF', 'SERVER_NAME', 'SERVER_ADDR'];
foreach ($server_vars as $var) {
    if (isset($_SERVER[$var])) {
        echo "$var: " . $_SERVER[$var] . "\n";
    }
}
echo "</pre>";

// Afficher les liens vers les autres tests
echo "<h2>Autres tests</h2>
<p><a href='test_mail.php' class='button'>Test mail.php</a> 
<a href='test_form.html' class='button'>Test formulaire</a></p>

<h2>Formulaires principaux</h2>
<p><a href='contact.html' class='button'>Formulaire de contact</a> 
<a href='reservation.html' class='button'>Formulaire de réservation</a></p>
</body>
</html>";
?>
