<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
// Permitir solicitudes desde cualquier origen
header("Access-Control-Allow-Origin: *");
// Permitir los métodos GET, POST, PUT, DELETE y OPTIONS
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
// Permitir ciertos encabezados en las solicitudes
header("Access-Control-Allow-Headers: Content-Type");

$app = new \Slim\App;

// GET Todos los clientes 
$app->get('/listclients', function(Request $request, Response $response){
  $sql = "SELECT * FROM clientes WHERE estado=1";
  try{
    $db = new db();
    $db = $db->conectDB();
    $resultado = $db->query($sql);

    if ($resultado->rowCount() > 0){
      $clientes = $resultado->fetchAll(PDO::FETCH_OBJ);
      return $response->withJson($clientes);
    } else {
      return $response->withJson(["error" => "No existen clientes en la BBDD."], 404);
    }
  } catch (PDOException $e) {
    return $response->withJson(["error" => $e->getMessage()], 500);
  }
}); 
// GET Recuperar cliente por ID 
$app->get('/listclient/{dni}', function(Request $request, Response $response){
  $dni_cliente = $request->getAttribute('dni');
  $sql = "SELECT * FROM clientes WHERE dni = $dni_cliente  and estado=1 ";
  try{
    $db = new db();
    $db = $db->conectDB();
    $resultado = $db->query($sql);

    if ($resultado->rowCount() > 0){
      $cliente = $resultado->fetchAll(PDO::FETCH_OBJ);
      return $response->withJson($cliente);
    } else {
      return $response->withJson(["error" => "No existe cliente en la BBDD con este dni."], 404);
    }
  } catch (PDOException $e) {
    return $response->withJson(["error" => $e->getMessage()], 500);
  }
});

// POST Crear nuevo cliente 
$app->post('/createclient', function(Request $request, Response $response){
  $nombre = $request->getParam('nombre');
  $apellido = $request->getParam('apellido');
  $edad = $request->getParam('edad');
  $fecha_nacimiento = $request->getParam('fecha_nacimiento');
  $dni = $request->getParam('dni');

  
  $sql = "INSERT INTO clientes (nombre, apellido, edad, fecha_nacimiento, dni , estado ) VALUES 
          (:nombre, :apellido, :edad, :fecha_nacimiento, :dni , 1)";
  try{
    $db = new db();
    $db = $db->conectDB();
    $resultado = $db->prepare($sql);

    $resultado->bindParam(':nombre', $nombre);
    $resultado->bindParam(':apellido', $apellido);
    $resultado->bindParam(':edad', $edad);
    $resultado->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $resultado->bindParam(':dni', $dni);


    $resultado->execute();
    return $response->withJson(["message" => "Nuevo cliente guardado."]);

    $resultado = null;
    $db = null;
  }catch(PDOException $e){
    return $response->withJson(["error" => ["text" => $e->getMessage()]], 500);
  }
}); 
// PUT Modificar cliente 
$app->put('/updateclient/{dni}', function(Request $request, Response $response){
  $nombre = $request->getParam('nombre');
  $apellido = $request->getParam('apellido');
  $edad = $request->getParam('edad');
  $fecha_nacimiento = $request->getParam('fecha_nacimiento');
  $dni = $request->getAttribute('dni');

  
  $sql = "UPDATE clientes SET
          nombre = :nombre,
          apellido = :apellido,
          edad = :edad,
          fecha_nacimiento = :fecha_nacimiento,
        
          estado=1
        WHERE dni = $dni";
     
  try{
    $db = new db();
    $db = $db->conectDB();
    $resultado = $db->prepare($sql);

    $resultado->bindParam(':nombre', $nombre);
    $resultado->bindParam(':apellido', $apellido);
    $resultado->bindParam(':edad', $edad);
    $resultado->bindParam(':fecha_nacimiento', $fecha_nacimiento);


    $resultado->execute();
    return $response->withJson(["message" => "Cliente modificado."]);

    $resultado = null;
    $db = null;
  }catch(PDOException $e){
    return $response->withJson(["error" => ["text" => $e->getMessage()]], 500);
  }
}); 

// DELETE borrar cliente 
$app->delete('/deleteclient/{dni}', function(Request $request, Response $response){
  $dni_cliente = $request->getAttribute('dni');
  $sql = "UPDATE  clientes SET estado=0 WHERE dni = $dni_cliente";
     
  try{
    $db = new db();
    $db = $db->conectDB();
    $resultado = $db->prepare($sql);
    $resultado->execute();

    if ($resultado->rowCount() > 0) {
      return $response->withJson(["message" => "Cliente eliminado."]);
    } else {
      return $response->withJson(["error" => "No existe cliente con este dni."], 404);
    }

    $resultado = null;
    $db = null;
  } catch(PDOException $e){
    return $response->withJson(["error" => ["text" => $e->getMessage()]], 500);
  }
});





