<?php

require_once 'dbConnect.php';
require_once 'utils.php';

function update($data) {
  /*
  assert_array_fields($data, 'codigo', 'nuevo_codigo', 'origen', 'destino', 'fecha', 'hora', 'plazas', 'plazas_libres');

  $conn = get_conn();

  $codigo = mysqli_real_escape_string($conn, $data['codigo']);
  $nuevo_codigo = mysqli_real_escape_string($conn, $data['nuevo_codigo']);
  $origen = mysqli_real_escape_string($conn, $data['origen']);
  $destino = mysqli_real_escape_string($conn, $data['destino']);
  $fecha = (mysqli_real_escape_string($conn, $data['fecha'])) + 0;
  $hora = mysqli_real_escape_string($conn, $data['hora']);
  $plazas = intval(mysqli_real_escape_string($conn, $data['plazas']));
  $plazas_libres = intval(mysqli_real_escape_string($conn, $data['plazas_libres']));
  $miQuery  = "DELETE FROM vuelos WHERE codigo = '$codigo'";

  $miQuery  = "UPDATE vuelos SET codigo = '$nuevo_codigo', origen = '$origen' , destino = '$destino', fecha = (FROM_UNIXTIME($fecha/1000)), hora = '$hora', plazas = $plazas, plazasLibres = $plazas_libres ";
  $miQuery .= "WHERE  codigo = '$codigo'";
  
  if ($conn->query($miQuery)) {

    if ($conn->affected_rows < 1)
      die(format_error("Code not found or no changes were made"));

    $result = array(
      "success" =>  true,
      "message" => "Updated sucessfully",
      "codigo" => $codigo
    );
    echo json_encode($result, JSON_PRETTY_PRINT);

  } else {  // Error en la query
    die(format_error("Internal error: ".$conn->error));
  }

  */
}
 ?>
