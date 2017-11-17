<?php
/**
 * Created by PhpStorm.
 * User: bpeeten
 * Date: 30/10/17
 * Time: 21:00
 */

namespace model;

include ('DAO.php');
include ('Contacts.php');

class PDOContactsDAO implements DAO
{
    private $connection = null;

    public function __construct(\PDO $connection)
    {
        echo 'beforeconstructDAO<br/>';
        $this->connection = $connection;
    }

    public function findAll()
    {
        echo 'DAO';
        try {
            $statement = $this->connection->query('SELECT * FROM contacts');
            if ($statement==false) {
                throw new ModelException("Problem with PDOStatement");
            }
            $statement->execute();
            $contacts = null;
            $statement->setFetchMode(\PDO::FETCH_ASSOC);
            echo 'beforefetch<br/>';
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
            echo 'afterfetch<br/>';
            foreach ($results as $result) {
                $contacts[] = new Contacts($result['id'], $result['first_name'], $result['last_name'], $result['email_address']);
            }
            echo 'DAOTRY<br/>';
            return $contacts;
        } catch (\PDOException $exception) {
            echo 'DAOcatch<br/>';
            throw new ModelException("PDO Exception.", 0, $exception);
        }
    }

    public function findById($id)
    {
        // TODO: Implement findContactById() method.
    }

    public function addNewContact()
    {
        // TODO: Implement addNewContact() method.
    }

    public function removeContactById($id)
    {
        // TODO: Implement removeContactById() method.
    }

    public function findContactById($id)
    {
        // TODO: Implement findContactById() method.
    }
}
//
//
//
/*$user     = 'root';
$password = 'root';
$database = 'AddressBook';
$server   = 'localhost';
$pdo      = null;
$pdo      = new \PDO("mysql:host=$server;dbname=$database", $user, $password);

$pdo->setAttribute(\PDO::ATTR_ERRMODE,
    \PDO::ERRMODE_EXCEPTION);

$contactDAO        =   new PDOContactsDAO($pdo);

$contacts = $contactDAO->findAll();

foreach($contacts AS $contact){
    echo json_encode($contact);
}*/