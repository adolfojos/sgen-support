<?php
require 'vendor/autoload.php';
$userModel = new \App\Models\Usuario();
$userModel->crearUsuario('admin', 'admin123', 'admin');
 echo "Admin creado";