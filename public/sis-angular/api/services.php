<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



require_once 'vendor/autoload.php';

$db = new mysqli("localhost", "admin", "jaamnra123", "sis-angular");

$app = new \Slim\Slim();



/* 
 * mostrar servicio por client por id
 */

$app->get('/:id',function($id) use ($db,$app){
   
   $query = $db->query("SELECT services.name_service FROM clients,services WHERE clients.id = services.id_user and clients.id ='{$id}'");
    $clients = array();
    while($file = $query->fetch_assoc()){
        $clients[] = $file;
    }
    
    if($query ){
    $result = ["status"=>"Success conexion","data"=>$clients];
    }else{
       $result = ["status"=>"error conexion","message"=>"Some is bad here"]; 
    }
    
    echo json_encode($result);
    
});



$app->run();
