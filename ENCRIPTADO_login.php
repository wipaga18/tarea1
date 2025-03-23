<?php
// Conexión a la base de datos (asegúrate de usar tus credenciales)
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "user_linkedln";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si los datos fueron enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Comprobar si los campos están presentes en el formulario
    if (isset($_POST["session_key"]) && isset($_POST["session_password"])) {
        // Recoger los datos del formulario
        $username = $_POST["session_key"];
        $password = $_POST["session_password"];

        // Validar si los campos no están vacíos
        if (!empty($username) && !empty($password)) {
            
            // Hashear la contraseña para almacenarla de forma segura
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Preparar la consulta SQL para insertar los datos en la base de datos
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $hashed_password);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "Datos almacenados correctamente.";
            } else {
                echo "Error al almacenar los datos: " . $stmt->error;
            }
            
            // Cerrar la sentencia
            $stmt->close();
        } else {
            echo "Por favor, ingrese tanto el usuario como la contraseña.";
        }
    } else {
        echo "Los datos del formulario no fueron recibidos correctamente.";
    }
} else {
    echo "No se recibió el formulario.";
}

// Cerrar la conexión
$conn->close();
?>