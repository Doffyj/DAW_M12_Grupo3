<?php
$host = 'localhost';
$usuario = 'root';
$contrasena = 'root';
$base_de_datos = 'users';

$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

function buscarUsuarios($conexion, $nombre) {
    $query = "SELECT * FROM usuarios WHERE nombre LIKE '%$nombre%' OR apellido LIKE '%$nombre%'";
    $resultado = $conexion->query($query);

    $usuarios = array();

    while ($fila = $resultado->fetch_assoc()) {
        $usuarios[] = $fila;
    }

    return $usuarios;
}

function mostrarUsuarios($usuarios) {
    echo '<table>';
    echo '<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Rol</th><th>Acciones</th></tr>';

    foreach ($usuarios as $usuario) {
        echo '<tr>';
        echo '<td>' . $usuario['id'] . '</td>';
        echo '<td>' . $usuario['nombre'] . '</td>';
        echo '<td>' . $usuario['apellido'] . '</td>';
        echo '<td>' . $usuario['rol'] . '</td>';
        echo '<td>';
        echo '<form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">';
        echo '<input type="hidden" name="accion" value="eliminar">';
        echo '<input type="hidden" name="id" value="' . $usuario['id'] . '">';
        echo '<button type="submit">Eliminar</button>';
        echo '</form>';
        echo '<form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">';
        echo '<input type="hidden" name="accion" value="editar">';
        echo '<input type="hidden" name="id" value="' . $usuario['id'] . '">';
        echo '<button type="submit">Editar</button>';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</table>';
}

function eliminarUsuario($conexion, $id) {
    $query = "DELETE FROM usuarios WHERE id = $id";
    $resultado = $conexion->query($query);

    if ($resultado) {
        echo "Usuario con ID $id eliminado correctamente.";
    } else {
        echo "Error al eliminar usuario con ID $id: " . $conexion->error;
    }
}

function editarUsuario($conexion, $id, $nuevoNombre, $nuevoApellido) {
    $query = "UPDATE usuarios SET nombre = '$nuevoNombre', apellido = '$nuevoApellido' WHERE id = $id";
    $resultado = $conexion->query($query);

    if ($resultado) {
        echo "Usuario con ID $id editado correctamente.";
    } else {
        echo "Error al editar usuario con ID $id: " . $conexion->error;
    }
}

function insertarUsuario($conexion, $nuevoNombre, $nuevoApellido) {
    $query = "INSERT INTO usuarios (nombre, apellido, contrasena, rol) VALUES ('$nuevoNombre', '$nuevoApellido', 'password', 0)";
    $resultado = $conexion->query($query);

    if ($resultado) {
        echo "Nuevo usuario insertado correctamente.";
    } else {
        echo "Error al insertar nuevo usuario: " . $conexion->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST["accion"];

    switch ($accion) {
        case "buscar":
            $nombre = $_POST["nombre"];
            $usuarios = buscarUsuarios($conexion, $nombre);
            mostrarUsuarios($usuarios);
            break;

        case "eliminar":
            $idEliminar = $_POST["id"];
            eliminarUsuario($conexion, $idEliminar);
            break;

        case "editar":
            $idEditar = $_POST["id"];
            break;

        case "guardar_edicion":
            $idGuardarEdicion = $_POST["id"];
            $nuevoNombre = $_POST["nuevo_nombre"];
            $nuevoApellido = $_POST["nuevo_apellido"];
            editarUsuario($conexion, $idGuardarEdicion, $nuevoNombre, $nuevoApellido);
            break;

        case "insertar":
            $nuevoNombre = $_POST["nuevo_nombre"];
            $nuevoApellido = $_POST["nuevo_apellido"];
            insertarUsuario($conexion, $nuevoNombre, $nuevoApellido);
            break;

        default:
            echo "Acción no reconocida";
            break;
    }
}

$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="stylesAdmin.css">
    <script>
       function buscarUsuarios() {
        var nombre = document.getElementById('nombre').value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    document.getElementById('resultados').innerHTML = xhr.responseText;
                } else {
                    console.error('Error al buscar usuarios:', xhr.status, xhr.statusText);
                }
            }
        };
        xhr.open('POST', 'gestion_usuarios.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('accion=buscar&nombre=' + encodeURIComponent(nombre));
    }

    function editarUsuario(id) {
        console.log('Editar usuario con ID:', id);
    }

    function eliminarUsuario(id) {
        console.log('Eliminar usuario con ID:', id);
    }

    function insertarUsuario() {
        console.log('Mostrar formulario de inserción');
    }

   
    </script>
</head>
<body>
    <div class="container">
        <h2>Gestión de Usuarios</h2>

        <label for="nombre">Buscar por Nombre o Apellido:</label>
        <input type="text" id="nombre">
        <button onclick="buscarUsuarios()">Buscar</button>

        <div id="resultados"></div>

        <div id="resultados"></div>

<!-- Formulario para Editar Usuario -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="hidden" name="accion" value="editar">
    <input type="hidden" id="id_editar" name="id" value="">
    <label for="nuevo_nombre_editar">Nuevo Nombre:</label>
    <input type="text" id="nuevo_nombre_editar" name="nuevo_nombre" required>
    <label for="nuevo_apellido_editar">Nuevo Apellido:</label>
    <input type="text" id="nuevo_apellido_editar" name="nuevo_apellido" required>
    <button type="submit">Guardar Edición</button>
</form>

<!-- Formulario para Insertar Usuario -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="hidden" name="accion" value="insertar">
    <label for="nuevo_nombre_insertar">Nombre:</label>
    <input type="text" id="nuevo_nombre_insertar" name="nuevo_nombre" required>
    <label for="nuevo_apellido_insertar">Apellido:</label>
    <input type="text" id="nuevo_apellido_insertar" name="nuevo_apellido" required>
    <button type="submit">Insertar Usuario</button>
</form>

<script>
    function editarUsuario(id, nombre, apellido) {
        document.getElementById('id_editar').value = id;
        document.getElementById('nuevo_nombre_editar').value = nombre;
        document.getElementById('nuevo_apellido_editar').value = apellido;
    }

    function eliminarUsuario(id) {
        console.log('Eliminar usuario con ID:', id);
    }

    function insertarUsuario() {
        console.log('Mostrar formulario de inserción');
    }

</script>
    </div>
</body>
</html>
