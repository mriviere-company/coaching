# Coaching — image-only website for a client

*[Version française plus bas](#français)*

A client project from 2022, built with **Symfony 6.1 / PHP 8.1**, Twig and Doctrine. The
brief was unusual: the client wanted a website made **only of images**, which he could
replace, add or reorder himself.

## What it does

- Public pages made of images, each page and its images managed from an **admin panel**.
- Admin **authentication** (Symfony Security).
- A simple **visit tracker** per page, to show the client which pages are viewed.

## Run it

```bash
composer install
yarn install && yarn build          # Webpack Encore assets
php bin/console doctrine:migrations:migrate
symfony server:start
```

A `docker-compose.yml` provides the PostgreSQL database for local development.

---

<a id="français"></a>

# Coaching — site 100 % images pour un client

Projet client de 2022, en **Symfony 6.1 / PHP 8.1**, avec Twig et Doctrine. La demande
était originale : le client voulait un site composé **uniquement d'images**, qu'il pourrait
remplacer, ajouter ou réorganiser lui-même.

## Ce qu'il fait

- Des pages publiques composées d'images, chaque page et ses images gérées depuis un
  **panneau d'administration**.
- Une **authentification** de l'administrateur (Symfony Security).
- Un **suivi simple des visites** par page, pour montrer au client les pages consultées.
