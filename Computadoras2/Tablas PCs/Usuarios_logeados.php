<?php
session_start(); //se inicia la sesion que sirve para guardar variables globales 
include("../Union-Server.php"); // Conexion a la base de datos
?>
<html>

<head>

    <link rel="stylesheet" href="../Estilos.css/nav2.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">


    <title>Formulario</title>

</head>

<body>
    <?php
    if ((($_SESSION["UserAdmin"] == 0))) { //Si el usuario no es admin lo expulsa
        header("location: ../PaginaDeInicio.php");
    } else {
    ?>
        <header>
            <nav> <label class="logo">
                    <img width="35px" src="<?php echo str_replace("./", "../", $_SESSION['Imagen']) ?>" alt="imagen"> <?php echo $_SESSION['Nombre'];
                                                                                                                        if ($_SESSION['UserAdmin'] == 0) {
                                                                                                                            echo "<h5>Usuario</h5>";
                                                                                                                        } else {
                                                                                                                            echo "<h5>Administrador</h5>";
                                                                                                                        }  ?>
                </label>
                <ul>
                    <li><a class="active" href="../PaginaDeInicio.php">Inicio</a></li>
                    <?php if ($_SESSION["UserAdmin"]) { //Si el usuario este se muestra ver usuarios
                    ?>
                        <li><a href="../Tablas PCs/Usuarios_logeados.php">Ver Usuarios</a></li>
                    <?php } ?>
                    <li><a href="../Perfil/Perfil.php">Perfil</a></li>
                    <li><a href="../Login/Logout.php">Cerrar Sesion</a></li>
                </ul>
            </nav>
        </header>
        <!-- Aca termina la nav -->


        <div class="center_div">
            <div class="contenidotab">
                <!-- fila de la tabla-->
                <div class="titulos">ID_Login</div> <!-- columna id-->
                <div class="titulos">Nombre</div><!-- columna nombre-->
                <div class="titulos">Email</div><!-- columna email-->
                <div class="titulos">Contraseña</div>
                <div class="titulos">Imagen</div>
                <div class="titulos">Administrador</div>
                <div class="titulos">Editar</div><!-- columna editar-->

                <?php
                $SQL = "SELECT * FROM `login-alumnos` WHERE 1"; //selecciono toda la base de datos para mostrarla
                $Resultado = mysqli_query($conex, $SQL); //se hace la conexion con toda la base de datos
                while ($mostrar = mysqli_fetch_array($Resultado)) { //imprime por pantalla toda la base de datos 
                ?>

                    <div class="datos"><?php echo $mostrar['IDLogin'] ?></div>
                    <div class="datos"><?php echo $mostrar['Nombre'] ?></div>
                    <div class="datos"><?php echo $mostrar['Email'] ?></div>
                    <div class="datos"><?php echo $mostrar['Contraseña'] ?></div>
                    <div class="datos"><img src="<?php echo str_replace("./", "../", $mostrar['Imagen']) ?>" alt="imagen"></div>
                    <div class="datos"><?php if ($mostrar['Administrador'] == 0) {
                                            echo "Usuario";
                                        } else {
                                            echo "Administrador";
                                        }  ?></div>
                    <!-- Obtiene el Id a actualizar -->
                    <div class="datos"> <a href="../Tablas PCs/actualizar.php?IDLogin=<?php echo $mostrar["IDLogin"]; ?>">Editar</a> </div>


            <?php
                }
            }
            mysqli_free_result($Resultado);
            ?>
            </div>
        </div>
</body>

</html>