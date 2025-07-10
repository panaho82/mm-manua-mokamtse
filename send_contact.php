<?php
// Activer l'affichage des erreurs (à commenter en production)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Démarrer la session pour la protection contre les doublons
session_start();

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Protection contre les soumissions multiples
    $form_token = md5(serialize($_POST) . time());
    if (isset($_SESSION['last_contact_token']) && $_SESSION['last_contact_token'] === $form_token) {
        // Redirection vers la page de succès (doublon détecté)
        header("Location: contact_success.html");
        exit;
    }
    
    // Récupération des données du formulaire
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : "";
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
    $subject = isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : "Sans sujet";
    $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : "";
    
    // Validation basique
    if (empty($name) || empty($email) || empty($message)) {
        header("Location: contact_error.html");
        exit;
    }
    
    // Adresse email de destination
    $to = "reservation@mm-locationvoitureraiatea.shop";
    
    // Sujet de l'email
    $email_subject = "Nouveau message de contact: " . $subject;
    
    // Corps de l'email
    $body = "Vous avez reçu un nouveau message depuis le formulaire de contact de votre site web.\n\n";
    $body .= "Détails:\n";
    $body .= "Nom: " . $name . "\n";
    $body .= "Email: " . $email . "\n";
    $body .= "Sujet: " . $subject . "\n\n";
    $body .= "Message:\n" . $message . "\n";
    
    // En-têtes de l'email - SIMPLIFIÉ
    $headers = "From: reservation@mm-locationvoitureraiatea.shop\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    // Envoi de l'email - SANS paramètres supplémentaires
    if (mail($to, $email_subject, $body, $headers)) {
        // Sauvegarder le token pour éviter les doublons
        $_SESSION['last_contact_token'] = $form_token;
        $_SESSION['last_contact_time'] = time();
        
        // Redirection vers une page de confirmation
        header("Location: contact_success.html");
        exit;
    } else {
        // En cas d'échec
        // Redirection vers une page d'erreur
        header("Location: contact_error.html");
        exit;
    }
}
?>
