<?php

//url aquispe
define('URL_SITIO', 'http://localhost/Proyecto/Sitio%20de%20Conferencias/registro.php');

require 'paypal/autoload.php';

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AeTXD4JZccj1GwXEEA6u-EYsySmJ_DU0WBYnDMbjxVXBDlbEKgisZMqtxL0Z1xkfPLyFlEI6YYlwG4na',     // ClientID
        'EEF_ArJbF1ST_lcpbZGSMHmKiCXRNf47et7UTeJt_7y1S41ZAj_PNDkRkcQrQSPn8bVRScqe1vRTB6sB'      // ClientSecret
    )
);

?>