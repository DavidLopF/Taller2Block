<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "transacciones";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}


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

    // SELECCIONAR EL ID DEL BANCO ORIGEN
    $banco = "SELECT bank_id FROM bank WHERE description_bank  = '$bancoOrigen'";
    $result = $conn->query($banco);
    $row = $result->fetch_assoc();
    echo "ID Banco Origen: " . $row["bank_id"] . "<br>";
    $bankOrigin = $row["bank_id"];

    // SELECCIONAR EL ID DEL BANCO DESTINO
    $banco = "SELECT bank_id FROM bank WHERE description_bank  = '$bancoDestino'";
    $result = $conn->query($banco);
    $row = $result->fetch_assoc();
    echo "ID Banco Destino: " . $row["bank_id"] . "<br>";
    $bankDestination = $row["bank_id"];


    //SELECCIONA EL ID DEL TIPO DE CUENTA ORIGEN Y DESTINO
    $sql = "SELECT account_type_id FROM account_type WHERE description_type = '$tipoCuentaOrigen'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo "ID Tipo de Cuenta Origen: " . $row["account_type_id"] . "<br>";
    $typeAccountOrigin = $row["account_type_id"];


    $sql = "SELECT account_type_id FROM account_type WHERE description_type = '$tipoCuentaDestino'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo "ID Tipo de Cuenta Destino: " . $row["account_type_id"] . "<br>";
    $typeAccountDestination = $row["account_type_id"];


    //guarda la transaccion
    $sql = "INSERT INTO transacciones.`transaction`
    (CUS, bank_send_id, bank_receives_id, account_root, account_destination, amount, transaction_date, description_transaction, account_type_send_id, account_type_receives_id)
    VALUES( $cus, $bankOrigin , $bankDestination, $cuentaOrigen, $cuentaDestino, $valorTransaccion, '$fechaHora' , '$descripcion', $typeAccountOrigin, $typeAccountDestination);";

    
    if ($conn->query($sql) === TRUE) {
        echo "Nuevo registro creado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "No se recibieron datos desde el formulario";
}