# Panel de Control de Citas

Este proyecto es un panel de control para la gestión de citas de profesionales de la salud. Fue desarrollado como prueba técnica utilizando **Laravel 10+** en el backend e integrado con **Vue 3 (Composition API)** en el frontend.

---

## Tecnologías utilizadas

- **PHP 8.2+**
- **Laravel 10+**
- **Vue 3** + **Vite** (Composition API)
- **JavaScript**
- **Blade**
- **Node.js 20.X** y **npm**
- **MySQL** o **SQLite**
- Opcional: **Laragon** / **XAMPP** / **WAMP** como entorno local

---

## Instalación y ejecución local

Sigue los siguientes pasos para ejecutar el proyecto en tu entorno local:

```bash
git clone https://github.com/nazasosaro/panel-control-citas.git
```
```bash
cd panel-control-citas
```
```bash
composer install
```
```bash
cp .env.example .env
```
```bash
php artisan key:generate
```
```bash
npm install
```
```bash
npm run dev
```

## Configura tu conexión a base de datos en el archivo `.env` y ejecuta las migraciones con:

```bash
php artisan migrate
```