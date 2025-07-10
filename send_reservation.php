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
    if (isset($_SESSION['last_reservation_token']) && $_SESSION['last_reservation_token'] === $form_token) {
        // Redirection vers la page de succès (doublon détecté)
        header("Location: reservation_success.html");
        exit;
    }
    
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
    $hotelName = isset($_POST['hotel-name']) ? htmlspecialchars($_POST['hotel-name']) : "";
    
    // Validation basique
    if (empty($vehicleType) || empty($pickupDate) || empty($returnDate) || empty($firstName) || empty($lastName) || empty($email) || empty($phone)) {
        header("Location: reservation_error.html");
        exit;
    }
    
    // Génération du numéro de réservation
    $counterFile = 'reservation_counter.txt';
    $currentNumber = 158; // Numéro de départ
    
    // Lire le compteur actuel
    if (file_exists($counterFile)) {
        $currentNumber = intval(file_get_contents($counterFile));
    }
    
    // Incrémenter le numéro
    $currentNumber++;
    
    // Formater le numéro de réservation
    $reservationNumber = "RESA-" . str_pad($currentNumber, 5, '0', STR_PAD_LEFT);
    
    // Sauvegarder le nouveau numéro
    file_put_contents($counterFile, $currentNumber);
    
    // Sauvegarder le numéro dans la session pour la page de succès
    $_SESSION['reservation_number'] = $reservationNumber;
    
    // Adresse email de destination
    $to = "reservation@mm-locationvoitureraiatea.shop";
    
    // Sujet de l'email
    $subject = "Nouvelle demande de réservation";
    
    // Corps de l'email
    $body = "Vous avez reçu une nouvelle demande de réservation depuis votre site web.\n\n";
    $body .= "NUMÉRO DE RÉSERVATION: " . $reservationNumber . "\n\n";
    $body .= "Détails de la réservation:\n";
    $body .= "Type de véhicule: " . $vehicleType . "\n";
    $body .= "Date de prise en charge: " . $pickupDate . " à " . $pickupTime . "\n";
    $body .= "Date de retour: " . $returnDate . " à " . $returnTime . "\n";
    $body .= "Lieu de prise en charge: " . $pickupLocation . "\n";
    $body .= "Lieu de retour: " . $returnLocation . "\n";
    if (!empty($hotelName)) {
        $body .= "Nom de l'hôtel: " . $hotelName . "\n";
    }
    $body .= "\nInformations du client:\n";
    $body .= "Nom: " . $firstName . " " . $lastName . "\n";
    $body .= "Email: " . $email . "\n";
    $body .= "Téléphone: " . $phone . "\n\n";
    if (!empty($specialRequests)) {
        $body .= "Demandes spéciales:\n" . $specialRequests . "\n";
    }
    
    // En-têtes de l'email - SIMPLIFIÉ
    $headers = "From: reservation@mm-locationvoitureraiatea.shop\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    // Envoi de l'email - SANS paramètres supplémentaires
    if (mail($to, $subject, $body, $headers)) {
        // Sauvegarder le token pour éviter les doublons
        $_SESSION['last_reservation_token'] = $form_token;
        $_SESSION['last_reservation_time'] = time();
        
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
