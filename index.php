<?php
require_once 'auth_middleware.php';
header("Access-Control-Allow-Origin: *");

// Inicializar sesión
session_start();

// Datos de conexión a la base de datos, este ejemplo esta creado para probarlo con un servidor XAMPP
$servername = "127.0.0.1"; // Cambiar por la dirección del servidor de la base de datos
$username = "victor"; // Cambiar por el nombre de usuario de la base de datos
$password = "victor"; // Cambiar por la contraseña de la base de datos
$dbname = "hackathon"; // Cambiar por el nombre de la base de datos

// Establecer conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}


// Endpoint de registro "/register"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/index.php/register') {

   // Obtener los datos del formulario de registro
   $username = $_POST['username'];
   $password = $_POST['password'];

   // Consulta a la base de datos para verificar si el usuario ya existe
   $checkUserQuery = "SELECT * FROM usuarios WHERE username = '$username'";
   $checkUserResult = $conn->query($checkUserQuery);

   // Verificar si el usuario ya existe en la base de datos
   if ($checkUserResult->num_rows > 0) {
	   // El usuario ya existe
	   echo "El nombre de usuario ya está registrado. Por favor, elige otro.";
   } else {
	   // Insertar el nuevo usuario en la base de datos
	   $insertUserQuery = "INSERT INTO usuarios (username, password) VALUES ('$username', '$password')";
	   if ($conn->query($insertUserQuery) === TRUE) {
		   echo "Registro exitoso";
	   } else {
		   echo "Error en el registro: " . $conn->error;
	   }
   }
   	   // Cerrar la conexión
	$conn->close();
}

// Endpoint de inicio de sesión "/login"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/index.php/login') {
		// Obtener los datos del formulario de inicio de sesión
		$username = $_POST['username'];
		$password = $_POST['password'];

		// Consulta a la base de datos para verificar las credenciales
		$sql = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
		$result = $conn->query($sql);

		// Verificar si se encontró un usuario con las credenciales proporcionadas
		if ($result->num_rows > 0) {
			// El inicio de sesión es exitoso
				// Generar un token de autenticación
				$token = generateAuthToken();
				// Establecer el token en una cookie
				setcookie('auth_token', $token, time() + 3600, '/');
				// Almacenar el token en una variable de sesión
				$_SESSION['username'] = $username;
				$_SESSION['password'] = $password;
				echo "Bienvenido usuario: $username.";
				
		} else {
			// Las credenciales son incorrectas
			echo "Credenciales incorrectas. Inténtalo de nuevo.";
		}
	// Cerrar la conexión
	$conn->close();
}

// Función para generar un token de autenticación
function generateAuthToken() {
    // Generar un token único
    $token = bin2hex(random_bytes(32));
    return $token;
}

?>
