<?php
// src/struct/accedi.php

$errorMessage = '';
$successMessage = '';

// Gestione POST del form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);
    
    // Validazione base
    if (empty($email) || empty($password)) {
        $errorMessage = 'Per favore, compila tutti i campi.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Inserisci un indirizzo email valido.';
    } else {
        // TODO: Connessione al database e verifica credenziali
        // Esempio simulato:
        
        // $user = $db->getUserByEmail($email);
        // if ($user && password_verify($password, $user['password'])) {
        //     $_SESSION['user'] = $user['username'];
        //     $_SESSION['user_id'] = $user['id'];
        //     header('Location: ' . getPrefix() . '/profilo');
        //     exit;
        // }
        
        // SIMULAZIONE per testing (rimuovere in produzione)
        if ($email === 'test@example.com' && $password === 'password123') {
            $_SESSION['user'] = 'DetectiveTest';
            $_SESSION['user_id'] = 1;
            
            // Se "Ricordami" è attivo, imposta cookie (opzionale)
            if ($remember) {
                setcookie('user_token', 'token_esempio', time() + (86400 * 30), '/');
            }
            
            header('Location: ' . getPrefix() . '/profilo');
            exit;
        } else {
            $errorMessage = 'Email o password non corretti.';
        }
    }
}

// Carica il template HTML
$templatePath = __DIR__ . '/../template/accedi.html';

if (!file_exists($templatePath)) {
    die("Errore: Template accedi.html non trovato in $templatePath");
}

$contenuto = file_get_contents($templatePath);

// Mostra eventuali messaggi di errore/successo
if (!empty($errorMessage)) {
    $alert = '<div class="alert alert-error" role="alert">' . htmlspecialchars($errorMessage) . '</div>';
    $contenuto = str_replace('<form class="auth-form"', $alert . '<form class="auth-form"', $contenuto);
}

if (!empty($successMessage)) {
    $alert = '<div class="alert alert-success" role="alert">' . htmlspecialchars($successMessage) . '</div>';
    $contenuto = str_replace('<form class="auth-form"', $alert . '<form class="auth-form"', $contenuto);
}

// Output finale
echo getTemplatePage("Accedi - AliceTrueCrime", $contenuto);
?>