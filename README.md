# ImpulsePHP Starter Project

This repository is a minimal starter project for ImpulsePHP. It includes a simple layout, example page and minimal tooling to get started quickly.

## Requirements

- PHP 8.2+
- Composer
- (Optional) Node.js + npm for building Tailwind CSS

## Installation

1. Clone the repository:

```bash
git clone <repo-url> my-project
cd my-project
```

2. Install PHP dependencies:

```bash
composer install
```

The Composer `post-install-cmd` will create symlinks for the `impulse.js` runtime into `public/` if the `impulsephp/js` package is available in `vendor/`.

3. (Optional) Install Node dependencies and build Tailwind CSS:

```bash
npm install
npm run watch:css # builds and watches assets/css -> public/css/main.css
```

## Running locally

A simple way to run the project locally is to use PHP's built-in web server from the project root:

```bash
php -S localhost:8000 -t public
```

Then open http://localhost:8000 in your browser.

## Project structure (relevant files)

- `public/` — front controller and public assets
- `views/` — Blade-like templates (`views/layouts/default.blade.php`, `views/pages/index.blade.php`)
- `src/` — application code
- `composer.json` — PHP dependencies and post-install scripts
- `package.json` — Node scripts (Tailwind CSS)

## Tips

- If you add new Composer path packages (like the local `impulsephp/*` packages), run `composer dump-autoload`.
- The project uses a minimal layout in `views/layouts/default.blade.php`. Customize it to fit your needs and add components in `views/`.

## License

MIT

