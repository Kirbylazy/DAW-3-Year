# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Laravel 12 climbing competition management platform (Spanish locale). Users register for **Competiciones** (competitions) grouped into **Copas** (cups/leagues) held at **Ubicaciones** (venues with physical wall dimensions).

## Commands

```bash
# Full setup from scratch
composer run setup          # install deps, copy .env, key:generate, migrate, npm install, build

# Development (runs all services concurrently via concurrently)
composer run dev            # php artisan serve + queue:listen + pail + npm run dev (Vite HMR)

# Frontend only
npm run dev                 # Vite dev server with HMR
npm run build               # Production asset build

# Database
php artisan migrate
php artisan migrate:fresh --seed   # Wipe and re-seed (uses DatabaseSeeder)
php artisan db:seed

# Tests
composer run test           # config:clear + php artisan test
php artisan test --filter TestName  # Run a single test
```

## Architecture

**Stack:** Laravel 12, PHP 8.2+, MySQL, Blade + Bootstrap 5 (CDN), Alpine.js, Vite.

> Note: Tailwind CSS is installed as a dev dependency but the app uses Bootstrap 5 via CDN. Do not mix them — stick with Bootstrap.

**Auth:** Laravel Breeze (session-based). All domain routes require `auth` middleware.

### Domain Model

```
Copa (cup/league)
  → hasMany Competicion

Ubicacion (venue: name, provincia, direccion, alto, ancho, n_lineas)
  → hasMany Competicion

Competicion (competition)
  → belongsTo Copa
  → belongsTo Ubicacion
  → belongsToMany User (pivot: competicions_users with tipoDato, dato columns)

User
  → belongsToMany Competicion
```

The pivot table `competicions_users` has a unique constraint on `(user_id, competicion_id)` and stores a `tipoDato`/`dato` pair (result type + value).

### Key Files

| Path | Purpose |
|---|---|
| `routes/web.php` | All routes: dashboard (paginated upcoming competitions), profile CRUD, auth |
| `app/Models/` | `Competicion`, `Copa`, `Ubicacion`, `User` |
| `app/Http/Controllers/` | `CompeticionController`, `CopaController`, `UbicacionController` — **currently empty scaffolds** |
| `resources/views/dashboard.blade.php` | Card grid of upcoming competitions with pagination |
| `resources/views/layouts/app.blade.php` | Main Bootstrap 5 layout with navbar |
| `database/seeders/DatabaseSeeder.php` | Creates 2 copas, 6 ubicaciones, 6 competiciones, 300 users |

### Current State / WIP

- The three domain controllers (`CompeticionController`, `CopaController`, `UbicacionController`) are empty — the main development work is implementing these.
- The "Inscribirme" (register) button on the dashboard is disabled ("próximamente") — user enrollment logic is not yet implemented.
- There is a duplicate `/dashboard` route in `web.php`; the second definition (with `Competicion::query()`) is the active one.
- No API routes exist.
- Tests are all Breeze-generated boilerplate; no domain tests have been written.

## Database

- Connection: MySQL, database `escalada`, user `root`, no password (local dev).
- Session, cache, and queue all use the `database` driver.
- App locale: `es` / `es_ES`.
