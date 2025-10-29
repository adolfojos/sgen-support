<?php
require 'vendor/autoload.php';
$userModel = new \App\Models\Usuario();
$userModel->crearUsuario('tecnico', 'tecnico123', 'tecnico');
 echo "Tecnico creado";