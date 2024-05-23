<?php include("sesionActiva.php"); ?>

<!DOCTYPE html>

<html lang="es">



<head>

    <?php

    include('encabezado.php');

    ?>

</head>



<body class="Body1">

    <div class="row">

        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">

            <?php

            include("barraLateral.php");

            include("../modelos/usuarios.php");



            $usuarioX = new usuarios();

            $usuarioX->setId($_SESSION['id']);

            $datosUsuario = $usuarioX->consultar();



            $usuario = $datosUsuario['usuario'];

            $nombre = $datosUsuario['nombre_completo'];

            $correo = $datosUsuario['correo_institucional'];

            $telefono = $datosUsuario['telefono'];

            $rol = $datosUsuario['rol'];

            $tipo_documento = ($datosUsuario['tipo_documento'] == 1) ? "Tarjeta de identidad" : (($datosUsuario['tipo_documento'] == 2) ? "Cédula de ciudadanía" : "Cédula de extranjería");

            $numero_documento = $datosUsuario['numero_documento'];





            ?>

        </div>

        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">&nbsp;</div>

                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">&nbsp;</div>

                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">

                    <div class="card">

                        <div class="card-header">

                            <h5 class="text-center">Mi perfil</h5>

                        </div>

                        <div class="card-body">

                            <form class="row">

                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">

                                    <div class="row">

                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">

                                            <label class="">Usuario</label>

                                            <input class="form-control " value="<?php echo $usuario; ?>">

                                        </div>



                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">

                                            <label class="">Nombre</label>

                                            <input class="form-control " value="<?php echo $nombre; ?>">

                                        </div>



                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                            <label class="">Correo institucional</label>

                                            <input class="form-control " value="<?php echo $correo; ?>">

                                        </div>

                                    </div>

                                </div>



                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">

                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">

                                        <label class="">Tipo documento</label>

                                        <input class="form-control " value="<?php echo $tipo_documento; ?>" readonly>

                                    </div>



                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">

                                        <label class="">Documento</label>

                                        <input class="form-control " value="<?php echo $numero_documento; ?>" readonly>

                                    </div>



                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                        <label class="">Teléfono</label>

                                        <input class="form-control " value="<?php echo $telefono; ?>">

                                    </div>

                                </div>



                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                    <!--<button class="btn btn-primary form-control">Actualizar</button> -->

                                </div>

                            </form>

                        </div>

                    </div>



                </div>

            </div>

        </div>

    </div>

    </div>

</body>



</html>