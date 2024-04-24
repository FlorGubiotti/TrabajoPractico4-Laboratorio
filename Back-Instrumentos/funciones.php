<?php
include_once("conexion.php");
ini_set('display_errors', 'Off');

// Configurar las cabeceras CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Manejar solicitudes OPTIONS
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    exit();
}

$query = "SELECT * FROM instrumento";
$filtro = false;
if ($_REQUEST["id"]) {
    $filtro = true;
    $query .= " WHERE id = " . $_REQUEST["id"] . "";
}
$query .= " ORDER BY id ASC";

$result = mysqli_query($conexion, $query) or die(mysqli_error($conexion));

$myarray = array();
while ($row = mysqli_fetch_assoc($result)) {
    $myObj = new stdClass();
    $myObj->id = intval($row['id']);
    $myObj->instrumento = $row['instrumento'];
    $myObj->marca = $row['marca'];
    $myObj->modelo = $row['modelo'];
    $myObj->imagen = $row['imagen'];
    $myObj->precio = round((float)$row['precio'], 2);
    $myObj->costoEnvio = $row['costoEnvio'];
    $myObj->cantidadVendida = $row['cantidadVendida'];
    $myObj->descripcion = $row['descripcion'];
    array_push($myarray, $myObj);
}
header('Content-Type: application/json; charset=utf-8');
if ($filtro) {
    echo json_encode($myObj);
} else {
    echo json_encode($myarray);
}
?>