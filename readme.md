# ElhorShop

## Descripción
Este proyecto es un sistema web desarrollado en PHP utilizando PDO para la gestión de bases de datos. Permite la gestión de información mediante un backend conectado a una base de datos MySQL y cuenta con un front-end básico en la carpeta `public`. Es un proyecto educativo que sirve para aprender y practicar buenas prácticas en PHP y acceso a bases de datos.

## Estructura del proyecto
- `app/` : Contiene los servicios y modelos del proyecto (lógica del backend).  
- `database/` : Scripts para crear y gestionar la base de datos.  
- `public/` : Archivos accesibles desde el navegador (front-end).  
- `src/favicon/` : Favicon del proyecto.  
- `composer.json` y `composer.lock` : Gestión de dependencias PHP.  
- `.gitignore` : Configuración de archivos a ignorar en Git.

## Requisitos y tecnologías utilizadas
- PHP >= 7.4  
- MySQL  
- PDO (PHP Data Objects)  
- Composer (gestión de dependencias)  
- HTML, CSS y Bootstrap (front-end básico)  
- Librerías PHP: `ramsey/uuid`  

## Instalación
1. Clona el repositorio:
   ```bash
   git clone https://github.com/elhordev/PDO-Proyecto.git
2. Copia los archivos a la carpeta raíz de tu servidor web (por ejemplo htdocs en XAMPP).

3. Crea la base de datos usando los scripts en database/.

4. Configura la conexión a la base de datos en los archivos de configuración del proyecto (app/config/Config.php).En este caso, al ser una bdd de prueba creada con XAMPP, por defecto, la contraseña es "", solo por fines educativos.

5. Ejecuta: 
    ```bash
    composer require ramsey/uuid
    ```
    
    Para tener la dependencia necesaria.

6. Inicia el servidor web y accede a http://localhost/PDO-Proyecto/public.

## Uso

Accede a la aplicación desde el navegador.

Puedes explorar las diferentes vistas que la cuenta Invitado te proporciona, para acceder a opciones de Administrador prueba con lo siguiente:
    
    Usuario : admin
    Password : admin

Administra la base de datos y prueba las funcionalidades que proporciona el proyecto.

## Documentación

Incluye PDFs educativos sobre PDO y acceso a bases de datos en la carpeta raíz:

PHP - Introducción a PDO.pdf

PHP - Acceso a BBDD.pdf
//Los incluí porque yo los utilizaba, programo desde distintos sitios y me es cómodo tenerlo subido al repo.

## Contribuciones

El proyecto está abierto a mejoras educativas: puedes proponer cambios mediante pull requests o abrir issues.

## Licencia

Sin licencia específica.

## Autor

Diego Crespo Muñoz
GitHub