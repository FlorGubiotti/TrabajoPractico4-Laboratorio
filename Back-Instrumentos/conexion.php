<?php

$conexion = new mysqli("localhost", "root", "1351986mysql");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$createDatabaseQuery = "CREATE DATABASE IF NOT EXISTS InstrumentosDB";
if ($conexion->query($createDatabaseQuery) !== TRUE) {
    die("Error al crear la base de datos: " . $conexion->error);
}

if (!$conexion->select_db("InstrumentosDB")) {
    die("Error al seleccionar la base de datos: " . $conexion->error);
}

$createTableQuery = "CREATE TABLE IF NOT EXISTS instrumento (
    id VARCHAR(10) PRIMARY KEY,
    instrumento VARCHAR(500) NOT NULL,
    marca VARCHAR(50) NOT NULL,
    modelo VARCHAR(50) NOT NULL,
    imagen VARCHAR(50) NOT NULL,
    precio VARCHAR(50) NOT NULL,
    costoEnvio VARCHAR(50) NOT NULL,
    cantidadVendida VARCHAR(50) NOT NULL,
    descripcion VARCHAR(1000) NOT NULL
)";
if ($conexion->query($createTableQuery) !== TRUE) {
    die("Error al crear la tabla: " . $conexion->error);
}

$jsonFilePath = "instrumentos.json";
$jsonContent = file_get_contents($jsonFilePath);
$jsonObject = json_decode($jsonContent, true);
$instrumentosArray = $jsonObject["instrumentos"];

$insertQuery = "INSERT INTO instrumento (id, instrumento, marca, modelo, imagen, precio, costoEnvio, cantidadVendida, descripcion) " .
    "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) " .
    "ON DUPLICATE KEY UPDATE " .
    "instrumento = VALUES(instrumento), " .
    "marca = VALUES(marca), " .
    "modelo = VALUES(modelo), " .
    "imagen = VALUES(imagen), " .
    "precio = VALUES(precio), " .
    "costoEnvio = VALUES(costoEnvio), " .
    "cantidadVendida = VALUES(cantidadVendida), " .
    "descripcion = VALUES(descripcion)";

if ($stmt = $conexion->prepare($insertQuery)) {
    $stmt->bind_param("sssssssss", $id, $instrumento, $marca, $modelo, $imagen, $precio, $costoEnvio, $cantidadVendida, $descripcion);

    foreach ($instrumentosArray as $instrumentoIndividual) {
        $id = $instrumentoIndividual["id"];
        $instrumento = $instrumentoIndividual["instrumento"];
        $marca = $instrumentoIndividual["marca"];
        $modelo = $instrumentoIndividual["modelo"];
        $imagen = $instrumentoIndividual["imagen"];
        $precio = $instrumentoIndividual["precio"];
        $costoEnvio = $instrumentoIndividual["costoEnvio"];
        $cantidadVendida = $instrumentoIndividual["cantidadVendida"];
        $descripcion = $instrumentoIndividual["descripcion"];

        if (!$stmt->execute()) {
            die("Error al insertar instrumento: " . $stmt->error);
        }
    }

} else {
    die("Error en la preparación de la consulta: " . $conexion->error);
}
