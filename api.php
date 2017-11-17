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
    echo 'beforedao<br/>';
    $contactDAO        =   new PDOContactsDAO($pdo);
    echo 'contactDAo is aangemaakt<br/>';
    echo 'inbetween<br/>';
    $contactRepository =   new PDOContactRepository($contactDAO);
    echo 'after dao<br/>';
    echo 'PDOContactRepository is aangemaakt<br/>';
    $contactView        =   new ContactJsonView();
    $contactController =   new ContactController($contactRepository, $contactView);
    echo 'contactController is aangemaakt<br/>';

    return   $contactController;
}



try   {
    echo 'try api <br/>';
    $contactController = generatecontactController();
    $router            = new AltoRouter();
    $router->setBasePath('/');

    $router->map(
        'GET',
        '/contacts/[i:id]',
        function   ($id)   use   ($contactController)   {
            echo 'getid';
                $contactController->handleFindContactById($id);
        }
    );

    $router->map(
              'GET',
              '/Groepswerk/contacts/',
              function () use ($contactController) {
                  echo 'get ';
                  $contactController->handleFindContacts();

              }
    );

    $router->map(
        'PUT',
        '/contacts/[i:id]',
        function ($id) use ($contactController) {
            echo 'etputid';
            $contactController->handleAddContactById($id);
        }
    );

    $router->map('DELETE',
        '/contacts/[i:id]',
        function ($id) use ($contactController){
            echo 'etdel';
            $contactController->handleDeleteContactById($id);
        }
    );

    $router->map('POST',
            '/contacts/',
            function () use ($contactController) {
                echo 'etpost <br/>';
                // read the information from the url.
                $requestBody = file_get_contents('php://input');
                // create a jsonObject where we can put the information from the url in.
                $jsonObject = json_decode($requestBody);
                $contactController->handleAddContactByObject($jsonObject);

            }
    );


    echo $router->match();

    $match   =   $router->match($_SERVER['REQUEST_URI']);
    echo $match . '<br/>';
    echo $_SERVER['REQUEST_URI'];
    echo '<br/>';
    echo $match;
    echo $match['target'];
    if   ($match   &&   is_callable($match['target']))   {
        echo 'matcht <br/>';
        call_user_func_array($match['target'],   $match['params']);
        echo $match['target'];
    } else {
        echo '<br/>';
        echo 'nomatch <br/>';
        echo 'HET IS GEEN MATCH<br/>';
        http_response_code(500);
    }

} catch (Exception   $exception) {
    echo 'catch 499';
    http_response_code(500);
}


?>