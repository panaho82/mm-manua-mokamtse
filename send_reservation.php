<?php
// Activer l'affichage des erreurs (à commenter en production)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $vehicleType = isset($_POST['vehicle-type']) ? htmlspecialchars($_POST['vehicle-type']) : "";
    $pickupDate = isset($_POST['pickup-date']) ? htmlspecialchars($_POST['pickup-date']) : "";
    $pickupTime = isset($_POST['pickup-time']) ? htmlspecialchars($_POST['pickup-time']) : "";
    $returnDate = isset($_POST['return-date']) ? htmlspecialchars($_POST['return-date']) : "";
    $returnTime = isset($_POST['return-time']) ? htmlspecialchars($_POST['return-time']) : "";
    $pickupLocation = isset($_POST['pickup-location']) ? htmlspecialchars($_POST['pickup-location']) : "";
    $returnLocation = isset($_POST['return-location']) ? htmlspecialchars($_POST['return-location']) : "";
    $firstName = isset($_POST['first-name']) ? htmlspecialchars($_POST['first-name']) : "";
    $lastName = isset($_POST['last-name']) ? htmlspecialchars($_POST['last-name']) : "";
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
    $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : "";
    $specialRequests = isset($_POST['special-requests']) ? htmlspecialchars($_POST['special-requests']) : "";
    
    // Adresse email de destination
    $to = "reservation@mm-locationvoitureraiatea.shop";
    
    // Sujet de l'email
    $subject = "Nouvelle demande de réservation";
    
    // Corps de l'email
    $body = "Vous avez reçu une nouvelle demande de réservation depuis votre site web.\n\n";
    $body .= "Détails de la réservation:\n";
    $body .= "Type de véhicule: " . $vehicleType . "\n";
    $body .= "Date de prise en charge: " . $pickupDate . " à " . $pickupTime . "\n";
    $body .= "Date de retour: " . $returnDate . " à " . $returnTime . "\n";
    $body .= "Lieu de prise en charge: " . $pickupLocation . "\n";
    $body .= "Lieu de retour: " . $returnLocation . "\n\n";
    $body .= "Informations du client:\n";
    $body .= "Nom: " . $firstName . " " . $lastName . "\n";
    $body .= "Email: " . $email . "\n";
    $body .= "Téléphone: " . $phone . "\n\n";
    if (!empty($specialRequests)) {
        $body .= "Demandes spéciales:\n" . $specialRequests . "\n";
    }
    
    // En-têtes de l'email - SIMPLIFIÉ
    $headers = "From: reservation@mm-locationvoitureraiatea.shop\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    
    // Envoi de l'email - SANS paramètres supplémentaires
    if (mail($to, $subject, $body, $headers)) {
        // Redirection vers une page de confirmation
        header("Location: reservation_success.html");
        exit;
    } else {
        // En cas d'échec
        // Redirection vers une page d'erreur
        header("Location: reservation_error.html");
        exit;
    }
}
?>
