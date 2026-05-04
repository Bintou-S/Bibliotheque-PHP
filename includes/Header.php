<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliotheque</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink:     #1a1208;
            --paper:   #f5f0e8;
            --cream:   #ede7d5;
            --gold:    #b8860b;
            --gold-lt: #d4a017;
            --rust:    #8b3a2a;
            --sage:    #4a5e4a;
            --border:  #c9bfa8;
            --shadow:  rgba(26, 18, 8, 0.12);
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--paper);
            color: var(--ink);
            min-height: 100vh;
            background-image:
                repeating-linear-gradient(
                    0deg,
                    transparent,
                    transparent 27px,
                    rgba(184,134,11,0.07) 27px,
                    rgba(184,134,11,0.07) 28px
                );
        }

        nav {
            background: var(--ink);
            padding: 0 2.5rem;
            display: flex;
            align-items: stretch;
            gap: 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 12px var(--shadow);
        }

        .nav-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            color: var(--gold-lt);
            letter-spacing: 0.04em;
            display: flex;
            align-items: center;
            padding: 1rem 2rem 1rem 0;
            border-right: 1px solid rgba(255,255,255,0.1);
            margin-right: 1.5rem;
            text-decoration: none;
        }

        nav a {
            color: rgba(245,240,232,0.7);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 0 1.2rem;
            display: flex;
            align-items: center;
            transition: color 0.2s, background 0.2s;
            border-bottom: 3px solid transparent;
        }

        nav a:hover, nav a.active {
            color: var(--gold-lt);
            border-bottom-color: var(--gold-lt);
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 2.5rem 2rem 4rem;
        }

        .page-header {
            margin-bottom: 2.5rem;
            padding-bottom: 1.25rem;
            border-bottom: 2px solid var(--border);
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.1;
        }

        .page-title span {
            display: block;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.8rem;
            font-weight: 400;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 0.25rem;
        }

        .alert {
            padding: 0.9rem 1.25rem;
            border-radius: 3px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            border-left: 4px solid;
        }

        .alert-success {
            background: #eef5ee;
            border-color: var(--sage);
            color: var(--sage);
        }

        .alert-error {
            background: #faf0ee;
            border-color: var(--rust);
            color: var(--rust);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.55rem 1.2rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            border: 2px solid transparent;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.18s;
            border-radius: 2px;
        }

        .btn-primary {
            background: var(--ink);
            color: var(--paper);
            border-color: var(--ink);
        }

        .btn-primary:hover {
            background: var(--gold);
            border-color: var(--gold);
            color: var(--ink);
        }

        .btn-outline {
            background: transparent;
            color: var(--ink);
            border-color: var(--border);
        }

        .btn-outline:hover {
            border-color: var(--ink);
        }

        .btn-danger {
            background: transparent;
            color: var(--rust);
            border-color: var(--rust);
        }

        .btn-danger:hover {
            background: var(--rust);
            color: #fff;
        }

        .btn-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.75rem;
        }

        .card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 2px 8px var(--shadow);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: var(--ink);
        }

        thead th {
            padding: 0.9rem 1.25rem;
            text-align: left;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.72rem;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--gold-lt);
        }

        tbody tr {
            border-bottom: 1px solid var(--cream);
            transition: background 0.15s;
        }

        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: var(--cream); }

        td {
            padding: 0.9rem 1.25rem;
            font-size: 0.9rem;
            vertical-align: middle;
        }

        .td-actions {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-end;
        }

        .badge {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            font-size: 0.72rem;
            font-weight: 500;
            letter-spacing: 0.04em;
            border-radius: 2px;
            background: var(--cream);
            color: var(--gold);
            border: 1px solid var(--border);
        }

        .empty-state {
            padding: 3rem;
            text-align: center;
            color: rgba(26,18,8,0.4);
            font-style: italic;
        }

        .form-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 2rem 2.5rem;
            box-shadow: 0 2px 8px var(--shadow);
            max-width: 640px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .form-group.full { grid-column: 1 / -1; }

        label {
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--gold);
        }

        input, select, textarea {
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            padding: 0.65rem 0.9rem;
            border: 1px solid var(--border);
            border-radius: 2px;
            background: var(--paper);
            color: var(--ink);
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
            width: 100%;
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(184,134,11,0.12);
        }

        .form-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.75rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--cream);
        }

        .section-divider {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            align-items: start;
        }

        @media (max-width: 700px) {
            .section-divider { grid-template-columns: 1fr; }
            .form-grid { grid-template-columns: 1fr; }
            .page-header { flex-direction: column; align-items: flex-start; }
        }
    </style>
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