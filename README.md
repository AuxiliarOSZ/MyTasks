# MyTasks - Gestión de Tareas con Laravel

Este proyecto fue desarrollado como ejercicio práctico para aplicar los conocimientos fundamentales en Laravel, incluyendo la creación de modelos, controladores, rutas, vistas y el uso de middleware. Además, se sentaron las bases para futuras mejoras escalables.

## Funcionalidades Implementadas

- **Gestión de Tareas:** Crear, visualizar, editar y eliminar tareas. Las tareas pueden tener fechas de vencimiento, prioridades, estados y etiquetas asociadas.
- **Gestión de Proyectos:** Creación y administración de proyectos. Cada tarea pertenece a un proyecto.
- **Gestión de Etiquetas:** Posibilidad de asociar múltiples etiquetas a cada tarea para mejorar su clasificación.
- **Autenticación:** Uso de middleware `auth` y `verified` para proteger rutas y garantizar acceso únicamente a usuarios autenticados.
- **Relaciones entre modelos:** Se establecieron relaciones uno a muchos y muchos a muchos utilizando Eloquent, permitiendo consultas eficientes y organización lógica de los datos.

## Estructura Técnica

- **Modelos Eloquent:** Tareas, Proyectos, Etiquetas, Estados, Prioridades.
- **Controladores:** Separación clara entre lógica de negocio y vistas.
- **Vistas Blade:** Interfaces limpias con Tailwind CSS.
- **Middleware:** Protección de rutas para garantizar seguridad y control de acceso.
- **Rutas Web:** Organización clara y modular usando `Route::controller()` y agrupadas por middleware.

## Escalabilidad

El sistema fue diseñado con una estructura  flexible, lo que permite su crecimiento a futuro. Entre las funcionalidades planificadas a futuro se contempla:

- **Proyectos colaborativos:** Asociación de múltiples usuarios a un mismo proyecto.
- **Notificaciones y recordatorios.**
- **Sistema de comentarios y archivos adjuntos.**

## Requisitos

- PHP 8.1+
- Laravel 11
- Composer
- PostgreSQL.
- Node.js & NPM (para recursos frontend)

## Instalación

```bash
git clone https://github.com/tu-usuario/mytasks.git
cd mytasks
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
