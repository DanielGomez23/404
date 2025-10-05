<?php
session_start();
session_destroy();
header("Location: ../views/landing.php");
exit;


?>