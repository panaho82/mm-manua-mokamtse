<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $vehicleType = htmlspecialchars($_POST['vehicle-type']);
    $pickupDate = htmlspecialchars($_POST['pickup-date']);
    $returnDate = htmlspecialchars($_POST['return-date']);
    $pickupTime = htmlspecialchars($_POST['pickup-time']);
    $returnTime = htmlspecialchars($_POST['return-time']);
    $pickupLocation = htmlspecialchars($_POST['pickup-location']);
    $returnLocation = htmlspecialchars($_POST['return-location']);
    $hotelName = isset($_POST['hotel-name']) ? htmlspecialchars($_POST['hotel-name']) : "Non spécifié";
    $firstName = htmlspecialchars($_POST['first-name']);
    $lastName = htmlspecialchars($_POST['last-name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : "Aucun message";
    
    // Adresse email de destination
    $to = "reservation@mm-locationvoitureraiatea.shop";
    
    // Sujet de l'email
    $email_subject = "Nouvelle demande de réservation de " . $firstName . " " . $lastName;
    
    // Corps de l'email
    $body = "Vous avez reçu une nouvelle demande de réservation depuis votre site web.\n\n";
    $body .= "Détails de la réservation:\n";
    $body .= "Véhicule: " . $vehicleType . "\n";
    $body .= "Date de prise en charge: " . $pickupDate . " à " . $pickupTime . "\n";
    $body .= "Date de retour: " . $returnDate . " à " . $returnTime . "\n";
    $body .= "Lieu de prise en charge: " . $pickupLocation . "\n";
    $body .= "Lieu de retour: " . $returnLocation . "\n";
    
    if ($pickupLocation == "hotel" || $returnLocation == "hotel") {
        $body .= "Nom de l'hôtel: " . $hotelName . "\n";
    }
    
    $body .= "\nCoordonnées du client:\n";
    $body .= "Nom complet: " . $firstName . " " . $lastName . "\n";
    $body .= "Email: " . $email . "\n";
    $body .= "Téléphone: " . $phone . "\n\n";
    $body .= "Message / Demandes spéciales:\n" . $message . "\n";
    
    // En-têtes de l'email
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    
    // Envoi de l'email
    if (mail($to, $email_subject, $body, $headers)) {
        // Redirection vers une page de confirmation
        header("Location: reservation_success.html");
        exit;
    } else {
        // En cas d'échec
        header("Location: reservation_error.html");
        exit;
    }
}
?>
