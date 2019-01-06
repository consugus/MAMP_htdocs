<?php
    // La llamada a las funciones de control de sesióin se hace en cada página que necesite protección,
    // al principio de cualquier otro código de la página
    include_once "funciones/sesiones.php";
    include_once "funciones/funciones.php";

    $sql = "SELECT fecha_registro , COUNT(*) AS cantidad FROM registrados GROUP BY DATE(fecha_registro) ORDER BY fecha_registro ";
    $resultado = $conn->query($sql);

    $arreglo_registros = array();
    while($registro_dia = $resultado->fetch_assoc() ){

        // echo "<pre>";
        //     var_dump( json_encode($registro_dia) );
        // echo "</pre>";

        $fecha = $registro_dia['fecha_registro'];
        $registro['fecha'] = date("Y-m-d", strtotime($fecha));
        $registro['cantidad'] = $registro_dia['cantidad'];
        $arreglo_registros[] = $registro;
    };

    // echo "<pre>";
    //     var_dump( json_encode($arreglo_registros) );
    // echo "</pre>";

    echo json_encode($arreglo_registros);






?>