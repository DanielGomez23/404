<?php
class Usuario {
    private mysqli $conn;

    public function __construct(mysqli $conn) {
        // Guardamos la conexión a MySQL en la clase para usarla en los métodos
        $this->conn = $conn;
    }

    
     // Registrar un usuario en la tabla correspondiente según el rol.
    public function registrar(string $rol, int $cedula, string $nombre, string $correo, string $contrasena): bool {
        // Validar que ningún campo obligatorio llegue vacío
        if (!$rol || !$cedula || !$nombre || !$correo || !$contrasena) {
            return false;
        }

        // Solo permitimos roles que existen en la base de datos
        $roles = ["postulante", "reclutador", "administrador"];
        if (!in_array($rol, $roles)) {
            return false;
        }

        //Consulta dinámica: usamos $rol como nombre de tabla
        // Esto es seguro porque antes validamos que $rol solo pueda ser uno de los 3
        $sql = "SELECT cedula FROM $rol WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) return false;

        // Revisamos si ya existe un usuario con ese correo en la tabla correspondiente
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Ya hay alguien registrado con ese correo → no permitimos duplicados
            return false;
        }

        // Encriptamos la contraseña con password_hash (bcrypt por defecto)
        $password_hash = password_hash($contrasena, PASSWORD_DEFAULT);

        // Insertamos el nuevo usuario en la tabla de su rol
        $sql = "INSERT INTO $rol (cedula, nombre, email, contrasena) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) return false;

        // "isss" → i = integer (cedula), s = string (los demás campos)
        $stmt->bind_param("isss", $cedula, $nombre, $correo, $password_hash);
        return $stmt->execute(); // true si se insertó correctamente
    }

    // Iniciar sesión en la tabla correspondiente según el rol.
     
    public function iniciarSesion(string $rol, string $correo, string $contrasena): ?array {
        // Igual que en registrar: validamos que el rol exista
        $roles = ["postulante", "reclutador", "administrador"];
        if (!in_array($rol, $roles)) {
            return null;
        }

        // Buscamos al usuario en la tabla de su rol
        $sql = "SELECT cedula, nombre, contrasena, email FROM $rol WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) return null;

        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();

            // Aquí se compara la contraseña ingresada con el hash en la BD
            if (password_verify($contrasena, $usuario['contrasena'])) {
                // Añadimos el rol manualmente al array para identificarlo después
                $usuario['rol'] = $rol;
                return $usuario; // devolvemos todos los datos del usuario
            }
        }
        // Si no pasó la validación → null
        return null;
    }
}
?>
