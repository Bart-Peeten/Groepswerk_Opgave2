<?php
/**
 * Created by PhpStorm.
 * User: bpeeten
 * Date: 26/10/17
 * Time: 21:15
 */

function   generateContactController() {
    $user     = 'root';
    $password = 'root';
    $database = 'AddressBook';
    $server   = 'localhost';
    $pdo      = null;
    $pdo      = new   PDO("mysql:host=$server;dbname=$database", $user, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE,
                        PDO::ERRMODE_EXCEPTION);

    $contactDAO        =   new   PDOContactsDAO($pdo);
    $contactRepository =   new   PDOContactRepository($contactDAO);
    //$personJsonView  =   new   PersonJsonView();
    //$personsJsonView =   new   PersonsJsonView();
    $contactController =   new   ContactController($contactRepository);

    return   $contactController;
}



try   {
    $contactController=generatecontactController();
    $router   =   new   AltoRouter();
    $router->setBasePath('/');

    $router->map(
        'GET',
        'contacts/[i:id]',
        function   ($id)   use   ($contactController)   {
                $contactController->handleFindContactById($id);
        }
    );

    $router->map(
              'GET',
              'contacts/',
              function () use ($contactController) {
                  $contactController->handleFindContacts();
              }
    );

    $router->map(
        'PUT',
        'contacts/',
        function () use ($contactController) {
            $contactController->handleAddContact();
        }
    );

    $router->map('DELETE',
        'contacts/[i:id]',
        function ($id) use ($contactController){
            $contactController->handleDeleteContactById($id);
        }
    );

    $router->map('POST',
            'contacts/',
            function () use ($contactController) {
                $requestBody = file_get_contents('php://input');
                $jsonObject = json_decode($requestBody);
                $contactController->handleAddContact($jsonObject);

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