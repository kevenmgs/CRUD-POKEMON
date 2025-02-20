**Requisitos**
- Servidor Web: Apache
- PHP: Versión 8.1 o superior
- Composer: Asegúrate de tener Composer instalado ejecutando:
      **composer -v**
- Editor de código

**Instalación y Configuración**
- Acceder a la ruta donde vamos a clonar el proyecto
- Clonar el proyecto ejecutar el comando 
        **git clone https://github.com/kevenmgs/CRUD-POKEMON.git**
- Acceder a la carpeta del proyecto 
        **cd CRUD-POKEMON**

**Instalar dependencias**
- En la terminar ejecutar 
        **composer install**
        **npm i**

**Configurar variables de entorno**
- Copia el archivo .env.example y nombrarlo .env
- En la terminar ejecutar:
        **php artisan key:generate**
- Crear una BD
- Editar el archivo .env con los datos de conexión
      **Modificar por los nombres de cada usuario**
        - DB_HOST=127.0.0.1
        - DB_PORT=3306
        - DB_DATABASE=nombre_de_tu_base_de_datos
        - DB_USERNAME=tu_usuario
        - DB_PASSWORD=tu_contraseña

**Ejecutar migraciones y seeders**
- En la terminar ejecutar 
        **php artisan migrate**
        **php artisan db:seed**

**Optimizar el proyecto**
- En la terminar ejecutar 
        **php artisan optimize**

**Levantar el servidor**
- En una terminar ejecutar:
        **php artisan serve**
- En otra terminar ejecutar:
        **npm run dev**



