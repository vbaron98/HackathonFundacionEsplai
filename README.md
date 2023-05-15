# Login App

Este es un ejemplo de una aplicación de inicio de sesión básica que utiliza PHP y MySQL para el almacenamiento de usuarios y autenticación. La aplicación permite a los usuarios registrarse, iniciar sesión y muestra un mensaje de bienvenida cuando se inicia sesión correctamente.

## Requisitos

- Servidor web con soporte para PHP
- Servidor de base de datos MySQL (por ejemplo, XAMPP)

## Instalación

1. Clona o descarga este repositorio en tu servidor web.

2. Importa la base de datos

   - Abre tu servidor de bases de datos (por ejemplo, phpMyAdmin).
   - Crea una nueva base de datos con el nombre "hackathon".
   - Importa el archivo "database.sql" que se encuentra en la carpeta "sql" en la base de datos recién creada. Esto creará la tabla "usuarios" necesaria para almacenar los datos de usuario.

3. Configuración de la base de datos

   - Abre el archivo "index.php" en el directorio raíz de la aplicación.
   - Modifica las siguientes variables con los detalles de tu servidor de base de datos:

     ```
     $servername = "127.0.0.1";
     $username = "tu_nombre_de_usuario";
     $password = "tu_contraseña";
     $dbname = "hackathon";
     ```

4. Inicia la aplicación

   - Abre tu navegador web y navega hasta la URL de la aplicación.
   - Deberías ver la página de inicio de sesión.

## Uso

### Registro de usuario

- En la página de inicio de sesión, haz clic en "Registrarse".
- Completa el formulario de registro con un nombre de usuario y contraseña.
- Haz clic en "Registrarse".
- Verás un mensaje de confirmación si el registro es exitoso.
- Si el nombre de usuario ya está registrado, verás un mensaje de error.

### Inicio de sesión

- En la página de inicio de sesión, introduce tu nombre de usuario y contraseña.
- Haz clic en "Iniciar sesión".
- Si las credenciales son correctas, se generará un token de autenticación y se almacenará en una cookie.
- Se mostrará un mensaje de bienvenida junto con tu nombre de usuario.

## Estructura del proyecto

- `index.php`: Archivo principal que contiene el código PHP para la gestión del registro y el inicio de sesión.
- `auth_middleware.php`: Middleware de autenticación que verifica la validez del token de autenticación en cada solicitud.
- `sql/database.sql`: Archivo SQL que contiene el script de creación de la tabla "usuarios" en la base de datos.

## Notas adicionales

- Este ejemplo utiliza cookies para almacenar el token de autenticación. Asegúrate de que tu navegador acepta cookies.
- También se almacena datos de sesión para el servidor pero al ser un ejemplo de una sola web, no se utilizan por ahora.
- Este código es solo para fines educativos y no debe utilizarse en un entorno de producción sin tomar las precauciones de seguridad adecuadas.

