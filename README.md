# Sistema de manejo de empleados

Esta es una sencilla aplicación de gestión de empleados basada en Laravel. Permite crear, editar, listar y eliminar empleados, con roles, áreas y suscripciones a boletines.

---

## 🚀 Getting Started

Siga los siguientes pasos para correr el proyecto por primera vez

---

## 📦 Instalación

1. **Clonar el repositorio**

```bash
git clone https://github.com/gcmartinezg/NEXURA-technical.git
cd NEXURA-technical
```

2. **Instalar las dependencias de PHP**
```bash
composer install
```

3. **Install las dependencias de JavaScript**
```bash
npm install
```

4. **Copiar el archivo .env.example, y renombrarlo como .env**

5. **Actualice las propiedades relacionadas a la base de datos**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nexura_technical
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. **Si usa XAMPP, ejecútelo e inicie los servicios de MySQL y el servidor de Apache**

7. **En MySQL, crear una base de datos nueva llamada nexura_technical**
```sql
create database nexura_technical;
```

## 🧮 Ejecutar las migraciones

Esto creará las tablas de la base de datos e insertará valores predeterminados para roles y áreas:
```bash
php artisan migrate --seed
```

## ▶️ Ejecutar el proyecto

Para esto deberá abrir dos terminales/consolas, una para ejecutar el servidor de PHP, y otra para los assets del front (CSS, JS, y demás que cambien durante la ejecución)
```bash
npm run dev
php artisan serve
```

Ahora la aplicación estará disponible para su acceso en la ruta http://127.0.0.1:8000