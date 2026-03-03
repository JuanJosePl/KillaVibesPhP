# 🎨 INDEXARTS  
## 🚀 Proyecto Oficial: KILLA VIBES

Bienvenido al repositorio oficial de **INDEXARTS**, el equipo responsable del desarrollo de **KILLA VIBES**.

KILLA VIBES es una plataforma ecommerce moderna, escalable y optimizada, diseñada para ofrecer una experiencia sólida tanto para administradores como para clientes.

---

## 🛍️ Sobre el Proyecto

**KILLA VIBES** es una solución de comercio electrónico desarrollada con tecnologías modernas enfocadas en rendimiento, seguridad y mantenibilidad.

### 🛠️ Tecnologías Utilizadas

- Laravel
- PHP
- MySQL
- Tailwind CSS

---

# 📦 Instalación del Proyecto

Sigue los pasos a continuación para configurar correctamente el entorno.

---

## 1️⃣ Clonar el repositorio


git clone <URL_DEL_REPOSITORIO>s
cd killa-vibes


---

## 2️⃣ Instalar dependencias PHP


composer install


Si no tienes Composer instalado globalmente:


php composer.phar install


---

## 3️⃣ Configurar el entorno

Copia el archivo de configuración:


cp .env.example .env


Luego edita el archivo `.env` con tus credenciales:

env
APP_NAME="KILLA VIBES"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_base_datos
DB_USERNAME=usuario
DB_PASSWORD=contraseña


---

## 4️⃣ Generar clave de aplicación

php artisan key:generate


---

## 5️⃣ Ejecutar migraciones


php artisan migrate


Si el proyecto incluye seeders:


php artisan db:seed


---

## 6️⃣ Configurar almacenamiento de imágenes


php artisan storage:link


Si necesitas hacerlo manualmente en Linux/macOS:


ln -s storage/app/public public/storage


---

# 🔐 Acceso al Panel Administrativo

Una vez desplegado el sistema, accede desde:


/admin


Ejemplo:


https://tudominio.com/admin


---

# 📁 Estructura Básica del Proyecto


app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
tests/


---

# 🚀 Estado del Proyecto

- Backend estructurado
- Base de datos configurada
- Panel administrativo funcional
- Desarrollo frontend en progreso

---

# 👨‍💻 Equipo de Desarrollo

## 🎨 INDEXARTS  

Creando identidad digital con visión, diseño y estructura sólida.

---

# 📄 Licencia

Este proyecto es desarrollado y mantenido por **INDEXARTS**.  
Todos los derechos reservados.
