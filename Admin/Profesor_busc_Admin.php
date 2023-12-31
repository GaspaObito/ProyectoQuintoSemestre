<?php include("../Template/CabeceraAnot.php"); ?>
<main class="ContainerGeneral">
    <div class="anotaciones">
        <h1 id="TitleStart">ACTUALIZAR PROFESOR</h1>
        <form action="Profesor_busc_Admin.php" method="post">
            <fieldset>
                <legend>Buscar Docente por N.I</legend>
                <div class="Formulario_Campos1">
                    <div style="display:flex;">
                        <label for="N.I" style="padding: 10px 10px 10px 0;">N.I</label>
                        <input class="Input_Text" type="text" id="N.I" name="Identificacionn" placeholder="N.I del Docente">
                    </div>
                    <div class="alinear-boton">
                        <button class="boton" type="submit" name='buscarDatos'>BUSCAR DOCENTE</button>
                    </div>
                </div>
            </fieldset>
        </form>
        <?php
        include '../Config/Conexion.php';
        /*SEARCH ID UNIQUE TEACHER BLOCK*/
        if (isset($_POST["buscarDatos"])) {
            $Id_Profe = $_POST['Identificacionn'];
            $consultar = mysqli_query($conexion, "SELECT CONCAT(o.Nombre, ' ', o.Apellido) AS NombreCompleto, o.*, c.Nom_Curso
            FROM profesor o  LEFT JOIN curso c ON o.Id_Profesor = c.Id_Profesor WHERE o.Id_Profesor='$Id_Profe'") or die("ERROR AL TRAER LOS DATOS");
            ?>            
            <div class="Container1">
                <table class="Custom_Table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Asignado</th>
                            <th>Curso</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>                  
                    <tbody>
                    <?php while ($extraido = mysqli_fetch_array($consultar)) { ?>
                        <tr>
                            <td><?php echo $extraido['Id_Profesor']; ?></td>
                            <td><?php echo $extraido['NombreCompleto']; ?></td>
                            <td><?php echo $extraido['Asignatura']; ?></td>
                            <td><?php echo $extraido['Nom_Curso']; ?></td>
                            <td class="td_Actions">
                                <form action="Profesor_busc_Admin.php" method="post">       
                                    <input type="hidden" name="NumeroEliminar" value="<?php echo $extraido['Id_Profesor']; ?>">
                                    <button name="EliminarDato" class="custom-button" type="submit">
                                        <svg class="navbar-icon" style="margin:0">
                                           <use xlink:href="../Assets/Svg/Trash.svg#Trash-icon">
                                        </svg>  
                                    </button>
                                </form>                               
                                <form action="actualizar_profesor.php" method="post">   
                                    <input type="hidden" name="NumeroModificar" value="<?php echo $extraido['Id_Profesor']; ?>">
                                    <button name="InsertarAnotacion" class="custom-button" type="submit">                                                                       
                                        <svg class="navbar-icon" style="margin:0">
                                            <use xlink:href="../Assets/Svg/Edit.svg#Edit-icon">
                                        </svg>                                                           
                                    </button>
                                </form> 
                            </td>               
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>    
            </div>
            <?php
            /*SEARCH ID UNIQUE TEACHER BLOCK*/
        } else {
            /* Utilizar Join para Ingresar el otro Campos de Curso */
            $consultar = mysqli_query($conexion, "SELECT CONCAT(o.Nombre, ' ', o.Apellido) AS NombreCompleto, o.*, c.Nom_Curso
            FROM profesor o
            LEFT JOIN curso c ON o.Id_Profesor = c.Id_Profesor") or die("ERROR AL TRAER LOS DATOS");
            $query = "SELECT COUNT(*) AS total FROM profesor";
            $query = "SELECT COUNT(*) AS total FROM profesor";
            $resultado = mysqli_query($conexion, $query);
            $datos = mysqli_fetch_assoc($resultado);
            $totalFilas = $datos['total'];
            ?>          
                <div class="Container1">
                    <label>Resultados Obtenidos: (<?php echo $totalFilas ?>)</label>
                    <table class="Custom_Table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Asignado</th>
                                <th>Curso</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>                  
                        <tbody>
                        <?php while ($extraido = mysqli_fetch_array($consultar)) { ?>
                            <tr>
                                <td><?php echo $extraido['Id_Profesor']; ?></td>
                                <td><?php echo $extraido['NombreCompleto']; ?></td>
                                <td><?php echo $extraido['Asignatura']; ?></td>
                                <td><?php echo $extraido['Nom_Curso']; ?></td>
                                <td class="td_Actions">
                                    <form action="Profesor_busc_Admin.php" method="post">       
                                        <input type="hidden" name="NumeroEliminar" value="<?php echo $extraido['Id_Profesor']; ?>">
                                        <button name="EliminarDato" class="custom-button" type="submit">
                                            <svg class="navbar-icon" style="margin:0">
                                               <use xlink:href="../Assets/Svg/Trash.svg#Trash-icon">
                                            </svg>  
                                        </button>
                                    </form>                               
                                    <form action="actualizar_profesor.php" method="post">   
                                        <input type="hidden" name="NumeroModificar" value="<?php echo $extraido['Id_Profesor']; ?>">
                                        <button name="InsertarAnotacion" class="custom-button" type="submit">                                                                       
                                            <svg class="navbar-icon" style="margin:0">
                                                <use xlink:href="../Assets/Svg/Edit.svg#Edit-icon">
                                            </svg>                                                           
                                        </button>
                                    </form> 
                                </td>               
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>    
                </div>
            <?php }
            if (isset($_POST["EliminarDato"])) {
                $NumeroEliminar = $_POST['NumeroEliminar'];
                ?>
                <script>
                    var numeroEliminar = "' . $NumeroEliminar . '";
                    if (confirm("¿Estás seguro de que deseas eliminar los datos?")) {
                        // Redirigir al servidor para eliminar los datos
                        location.href = "../Config/Ft_Eliminar_Profe.php?NumeroEliminar=" + numeroEliminar;
                    } else {
                        // Cancelar la eliminación, redirigir a otra página o realizar acciones adicionales
                        alert("Eliminación cancelada");
                        location.href = "Profesor_busc_Admin.php";
                    }
                </script>
           <?php } ?>
        </div>
        <div class="alinear-boton">
            <a href="../Formulario/Create_profesor.php"> <button class="boton" type="submit" name="buscarDatos">AÑADIR PROFESOR</button></a>
        </div>
    </div>
    </div>
</main>
<?php include("../Template/FooterProfe2.php"); ?>