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

    if (empty($fechaHora) || empty($bancoOrigen) || empty($cuentaOrigen) || empty($tipoCuentaOrigen) || empty($bancoDestino) || empty($cuentaDestino) || empty($tipoCuentaDestino) || empty($identificacion) || empty($valorTransaccion) || empty($cus) || empty($descripcion)) {
        echo "Todos los datos son obligatorios";
        exit;
    }

    echo "<h2>Información recibida desde el formulario</h2>";
    echo "<hr>";
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
    echo "<hr>";

    // SELECCIONAR EL ID DEL BANCO ORIGEN
    $banco = "SELECT bank_id FROM bank WHERE description_bank  = '$bancoOrigen'";
    $result = $conn->query($banco);
    $row = $result->fetch_assoc();
    $bankOrigin = $row["bank_id"];

    // SELECCIONAR EL ID DEL BANCO DESTINO
    $banco = "SELECT bank_id FROM bank WHERE description_bank  = '$bancoDestino'";
    $result = $conn->query($banco);
    $row = $result->fetch_assoc();
    $bankDestination = $row["bank_id"];


    //SELECCIONA EL ID DEL TIPO DE CUENTA ORIGEN Y DESTINO
    $sql = "SELECT account_type_id FROM account_type WHERE description_type = '$tipoCuentaOrigen'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $typeAccountOrigin = $row["account_type_id"];


    $sql = "SELECT account_type_id FROM account_type WHERE description_type = '$tipoCuentaDestino'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $typeAccountDestination = $row["account_type_id"];


    //guarda la transaccion
    $sql = "INSERT INTO transacciones.`transaction`
    (CUS, bank_send_id, bank_receives_id, account_root, account_destination, amount, transaction_date, description_transaction, account_type_send_id, account_type_receives_id)
    VALUES( $cus, $bankOrigin , $bankDestination, $cuentaOrigen, $cuentaDestino, $valorTransaccion, '$fechaHora' , '$descripcion', $typeAccountOrigin, $typeAccountDestination);";

    function encrypt_decrypt($action, $string, $metod)
    {
        $output = false;

        //$encrypt_method = "AES-128-ECB";
        $encrypt_method = "DES-" . $metod;
        $key = 'ESTA ES MI CLAVE';

        if ($action == 'cifrar') {
            $output = openssl_encrypt($string, $encrypt_method, $key);
            $output;
        } else if ($action == 'descifrar') {
            $output = openssl_decrypt($string, $encrypt_method, $key);
        }

        return $output;
    }


    if ($conn->query($sql) === TRUE) {

        echo "Nuevo registro creado exitosamente";
        $data = $fechaHora . $bancoOrigen . $cuentaOrigen . $tipoCuentaOrigen . $bancoDestino . $cuentaDestino . $tipoCuentaDestino . $identificacion . $valorTransaccion . $cus . $descripcion;
        echo "<hr>";
        echo "Datos concatenados: " . $data;
        $results = array();
        $cripher_methods = array("CBC", "ECB", "CFB", "OFB");
        $times = array();
        foreach ($cripher_methods as $method) {

            $start = microtime(true);
            $results[$method] = encrypt_decrypt('cifrar', $data, $method);
            $end = microtime(true);
            $times[$method] = $end - $start;

            $sql = "INSERT INTO transacciones.cripher_methods
            (cripher_method, description_cripher)
            VALUES('$method','$results[$method]');";

            if ($conn->query($sql) === TRUE) {
                echo "Nuevo registro creado exitosamente";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        echo "<hr>";
        echo "Datos cifrados: ";
        print_r($results);
        echo "<hr>";
        echo "Tiempos de cifrado en milisegundos: ";
        print_r($times);




    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        
    }
} else {
    echo "No se recibieron datos desde el formulario";
}