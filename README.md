# 📓 App Notas Pract

> Sistema profesional de gestión de notas desarrollado en PHP vanilla, implementando arquitectura MVC y mejores prácticas de desarrollo web.

[![PHP](https://img.shields.io/badge/PHP-8.0%2B-777BB4?style=flat&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0%2B-4479A1?style=flat&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v4-38B2AC?style=flat&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)
[![Status](https://img.shields.io/badge/Status-En%20Desarrollo-yellow)](https://github.com)

---

## 📋 Tabla de Contenidos

- [Descripción](#-descripción)
- [Características](#-características)
- [Demo Visual](#-demo-visual)
- [Requisitos](#-requisitos)
- [Instalación](#-instalación)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [Arquitectura](#-arquitectura)
- [Base de Datos](#-base-de-datos)
- [Conceptos Avanzados](#-conceptos-avanzados)
- [Seguridad](#-seguridad)
- [Roadmap](#-roadmap)
- [Contribución](#-contribución)

---

## 🎯 Descripción

**App Notas Pract** es un proyecto educativo que implementa un sistema completo de gestión de notas personales usando **PHP puro** (sin frameworks). Diseñado para demostrar la correcta implementación del patrón **MVC**, manejo profesional de bases de datos con **PDO**, sistema de ruteo dinámico, y principios de **clean code**.

El proyecto está construido desde cero sin dependencias de frameworks, lo que permite entender profundamente los fundamentos de desarrollo web en PHP.

### 🎓 Propósito Educativo

Este proyecto sirve como referencia para aprender:

- ✅ Arquitectura MVC sin frameworks
- ✅ Sistema de ruteo personalizado
- ✅ Manejo de bases de datos con PDO
- ✅ Validaciones de entrada robustas
- ✅ Separación de responsabilidades
- ✅ Helpers y funciones reutilizables
- ✅ Manejo profesional de errores HTTP

---

## ✨ Características

### Funcionalidades Implementadas

- ✅ **CRUD de Notas Completo**
  - Crear notas con validación (1-1000 caracteres)
  - Visualizar listado de notas del usuario
  - Ver detalle individual de cada nota
  - Control de acceso por usuario (user_id)

- ✅ **Sistema de Navegación**
  - Página de inicio (Home)
  - Página About Us
  - Gestión de notas
  - Página de contacto
  - Navegación responsive con menú móvil

### Arquitectura Técnica

- 🏗️ **Patrón MVC Puro**: Separación total de lógica, presentación y datos
- 🛣️ **Front Controller Pattern**: Punto de entrada único con `index.php`
- 🗺️ **Sistema de Ruteo Dinámico**: Mapeo de URLs a controladores mediante `routes.php`
- 🔒 **Seguridad Multi-capa**:
  - Consultas preparadas (PDO)
  - Validación de entrada con clase `Validator`
  - Protección XSS con `htmlspecialchars()`
  - Sistema de autorización básico
- 🎨 **UI Moderna**: Interfaz responsive con Tailwind CSS v4
- 📦 **Código Modular**: Helpers globales y componentes reutilizables
- 🔄 **URLs Limpias**: Configuración Apache con `.htaccess`

---

## 🖼️ Demo Visual

### Vista de Listado de Notas

```
┌─────────────────────────────────────────┐
│  📝 My Notes                            │
├─────────────────────────────────────────┤
│  ┌───────────────────────────────────┐  │
│  │ 📄 Mi primera nota               │  │
│  │ Click para ver los detalles...   │  │
│  │ [Ver nota →]                     │  │
│  └───────────────────────────────────┘  │
│  ┌───────────────────────────────────┐  │
│  │ 📄 Ideas para el proyecto        │  │
│  │ Click para ver los detalles...   │  │
│  │ [Ver nota →]                     │  │
│  └───────────────────────────────────┘  │
│                                         │
│  [+ Crear Nota Nueva]                  │
└─────────────────────────────────────────┘
```

---

## 🛠️ Requisitos

### Requisitos del Sistema

| Componente      | Versión Mínima | Recomendada |
| --------------- | -------------- | ----------- |
| **PHP**         | 8.0            | 8.2+        |
| **Apache**      | 2.4            | 2.4.54+     |
| **MySQL**       | 8.0            | 8.0.32+     |
| **mod_rewrite** | Habilitado     | Habilitado  |

### Extensiones PHP Requeridas

```ini
extension=pdo_mysql
extension=mbstring
```

### Servidor Local Recomendado

- XAMPP 8.0+
- Laragon
- WAMP Server
- MAMP

---

## 🚀 Instalación

### 1. Clonar el Proyecto

```bash
git clone https://github.com/tu-usuario/app_notas_pract.git
cd app_notas_pract
```

### 2. Configurar Base de Datos

**Crear la base de datos:**

```sql
CREATE DATABASE pnotas CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE pnotas;
```

**Ejecutar el schema SQL:**

```sql
-- Tabla de usuarios
CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla de notas
CREATE TABLE `notes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `body` TEXT NOT NULL,
  `user_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  CONSTRAINT `fk_user_notes` FOREIGN KEY (`user_id`)
    REFERENCES `users` (`id`)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

**Insertar datos de prueba:**

```sql
-- Usuario de prueba
INSERT INTO users (id, name, email) VALUES
(1, 'Admin User', 'admin@example.com'),
(2, 'Demo User', 'demo@example.com');

-- Notas de ejemplo
INSERT INTO notes (body, user_id) VALUES
('Esta es mi primera nota de prueba', 2),
('Recordar: Aprender más sobre PHP y MVC', 2),
('Ideas para mejorar el proyecto: añadir autenticación', 2);
```

### 3. Configurar Credenciales

Editar `config.php`:

```php
<?php
// config.php

return [
    'database' => [
        'host' => 'localhost',
        'port' => 3306,
        'dbname' => 'pnotas',
        'charset' => 'utf8mb4'
    ],
    'user' => 'notesuser',      // Tu usuario de MySQL
    'password' => ''             // Tu contraseña de MySQL
];
```

> **💡 Tip:** Para entornos de producción, considera usar variables de entorno en lugar de hardcodear credenciales.

### 4. Configurar Apache

**Verificar `.htaccess`:**

```apache
RewriteEngine On
RewriteBase /app_notas_pract/

# Si no es un archivo o carpeta real, mándalo todo al index.php
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```

> ⚠️ **Importante:** Ajusta `RewriteBase` según la ubicación de tu proyecto:
>
> - Si está en la raíz: `/`
> - Si está en subcarpeta: `/nombre_carpeta/`

### 5. Verificar Permisos (Linux/Mac)

```bash
chmod 755 app_notas_pract
```

### 6. Acceder a la Aplicación

```
http://localhost/app_notas_pract
```

---

## 📂 Estructura del Proyecto

```
app_notas_pract/
│
├── 🔧 Core Application
│   ├── index.php                  # Front Controller (punto de entrada)
│   ├── router.php                 # Sistema de enrutamiento
│   ├── routes.php                 # Definición de rutas
│   ├── functions.php              # Helpers globales
│   └── config.php                 # Configuración de aplicación
│
├── 📊 Data Access Layer
│   ├── Database.php               # Clase wrapper de PDO
│   ├── Response.php               # Códigos de respuesta HTTP
│   └── Validator.php              # Validaciones de entrada
│
├── 🎮 Controllers
│   ├── index.php                  # Controlador de home
│   ├── about.php                  # Página about
│   ├── contact.php                # Página contacto
│   └── notes/
│       ├── index.php              # Listado de notas
│       ├── show.php               # Detalle de nota individual
│       └── create.php             # Crear nueva nota
│
├── 🎨 Views (Presentation Layer)
│   ├── index.view.php             # Vista home
│   ├── about.view.php             # Vista about
│   ├── contact.view.php           # Vista contacto
│   ├── 403.php                    # Error de autorización
│   ├── 404.php                    # Página no encontrada
│   ├── notes/
│   │   ├── notes.view.php         # Lista de notas
│   │   ├── note.view.php          # Detalle de nota
│   │   └── note-create.view.php  # Formulario de creación
│   └── partials/
│       ├── head.php               # <head> con meta tags y CSS
│       ├── nav.php                # Navegación principal
│       ├── banner.php             # Hero section / Page header
│       └── footer.php             # Pie de página
│
├── ⚙️ Configuration
│   ├── .htaccess                  # Configuración Apache
│   └── .gitignore                 # Archivos ignorados por Git
│
└── 📖 Documentation
    ├── README.md
    ├── estructura_proyecto.txt
    └── proyecto_completo.txt
```

---

## 🏗️ Arquitectura

### Patrón MVC Implementado

```
┌──────────────────────────────────────────────────────────┐
│                      USER REQUEST                        │
│                  (http://localhost/notes)                │
└────────────────────────┬─────────────────────────────────┘
                         ▼
┌─────────────────────────────────────────────────────────┐
│              FRONT CONTROLLER (index.php)               │
│  1. Carga configuración y clases                        │
│  2. Inicializa conexión a BD                            │
│  3. Extrae URI de la petición                           │
└────────────────────────┬────────────────────────────────┘
                         ▼
┌─────────────────────────────────────────────────────────┐
│                  ROUTER (router.php)                    │
│  • Lee el mapa de rutas (routes.php)                    │
│  • Asocia URI con controlador                           │
│  • Despacha el controlador correspondiente              │
└────────────────────────┬────────────────────────────────┘
                         ▼
┌─────────────────────────────────────────────────────────┐
│           CONTROLLER (notes/index.php)                  │
│  • Recibe la petición                                   │
│  • Valida datos de entrada                              │
│  • Interactúa con el modelo (Database)                  │
│  • Prepara datos para la vista                          │
└──────────┬──────────────────────────────┬───────────────┘
           ▼                              ▼
┌──────────────────────┐      ┌──────────────────────────┐
│   MODEL (Database)   │      │   VIEW (notes.view.php)  │
│  • Query a BD        │      │  • Recibe datos del      │
│  • PDO preparado     │      │    controlador           │
│  • Retorna datos     │      │  • Renderiza HTML        │
└──────────────────────┘      │  • Usa partials          │
                              └────────────┬─────────────┘
                                           ▼
                              ┌──────────────────────────┐
                              │    RESPONSE (HTML)       │
                              │  Enviado al navegador    │
                              └──────────────────────────┘
```

### Flujo Detallado de una Request

#### Ejemplo: Crear una nota nueva

1. **Request HTTP**

   ```
   POST /app_notas_pract/notes/create
   Body: { body: "Mi nueva nota" }
   ```

2. **Front Controller (`index.php`)**

   ```php
   require 'functions.php';
   require 'Database.php';
   require 'Response.php';

   $config = require 'config.php';
   $db = new Database($config);

   $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
   $routes = require 'routes.php';

   routeToController($uri, $routes);
   ```

3. **Router (`router.php`)**

   ```php
   // Busca en routes.php
   '/notes/create' => 'controllers/notes/create.php'

   // Incluye el controlador
   require base_path('controllers/notes/create.php');
   ```

4. **Controller (`controllers/notes/create.php`)**

   ```php
   // Valida datos
   if (!Validator::string($_POST['body'], 1, 1000)) {
       $errors['body'] = 'Error de validación';
   }

   // Inserta en BD
   $db->query("INSERT INTO notes...", [...]);

   // Redirige
   header('Location: /notes');
   ```

5. **Model (`Database.php`)**

   ```php
   public function query($query, $params = []) {
       $this->statement = $this->connection->prepare($query);
       $this->statement->execute($params);
       return $this;
   }
   ```

6. **Response**
   ```
   HTTP/1.1 302 Found
   Location: /app_notas_pract/notes
   ```

---

## 💾 Base de Datos

### Diagrama Entidad-Relación

```
┌─────────────────────┐         ┌─────────────────────┐
│       USERS         │         │       NOTES         │
├─────────────────────┤         ├─────────────────────┤
│ 🔑 id (PK)         │◄───────┤│ 🔑 id (PK)         │
│ 📧 email (UNIQUE)  │    1:N  │ 📝 body             │
│ 👤 name            │         │ 🔗 user_id (FK)     │
│ 📅 created_at      │         │ 📅 created_at       │
│ 📅 updated_at      │         │ 📅 updated_at       │
└─────────────────────┘         └─────────────────────┘
```

### Descripción de Tablas

#### Tabla: `users`

```sql
CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB;
```

| Campo        | Tipo         | Descripción                     |
| ------------ | ------------ | ------------------------------- |
| `id`         | INT (PK)     | Identificador único del usuario |
| `name`       | VARCHAR(255) | Nombre completo del usuario     |
| `email`      | VARCHAR(255) | Email único (usado para login)  |
| `created_at` | TIMESTAMP    | Fecha de registro               |
| `updated_at` | TIMESTAMP    | Última actualización            |

#### Tabla: `notes`

```sql
CREATE TABLE `notes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `body` TEXT NOT NULL,
  `user_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  CONSTRAINT `fk_user_notes` FOREIGN KEY (`user_id`)
    REFERENCES `users` (`id`)
    ON DELETE CASCADE
) ENGINE=InnoDB;
```

| Campo        | Tipo      | Descripción                         |
| ------------ | --------- | ----------------------------------- |
| `id`         | INT (PK)  | Identificador único de la nota      |
| `body`       | TEXT      | Contenido de la nota (1-1000 chars) |
| `user_id`    | INT (FK)  | Relación con tabla users            |
| `created_at` | TIMESTAMP | Fecha de creación                   |
| `updated_at` | TIMESTAMP | Última modificación                 |

### Relaciones

- **1:N** - Un usuario puede tener muchas notas
- **CASCADE DELETE** - Si se elimina un usuario, se eliminan sus notas

---

## 🎓 Conceptos Avanzados

### 1. Sistema de Helpers Globales

**`functions.php`** - Funciones reutilizables en toda la aplicación

#### Helper: `base_path()`

```php
const BASE_PATH = __DIR__ . '/';

function base_path($path) {
    return BASE_PATH . $path;
}

// Uso:
require base_path('Database.php');
require base_path('views/partials/head.php');
```

**Beneficio:** Evita errores de rutas relativas al navegar por subdirectorios.

#### Helper: `view()`

```php
function view($path, $attributes = []) {
    extract($attributes);
    require base_path('views/' . $path);
}

// Uso en controlador:
view('notes/show.view.php', [
    'heading' => 'Detalle de Nota',
    'note' => $note
]);
```

**Beneficio:** Inyección limpia de datos desde controlador a vista.

#### Helper: `abort()`

```php
function abort($code = 404) {
    http_response_code($code);
    require base_path("views/{$code}.php");
    die();
}

// Uso:
if (!$note) {
    abort(404);
}
```

**Beneficio:** Manejo centralizado de errores HTTP.

#### Helper: `urlIs()`

```php
function urlIs($value) {
    return $_SERVER['REQUEST_URI'] === $value;
}

// Uso en navegación:
class="<?= urlIs('/notes') ? 'active' : '' ?>"
```

**Beneficio:** Resaltar la página activa en la navegación.

#### Helper: `authorize()`

```php
function authorize($condition, $status = Response::FORBIDDEN) {
    if (!$condition) {
        abort($status);
    }
}

// Uso:
authorize($note['user_id'] === $currentUserId);
```

**Beneficio:** Sistema de autorización simple pero efectivo.

---

### 2. Abstracción de Base de Datos

**`Database.php`** - Wrapper profesional de PDO

```php
class Database {
    public $connection;
    public $statement;

    public function __construct($config, $username = 'root', $password = '') {
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    public function query($query, $params = []) {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);
        return $this;
    }

    public function get() {
        return $this->statement->fetchAll();
    }

    public function find() {
        return $this->statement->fetch();
    }

    public function findOrFail() {
        $result = $this->find();
        if (!$result) {
            abort();
        }
        return $result;
    }
}
```

**Uso:**

```php
// Obtener todas las notas del usuario
$notes = $db->query(
    "SELECT * FROM notes WHERE user_id = :user_id",
    ['user_id' => $currentUserId]
)->get();

// Obtener una nota específica o 404
$note = $db->query(
    "SELECT * FROM notes WHERE id = :id",
    ['id' => $_GET['id']]
)->findOrFail();

// Insertar nueva nota
$db->query(
    "INSERT INTO notes(body, user_id) VALUES(:body, :user_id)",
    [
        'body' => $_POST['body'],
        'user_id' => $currentUserId
    ]
);
```

---

### 3. Sistema de Validaciones

**`Validator.php`** - Validación de entrada robusta

```php
class Validator {
    /**
     * Valida que un string esté dentro de un rango de longitud
     */
    public static function string($value, $min = 1, $max = INF) {
        $value = trim($value);
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    /**
     * Valida formato de email
     */
    public static function email($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
```

**Uso en controladores:**

```php
$errors = [];

// Validar campo body
if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'El contenido debe tener entre 1 y 1000 caracteres.';
}

// Validar email
if (!Validator::email($_POST['email'])) {
    $errors['email'] = 'Email inválido.';
}

// Solo proceder si no hay errores
if (empty($errors)) {
    // Guardar en BD
}
```

**Mostrar errores en vista:**

```php
<?php if (isset($errors['body'])): ?>
    <p class="text-red-500 text-xs mt-2">
        <?= $errors['body'] ?>
    </p>
<?php endif; ?>
```

---

### 4. Sistema de Ruteo Dinámico

**`routes.php`** - Mapa de rutas

```php
<?php

return [
    '/app_notas_pract/' => 'controllers/index.php',
    '/app_notas_pract/about' => 'controllers/about.php',
    '/app_notas_pract/contact' => 'controllers/contact.php',
    '/app_notas_pract/notes' => 'controllers/notes/index.php',
    '/app_notas_pract/note' => 'controllers/notes/show.php',
    '/app_notas_pract/notes/create' => 'controllers/notes/create.php',
];
```

**`router.php`** - Despachador de rutas

```php
<?php

function routeToController($uri, $routes) {
    if (array_key_exists($uri, $routes)) {
        require base_path($routes[$uri]);
    } else {
        abort(Response::NOT_FOUND);
    }
}

// Uso en index.php
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$routes = require base_path('routes.php');

routeToController($uri, $routes);
```

**Beneficios:**

- ✅ Fácil agregar nuevas rutas
- ✅ Separación de responsabilidades
- ✅ Mantenibilidad mejorada
- ✅ Similar a frameworks modernos (Laravel, Symfony)

---

### 5. Sistema de Componentes (Partials)

**Estructura modular de vistas:**

```php
<!-- views/notes/notes.view.php -->
<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <!-- Contenido específico de la página -->
</main>

<?php require base_path('views/partials/footer.php') ?>
```

**Beneficios:**

- 🔄 Reutilización de código
- 🎨 Consistencia visual
- 🛠️ Fácil mantenimiento
- 📱 Responsive design centralizado

---

## 🔐 Seguridad

### 1. Consultas Preparadas (PDO)

❌ **Forma insegura (Vulnerable a SQL Injection):**

```php
$id = $_GET['id'];
$query = "SELECT * FROM notes WHERE id = $id";
$result = mysqli_query($conn, $query);
```

✅ **Forma segura (PDO con parámetros vinculados):**

```php
$note = $db->query(
    "SELECT * FROM notes WHERE id = :id",
    ['id' => $_GET['id']]
)->find();
```

### 2. Protección XSS

❌ **Vulnerable a Cross-Site Scripting:**

```php
<p><?= $note['body'] ?></p>
```

✅ **Protegido con escapado:**

```php
<p><?= htmlspecialchars($note['body'], ENT_QUOTES, 'UTF-8') ?></p>
```

### 3. Validación de Entrada

```php
// Validar antes de insertar
if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'Contenido inválido';
}

if (empty($errors)) {
    // Solo entonces guardar en BD
}
```

### 4. Control de Acceso

```php
// Verificar que la nota pertenezca al usuario actual
$note = $db->query(
    "SELECT * FROM notes WHERE id = :id",
    ['id' => $_GET['id']]
)->findOrFail();

authorize($note['user_id'] === $currentUserId);
```

### 5. Códigos HTTP Apropiados

```php
class Response {
    const NOT_FOUND = 404;
    const FORBIDDEN = 403;
    const UNAUTHORIZED = 401;
    const SERVER_ERROR = 500;
}
```

### 6. Configuración Segura de PDO

```php
$this->connection = new PDO($dsn, $username, $password, [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
]);
```

---

## 🗺️ Roadmap

### ✅ Fase 1: Fundamentos (Completado)

- [x] Arquitectura MVC base
- [x] Sistema de ruteo dinámico
- [x] Conexión a base de datos con PDO
- [x] CRUD parcial de notas (Create, Read)
- [x] Helpers globales (base_path, view, abort, etc.)
- [x] Validaciones de entrada
- [x] Manejo de errores HTTP (403, 404)
- [x] UI responsive con Tailwind CSS
- [x] Sistema de componentes (partials)

### 🚧 Fase 2: Autenticación (En Desarrollo)

- [ ] Sistema de registro de usuarios
  - [ ] Formulario de registro
  - [ ] Hash de contraseñas con `password_hash()`
  - [ ] Validación de email único
- [ ] Sistema de login
  - [ ] Formulario de inicio de sesión
  - [ ] Verificación de contraseñas
  - [ ] Manejo de sesiones (`$_SESSION`)
- [ ] Middleware de autenticación
  - [ ] Proteger rutas privadas
  - [ ] Redirección a login si no autenticado
- [ ] Sistema de logout
- [ ] Recordar sesión ("Remember me")

### 📅 Fase 3: CRUD Completo (Próximo)

- [ ] Editar notas
  - [ ] Formulario de edición
  - [ ] Validación de permisos
  - [ ] Actualización en BD
- [ ] Eliminar notas
  - [ ] Confirmación de eliminación
  - [ ] Soft delete vs hard delete
- [ ] Búsqueda de notas
  - [ ] Filtro por contenido
  - [ ] Filtro por fecha

### 🎯 Fase 4: Mejoras UX (Futuro)

- [ ] Sistema de flash messages
- [ ] Paginación de listados
- [ ] Ordenamiento de notas
- [ ] Categorías/etiquetas
- [ ] Exportar notas (PDF, TXT)
- [ ] Modo oscuro/claro

### 🔒 Fase 5: Seguridad Avanzada (Futuro)

- [ ] CSRF Protection
- [ ] Rate limiting
- [ ] Validación de tipos MIME en uploads
- [ ] Headers de seguridad (CSP, X-Frame-Options)
- [ ] Logging de actividad

### 🚀 Fase 6: Optimización (Futuro)

- [ ] Caché de consultas
- [ ] Lazy loading de imágenes
- [ ] Minificación de assets
- [ ] CDN para assets estáticos

---

## 📚 Aprendizajes Clave

### Conceptos Aplicados

1. **Separation of Concerns**
   - Controladores: Lógica de negocio
   - Modelos: Acceso a datos
   - Vistas: Presentación

2. **DRY (Don't Repeat Yourself)**
   - Helpers reutilizables
   - Componentes partials
   - Clase Database genérica

3. **Single Responsibility Principle**
   - Cada clase tiene una responsabilidad única
   - Validator solo valida
   - Database solo maneja persistencia

4. **Dependency Injection**
   - `$db` se pasa a controladores
   - Configuración externa en `config.php`

5. **RESTful Principles**
   - URLs descriptivas
   - Métodos HTTP apropiados (GET, POST)
   - Códigos de estado correctos

---

## 🤝 Contribución

Este proyecto es educativo y acepta contribuciones. Si deseas mejorar algo:

### Proceso de Contribución

1. **Fork** el repositorio
2. **Crea una rama** feature
   ```bash
   git checkout -b feature/nueva-funcionalidad
   ```
3. **Commit** tus cambios
   ```bash
   git commit -m 'Añadir: nueva funcionalidad X'
   ```
4. **Push** a la rama
   ```bash
   git push origin feature/nueva-funcionalidad
   ```
5. **Abre un Pull Request**

### Áreas de Mejora Sugeridas

- 📝 Agregar comentarios PHPDoc
- 🧪 Implementar tests unitarios
- 🎨 Mejorar el diseño UI/UX
- 🔒 Fortalecer medidas de seguridad
- 📖 Ampliar documentación
- ♿ Mejorar accesibilidad (ARIA, semántica)

---

## 📖 Recursos de Aprendizaje

### Documentación Oficial

- [PHP Manual](https://www.php.net/manual/es/) - Documentación oficial de PHP
- [PDO Documentation](https://www.php.net/manual/es/book.pdo.php) - Guía de PHP Data Objects
- [MySQL Reference](https://dev.mysql.com/doc/) - Manual de MySQL

### Mejores Prácticas

- [PHP: The Right Way](https://phptherightway.com/) - Guía de mejores prácticas
- [PSR-12](https://www.php-fig.org/psr/psr-12/) - Estándar de codificación PHP
- [OWASP PHP Security](https://owasp.org/www-project-php-security/) - Seguridad en PHP

### Tutoriales Recomendados

- [Laracasts PHP for Beginners](https://laracasts.com/series/php-for-beginners) - Serie educativa
- [SymfonyCasts](https://symfonycasts.com/) - Tutoriales avanzados

---

## 📝 Licencia

Este proyecto está bajo la **Licencia MIT**.

```
MIT License

Copyright (c) 2026 [Tu Nombre]

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
```

---

## 👨‍💻 Autor

**[Daniel Acuña]**  
PHP Developer | Proyecto Educativo

---

## 🙏 Agradecimientos

- **Tailwind CSS** - Framework CSS moderno
- **Comunidad PHP** - Por su continuo apoyo y recursos
- **Laracasts** - Por inspirar este proyecto educativo
- **Stack Overflow** - Por resolver infinitas dudas

---

<p align="center">
  <strong>Desarrollado con ❤️ y ☕ para aprender PHP profesional</strong><br>
  <sub>Proyecto educativo sin fines comerciales</sub>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Made%20with-PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="Made with PHP">
  <img src="https://img.shields.io/badge/Powered%20by-MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="Powered by MySQL">
  <img src="https://img.shields.io/badge/Styled%20with-Tailwind-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Styled with Tailwind">
</p>
