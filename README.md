
# Projet de démarrage ImpulsePHP

Ce dépôt est un projet minimal prêt à l'emploi pour démarrer avec ImpulsePHP. Il contient un layout simple, une page d'exemple et quelques outils minimaux pour commencer rapidement.

## Prérequis

- PHP 8.2+
- Composer
- (Optionnel) Node.js et npm pour compiler Tailwind CSS

## Installation

1. Cloner le dépôt :

```bash
git clone <repo-url> mon-projet
cd mon-projet
```

2. Installer les dépendances PHP :

```bash
composer install
```

Le script `post-install-cmd` défini dans `composer.json` crée des liens symboliques vers `public/impulse.js` si le paquet `impulsephp/js` est présent dans `vendor/`.

3. (Optionnel) Installer les dépendances Node et construire Tailwind CSS :

```bash
npm install
npm run watch:css # génère et surveille assets/css -> public/css/main.css
```

## Exécuter en local

Vous pouvez utiliser le serveur PHP intégré depuis la racine du projet :

```bash
php -S localhost:8000 -t public
```

Puis ouvrez http://localhost:8000 dans votre navigateur.

## Structure du projet (fichiers importants)

- `public/` — front controller et assets publics
- `views/` — templates de type Blade (`views/layouts/default.blade.php`, `views/pages/index.blade.php`)
- `src/` — code applicatif (pages / contrôleurs)
- `composer.json` — dépendances PHP et scripts post-install
- `package.json` — scripts Node (Tailwind CSS)

## Conseils

- Si vous n'utilisez pas Tailwind, placez un fichier CSS compatible dans `public/css/main.css` ou modifiez le lien dans le layout.
- Après ajout ou modification de packages locaux (dossiers `impulsephp/*`), exécutez `composer dump-autoload`.

## Licence

MIT

