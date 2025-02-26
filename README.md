# 🚀 Prueba Técnica PHP - DDD & Clean Architecture

Este proyecto es una prueba técnica que implementa **Domain-Driven Design (DDD)** y **Clean Architecture** en PHP, utilizando **Doctrine ORM**, **MySQL** y **Docker** para la gestión y persistencia de usuarios.

## 📌 Características
- ✅ **Arquitectura basada en DDD y Clean Architecture**.
- ✅ **Persistencia con Doctrine ORM y MySQL**.
- ✅ **Pruebas unitarias e integración con PHPUnit**.
- ✅ **Contenedores Docker para un despliegue rápido**.

---

## 🛠️ Instalación y Configuración

### 1️⃣ **Clonar el Repositorio**
```sh
git clone https://github.com/tuusuario/prueba-php-ddd.git
cd prueba-php-ddd
```

### 2️⃣ **Configurar Variables de Entorno**
Crea un archivo `.env` en la raíz del proyecto con las siguientes variables:
```ini
DB_HOST=db
DB_PORT=3306
DB_DATABASE=test_ddd
DB_USERNAME=user
DB_PASSWORD=password
```

### 3️⃣ **Levantar los Contenedores con Docker**
```sh
docker-compose up -d --build
```
Esto iniciará:
- Un servidor Apache con PHP 8.2 y Doctrine.
- Una base de datos MySQL con la configuración adecuada.
- Adminer para administrar la base de datos en `http://localhost:8080`.

### 4️⃣ **Ejecutar Migraciones de la Base de Datos**
Dentro del contenedor de PHP, ejecuta:
```sh
docker exec -it php_app php bin/doctrine.php orm:schema-tool:update --force
```

---

## 📡 Uso de la API

### **🔹 Registro de Usuario**
**Endpoint:** `POST /register`

📌 **Ejemplo de Request:**
```json
{
    "name": "John Doe",
    "email": "johndoe@example.com",
    "password": "SecurePass123!"
}
```

📌 **Ejemplo de Respuesta Exitosa:**
```json
{
    "message": "Usuario registrado exitosamente"
}
```

📌 **Errores Posibles:**
```json
{
    "error": "Email ya registrado"
}
```

---

## 🔍 Pruebas

### 1️⃣ **Ejecutar Pruebas Unitarias y de Integración**
```sh
docker exec -it php_app vendor/bin/phpunit
```
Si todo está correcto, deberías ver:
```
OK (X tests, X assertions)
```

---

## 🖥️ Acceso a Adminer (Gestor de Base de Datos)
Adminer está disponible en `http://localhost:8080` con las siguientes credenciales:
- **Servidor:** `db`
- **Usuario:** `user`
- **Contraseña:** `password`
- **Base de datos:** `test_ddd`

---

## 📌 Tecnologías Utilizadas
- PHP 8.2
- Doctrine ORM
- MySQL 8.0
- Symfony Routing
- PHPUnit
- Docker + Docker Compose
- Apache 2.4
- Dotenv para manejo de variables de entorno

---

## 📜 Licencia
Este proyecto es de uso libre para propósitos educativos y técnicos. 🚀

