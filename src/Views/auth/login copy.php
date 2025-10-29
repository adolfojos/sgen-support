<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SGEN - Iniciar Sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: grid;
            place-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }
        .login-container {
            background: #fff;
            border: 1px solid #ccc;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            width: 350px;
            border-radius: 8px;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .flash-message {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-weight: bold;
            text-align: center;
        }
        .flash-success {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }
        .flash-error {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }
        .error {
            color: red;
            background: #ffebee;
            border: 1px solid red;
            padding: 10px;
            margin-bottom: 15px;
            text-align: center;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <?php 
    // ---- MENSAJES FLASH ----
    if (isset($_SESSION['flash_message'])):
        $flash = $_SESSION['flash_message'];
    ?>
        <div class="flash-message flash-<?php echo htmlspecialchars($flash['type']); ?>">
            <?php echo htmlspecialchars($flash['message']); ?>
        </div>
    <?php 
        unset($_SESSION['flash_message']);
    endif;
    ?>

    <div class="login-container">
        <h2>Acceso al Sistema</h2>

        <?php if (isset($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="/sgen-support/public/auth/procesar" method="POST">
            <div class="form-group">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Ingresar</button>
        </form>
    </div>

</body>
</html>
