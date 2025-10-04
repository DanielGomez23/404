<?php
require_once '../config/Database.php';
require_once '../models/Usuarios.php';
require_once '../utils/alerta.php';
session_start();

class AuthController {
    private Usuario $usuario;
    private Alerta $alerta;


    public function __construct(mysqli $conn) {
        $this->usuario = new Usuario($conn);
        $this->alerta = new Alerta();
    }
    // Registrar usuario
    public function registrarUsuario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar'])) {
            $cedula = intval($_POST['cedula'] ?? 0);
            $nombre = trim($_POST['nombre'] ?? '');
            $correo = trim($_POST['correo'] ?? '');
            $contrasena = trim($_POST['contrasena'] ?? '');
            $rol = trim($_POST['rol'] ?? '');

            if (!$cedula || !$nombre || !$correo || !$contrasena || !$rol) {
                $this->alerta->mostrarAlerta('warning', 'Campos obligatorios', 'Todos los campos son obligatorios.', '../views/registro.php');
            }

            if ($this->usuario->registrar($rol, $cedula, $nombre, $correo, $contrasena)) {
                $this->alerta->mostrarAlerta('success', 'Registro exitoso', 'Tu cuenta fue creada con éxito.', '../views/login.php');
            } else {
                $this->alerta->mostrarAlerta('error', 'Error', 'No se pudo registrar. Verifica los datos.', '../views/registro.php');
            }
        }
    }
    // Iniciar sesión
    public function iniciarSesion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
            $rol = trim($_POST['rol'] ?? '');
            $correo = trim($_POST['correo'] ?? '');
            $contrasena = trim($_POST['contrasena'] ?? '');

            if (!$rol || !$correo || !$contrasena) {
                $this->alerta->mostrarAlerta('warning', 'Campos obligatorios', 'Todos los campos son obligatorios.', '../views/login.php');
            }

            $usuario = $this->usuario->iniciarSesion($rol, $correo, $contrasena);

            if ($usuario) {
                $_SESSION['usuario_id'] = $usuario['cedula'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                $_SESSION['usuario_rol'] = $usuario['rol'];

                // Redirige el rol
                if ($usuario['rol'] === 'administrador') {
                    $this->alerta->mostrarAlerta('success', 'Bienvenido', "Hola {$usuario['nombre']}, bienvenido al panel de administrador.", '../views/dash/dash_admin.php');
                } else {
                    $this->alerta->mostrarAlerta('success', 'Bienvenido', "Hola {$usuario['nombre']}, bienvenido al sistema.", '../views/dashboard.php');
                }
            } else {
                $this->alerta->mostrarAlerta('error', 'Error de autenticación', 'Credenciales incorrectas.', '../views/login.php');
            }
        }
    }

// Editar usuario
public function editarUsuario() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
        $rol = trim($_POST['rol'] ?? '');
        $cedula_original = intval($_POST['cedula_original'] ?? 0); // Para buscar el usuario original
        $cedula = intval($_POST['cedula'] ?? 0);
        $nombre = trim($_POST['nombre'] ?? '');
        $correo = trim($_POST['email'] ?? ''); // debe coincidir con el formulario

        $actualizado = $this->usuario->actualizarUsuario(
            $rol,
            $cedula_original,
            $cedula,
            $nombre,
            $correo
        );

        if ($actualizado) {
            $this->alerta->mostrarAlerta(
                'success',
                'Usuario actualizado',
                'El usuario fue actualizado correctamente.',
                '../views/gestion_usuarios.php'
            );
        } else {
            $this->alerta->mostrarAlerta(
                'error',
                'Error',
                'No se pudo actualizar el usuario.',
                '../views/gestion_usuarios.php'
            );
        }
    }
}


// Eliminar usuario
    public function eliminarUsuario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
            $rol = trim($_POST['rol'] ?? '');
            $cedula = intval($_POST['cedula'] ?? 0);

            if ($this->usuario->eliminarUsuario($rol, $cedula)) {
                $this->alerta->mostrarAlerta('success', 'Usuario eliminado', 'El usuario fue eliminado correctamente.', '../views/gestion_usuarios.php');
            } else {
                $this->alerta->mostrarAlerta('error', 'Error', 'No se pudo eliminar el usuario.', '../views/admin_dashboard.php');
            }
        }
    }
}
// Conexión
$conn = Database::getConnection();

if (!$conn) {
    error_log('Error de conexión a la base de datos');
    header('Location: ../views/error.php');
    exit;
}

$authController = new AuthController($conn);

// Rutas según formulario enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['registrar'])) {
            $authController->registrarUsuario();
        } elseif (isset($_POST['login'])) {
            $authController->iniciarSesion();
        } elseif (isset($_POST['editar'])) {
            $authController->editarUsuario();
        } elseif (isset($_POST['eliminar'])) {
            $authController->eliminarUsuario();
        }
    } catch (Exception $e) {
        error_log("Error en AuthController: " . $e->getMessage());
        header("Location: ../views/error.php");
        exit;
    }
}
?>
