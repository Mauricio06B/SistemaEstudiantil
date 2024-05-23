<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("encabezado.php") ?>
</head>

<body id="bodyCrearcuenta">
    <div class="pagina-inicio-sesion">

        <form action="registro.php" method="post">
            <img id="imagenUcaldas" src="../imagenes/monitorias.png" alt="Texto Alternativo">
            <img id="imagenLogo" src="../imagenes/estudio.png" alt="Texto Alternativo">

            <h3 class="estilo_h3"> Registro Usuarios </h3>
            <?php if (isset($_GET['mensaje'])) { ?>
                <div class="alert alert-warning"><?php echo $_GET['mensaje']; ?></div>
            <?php } ?>
            <label class="label">Nombre</label><i class="fa-solid fa-user"></i>
            <input class="input" type="text" name="usuario" placeholder="Nombre de usuario">

            <label class="label"> Correo Institucional</label>
            <input class="input" type="text" name="correo" placeholder="Correo Intitucional" value="">

            <label class="label"> Telefono</label>
            <input class="input" type="text" name="telefono" placeholder="telefono">

            <label class="tipo_documento">Tipo de Documento:</label>
            <select id="tipo_documento" name="tipo_documento" class="form-control" required>
                <option value="1">Tarjeta de Identidad</option>
                <option value="2">Cédula de ciudadania</option>
                <option value="3">Cédula de Extranjería</option>
            </select>

            <label class="label"> Número de documento</label>
            <input class="input" type="text" name="documento" placeholder="Documento">

            <label class="label"> Contraseña</label>
            <input class="input" type="text" name="contrasena" placeholder="Contraseña">

            <?php if (isset($_GET['error'])) { ?>
                <br>
                <div class="alert alert-danger"><?php echo $_GET['error'] ?></div>
            <?php } ?>

            <?php if (isset($_GET['exito'])) { ?>
                <br>
                <div class="alert alert-success"><?php echo $_GET['exito'] ?></div>
            <?php } ?>

            <div class="botones">
                <a href="cerrarSesion.php" class="btn btn-#08d9dd btn-image"></a>
                <button class="btnRegistrar">Registrar</button>
        </form>
    </div>
    </div>

</body>

</html>