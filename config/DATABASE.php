<?php
class Database {
    // Conexión compartida para toda la aplicación.
    // El signo ? antes de mysqli significa que puede ser null o un objeto mysqli.
    private static ?mysqli $conn = null;

    // Método estático: se puede llamar sin crear un objeto (Database::getConnection()).
    // Devuelve la conexión mysqli o null si no se pudo crear.
    public static function getConnection(): ?mysqli {
        
        // Si aún no existe una conexión, se crea una nueva.
        // Esto asegura que usemos siempre la misma conexión (patrón Singleton).
        if (self::$conn === null) {
            self::$conn = new mysqli("localhost", "root", "root", "project_db");

            // 🔹 Si ocurre un error al conectar, se detiene el script con un mensaje.
            if (self::$conn->connect_error) {
                die("Error de conexión: " . self::$conn->connect_error);
            } 
        }

        // Si ya había una conexión abierta, simplemente la devuelve.
        return self::$conn;
    }
}
?>
