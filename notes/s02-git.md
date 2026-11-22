# Session 02 - Git et GitHub

Réponses rédigées avec mes propres mots, puis comparées au corrigé de la page.

## 1. Index et commit

`git add` fait passer les fichiers de l'arbre de travail vers l'index (zone de préparation) : c'est là qu'on choisit ce qui sera enregistré. `git commit` crée un instantané permanent de l'index dans le dépôt local, avec un identifiant et un message. `git push` envoie ensuite ces commits vers le dépôt distant GitHub.

## 2. Branche et tag

Une branche avance avec chaque nouveau commit : elle pointe toujours vers le dernier commit de la lignée. Un tag, lui, est fixé une fois pour toutes sur un commit précis : `lab-01` désigne toujours l'état exact du projet à la fin de la séance 01, même si `main` continue d'évoluer.

## 3. Le fichier .env

`.env` contient `APP_KEY`, les réglages propres à la machine et les secrets (accès base de données, clés d'API). Il ne doit jamais être versionné ni poussé sur GitHub. Un autre développeur copie `.env.example` vers `.env`, puis lance `php artisan key:generate` pour créer sa propre clé.

## 4. Le dossier vendor/

`vendor/` contient toutes les dépendances Composer. Il est volumineux et entièrement généré : on ne le modifie jamais à la main et on ne le versionne pas. `composer install` le reconstruit à l'identique en utilisant les versions exactes figées dans `composer.lock`.

## 5. Git Credential Manager

Git Credential Manager (GCM) stocke le jeton GitHub dans le Gestionnaire d'identifiants Windows (entrée `git:https://github.com`). Sur un poste partagé du laboratoire, il faut supprimer cette entrée en fin de séance : la personne suivante pourrait pousser avec mon identité. Sur un ordinateur personnel, on peut la conserver.

## 6. Historique depuis lab-01

Nombre de commits depuis lab-01 : 5 commits (page a-propos, capture d'écran, README, documentation des routes, notes Git).

Fichiers modifiés depuis lab-01 : `notes/s02-git.md`, `routes/web.php`, `resources/views/a-propos.blade.php`, `screenshots/s02-a-propos.png`, `README.md`.

Ce que `git tag -n` affiche pour lab-01 : `lab-01` suivi du message du commit qu'il désigne, c'est-à-dire `feat: bootstrap Laravel 13 Mini-CMS with initial routes, Blade views and lifecycle notes (lab-01)`.
