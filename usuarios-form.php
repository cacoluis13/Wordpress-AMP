<form method="POST" action="/register">
    <label for="nombre">Nombre Completo:</label>
    <input type="text" name="nombre" required minlength="3" pattern="[A-Za-z\s]+" title="Solo letras y espacios permitidos">
    
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    
    <label for="password">Contraseña:</label>
    <input type="password" name="password" required minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos una letra mayúscula, una minúscula y un número.">

    <label for="confirm_password">Confirmar Contraseña:</label>
    <input type="password" name="confirm_password" required>
    
    <button type="submit" name="register">Registrar</button>
    
</form>
