<?php

require_once 'dbConnect.php';
require_once 'utils.php';


function read($data) {

  $coll = get_mongo_collection();
  //echo var_dump($coll);
  //$query = "SELECT * FROM vuelos";
  //@addQuerySearch($conn, $query, $data); // add search based on $data
  //$result = $conn->query($query);

  $search = [
    'origen' => ['$regex'=>searchRegex($data, "origen")],
    'destino' => ['$regex'=>searchRegex($data, "destino")],
    'fecha' => ['$regex'=>searchRegex($data, "fecha")]
  ];
  $cursor = $coll->find($search);

  //if ($cursor->isDead()) {
  //  die(format_error("Error interno: No se pudo conectar a la coleccion de mongo especificada"));
  //}

  //echo var_dump($cursor);

  $arrayVuelos = array();
  $contador = 0;
  foreach ($cursor as $document) {
      array_push($arrayVuelos, $document);
      $contador++;
  }

  $result = array(
    "estado" =>  true,
    "encontrados" => $contador,
    "vuelos" => $arrayVuelos
  );

  if (isset($_GET["origen"]) || isset($_GET["destino"]) || isset($_GET["fecha"])) {
    $busqueda = array();
    if (isset($_GET["origen"])) $busqueda["origen"] = $_GET["origen"];
    if (isset($_GET["destino"])) $busqueda["destino"] = $_GET["destino"];
    if (isset($_GET["fecha"])) $busqueda["fecha"] = $_GET["fecha"];
    $result["busqueda"] = $busqueda;
  }

  echo json_encode($result, JSON_PRETTY_PRINT);
}

function searchRegex($arr, $field) {
  if (isset($arr[$field]) && $arr[$field] != "") {
    return new MongoDB\BSON\Regex($arr[$field], 'i');
  } else {
    return ".*"; // match all
  }
}

?>
