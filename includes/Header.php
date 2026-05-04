<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliotheque</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- CSS externe -->
    <link rel="stylesheet" href="includes/style.css">
</head>

<body>

<nav>
    <a class="nav-brand" href="index.php">Bibliotheque</a>

    <a href="livres.php"
       class="<?php echo (basename($_SERVER['PHP_SELF']) === 'livres.php') ? 'active' : ''; ?>">
        Livres
    </a>

    <a href="auteurs.php"
       class="<?php echo (basename($_SERVER['PHP_SELF']) === 'auteurs.php') ? 'active' : ''; ?>">
        Auteurs
    </a>

    <a href="categories.php"
       class="<?php echo (basename($_SERVER['PHP_SELF']) === 'categories.php') ? 'active' : ''; ?>">
        Categories
    </a>
</nav>

<div class="container">