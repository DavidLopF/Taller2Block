<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fechaHora = $_POST["fechaHora"];
    $bancoOrigen = $_POST["bancoOrigen"];
    $cuentaOrigen = $_POST["cuentaOrigen"];
    $tipoCuentaOrigen = $_POST["tipoCuentaOrigen"];
    $bancoDestino = $_POST["bancoDestino"];
    $cuentaDestino = $_POST["cuentaDestino"];
    $tipoCuentaDestino = $_POST["tipoCuentaDestino"];
    $identificacion = $_POST["identificacion"];
    $valorTransaccion = $_POST["valorTransaccion"];
    $cus = $_POST["cus"];
    $descripcion = $_POST["descripcion"];

    // Imprimir los datos recibidos
    echo "<h2>Información recibida desde el formulario</h2>";
    echo "Fecha - hora: " . $fechaHora . "<br>";
    echo "Banco Origen: " . $bancoOrigen . "<br>";
    echo "Cuenta Origen: " . $cuentaOrigen . "<br>";
    echo "Tipo de Cuenta Origen: " . $tipoCuentaOrigen . "<br>";
    echo "Banco Destino: " . $bancoDestino . "<br>";
    echo "Cuenta Destino: " . $cuentaDestino . "<br>";
    echo "Tipo de Cuenta Destino: " . $tipoCuentaDestino . "<br>";
    echo "Número de identificación: " . $identificacion . "<br>";
    echo "Valor Transacción: " . $valorTransaccion . "<br>";
    echo "CUS: " . $cus . "<br>";
    echo "Descripción: " . $descripcion . "<br>";
} else {
    echo "No se recibieron datos desde el formulario";
}