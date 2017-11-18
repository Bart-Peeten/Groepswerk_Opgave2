<?php
/**
 * Created by PhpStorm.
 * User: bpeeten
 * Date: 30/10/17
 * Time: 21:00
 */

namespace model;


class PDOContactsDAO implements DAO
{
    private $connection = null;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll()
    {
        try {
            $statement = $this->connection->query('SELECT * FROM contacts');
            if ($statement==false) {
                throw new ModelException("Problem with PDOStatement");
            }
            $statement->execute();
            $contacts = null;
            $statement->setFetchMode(\PDO::FETCH_ASSOC);
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($results as $result) {
                $contacts[] = new Contacts($result['id'], $result['first_name'], $result['last_name'], $result['email_address']);
            }
            return $contacts;
        } catch (\PDOException $exception) {
            throw new ModelException("PDO Exception.", 0, $exception);
        }
    }

    public function findById($id)
    {
        try {
            $statement = $this->connection->query('SELECT * FROM contacts WHERE id = ' . $id);
            if ($statement==false) {
                throw new ModelException("Problem with PDOStatement");
            }
            $statement->execute();
            $contacts = null;
            $statement->setFetchMode(\PDO::FETCH_ASSOC);
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($results as $result) {
                $contacts[] = new Contacts($result['id'], $result['first_name'], $result['last_name'], $result['email_address']);
            }
            return $contacts;
        } catch (\PDOException $exception) {
            throw new ModelException("PDO Exception.", 0, $exception);
        }
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
//$user     = 'root';
//$password = 'root';
//$database = 'AddressBook';
//$server   = 'localhost';
//$pdo      = null;
//$pdo      = new \PDO("mysql:host=$server;dbname=$database", $user, $password);
//
//$pdo->setAttribute(\PDO::ATTR_ERRMODE,
//    \PDO::ERRMODE_EXCEPTION);
//
//$contactDAO        =   new PDOContactsDAO($pdo);
//
//$contacts = $contactDAO->findAll();
//
//foreach($contacts AS $contact){
//    echo json_encode($contact);
//}