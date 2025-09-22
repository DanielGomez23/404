<?php
require_once '../config/Database.php';

class Alerta{
public function mostrarAlerta($icono, $titulo, $mensaje, $redireccion) {
        echo "
        <html><head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head><body>
        <script>
            Swal.fire({
                icon: '$icono',
                title: '$titulo',
                text: '$mensaje',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                window.location.href = '$redireccion';
            });
        </script>
        </body></html>";
        exit;
    }
}
    ?>