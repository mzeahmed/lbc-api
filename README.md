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

`docker container exec -ti [ID du container] bash`

[//]: # (#### Recuperer le JWT)

[//]: # (`curl -X POST -H "Content-Type: application/json" --header "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NDU4MzA4NzksImV4cCI6MTY0NTgzNDQ3OSwicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6ImFobWVkQG16ZS5uZXQifQ.OhETuR3e154WbXlXYdSGoeXz9U8l9nfTKxmytLEjv49M7ARVpOa4ai1Od6lnDuzYGN0qo5C5lLZzy4Qe7_d8iYQjEbcUz4v9oAH9NaKe_M15GsuLLDQSU3KxKI3G2rX7Hsu0IlcI1SzK0jctp2cWcHsulq_b3h3ou9hRgpyahVoIuMyD9bD0Nz9UGPSMG-i2G7Q9ZKvenSz_gdSGpQRSP3ddp1UdAcdsXzKT8xPQ44mday-MY_FSVtAhJ6gjyUVkyH-hUpCyWu4pOHqWPMQvhz1LJYtH8hTXXAsz8n2dkYhZ97FgkrV0pU-P8hez6piiymdEKGWj_FExZqwvIQaITIlsxqUOnStRGv9VfpFb2xkJIm1VlSA-r3aHIxNqINqtIQS9hbi0uoRmMmTKBgrPdARqjTN-JjTVH1UonBfA1UkM3nLDm9Z3_e5ksreoGB7oV3bUG_Jh9fEHk5rclTm1GfpFnKIPO7bp-ckW9AtdWBbUlLQUWKLOuBHl8EGI8UDrb-yENQMjD71WipZ6qxEOBJ0RHND7eGFoXrM4v23DicqLbAT_mArjQuCpElsdTOhINxVGnODqTSigoAptO6W-HkRoL0XYRkUGpgVO7Mci3CHzPLuU23h3MeqOExyYPo1nZkFkRdhvU3umYDALAYXu7VjLeC1cPFdNAk6zaoQxjS4" http://localhost/api/login_check -d '{"username":"ahmed@mze.net","password":"password"}'`)

#### Lister les annonces

`curl --header "Content-Type: application/json" --header "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NDU4MzA4NzksImV4cCI6MTY0NTgzNDQ3OSwicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6ImFobWVkQG16ZS5uZXQifQ.OhETuR3e154WbXlXYdSGoeXz9U8l9nfTKxmytLEjv49M7ARVpOa4ai1Od6lnDuzYGN0qo5C5lLZzy4Qe7_d8iYQjEbcUz4v9oAH9NaKe_M15GsuLLDQSU3KxKI3G2rX7Hsu0IlcI1SzK0jctp2cWcHsulq_b3h3ou9hRgpyahVoIuMyD9bD0Nz9UGPSMG-i2G7Q9ZKvenSz_gdSGpQRSP3ddp1UdAcdsXzKT8xPQ44mday-MY_FSVtAhJ6gjyUVkyH-hUpCyWu4pOHqWPMQvhz1LJYtH8hTXXAsz8n2dkYhZ97FgkrV0pU-P8hez6piiymdEKGWj_FExZqwvIQaITIlsxqUOnStRGv9VfpFb2xkJIm1VlSA-r3aHIxNqINqtIQS9hbi0uoRmMmTKBgrPdARqjTN-JjTVH1UonBfA1UkM3nLDm9Z3_e5ksreoGB7oV3bUG_Jh9fEHk5rclTm1GfpFnKIPO7bp-ckW9AtdWBbUlLQUWKLOuBHl8EGI8UDrb-yENQMjD71WipZ6qxEOBJ0RHND7eGFoXrM4v23DicqLbAT_mArjQuCpElsdTOhINxVGnODqTSigoAptO6W-HkRoL0XYRkUGpgVO7Mci3CHzPLuU23h3MeqOExyYPo1nZkFkRdhvU3umYDALAYXu7VjLeC1cPFdNAk6zaoQxjS4" --request GET http://localhost/api/ad`

---

#### Récuperer une annonce

`curl --header "Content-Type: application/json" --header "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NDU4MzA4NzksImV4cCI6MTY0NTgzNDQ3OSwicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6ImFobWVkQG16ZS5uZXQifQ.OhETuR3e154WbXlXYdSGoeXz9U8l9nfTKxmytLEjv49M7ARVpOa4ai1Od6lnDuzYGN0qo5C5lLZzy4Qe7_d8iYQjEbcUz4v9oAH9NaKe_M15GsuLLDQSU3KxKI3G2rX7Hsu0IlcI1SzK0jctp2cWcHsulq_b3h3ou9hRgpyahVoIuMyD9bD0Nz9UGPSMG-i2G7Q9ZKvenSz_gdSGpQRSP3ddp1UdAcdsXzKT8xPQ44mday-MY_FSVtAhJ6gjyUVkyH-hUpCyWu4pOHqWPMQvhz1LJYtH8hTXXAsz8n2dkYhZ97FgkrV0pU-P8hez6piiymdEKGWj_FExZqwvIQaITIlsxqUOnStRGv9VfpFb2xkJIm1VlSA-r3aHIxNqINqtIQS9hbi0uoRmMmTKBgrPdARqjTN-JjTVH1UonBfA1UkM3nLDm9Z3_e5ksreoGB7oV3bUG_Jh9fEHk5rclTm1GfpFnKIPO7bp-ckW9AtdWBbUlLQUWKLOuBHl8EGI8UDrb-yENQMjD71WipZ6qxEOBJ0RHND7eGFoXrM4v23DicqLbAT_mArjQuCpElsdTOhINxVGnODqTSigoAptO6W-HkRoL0XYRkUGpgVO7Mci3CHzPLuU23h3MeqOExyYPo1nZkFkRdhvU3umYDALAYXu7VjLeC1cPFdNAk6zaoQxjS4" --request GET http://localhost/api/ad/1`

---

#### Publier une annonce

`curl --header "Content-Type: application/json" --header "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NDU4MzA4NzksImV4cCI6MTY0NTgzNDQ3OSwicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6ImFobWVkQG16ZS5uZXQifQ.OhETuR3e154WbXlXYdSGoeXz9U8l9nfTKxmytLEjv49M7ARVpOa4ai1Od6lnDuzYGN0qo5C5lLZzy4Qe7_d8iYQjEbcUz4v9oAH9NaKe_M15GsuLLDQSU3KxKI3G2rX7Hsu0IlcI1SzK0jctp2cWcHsulq_b3h3ou9hRgpyahVoIuMyD9bD0Nz9UGPSMG-i2G7Q9ZKvenSz_gdSGpQRSP3ddp1UdAcdsXzKT8xPQ44mday-MY_FSVtAhJ6gjyUVkyH-hUpCyWu4pOHqWPMQvhz1LJYtH8hTXXAsz8n2dkYhZ97FgkrV0pU-P8hez6piiymdEKGWj_FExZqwvIQaITIlsxqUOnStRGv9VfpFb2xkJIm1VlSA-r3aHIxNqINqtIQS9hbi0uoRmMmTKBgrPdARqjTN-JjTVH1UonBfA1UkM3nLDm9Z3_e5ksreoGB7oV3bUG_Jh9fEHk5rclTm1GfpFnKIPO7bp-ckW9AtdWBbUlLQUWKLOuBHl8EGI8UDrb-yENQMjD71WipZ6qxEOBJ0RHND7eGFoXrM4v23DicqLbAT_mArjQuCpElsdTOhINxVGnODqTSigoAptO6W-HkRoL0XYRkUGpgVO7Mci3CHzPLuU23h3MeqOExyYPo1nZkFkRdhvU3umYDALAYXu7VjLeC1cPFdNAk6zaoQxjS4" --request POST --data '{"title": "Titre CURL", "content": "Contenu CURL", "vehicle": {"id": 1}, "category": {"id": 2}}' http://localhost/api/ad/store`

---

#### Modifier une annonce

`curl --header "Content-Type: application/json" --header "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NDU4MzA4NzksImV4cCI6MTY0NTgzNDQ3OSwicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6ImFobWVkQG16ZS5uZXQifQ.OhETuR3e154WbXlXYdSGoeXz9U8l9nfTKxmytLEjv49M7ARVpOa4ai1Od6lnDuzYGN0qo5C5lLZzy4Qe7_d8iYQjEbcUz4v9oAH9NaKe_M15GsuLLDQSU3KxKI3G2rX7Hsu0IlcI1SzK0jctp2cWcHsulq_b3h3ou9hRgpyahVoIuMyD9bD0Nz9UGPSMG-i2G7Q9ZKvenSz_gdSGpQRSP3ddp1UdAcdsXzKT8xPQ44mday-MY_FSVtAhJ6gjyUVkyH-hUpCyWu4pOHqWPMQvhz1LJYtH8hTXXAsz8n2dkYhZ97FgkrV0pU-P8hez6piiymdEKGWj_FExZqwvIQaITIlsxqUOnStRGv9VfpFb2xkJIm1VlSA-r3aHIxNqINqtIQS9hbi0uoRmMmTKBgrPdARqjTN-JjTVH1UonBfA1UkM3nLDm9Z3_e5ksreoGB7oV3bUG_Jh9fEHk5rclTm1GfpFnKIPO7bp-ckW9AtdWBbUlLQUWKLOuBHl8EGI8UDrb-yENQMjD71WipZ6qxEOBJ0RHND7eGFoXrM4v23DicqLbAT_mArjQuCpElsdTOhINxVGnODqTSigoAptO6W-HkRoL0XYRkUGpgVO7Mci3CHzPLuU23h3MeqOExyYPo1nZkFkRdhvU3umYDALAYXu7VjLeC1cPFdNAk6zaoQxjS4" --request PATCH --data '{"id": 38, "title": "Titre CURL modifié"}' http://localhost/api/ad/38/edit`

---

#### Supprimer une annonce

`curl --header "Content-Type: application/json" --header "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NDU4MzA4NzksImV4cCI6MTY0NTgzNDQ3OSwicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6ImFobWVkQG16ZS5uZXQifQ.OhETuR3e154WbXlXYdSGoeXz9U8l9nfTKxmytLEjv49M7ARVpOa4ai1Od6lnDuzYGN0qo5C5lLZzy4Qe7_d8iYQjEbcUz4v9oAH9NaKe_M15GsuLLDQSU3KxKI3G2rX7Hsu0IlcI1SzK0jctp2cWcHsulq_b3h3ou9hRgpyahVoIuMyD9bD0Nz9UGPSMG-i2G7Q9ZKvenSz_gdSGpQRSP3ddp1UdAcdsXzKT8xPQ44mday-MY_FSVtAhJ6gjyUVkyH-hUpCyWu4pOHqWPMQvhz1LJYtH8hTXXAsz8n2dkYhZ97FgkrV0pU-P8hez6piiymdEKGWj_FExZqwvIQaITIlsxqUOnStRGv9VfpFb2xkJIm1VlSA-r3aHIxNqINqtIQS9hbi0uoRmMmTKBgrPdARqjTN-JjTVH1UonBfA1UkM3nLDm9Z3_e5ksreoGB7oV3bUG_Jh9fEHk5rclTm1GfpFnKIPO7bp-ckW9AtdWBbUlLQUWKLOuBHl8EGI8UDrb-yENQMjD71WipZ6qxEOBJ0RHND7eGFoXrM4v23DicqLbAT_mArjQuCpElsdTOhINxVGnODqTSigoAptO6W-HkRoL0XYRkUGpgVO7Mci3CHzPLuU23h3MeqOExyYPo1nZkFkRdhvU3umYDALAYXu7VjLeC1cPFdNAk6zaoQxjS4" --request DELETE http://localhost/api/ad/38/delete`

#### Rechercher un vehicule

Marques disponible: Audi, BMW, Citroen

`curl --header "Content-Type: application/json" --header "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NDU4MzA4NzksImV4cCI6MTY0NTgzNDQ3OSwicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6ImFobWVkQG16ZS5uZXQifQ.OhETuR3e154WbXlXYdSGoeXz9U8l9nfTKxmytLEjv49M7ARVpOa4ai1Od6lnDuzYGN0qo5C5lLZzy4Qe7_d8iYQjEbcUz4v9oAH9NaKe_M15GsuLLDQSU3KxKI3G2rX7Hsu0IlcI1SzK0jctp2cWcHsulq_b3h3ou9hRgpyahVoIuMyD9bD0Nz9UGPSMG-i2G7Q9ZKvenSz_gdSGpQRSP3ddp1UdAcdsXzKT8xPQ44mday-MY_FSVtAhJ6gjyUVkyH-hUpCyWu4pOHqWPMQvhz1LJYtH8hTXXAsz8n2dkYhZ97FgkrV0pU-P8hez6piiymdEKGWj_FExZqwvIQaITIlsxqUOnStRGv9VfpFb2xkJIm1VlSA-r3aHIxNqINqtIQS9hbi0uoRmMmTKBgrPdARqjTN-JjTVH1UonBfA1UkM3nLDm9Z3_e5ksreoGB7oV3bUG_Jh9fEHk5rclTm1GfpFnKIPO7bp-ckW9AtdWBbUlLQUWKLOuBHl8EGI8UDrb-yENQMjD71WipZ6qxEOBJ0RHND7eGFoXrM4v23DicqLbAT_mArjQuCpElsdTOhINxVGnODqTSigoAptO6W-HkRoL0XYRkUGpgVO7Mci3CHzPLuU23h3MeqOExyYPo1nZkFkRdhvU3umYDALAYXu7VjLeC1cPFdNAk6zaoQxjS4" --request GET http://localhost/api/search?q=rs`

Remplacer le parametre `?q=rs` par les models recherchés, exemple `?q=m6`, `?q=pica`, etc...
