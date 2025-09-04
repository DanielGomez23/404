<?php
class Usuario {
    private mysqli $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }
    // Registrar un usuario en su tabla
    public function registrar(string $rol, int $cedula, string $nombre, string $correo, string $contrasena): bool {
        if (!$rol || !$cedula || !$nombre || !$correo || !$contrasena) {
            return false;
        }

        $roles = ["postulante", "reclutador", "administrador"];
        if (!in_array($rol, $roles)) {
            return false;
        }

        $sql = "SELECT cedula FROM $rol WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) return false;

        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            return false;
        }

        $password_hash = password_hash($contrasena, PASSWORD_DEFAULT);

        $sql = "INSERT INTO $rol (cedula, nombre, email, contrasena) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) return false;

        $stmt->bind_param("isss", $cedula, $nombre, $correo, $password_hash);
        return $stmt->execute();
    }
    // Iniciar sesión
    public function iniciarSesion(string $rol, string $correo, string $contrasena): ?array {
        $roles = ["postulante", "reclutador", "administrador"];
        if (!in_array($rol, $roles)) {
            return null;
        }

        $sql = "SELECT cedula, nombre, contrasena, email FROM $rol WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) return null;

        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();
            if (password_verify($contrasena, $usuario['contrasena'])) {
                $usuario['rol'] = $rol;
                return $usuario;
            }
        }
        return null;
    }
    // Editar usuario
    public function actualizarUsuario(string $rol, int $cedula, string $nombre, string $correo): bool {
        $roles = ["postulante", "reclutador", "administrador"];
        if (!in_array($rol, $roles)) {
            return false;
        }

        $sql = "UPDATE $rol SET nombre = ?, email = ? WHERE cedula = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) return false;

        $stmt->bind_param("ssi", $nombre, $correo, $cedula);
        return $stmt->execute();
    }
    // Eliminar usuario
    public function eliminarUsuario(string $rol, int $cedula): bool {
        $roles = ["postulante", "reclutador", "administrador"];
        if (!in_array($rol, $roles)) {
            return false;
        }

        $sql = "DELETE FROM $rol WHERE cedula = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) return false;

        $stmt->bind_param("i", $cedula);
        return $stmt->execute();
    }
    // Obtener todos los usuarios (para admin)
    public function obtenerTodosUsuarios(): array {
        $roles = ["postulante", "reclutador", "administrador"];
        $usuarios = [];

        foreach ($roles as $rol) {
            $sql = "SELECT cedula, nombre, email, '$rol' AS rol FROM $rol";
            $resultado = $this->conn->query($sql);

            if ($resultado && $resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    $usuarios[] = $fila;
                }
            }
        }
        return $usuarios;
    }
}
?>
