<?php
// Vérification de la méthode de requête
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    
    // Tentative d'envoi avec la fonction mail() standard
    $to = "reservation@mm-locationvoitureraiatea.shop";
    $email_subject = "Nouveau message de contact: " . $subject;
    
    // Corps de l'email
    $body = "Vous avez reçu un nouveau message depuis le formulaire de contact de votre site web.\n\n";
    $body .= "Détails:\n";
    $body .= "Nom: " . $name . "\n";
    $body .= "Email: " . $email . "\n";
    $body .= "Sujet: " . $subject . "\n\n";
    $body .= "Message:\n" . $message . "\n";
    
    // En-têtes pour l'email
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    // Ajout d'un paramètre supplémentaire pour Hostinger
    $additional_parameters = "-f reservation@mm-locationvoitureraiatea.shop";
    
    // Tentative d'envoi avec paramètres supplémentaires
    if (mail($to, $email_subject, $body, $headers, $additional_parameters)) {
        // Redirection vers une page de confirmation
        header("Location: contact_success.html");
        exit;
    } else {
        // Enregistrement des erreurs dans un fichier log
        $error_log = "Date: " . date("Y-m-d H:i:s") . "\n";
        $error_log .= "Erreur d'envoi d'email\n";
        $error_log .= "De: " . $email . "\n";
        $error_log .= "À: " . $to . "\n";
        $error_log .= "Sujet: " . $email_subject . "\n";
        $error_log .= "Erreur PHP: " . (error_get_last() ? print_r(error_get_last(), true) : "Aucune erreur spécifique") . "\n\n";
        
        file_put_contents("mail_error.log", $error_log, FILE_APPEND);
        
        // Redirection vers une page d'erreur
        header("Location: contact_error.html");
        exit;
    }
}
?>
