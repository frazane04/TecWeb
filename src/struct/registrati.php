<?php
// src/struct/registrati.php

$errorMessage = '';
$successMessage = '';

// Gestione POST del form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $passwordConfirm = $_POST['password_confirm'] ?? '';
    $termsAccepted = isset($_POST['terms']);
    $newsletterOptIn = isset($_POST['newsletter']);
    
    // Validazione
    if (empty($username) || empty($email) || empty($password) || empty($passwordConfirm)) {
        $errorMessage = 'Per favore, compila tutti i campi obbligatori.';
    } elseif (strlen($username) < 3 || strlen($username) > 30) {
        $errorMessage = 'Lo username deve essere tra 3 e 30 caratteri.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Inserisci un indirizzo email valido.';
    } elseif (strlen($password) < 8) {
        $errorMessage = 'La password deve contenere almeno 8 caratteri.';
    } elseif ($password !== $passwordConfirm) {
        $errorMessage = 'Le password non coincidono.';
    } elseif (!$termsAccepted) {
        $errorMessage = 'Devi accettare i Termini di Servizio per registrarti.';
    } else {
        // TODO: Verifica che username ed email non esistano già nel database
        // $existingUser = $db->getUserByUsername($username);
        // $existingEmail = $db->getUserByEmail($email);
        
        // if ($existingUser) {
        //     $errorMessage = 'Username già in uso.';
        // } elseif ($existingEmail) {
        //     $errorMessage = 'Email già registrata.';
        // } else {
        //     // Hash della password
        //     $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        //     
        //     // Inserimento nel database
        //     $db->insertUser($username, $email, $hashedPassword, $newsletterOptIn);
        //     
        //     $successMessage = 'Registrazione completata! Ora puoi accedere.';
        //     // Redirect dopo 2 secondi
        //     header('Refresh: 2; url=' . getPrefix() . '/accedi');
        // }
        
        // SIMULAZIONE per testing (rimuovere in produzione)
        $successMessage = 'Registrazione completata con successo! Verrai reindirizzato alla pagina di login...';
        header('Refresh: 2; url=' . getPrefix() . '/accedi');
    }
}

// Carica il template HTML
$templatePath = __DIR__ . '/../template/registrati.html';

if (!file_exists($templatePath)) {
    die("Errore: Template registrati.html non trovato in $templatePath");
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
echo getTemplatePage("Registrati - AliceTrueCrime", $contenuto);
?>