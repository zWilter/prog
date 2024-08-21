<?php

// Establece las credenciales de conexión a la base de datos
$dbhost = "localhost"; // Nombre del servidor de la base de datos
$dbuser = "root"; // Nombre de usuario de la base de datos
$dbpass = ""; // Contraseña de la base de datos
$dbname = "user"; // Nombre de la base de datos

// Crea la conexión
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Verifica la conexión
if (!$conn) {
    die("No hay conexión: " . mysqli_connect_error());
}

if (isset($_POST["txtusuario"]) && isset($_POST["txtpassword"]) && isset($_POST["tipousuario"])) {
    
    $nombre = mysqli_real_escape_string($conn, $_POST["txtusuario"]);
    $pass = mysqli_real_escape_string($conn, $_POST["txtpassword"]);
    $tipo = mysqli_real_escape_string($conn, $_POST["tipousuario"]);

    $query = mysqli_query($conn, "SELECT * FROM login WHERE usuario = '$nombre' AND password = '$pass'");

    if (mysqli_num_rows($query) == 1) {
        $user_data = mysqli_fetch_assoc($query);
        $user_type = $user_data['tipo']; 

        if ($user_type == $tipo) {
            if ($tipo == 'empleado') {
                header("Location: empleados.html");
                exit();
            } else if ($tipo == 'cliente') {
                header("Location: clientes.html");
                exit();
            }
        } else {
            echo "Revisa si realmente tienes ese rol";
        }
    } else {
        echo "No registrado";
    }
} else {
    echo "Datos no fueron recibidos correctamente";
}

mysqli_close($conn);

?>
