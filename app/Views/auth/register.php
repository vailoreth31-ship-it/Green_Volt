<div style="max-width: 450px; margin: 40px auto; padding: 25px; border: 1px solid #ddd; border-radius: 8px; font-family: sans-serif;">
    <h2 style="text-align: center; color: #0d6efd; margin-bottom: 20px;">Crear Cuenta</h2>

    <?php if (!empty($error)): ?>
        <div style="background-color: #f8d7da; color: #842029; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form action="/green_volt/auth/processRegister" method="POST">
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nombre Completo:</label>
            <input type="text" name="nombre" required style="width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Correo Electrónico:</label>
            <input type="email" name="email" required style="width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Contraseña:</label>
            <input type="password" name="password" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}" title="Usa al menos 8 caracteres, incluyendo una letra mayúscula, una minúscula y un número." autocomplete="new-password" required style="width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
            <small style="display: block; margin-top: 5px; color: #555;">Debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número.</small>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Confirmar Contraseña:</label>
            <input type="password" name="confirm_password" minlength="8" autocomplete="new-password" required style="width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <button type="submit" style="width: 100%; background-color: #198754; color: white; border: none; padding: 12px; font-size: 16px; border-radius: 4px; cursor: pointer;">
            Registrarse
        </button>
    </form>

    <p style="text-align: center; margin-top: 15px;">
        ¿Ya tienes cuenta? <a href="/green_volt/auth/login" style="color: #0d6efd; text-decoration: none;">Inicia sesión</a>
    </p>
</div>