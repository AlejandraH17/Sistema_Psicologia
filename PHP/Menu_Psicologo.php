<?php
session_start();
include_once('../Configuracion/Conexion_BD.php');

if (!isset($_SESSION['Id_Usuario'])) {
    header("Location: ../PHP/Iniciar_Sesion.php?error=error_acceso");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emoción Vital</title>
    <link href="../CSS/Calendario.css" rel="stylesheet">
    <link href="../fullcalendar/lib/main.min.css" rel="stylesheet">
    <link href="../CSS/Solicitud_Citas.css" rel="stylesheet">
</head>

<body>


    <!-- Mostrar el nombre del usuario -->
    <div class="Nombre_Usuario">
        <?php
        if (isset($_SESSION['Usuario'])) {
            echo "Bienvenido, " . $_SESSION['Usuario'];
        }
        ?>
    </div>

    <div class="Menu_Lateral" id="Menu_Lateral">
        <img src="" alt="">
        <ul>
            <li><a href="Menu_Psicologo.php">Inicio</a></li>
            <li><a href="Agendar_Cita.php">Agendar Cita</a></li>
            <li><a href="Citas_Psicologo.php">Citas Agendadas</a></li>
            <li><a href="Historial_Clinico.php">Historial Clinico</a></li>
            <li><a href=" ">Generar Factura</a></li>
            <li><a href=" ">Reportes</a></li>
            <li><a href="Nuevo_Registro.php">Registrar Usuario</a></li>
            <li><a href="Configuracion_Psicologo.php">Configuración</a></li>
            <li><a href="CerrarSesion.php">Cerrar Sesión</a></li>
        </ul>
    </div>



    <div class="Contenido_Principal" id="Contenido_Principal">

        <div id="Contenido_Calendario"></div>

        <div class="Contenedor_Citas" id="Contenedor_Citas">
            <h1>SOLICITUD DE CITAS</h1>
            <div class="Citas_MayorEdad" id="Citas_MayorEdad">
                <h2>CITAS INDIVIDUAL</h2>
                <form action="../Configuracion/ProcesarCita.php" method="post">
                    <table>
                        <tr>
                            <th colspan="6">Paciente</th>
                            <th colspan="4">Cita</th>
                            <th rowspan="2">Operación</th>
                        </tr>
                        <tr>
                            <th colspan="2">Identificación</th>
                            <th colspan="2">Nombres</th>
                            <th colspan="2">Apellidos</th>
                            <th>Tipo</th>
                            <th>Hora</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                        </tr>
                        <tr>
                            <?php
                            require '../Configuracion/SolicitudCitas.php';
                            if (mysqli_num_rows($Resultado1) > 0) {
                                // Mostrar los datos de cada fila
                                while ($Fila = mysqli_fetch_assoc($Resultado1)) {
                                    echo "<tr>";
                                    echo "<td>" . $Fila["Tipo_Documento"] . "</td>";
                                    echo "<td>" . $Fila["Documento_Id"] . "</td>";
                                    echo "<td>" . $Fila["Primer_Nombre"] . "</td>";
                                    echo "<td>" . $Fila["Segundo_Nombre"] . "</td>";
                                    echo "<td>" . $Fila["Primer_Apellido"] . "</td>";
                                    echo "<td>" . $Fila["Segundo_Apellido"] . "</td>";

                                    echo "<td>" . $Fila["Tipo_Cita"] . "</td>";
                                    echo "<td>" . $Fila["Hora_Inicio"] . "</td>";
                                    echo "<td>" . $Fila["Dia"] . "</td>";
                                    echo "<td>" . $Fila["Status_Cita"] . "</td>";
                                    echo "<td><input type='checkbox' name='seleccionar[]' value='" . $Fila["Id_Paciente"] . "|" . $Fila["Id_Cita"] . "|" . $Fila["Id_Calendario"] . "|" . $Fila["Tipo_Cita"] .  "'></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='11'>No hay citas agendadas.</td></tr>";
                            }
                            ?>
                        </tr>
                    </table>
            </div>

            <div class="Citas_MenorEdad">
                <h2>CITA INFANTIL O ADOLESCENTE</h2>
                <table>
                    <tr>
                        <th colspan="3">Representante</th>
                        <th colspan="6">Paciente</th>
                        <th colspan="4">Cita</th>
                        <th rowspan="2">Operación</th>
                    </tr>
                    <tr>
                        <th colspan="2">Identificación</th>
                        <th>Parentezco</th>
                        <th colspan="2">Identificación</th>
                        <th colspan="2">Nombres</th>
                        <th colspan="2">Apellidos</th>
                        <th>Tipo</th>
                        <th>Hora</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                    </tr>
                    <tr>
                        <?php
                        require '../Configuracion/SolicitudCitas.php';
                        if (mysqli_num_rows($Resultado2) > 0) {
                            // Mostrar los datos de cada fila
                            while ($Fila = mysqli_fetch_assoc($Resultado2)) {
                                echo "<tr>";
                                echo "<td>" . $Fila["Tipo_Documento"] . "</td>";
                                echo "<td>" . $Fila["Documento_Id"] . "</td>";
                                echo "<td>" . $Fila["Parentezco"] . "</td>";

                                echo "<td>" . $Fila["Tipo_Documento_Menor"] . "</td>";
                                echo "<td>" . $Fila["Documento_Menor"] . "</td>";
                                echo "<td>" . $Fila["Primer_Nombre"] . "</td>";
                                echo "<td>" . $Fila["Segundo_Nombre"] . "</td>";
                                echo "<td>" . $Fila["Primer_Apellido"] . "</td>";
                                echo "<td>" . $Fila["Segundo_Apellido"] . "</td>";

                                echo "<td>" . $Fila["Tipo_Cita"] . "</td>";
                                echo "<td>" . $Fila["Hora_Inicio"] . "</td>";
                                echo "<td>" . $Fila["Dia"] . "</td>";
                                echo "<td>" . $Fila["Status_Cita"] . "</td>";
                                echo "<td><input type='checkbox' name='seleccionar[]' value='" . $Fila["Id_Paciente"] . "|" . $Fila["Id_Cita"] . "|" . $Fila["Id_Calendario"] . "|" . $Fila["Tipo_Cita"] .  "'></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='14'>No hay citas agendadas.</td></tr>";
                        }
                        ?>
                    </tr>
                </table>
            </div>
            <!--<input type="submit" value="Enviar">-->
            <input type="submit" name="accion_aceptar" value="Aceptar">
            <input type="submit" name="accion_cancelar" value="Cancelar">
            </form>
        </div>

    </div>

    <script src="../fullcalendar/lib/main.js"></script>
    <script src="../fullcalendar/lib/locales/es.js"></script>
    <script src="../JS/Calendario.js"></script>
</body>

</html>