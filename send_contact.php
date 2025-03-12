<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    
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
    
    // En-têtes de l'email
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    
    // Envoi de l'email
    if (mail($to, $email_subject, $body, $headers)) {
        // Redirection vers une page de confirmation
        header("Location: contact_success.html");
        exit;
    } else {
        // En cas d'échec
        header("Location: contact_error.html");
        exit;
    }
}
?>
