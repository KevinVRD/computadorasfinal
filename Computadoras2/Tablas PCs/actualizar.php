<?php
session_start();
include("../Union-Server.php"); //Union a la base de datos
if (((empty($_SESSION["Email"])))) { //Si no se logeo lo expulsa
    header("location: ../Login/Login.php");
} else {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Base de datos Alumnos</title>
        <link rel="stylesheet" href="../Estilos.css/paginas.css">
        <link>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');
        </style>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    </head>

    <body>
        <?php include("../Estilos.css/nav.php") ?>


        <?php
        //PAGINA DE ACtUALIZAR PERFIL
        if (isset($_POST['submitPerfil']) or isset($_POST['submitPerfil1'])) { ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <?php
                //se selecciona atraves del idlogin para que muestre el usuario a actualizar
                $SQL = "SELECT * FROM `login-alumnos` WHERE IDLogin = '" . $_SESSION["IDLogin"] . "'";
                $Resultado = mysqli_query($conex, $SQL); //conexion para ver la tabla del usuario
                while ($mostrar = mysqli_fetch_array($Resultado)) { //imprime la tabla del usuario
                ?>
                    <!-- espacio donde se sube la imagen-->
                    <div class="main_container">
                        <div class="item">
                            <script src="../script.js"></script>
                            <div><img width="70px" id="imagenPrevisualizacion" src="<?php echo str_replace("./", "../", $mostrar['Imagen']) ?>" alt="imagen"><!-- muestra la imagen subida-->
                            </div>
                            <div class="i_item"><input type="file" name="Imagen" id="seleccionArchivos" accept="image/*"> </div>

                            <div class="i_item"> <label for=""><i class="bi bi-person-fill"></i> Nombre:</label> </div>
                            <div class="input_contenedor"> <input type="text" name="Nombre" value="<?php echo $mostrar['Nombre'] ?>" /></div>

                            <div class="i_item"><label for=""><i class="bi bi-envelope"></i> Email:</label></div>
                            <div class="input_contenedor"><input type="text" name="Email" value="<?php echo $mostrar['Email'] ?>" disabled /></div>

                            <div class="i_item"><label for=""><i class="bi bi-key"></i> Contraseña:</label></div>
                            <div class="input_contenedor"> <input type="text" name="Contraseña" value="<?php echo $mostrar['Contraseña'] ?>" /></div>

                            <div class="I_item"><input class="button2" type="submit" value="Editar" name="submitPerfil1"><!-- Boton de actualizar que lleva al proceso_update -->
                            </div>
                            <!-- La imagen que vamos a usar para previsualizar lo que el usuario selecciona -->
                        </div>
                    <?php

                }
                //PAGINA DE ACTUALIZAR USUARIOS
            } else if (isset($_GET["IDLogin"])) {
                    ?><div class="main_container">
                        <form class="item" action="" method="POST">
                            <?php
                            $IDLogin = $_GET["IDLogin"]; // Se obtiene en IDlogin del objeto que se va a actualizar
                            $SQL = "SELECT * FROM `login-alumnos` WHERE IDLogin = '$IDLogin'";
                            $Resultado = mysqli_query($conex, $SQL); //conexion para ver la tabla del usuario
                            while ($mostrar = mysqli_fetch_array($Resultado)) { //imprime la tabla del usuario
                            ?>
                                <input type="hidden" value="<?php echo $mostrar['IDLogin'] ?>" name="IDLogin" required minlength="1">

                                <div class="i_item"><i class="bi bi-person-fill"></i> <label for=""> Nombre: </label></div>
                                <div class="input_contenedor">
                                    <input type="text" name="Nombre" value="<?php echo $mostrar['Nombre'] ?>" />
                                </div>

                                <div class="i_item"><label for=""><i class="bi bi-envelope"></i> Email: </label> </div>
                                <div class="input_contenedor">
                                    <input type="text" name="Email" value="<?php echo $mostrar['Email'] ?>" />
                                </div>

                                <div class="i_item"><label for=""><i class="bi bi-key"></i> Contraseña:</label> </div>
                                <div class=" input_contenedor">
                                    <input type="text" name="Contraseña" value="<?php echo $mostrar['Contraseña'] ?>" />
                                </div>

                                <div><label for=""> Rango:</label></div>
                                <div class="input_contenedor">
                                    <input type="text" name="Administrador" value="<?php echo $mostrar['Administrador'] ?>" />
                                </div>

                                <input class="button_item" type="submit" value="Actualizar" name="submitUser">
                        </form>
                    </div>
                <?php
                            }
                            //PAGINA DE ACtUALIZAR PCs
                        } else {
                ?> <div class="main_container">
                    <form class="item" action="" method="POST">
                        <!--formulario que lleva al proceso de update cuando se oprime el boton -->
                        <?php
                            $id = $_GET["ID"]; // Se obtiene en ID del objeto que se va a actualizar
                            $SQL = "SELECT * FROM `pcs` WHERE ID = '$id'"; //se selecciona atraves del id para que muestre el usuario a actualizar
                            $Resultado = mysqli_query($conex, $SQL); //conexion para ver la tabla del usuario
                            while ($mostrar = mysqli_fetch_array($Resultado)) { //imprime la tabla del usuario
                        ?>
                            <input type="hidden" value="<?php echo $mostrar['ID'] ?>" name="ID" required minlength="1">
                            <!--id oculto para hacer el proceso de update no mostrar -->
                            <div class="alt_item">
                                <div class="i_item"><label> Procesador:</label></div>
                                <div class="input_contenedor">
                                    <input type="text" name="Procesador" value="<?php echo $mostrar['Procesador'] ?>" />
                                </div>

                                <dic class="alt_item1">
                                    <div class="i_item"><label for=""> Seleccionar, laboratorio:</label></div>
                                    <div class="input_contenedor">
                                        <select name="Laboratorio">
                                            <option value="Laboratorio 1">Laboratorio 1</option>
                                            <option value="Laboratorio 2">Laboratorio 2</option>
                                            <option value="Laboratorio 3">Laboratorio 3</option>
                                        </select>
                                    </div>
                                </dic>
                                <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
                                <div class="alt_item1">
                                    <div class="i_item"> <label><i class="bi bi-cpu"></i> Memoria RAM:</label></div>
                                    <div class="input_contenedor">
                                        <input type="number" name="RAM" value="<?php echo $mostrar['RAM'] ?>" />
                                    </div>
                                </div>
                                <div class="alt_item1">
                                    <div class="i_item"><label for=""> Nro, #Zocalos de Ram:</label> </div>
                                    <div class="input_contenedor">
                                        <input type="number" name="Zocalos" value="<?php echo $mostrar['Zocalos'] ?>" />
                                    </div>
                                </div>
                            </div>
                            <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
                            <div></div>
                            <div class="i_item"><label for=""> MotherBoard:</label></div>
                            <div class="input_contenedor">
                                <input type="text" name="MotherBoard" value="<?php echo $mostrar['MotherBoard'] ?>" />
                            </div>


                            <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
                            <div class="i_item"><label for=""><i class="bi bi-disc"></i> Disco:</label></div>
                            <div class="input_contenedor">
                                <input type="text" name="HDD" value="<?php echo $mostrar['HDD'] ?>" />
                            </div>

                            <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
                            <div class="i_item"><label for=""><i class="bi bi-pc-display-horizontal"></i> Marca</label></div>
                            <div class="input_contenedor">
                                <input type="text" name="Marca" value="<?php echo $mostrar['Marca'] ?>" />
                            </div>

                            <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->

                            <div class="i_item"><label><i class="bi bi-align-top"></i> DIMMs:</label></div>
                            <div class="input_contenedor">
                                <input type="text" name="DIMMs" value="<?php echo $mostrar['DIMMs'] ?>" />
                            </div>

                            <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
                            <div class="i_item"><label><i class="bi bi-grip-horizontal"></i> Zocalos_Libres:</label></div>
                            <div class="input_contenedor">
                                <input type="text" name="Zocalos_Libres" value="<?php echo $mostrar['Zocalos_Libres'] ?>" />
                            </div>

                            <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
                            <div class="i_item"><label for=""><i class="bi bi-terminal"></i> PS/2:</label> </div>
                            <div class="input_contenedor">
                                <input type="checkbox" name="PS2" value="1" />
                            </div>

                            <div class="i_item"><label for=""><i class="bi bi-stickies"></i> Cambios:</label></div>
                            <div class="input_contenedor">
                                <input type="text" name="Historial" />
                            </div><!-- Hacer mas grande el textbox -->

                            <div class="i_item"><label for=""> <i class="bi bi-person-fill"></i>Administrador:</label></div>
                            <div class="input_cotenedor">
                                <input type="text" name="Administrador" value="<?php echo $mostrar['Administrador'] ?>" />
                            </div>

                            <div class="i_item"><input class="button_item" type="submit" value="Actualizar" name="submitUpdate"> </div>
                            <div class="i_item"><input class="button_item" type="submit" value="Eliminar" name="submitDelete"> </div><!-- Boton de actualizar que lleva al proceso_update -->
                    </form>
                </div>
    <?php
                            }
                        }
                        include("../Tablas PCs/Proceso_update.php"); //Lo lleva al proceso update
                    }
    ?>

    </body>

    </html>