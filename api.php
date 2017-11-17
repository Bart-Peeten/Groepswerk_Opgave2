<?php
/**
 * Created by PhpStorm.
 * User: bpeeten
 * Date: 26/10/17
 * Time: 21:15
 */

ini_set('display_errors', 1);

require_once "vendor/autoload.php";

use model\PDOContactsDAO;
use model\PDOContactRepository;
use controller\ContactController;
use view\ContactJsonView;


function generateContactController() {
    $user     = 'root';
    $password = 'root';
    $database = 'AddressBook';
    $server   = 'localhost';
    $pdo      = null;
    $pdo      = new PDO("mysql:host=$server;dbname=$database", $user, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE,
                        PDO::ERRMODE_EXCEPTION);
    echo 'beforedao';
    $contactDAO        =   new PDOContactsDAO($pdo);
    echo 'inbetween';
    $contactRepository =   new PDOContactRepository($contactDAO);
    echo 'after dao';
    $contactView        =   new ContactJsonView();
    $contactController =   new ContactController($contactRepository, $contactView);

    return   $contactController;
}



try   {
    echo 'try api ';
    $contactController = generatecontactController();
    $router            = new AltoRouter();
    //$router->setBasePath('/Groepswerk_Opgave2/');

    $router->map(
        'GET',
        'contacts/[i:id]',
        function   ($id)   use   ($contactController)   {
            echo 'etid';
                $contactController->handleFindContactById($id);
        }
    );

    $router->map(
              'GET',
              '/contacts/',
              function () use ($contactController) {
                  echo 'et ';
                  $contactController->handleFindContacts();

              }
    );

    $router->map(
        'PUT',
        'contacts/[i:id]',
        function ($id) use ($contactController) {
            echo 'etputid';
            $contactController->handleAddContactById($id);
        }
    );

    $router->map('DELETE',
        'contacts/[i:id]',
        function ($id) use ($contactController){
            echo 'etdel';
            $contactController->handleDeleteContactById($id);
        }
    );

    $router->map('POST',
            'contacts/',
            function () use ($contactController) {
                echo 'etpost';
                // read the information from the url.
                $requestBody = file_get_contents('php://input');
                // create a jsonObject where we can put the information from the url in.
                $jsonObject = json_decode($requestBody);
                $contactController->handleAddContactByObject($jsonObject);

            }
    );


    echo $router->match();

    $match   =   $router->match($_SERVER['REQUEST_URI']);
    echo $_SERVER['REQUEST_URI'];
    echo $match;
    echo $match['target'];
    if   ($match   &&   is_callable($match['target']))   {
        echo 'matcht';
        call_user_func_array($match['target'],   $match['params']);
        echo $match['target'];
    } else {
        echo 'nomatch';
        http_response_code(500);
    }

} catch (Exception   $exception) {
    echo 'catch 499';
    http_response_code(500);
}


?>