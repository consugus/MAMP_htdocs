<?php

 if(!isset($_POST['submit'])) {
   exit("hubo un error");
 }

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

require 'includes/paypalConfig.php';

if(isset($_POST['submit'])){
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $email = $_POST['eMail'];
  $regalo = $_POST['regalo'];
  $total = $_POST['total_pedido'];
  $fecha = date('Y-m-d H:i:s');
  // Pedidos
  $boletos = $_POST['boletos'];
  $numero_boletos = $boletos;
  $pedido_extra = $_POST['pedido_extra'];
  $camisas = $_POST['pedido_extra']['camisas']['cantidad'];
  $precioCamisa = $_POST['pedido_extra']['camisas']['precio'];
  $etiquetas = $_POST['pedido_extra']['etiquetas']['cantidad'];
  $precioEtiquetas = $_POST['pedido_extra']['etiquetas']['precio'];

  include_once "includes/funciones/funciones.php";
  $pedido = productos_json($boletos, $camisas, $etiquetas);

  // Eventos
  $eventos = $_POST['registro'];
  $registro = eventos_json($eventos);

  try{
      require_once('includes/funciones/dbconnection.php');
      $query = "INSERT INTO registrados (";
      $query .= "nombre_registrado, ";
      $query .= "apellido_registrado, ";
      $query .= "email_registrado, ";
      $query .= "fecha_registro, ";
      $query .= "pases_articulos, ";
      $query .= "talleres_registrados, ";
      $query .= "regalo, ";
      $query .= "total_pagado )";
      $query .= "VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($query);
      // Se coloca una legra s por cada parámetro que se ingresa que no sea un entero, y una letra
      // i por cada valor númerico
      $stmt ->bind_param("ssssssis", $nombre, $apellido, $email, $fecha, $pedido, $registro, $regalo, $total);
      $stmt->execute();
      $ID_registro = $stmt->insert_id;
      $stmt->close();
      $conn->close();
      //header("Location: validar_registro.php?Exitoso=1");
  } catch(\Exception $e){
      echo $e->getMessage();
  }
}

$compra = new Payer();
$compra->setPaymentMethod('paypal');

$articulo = new Item();
$articulo->setName($producto)
      ->setCurrency('USD')
      ->setQuantity(1)
      ->setPrice($precio);

$i = 0;
$arreglo_pedido = array();
foreach ($numero_boletos as $key => $value) {
  if( (int)$value['cantidad'] > 0){
    ${"articulo$i"} = new Item();
    ${"articulo$i"}->setName('Pase: ' . $key)
                   ->setCurrency('USD')
                   ->setQuantity( (int) $value['cantidad'] )
                  ->setPrice( (int)$value['precio'] );
    $arreglo_pedido[] = ${"articulo$i"};
    $i++;
  };
}

foreach ($pedido_extra as $key => $value) {
  if( (int)$value['cantidad'] > 0){
    if($key == 'camisas'){
      $precio = (float)$value['precio'] * 0.93;
    } else{
      $precio = (int)$value['precio'];
    };
    ${"articulo$i"} = new Item();
    ${"articulo$i"}->setName('Extras: ' . $key)
                   ->setCurrency('USD')
                   ->setQuantity( (int) $value['cantidad'] )
                   ->setPrice( $precio );
    $arreglo_pedido[] = ${"articulo$i"};
    $i++;
  };
}

$listaArticulos = new ItemList();
$listaArticulos->setItems($arreglo_pedido);

$cantidad = new Amount();
$cantidad->setCurrency('USD')
         ->setTotal($total);

$transaccion = new Transaction();
$transaccion->setAmount($cantidad)
            ->setItemList($listaArticulos)
            ->setDescription('Pago GLDWEBCAMP ')
            ->setInvoiceNumber($ID_registro);

$redireccionar = new RedirectUrls();
$redireccionar->setReturnUrl(URL_SITIO . "/pago_finalizado.php?exito=true&id_pago={$ID_registro}")
              ->setCancelUrl(URL_SITIO . "/pago_finalizado.php?exito=false&id_pago={$ID_registro}");


$pago = new Payment();
$pago->setIntent("sale")
     ->setPayer($compra)
     ->setRedirectUrls($redireccionar)
     ->setTransactions(array($transaccion));

     try {
       $pago->create($apiContext);
     } catch (PayPal\Exception\PayPalConnectionException $pce) {
       // Don't spit out errors or use "exit" like this in production code
       echo '<pre>';print_r(json_decode($pce->getData()));exit;
   }

$aprobado = $pago->getApprovalLink();


header("Location: {$aprobado}");

