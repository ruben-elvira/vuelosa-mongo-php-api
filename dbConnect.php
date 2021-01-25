<?php

function get_mongo_collection() {

    if (!extension_loaded("mongodb")) {
        die(format_error("Extensión 'mongodb' no cargada"));
    }

    $db = "ADAT_Vuelos";
    $col = "vuelos_ampliada";

    try {
        $collection = (new MongoDB\Client)->$db->$col;
    } catch (Exception $e ) { 
        die(format_error("Error connecting to database " . $e));
    }

    return $collection;
}

?>
