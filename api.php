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

//include 'AltoRouter.php';

function generateContactController() {
    $user     = 'root';
    $password = 'root';
    $database = 'AddressBook';
    $server   = 'localhost';
    $pdo      = null;
    $pdo      = new PDO("mysql:host=$server;dbname=$database", $user, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE,
                        PDO::ERRMODE_EXCEPTION);
    $contactDAO        =   new PDOContactsDAO($pdo);
    $contactRepository =   new PDOContactRepository($contactDAO);
    $contactView        =   new ContactJsonView();
    $contactController =   new ContactController($contactRepository, $contactView);
    return   $contactController;
}


try   {
    $contactController = generatecontactController();
    $router            = new AltoRouter();
    $router->setBasePath('/Groepswerk_Opgave2/');
    //echo 'setbase ' ;

    $router->map(
        'GET',
        'contacts/',

        function () use ($contactController) {
            //echo 'GET';
            $contactController->handleFindContacts();

        }
    );

    $router->map(
        'GET',
        'contacts/[i:id]',
        function   ($id)   use   ($contactController)   {
            //echo 'GETID' ;
                $contactController->handleFindContactById($id);
        }
    );

    $router->map('POST',
            'contacts/',
            function () use ($contactController) {

                // read the information from the url.
                $requestBody = file_get_contents('php://input');
                // create a jsonObject where we can put the information from the url in.
                $jsonObject = json_decode($requestBody);

                $contactController->handleAddOrUpdateContactByObject($jsonObject);

            }
    );

    $router->map('DELETE',
        'contacts/[i:id]',
        function ($id) use ($contactController){
            $contactController->handleDeleteContactById($id);
        }
    );


    //echo $_SERVER['REQUEST_URI'];

    $match   =   $router->match();


    if   ($match   &&   is_callable($match['target']))   {
        call_user_func_array($match['target'],   $match['params']);
    } else {
        http_response_code(500);
        //print_r($_SERVER);
    }

} catch (Exception   $exception) {
    http_response_code(500);
}


?>