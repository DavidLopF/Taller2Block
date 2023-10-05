<?php
    function encrypt_decrypt($action, $string, $clave ) {
        $output = false;
     
        //$encrypt_method = "AES-128-ECB";
        $encrypt_method = "DES-CBC";
        $key = $clave;
     
        if ( $action == 'cifrar' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key);
            $output;
        } else if( $action == 'descifrar' ) {
            $output = openssl_decrypt($string, $encrypt_method, $key);
        }
     
        return $output;
    }

    $cripher_text = "2023-10-04T23:13Banco Davivienda3142345235AhorrosBanco de Occidente4324234523Ahorros123432456765873Prueba final";
    echo "Plain Text =" .$cripher_text. "<br>";
    $k1 = hexdec("1FE01FE00EF10EF1");
    $k2 = hexdec("E01FE01FF10EF10E");


    $encrypted_txt = encrypt_decrypt('cifrar', $cripher_text, $k1);
    echo "Encrypted Text  wiht k1 = " .$encrypted_txt. "<br>";
    $encrypted_txt = encrypt_decrypt('cifrar', $encrypted_txt, $k2);
    echo "Encrypted Text  wiht k2 = " .$encrypted_txt. "<br>";
    $decrypted_txt = encrypt_decrypt('descifrar', $encrypted_txt, $k1);
    echo "Encrypted Text  wiht k3 = " .$decrypted_txt. "<br>";
    
