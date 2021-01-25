<?php

// Función que comprueba si los datos que recibimos existen
function has_all_post_vars(...$list){
  foreach ($list as $val) {
    if (!isset($_POST[$val])) return false;
  }
  return true;
}


// Función que comprueba si los datos que recibimos de un array existen
function assert_array_fields($obj, ...$list){
  foreach ($list as $val) {
    if (!isset($obj[$val]))
      die(format_error("Required field ".$val));
  }
}

// Formatea un error en JSON
function format_error($msg) {
  $result = array (
    "estado"  => false,
    "mensaje" => $msg
  );
  return json_encode($result, JSON_PRETTY_PRINT);
}

function generateRandomString($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

?>
