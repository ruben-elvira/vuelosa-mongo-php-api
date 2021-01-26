<?php
require_once 'dbConnect.php';
require_once 'utils.php';

function update($data)
{
    $coleccion = get_mongo_collection();
    $filtro = [
        'codigo' => $data["codigo"],
        'vendidos' => [
            'codigoVenta' => $codigoVenta]
    ];
    $updateDoc = [
        '$set' => [
            'vendidos' => [
                'dni' => $data['dni'],
                'apellido' => $data['apellido'],
                'nombre' => $data['nombre'],
                'dniPagador' => $data['dniPagador'],
                'tarjeta' => $data['tarjeta'],
                'codigoVenta' => $codigoVenta
            ]
        ]
    ];
    $updateResults = $coleccion->updateOne($filtro, $updateDoc);
}
?>
