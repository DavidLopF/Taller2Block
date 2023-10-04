<?php
$entidades = array("Banco Davivienda", "Banco de Bogota", "Av Villas", "Banco de Occidente", "Bancolombia");
$tiposCuenta = array("Ahorros", "Corriente");
?>

<form method="post" action="transaction.php">
    Fecha - hora: <input type="datetime-local" name="fechaHora"><br>    
    Banco Origen: 
    <select name="bancoOrigen">
        <?php foreach($entidades as $entidad) { ?>
            <option value="<?php echo $entidad; ?>"><?php echo $entidad; ?></option>
        <?php } ?>
    </select><br>
    Cuenta Origen: <input type="text" name="cuentaOrigen"><br>
    Tipo de Cuenta Origen: 
    <select name="tipoCuentaOrigen">
        <?php foreach($tiposCuenta as $tipo) { ?>
            <option value="<?php echo $tipo; ?>"><?php echo $tipo; ?></option>
        <?php } ?>
    </select><br>
    Banco Destino: 
    <select name="bancoDestino">
        <?php foreach($entidades as $entidad) { ?>
            <option value="<?php echo $entidad; ?>"><?php echo $entidad; ?></option>
        <?php } ?>
    </select><br>
    Cuenta Destino: <input type="text" name="cuentaDestino"><br>
    Tipo de Cuenta Destino: 
    <select name="tipoCuentaDestino">
        <?php foreach($tiposCuenta as $tipo) { ?>
            <option value="<?php echo $tipo; ?>"><?php echo $tipo; ?></option>
        <?php } ?>
    </select><br>
    Número de identificación: <input type="text" name="identificacion"><br>
    Valor Transacción: <input type="number" min="0" name="valorTransaccion"><br>
    CUS: <input type="number" min="0" name="cus"><br>
    Descripción: <textarea name="descripcion"></textarea><br>
    <input type="submit" value="Enviar">
</form>
