<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once('Conexion_BD.php');

if (!isset($_SESSION['Id_Usuario'])) {
    header("Location:../PHP/Iniciar_Sesion.php?error=error_acceso");
    exit(); 
}

// Consulta para paciente mayor de edad modificada
$Consulta1 = "SELECT p.Id_Paciente, p.Tipo_Documento, p.Documento_Id, p.Primer_Nombre, p.Segundo_Nombre, p.Primer_Apellido, p.Segundo_Apellido, tc.Tipo_Cita, ct.Id_Cita, ct.Hora_Inicio, cl.Id_Calendario, cl.Dia, ct.Status_Cita
FROM paciente AS p INNER JOIN tipo_cita AS tc ON p.Id_Cita = tc.Id_TipoCita INNER JOIN cita AS ct ON p.Id_Paciente = ct.Id_Paciente INNER JOIN calendario AS cl ON ct.Id_Cita = cl.Id_Cita 
WHERE ct.Status_Cita = 'Espera' AND ct.Status = 'Espera' AND cl.Status = 'Activo' AND p.Status = 'Activo' ";

// Consulta para paciente menor de edad modificada
$Consulta2 = "SELECT pm.Id_Paciente, pm.Tipo_Documento, pm.Documento_Id, pm.Parentezco, pm.Tipo_Documento_Menor, pm.Documento_Menor, pm.Primer_Nombre, pm.Segundo_Nombre, pm.Primer_Apellido, pm.Segundo_Apellido, tc.Tipo_Cita, ct.Id_Cita, ct.Hora_Inicio, cl.Id_Calendario, cl.Dia, ct.Status_Cita
FROM paciente_menoredad AS pm INNER JOIN tipo_cita AS tc ON pm.Id_Cita = tc.Id_TipoCita INNER JOIN cita AS ct ON pm.Id_Paciente = ct.Id_PacienteMenor INNER JOIN calendario AS cl ON ct.Id_Cita = cl.Id_Cita 
WHERE ct.Status_Cita = 'Espera' AND ct.Status = 'Espera' AND cl.Status = 'Activo' AND pm.Status = 'Activo'";

$Declaracion1 = $Conexion->prepare($Consulta1);
if ($Declaracion1->execute()) {
    $Resultado1 = $Declaracion1->get_result();
} else {
    header("Location:../PHP/Menu_Psicologo.php?error=Error_Consulta1");
    exit();
}

$Declaracion2 = $Conexion->prepare($Consulta2);
if ($Declaracion2->execute()) {
    $Resultado2 = $Declaracion2->get_result();
} else {
    header("Location:../PHP/Menu_Psicologo.php?error=Error_Consulta2");
    exit();
}

$Declaracion1->close();
$Declaracion2->close();
?>
