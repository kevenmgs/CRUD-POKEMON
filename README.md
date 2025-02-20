**Configuracion del proyecto**
**Requisitos**
- Servidor Web (Apacache)
- PHP 8.1 o superior
- Tener instalado composer, para verificar aplicamos el comando **composer -v**
- Tener un editor de codigo

**Clonar el proyecto y configuracón**
- Acceder a la ruta donde vamos a clonar el proyecto
- clonar el proyecto ejecutar el comando **git clone https://github.com/kevenmgs/CRUD-POKEMON.git**
- Acceder a la carpeta del proyecto **cd CRUD-POKEMON**
- En la terminar ejecutar **composer install**
- En la terminar ejecutar **npm i**
- Copia el archivo .env.example y nombrarlo .env
- En la terminar ejecutar **php artisan key:generate**
- Crear una BD
- En el archivo .env hacer la configuración
  **Modificar por los nombres de cada usuario**
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nombre_de_tu_base_de_datos
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña
- Ejecutar migraciones **php artisan migrate**
- Ejecutar seeders **php artisan db:seed**
- Ejecutar **php artisan optimize**
- En una terminar ejecutar **php artisan serve**
- En otra terminar ejecutar **npm run dev**



