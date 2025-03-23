<?php
// Datos de conexión a la base de datos
$host = 'localhost'; // El servidor de la base de datos
$dbname = 'user_linkedln'; // El nombre de la base de datos (que vamos a eliminar y crear nuevamente)
$username_db = 'root'; // El nombre de usuario de MySQL
$password_db = ''; // La contraseña de MySQL (por defecto, vacío en XAMPP)

// Conectar a la base de datos
$conn = new mysqli($host, $username_db, $password_db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Eliminar la base de datos si existe
$sql = "DROP DATABASE IF EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Base de datos eliminada correctamente.<br>";
} else {
    echo "Error al eliminar base de datos: " . $conn->error . "<br>";
}

// Crear nuevamente la base de datos
$sql = "CREATE DATABASE $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Base de datos creada correctamente.<br>";
} else {
    echo "Error al crear base de datos: " . $conn->error . "<br>";
}

// Seleccionar la base de datos recién creada
$conn->select_db($dbname);

// Crear la tabla `users`
$sql = "CREATE TABLE users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabla `users` creada correctamente.<br>";
} else {
    echo "Error al crear tabla: " . $conn->error . "<br>";
}

// Cerrar la conexión
$conn->close();
?>