<?php

use MongoDB\Operation\ModifyCollection;

require_once 'dbConnect.php';
require_once 'utils.php';

function insert($data) {
  assert_array_fields($data, 'codigo', 'dni', 'apellido', 'nombre', 'dniPagador', 'tarjeta');

  $coll = get_mongo_collection();

  $codigoVenta = generateRandomString(7);
 

  $filterDoc = [
    'codigo' => $data['codigo']
  ];

  $detallesVuelo = $coll->findOne(['codigo' => $data['codigo']]);
  $asiento = $detallesVuelo['plazas_totales'] - $detallesVuelo['plazas_disponibles'] + 1;

  $updateDoc = [
    '$push' => 
      ['vendidos' => 
        [
          'asiento' => $asiento,
          'dni' => $data['dni'],
          'apellido' => $data['apellido'],
          'nombre' => $data['nombre'],
          'dniPagador' => $data['dniPagador'],
          'tarjeta' => $data['tarjeta'],
          'codigoVenta' => $codigoVenta
        ]
      ]
  ];

  $updateResult = $coll->updateOne($filterDoc,$updateDoc);
  $updateResult = $coll->updateOne($filterDoc, ['$inc' => ['plazas_disponibles' => -1]]);

  $modifiedCount = $updateResult->getModifiedCount();

  if ($modifiedCount !== 1) {
    die(format_error("No se pudo completar la compra"));
  }

  $result = @array(
    "estado" =>  true,
    "codigo" => $data['codigo'],
    "origen" => $detallesVuelo['origen'],
    "destino" => $detallesVuelo['destino'],
    "fecha" => $detallesVuelo['fecha'],
    "hora" => $detallesVuelo['hora'],
    'asiento' => $asiento,
    'dni' => $data['dni'],
    'apellido' => $data['apellido'],
    'nombre' => $data['nombre'],
    'dniPagador' => $data['dniPagador'],
    'tarjeta' => $data['tarjeta'],
    "codigoVenta" => $codigoVenta,
    "costeBillete" => $detallesVuelo['costeBillete']
  );
  echo json_encode($result, JSON_PRETTY_PRINT);
  
}

 ?>
