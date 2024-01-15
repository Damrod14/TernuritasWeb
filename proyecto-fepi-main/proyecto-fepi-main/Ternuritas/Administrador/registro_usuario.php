<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexión</title>
</head>
<body>
    <?php
    $enlace = mysqli_connect("localhost", "root", "", "ternuritas");

    if (!$enlace) {
        die("No se pudo conectar a la base de datos" . mysqli_error());
    }

    echo "Conexion exitosa";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener datos del formulario
        $nombreCompleto = $_POST["nombre_completo"];
        $mail = $_POST["mail"];
        $password = $_POST["password"];
        $direccion = $_POST["direccion"];
        $telefono = $_POST["telefono"];

        echo "Nombre Completo: $nombreCompleto<br>";
        echo "Correo Electrónico: $mail<br>";
        echo "Contraseña: $password<br>";
        echo "Dirección: $direccion<br>";
        echo "Teléfono: $telefono<br>";
        
        // Utilizar consultas preparadas para prevenir la inyección SQL
        $sql = "INSERT INTO usuario (mail, password, nombre_completo, def_direccion_envio, telefono) VALUES (?, ?, ?, ?, ?)";

        // Preparar la consulta
        $stmt = mysqli_prepare($enlace, $sql);

        // Vincular parámetros
        mysqli_stmt_bind_param($stmt, "sssss", $mail, $password, $nombreCompleto, $direccion, $telefono);

        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            echo "Usuario registrado correctamente.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($enlace);
        }

        // Cerrar la sentencia preparada
        mysqli_stmt_close($stmt);
    }

    // Cerrar la conexión
    mysqli_close($enlace);
    ?>
</body>
</html>