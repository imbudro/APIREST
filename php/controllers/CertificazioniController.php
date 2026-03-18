<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CertificazioniController
{
  public function index(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM certificazioni");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }
  
  
  public function show(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM certificazioni where alunno_id=".$args['id']);
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }




  public function create(Request $request, Response $response, $args){
    $params = json_decode($request -> getBody(), true);
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("INSERT INTO `certificazioni`( `id`, `alunno_id`, `titolo`, `votazione`, `ente`) VALUES ( '" . $params['id'] . "', '" . $params['alunno_id'] . "', '" . $params['titolo'] . "' , '" . $params['votazione'] . "' , '" . $params['ente'] . "');");
    if($result){
      $results['message'] = "Certificazione aggiunta" ;
    }
    else{

      $results['message'] = "la certificazione NON è stata inserita" ;
    }




    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }  

  

  public function update(Request $request, Response $response, $args){
    $params = json_decode($request -> getBody(), true);
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query( $result = $mysqli_connection->query(
      "UPDATE `certificazioni` 
       SET `id`='" . $params['id'] . "',
       `alunno_id`='" . $params['alunno_id'] . "',
       `titolo`='" . $params['titolo'] . "',
       `votazione`='" . $params['votazione'] . "',
       `ente`='" . $params['ente'] . "'
       WHERE id = " . $args['id']));
    if($result){
      $results['message'] = "certificazione non aggiornata" ;
    }
    else{

      $results['message'] = "certificazione aggiornata" ;
    }

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }  

  public function destroy(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("DELETE FROM certificazioni WHERE id=".$args['id']);
    if($result){
      $results['message'] = "certificazione" . $args['id']. " rimossa con successo" ;
    }
    else{

      $results['message'] = "certificazione" . $args['id']. " NON rimossa" ;
    }
    $response->getBody()->write(json_encode($results));
    
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

}