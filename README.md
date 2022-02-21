<p align="center">
 <strong>Ahmed Mze</strong>
</p>

# API de petites annonces

### Créé avec [Symfony](https://symfony.com/) dans un envirronement [Docker](https://www.docker.com/get-started)

## Instalation

Si environnement Windows, pour l'utilisation de Make, installer Chocolatey. Lancer cette commande avec Powershell en
tant qu'administrateur

`Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://community.chocolatey.org/install.ps1'))`

[Methode ici](https://chocolatey.org/install)

Une fois Chocolatey installé lancer cette commande `choco install make`

Relancer le terminal et la commande make sera disponible.

### Build de l'application

`make build` ou `docker compose build`

### Lancement des containers

`make up` ou `docker compose up`

### Installaton des dépendances php

`composer install`

### Création de la base de données

`php bin/console doctrine:database:create`

### Céation des fichiers de migrations

`php bin/console make:migration`

### Lancement des migrations

`php bin/console doctrine:migrations:migrate`

### Chargement des fixtures (Fausses données)

`php bin/console doctrine:fixtures:load`