<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// index.php

// 1. Includi il file utils
require_once 'src/struct/utils.php';

// 2. Definisci il contenuto specifico di QUESTA pagina
// (Puoi scriverlo qui o caricarlo da un file .html separato come src/templates/home.html)
$contenutoHome = <<<HTML
    <section class="hero">
        <h1>Benvenuto nel tuo nuovo sito!</h1>
        <p>Questo contenuto è iniettato dinamicamente tra header e footer.</p>
        <button class="cta-button">Scopri di più</button>
    </section>
HTML;

// 3. Genera e stampa la pagina completa
// Parametri: (Titolo scheda browser, Contenuto HTML)
echo getTemplatePage("Home Page - MioProgetto", $contenutoHome);
?>