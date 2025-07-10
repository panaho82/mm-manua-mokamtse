<?php
session_start();
header('Content-Type: application/json');

// Vérifier si le numéro de réservation existe en session
if (isset($_SESSION['reservation_number'])) {
    $response = [
        'success' => true,
        'reservation_number' => $_SESSION['reservation_number']
    ];
    // Nettoyer la session après utilisation
    unset($_SESSION['reservation_number']);
} else {
    $response = [
        'success' => false,
        'error' => 'Numéro de réservation non trouvé'
    ];
}

echo json_encode($response);
?> 