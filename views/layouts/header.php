<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Moukda Phaengvixay">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>{{title}}</title>
    <link rel="stylesheet" href="{{asset}}/css/style.css">
    <script src="{{asset}}/javascript/index.js" type="module"></script>
</head>
<body>
     <header class="entete">
        <nav class="nav-principale">
            <a href="{{base}}/home"><img class="logo" src="{{asset}}/img/logo/logo.webp" alt="logo"></a>
            <input type="checkbox" id="menu-checkbox" class="menu-checkbox">
            <label for="menu-checkbox" class="menu-burger">
                <span class="invisible">menu-burger</span>
                <i class="fas fa-bars"></i>
            </label>
            <ul class="menu-principal">
                <li><a href="{{base}}/home">Accueil</a></li>
                <li class="sous-menu">
                    <a href="#">À propos <i class="fas fa-chevron-down "></i></a>
                    <ul class="menu-deroulant">
                        <li><a href="#">La philatélie, c'est la vie.</a></li>
                        <li><a href="#">Biographie du Lord</a></li>
                        <li><a href="#">Historique familiale</a></li>
                    </ul>
                </li>
                <li class="sous-menu">
                   <a href="portail-enchere.html">Portail enchères <i class="fas fa-chevron-down"></i></a>
                    <ul class="menu-deroulant">
                        <li><a href="#">En cours</a></li>
                        <li><a href="#">Archivées</a></li>
                    </ul>
                </li>
                <li class="sous-menu">
                    <a href="#">Actualités <i class="fas fa-chevron-down"></i></a>
                    <ul class="menu-deroulant">
                        <li><a href="#">Timbres</a></li>
                        <li><a href="fiche-enchere.html">Enchères</a></li>
                        <li><a href="#">Bridge</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="menu-principal">
                {% if guest %}
                <li><a href="{{base}}/utilisateur/create">Devenir membre <i class="fa fa-user"></i></a></li>
                {% else %}
                <li><a href="{{base}}/utilisateur/view?id={{utilisateur.id}}">Profil membre <i class="fa fa-user"></i></a></li>
                {% endif %}
                {% if guest %}
                <li><a href="{{base}}/login">Se connecter</a></li>
                {% else %}
                <li><a href="{{base}}/logout">Se déconnecter</a></li>
                {% endif %}
            </ul>
        </nav>
        <form action="#" method="POST">
            <label class="invisible" for="recherche">Recherche</label>
            <input type="search" id="recherche" name="recherche" placeholder="Recherche de timbres...">
            <img class="icone-form" src="https://s2.svgbox.net/octicons.svg?ic=search&color=000" alt="icone recherche" width="32" height="32">
            </form>
    </header>
    <main>