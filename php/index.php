<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('encabezado.php'); ?>
</head>

<body id="body">
    <?php if (!isset($_GET['correcto'])) { ?>
        <form action="validarSesion.php" method="POST" class="form">
            <img id="imagenUcaldas" src="../imagenes/monitorias.png" alt="Texto Alternativo">
            <img id="imagenLogo" src="../imagenes/estudio.png" alt="Texto Alternativo">
            <h2> INICIO DE SESION </h2>
            <hr>
            <i class="fa-solid fa-user"></i>
            <label class="label"> Usuario</label>
            <input class="input" type="text" name="usuario" placeholder="Nombre de usuario">

            <i class="fa-solid fa-unlock"></i>
            <label class="label"> Clave</label>
            <input class="input" type="password" name="clave" placeholder="Clave">
            <hr>
            <a href="crearCuenta.php">Crear Cuenta</a>
            <button type="submit" class="button">Iniciar Sesion</button>
        </form>
    <?php } else { ?>
        <div class="alert alert-warning">
            <?php echo $_GET['correcto']; ?>
        </div>
    <?php } ?>
</body>
</html>