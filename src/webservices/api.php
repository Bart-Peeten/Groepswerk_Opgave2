<?php
/**
 * Created by PhpStorm.
 * User: bpeeten
 * Date: 26/10/17
 * Time: 21:15
 */

function   generatePersonController() {
    $user     = 'root';
    $password = 'root';
    $database = 'persondb';
    $server   = 'localhost';
    $pdo      = null;
    $pdo      = new   PDO("mysql:host=$server;dbname=$database", $user, $password);                                                    $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,
                        PDO::ERRMODE_EXCEPTION);

    $personDAO   =   new   PDOPersonDAO($pdo);
    $personRepository   =   new   PDOPersonRepository($personDAO);
    $personJsonView   =   new   PersonJsonView();
    $personsJsonView   =   new   PersonsJsonView();
    $personController   =   new   PersonController($personRepository,
                                                   $personJsonView,
                                                   $personsJsonView);

    return   $personController;
}



try   {
    $personController=generatePersonController();
    $router   =   new   AltoRouter();
    $router->setBasePath('/');

    $router->map(
        'GET',
        'persons/[i:id]',
        function   ($id)   use   ($personController)   {
                $personController->handleFindPersonById($id);
        }
    );

    $router->map(
              'GET',
              'persons/',
              function () use ($personController) {
                  $personController->handleFindPersons();
              }
          );

    $router->map('POST',
            'persons/',
            function () {
                $requestBody = file_get_contents('php://input');
                $jsonObject = json_decode($requestBody);
                //   ...
            }
    );

    $match   =   $router->match();
    if   ($match   &&   is_callable($match['target']))   {
        call_user_func_array($match['target'],   $match['params']);
    } else {
        http_response_code(500);
    }

} catch (Exception   $exception) {
    http_response_code(500);
}


?>