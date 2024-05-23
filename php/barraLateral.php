<?php
$rol = $_SESSION['rol'];
$perfil = ($rol == 1 ? "Estudiante" : ($rol == 2 ? "Docente" : "Administrador"));
$nombre = $_SESSION['usuario'];
?>
<nav class="sidebar_nav">
    <h4 class="text-center text-white"><?php echo $perfil; ?></h4>
    <a class="text-center"><?php echo $nombre; ?></a>

    <hr>
    <?php if ($rol == 1) { ?>
        <a href="#"><i class="fa-solid fa-pen-to-square"></i></i>&nbsp;Asistencia</a>
    <?php } ?>

    <?php if ($rol == 2) { ?>
        <a href="misMaterias.php"><i class="fa-solid fa-chalkboard-user"></i></i></i>&nbsp;Mis clases</a>
    <?php } ?>

    <?php if ($rol == 3) { ?>
        <a href="listaDocentes.php"><i class="fa-solid fa-chalkboard-user"></i></i></i>&nbsp;Docentes</a>
        <a href="listaAsignaturas.php"><i class="fa-solid fa-chalkboard-user"></i></i></i>&nbsp;Asignaturas</a>
        <a href="lista_clases.php"><i class="fa-solid fa-chalkboard-user"></i></i></i>&nbsp;Clases</a>
        <a href="lista_usuarios_asignaturas.php"><i class="fa-solid fa-chalkboard-user"></i></i></i>&nbsp;Asignaciones</a>
    <?php } ?>
    <a href="cerrarSesion.php"><i class="fa-solid fa-circle-left"></i>&nbsp;Cerrar sesión</a>
</nav>