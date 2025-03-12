<?php
// Informations pour le test d'envoi d'email
$to = "reservation@mm-locationvoitureraiatea.shop";
$subject = "Test d'envoi d'email";
$message = "Ceci est un test pour vérifier si la fonction mail() fonctionne correctement.";
$headers = "From: reservation@mm-locationvoitureraiatea.shop";

// Tentative d'envoi d'email
$success = mail($to, $subject, $message, $headers);

// Affichage du résultat
if ($success) {
    echo "Email envoyé avec succès!";
} else {
    echo "Échec de l'envoi de l'email.";
    
    // Affichage des erreurs PHP si disponibles
    if (error_get_last()) {
        echo "<br>Erreur PHP: " . print_r(error_get_last(), true);
    }
}

// Affichage des informations de configuration PHP
echo "<h2>Informations de configuration PHP</h2>";
echo "<p>Version PHP: " . phpversion() . "</p>";

// Vérification si la fonction mail() est disponible
echo "<p>Fonction mail() disponible: " . (function_exists('mail') ? 'Oui' : 'Non') . "</p>";

// Affichage de la configuration SMTP si disponible
echo "<h3>Configuration SMTP</h3>";
echo "<pre>";
print_r(ini_get_all('mail'));
echo "</pre>";
?>
