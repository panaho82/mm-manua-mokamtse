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
    
    // Configuration SMTP - À MODIFIER AVEC VOS INFORMATIONS HOSTINGER
    $smtp_host = "smtp.hostinger.com"; // Serveur SMTP de Hostinger
    $smtp_port = 587; // Port SMTP (généralement 587 ou 465)
    $smtp_username = "reservation@mm-locationvoitureraiatea.shop"; // Votre adresse email complète
    $smtp_password = "VOTRE_MOT_DE_PASSE"; // Votre mot de passe email
    
    // En-têtes pour l'email
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    // Tentative d'envoi via SMTP
    $success = false;
    
    // Connexion au serveur SMTP
    $smtp_conn = fsockopen($smtp_host, $smtp_port, $errno, $errstr, 30);
    if (!$smtp_conn) {
        $error_message = "Connexion au serveur SMTP impossible: $errstr ($errno)";
    } else {
        // Lecture de la réponse du serveur
        if (substr(fgets($smtp_conn, 515), 0, 3) != 220) {
            $error_message = "Pas de réponse du serveur SMTP";
        } else {
            // Envoi commande EHLO
            fputs($smtp_conn, "EHLO " . $smtp_host . "\r\n");
            if (substr(fgets($smtp_conn, 515), 0, 3) != 250) {
                $error_message = "EHLO non accepté par le serveur SMTP";
            } else {
                // Authentification
                fputs($smtp_conn, "AUTH LOGIN\r\n");
                if (substr(fgets($smtp_conn, 515), 0, 3) != 334) {
                    $error_message = "AUTH LOGIN non accepté par le serveur SMTP";
                } else {
                    fputs($smtp_conn, base64_encode($smtp_username) . "\r\n");
                    if (substr(fgets($smtp_conn, 515), 0, 3) != 334) {
                        $error_message = "Nom d'utilisateur non accepté par le serveur SMTP";
                    } else {
                        fputs($smtp_conn, base64_encode($smtp_password) . "\r\n");
                        if (substr(fgets($smtp_conn, 515), 0, 3) != 235) {
                            $error_message = "Mot de passe non accepté par le serveur SMTP";
                        } else {
                            // Expéditeur
                            fputs($smtp_conn, "MAIL FROM: <" . $smtp_username . ">\r\n");
                            if (substr(fgets($smtp_conn, 515), 0, 3) != 250) {
                                $error_message = "MAIL FROM non accepté par le serveur SMTP";
                            } else {
                                // Destinataire
                                fputs($smtp_conn, "RCPT TO: <" . $to . ">\r\n");
                                if (substr(fgets($smtp_conn, 515), 0, 3) != 250) {
                                    $error_message = "RCPT TO non accepté par le serveur SMTP";
                                } else {
                                    // Données
                                    fputs($smtp_conn, "DATA\r\n");
                                    if (substr(fgets($smtp_conn, 515), 0, 3) != 354) {
                                        $error_message = "DATA non accepté par le serveur SMTP";
                                    } else {
                                        // Envoi du message
                                        fputs($smtp_conn, "Subject: " . $email_subject . "\r\n");
                                        fputs($smtp_conn, $headers . "\r\n");
                                        fputs($smtp_conn, $body . "\r\n.\r\n");
                                        if (substr(fgets($smtp_conn, 515), 0, 3) != 250) {
                                            $error_message = "Message non accepté par le serveur SMTP";
                                        } else {
                                            $success = true;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            // Fermeture de la connexion
            fputs($smtp_conn, "QUIT\r\n");
            fclose($smtp_conn);
        }
    }
    
    if ($success) {
        // Redirection vers une page de confirmation
        header("Location: contact_success.html");
        exit;
    } else {
        // En cas d'échec, essayons la méthode mail() standard
        if (mail($to, $email_subject, $body, $headers)) {
            header("Location: contact_success.html");
            exit;
        } else {
            // Échec total, affichage de l'erreur
            echo "Échec de l'envoi du message. Erreur: " . (isset($error_message) ? $error_message : "Inconnue");
            echo "<br><a href='contact.html'>Retour au formulaire</a>";
        }
    }
}
?>
