<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexión</title>
</head>
<body>
    <?php
    $enlace = mysqli_connect("localhost", "root", "","ternuritas");

    if(!$enlace){
        die("No se pudo conectar a la base de datos".mysqli_error());
    }

    echo "Conexion exitosa";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener datos del formulario
        $nombreProducto = $_POST["nombreProducto"];
        $precio = $_POST["precio"];
        $descripcion = $_POST["descripcion"];
        $categoria = $_POST["categoria"];
    
        // Procesar la imagen
        $imagenDirectorio = "../fotos_server/";
        $nombreArchivo = $_FILES["imagen"]["name"];
        $rutaCompleta = $imagenDirectorio . $nombreArchivo;
    
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaCompleta);
    
        // Insertar datos en la base de datos
        $sql = "INSERT INTO productos (nombre, precio, descripcion, miniatura, categoria) VALUES ('$nombreProducto', $precio, '$descripcion', '$rutaCompleta', '$categoria')";
    
        if ($enlace->query($sql) === TRUE) {
            echo "Producto cargado correctamente.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    mysqli_close($enlace);
    ?>
</body>
</html>