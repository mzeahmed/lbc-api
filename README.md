<p align="center">
 <strong>Ahmed Mze</strong>
</p>

# API de petites annonces

### Créé avec [Symfony](https://symfony.com/) dans un envirronement [Docker](https://www.docker.com/get-started)

## Installation

Sur Windows, pour l'utilisation de Make, installer Chocolatey. Lancer cette commande avec Powershell en tant
qu'administrateur

`Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://community.chocolatey.org/install.ps1'))`

[Methode ici](https://chocolatey.org/install)

Une fois Chocolatey installé lancer cette commande `choco install make`

Relancer le terminal et la commande make sera disponible.

### Build de l'application

`make build` ou `docker compose build`

---

### Lancement des containers

`make up` ou `docker compose up`

---

### Installaton des dépendances php

`composer install`

---

### Création de la base de données

`php bin/console doctrine:database:create`

---

### Mettre le schema de la base de données

`php bin/console doctrine:schema:update --force`

---

### Chargement des fixtures (Fausses données)

`php bin/console doctrine:fixtures:load`

---

#### URL de la base de données

[http://localhost:8080/](http://localhost:8080)

---

## Requetes CURL pour tester les routes

#### Remplacer les ids si besoin en  fonction de ceux present en base de données

Se connecter au container `lbc-api_web`

`docker container exec -ti <<ID du container>> bash`

#### Connecter l'utilisateur et recuperer le token

`curl -X POST --header "Content-Type: application/json" http://localhost/api/login_check -d '{"username":"ahmed@mze.net","password":"password"}'`

Copier le token affiché dans la console et le coller avec les requetes suivantes

#### Lister les annonces

`curl --header "Content-Type: application/json" --header "Authorization: Bearer <<token>>" --request GET http://localhost/api/ad`

---

#### Récuperer une annonce

`curl --header "Content-Type: application/json" --header "Authorization: Bearer <<token>>" --request GET http://localhost/api/ad/1`

---

#### Publier une annonce

`curl --header "Content-Type: application/json" --header "Authorization: Bearer <<token>>" --request POST --data '{"title": "Titre CURL", "content": "Contenu CURL", "vehicle": {"id": 1}, "category": {"id": 2}}' http://localhost/api/ad/store`

---

#### Modifier une annonce

`curl --header "Content-Type: application/json" --header "Authorization: Bearer <<token>>" --request PATCH --data '{"id": 38, "title": "Titre CURL modifié"}' http://localhost/api/ad/38/edit`

---

#### Supprimer une annonce

`curl --header "Content-Type: application/json" --header "Authorization: Bearer <<token>>" --request DELETE http://localhost/api/ad/38/delete`

#### Rechercher un vehicule

Marques disponible: Audi, BMW, Citroen

`curl --header "Content-Type: application/json" --header "Authorization: Bearer <<token>>" --request GET http://localhost/api/search?q=rs`

Remplacer le parametre `?q=rs` par les models recherchés, exemple `?q=m6`, `?q=pica`, etc...
