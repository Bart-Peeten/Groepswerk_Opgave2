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
            $statement = $this->connection->prepare('SELECT * FROM contacts WHERE id =?');

            if ($statement==false) {
                throw new ModelException("Problem with PDOStatement");
            }
            $statement->bindParam(1,$id, \PDO::PARAM_INT);

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

    public function addObject($contact)
    {
        try{
            $pdo = $this->connection;
            $pdo->beginTransaction();
            $statement = $pdo->prepare('INSERT INTO contacts (first_name, last_name, email_address) VALUES(:first_name, :last_name, :email_address)');
            $statement->bindParam(':first_name',$contact->first_name,\PDO::PARAM_STR);
            $statement->bindParam(':last_name',$contact->last_name,\PDO::PARAM_STR);
            $statement->bindParam(':email_address',$contact->email_address,\PDO::PARAM_STR);
            $numberrows= $statement->execute();
            $pdo->commit();


            return $contact;

        } catch (\PDOException $exception){
            $pdo->rollBack();
            throw new ModelException("PDO Exception.", 0, $exception);
        }
    }

    public function updateById($contact)
    {

        try{
        $pdo = $this->connection;
        $pdo->beginTransaction();
            $statement = $pdo->prepare('UPDATE contacts SET first_name = :first_name, last_name = :last_name, email_address = :email_address WHERE id = :id');
            $statement->bindParam(':first_name',$contact->first_name,\PDO::PARAM_STR);
            $statement->bindParam(':last_name',$contact->last_name,\PDO::PARAM_STR);
            $statement->bindParam(':email_address',$contact->email_address,\PDO::PARAM_STR);
            $statement->bindParam(':id',$contact->id, \PDO::PARAM_INT);

            $numberrows= $statement->execute();
            $pdo->commit();


            return $numberrows;

        } catch (\PDOException $exception){
            $pdo->rollBack();
            throw new ModelException("PDO Exception.", 0, $exception);
    }

    }

    public function removeById($id)
    {
        try{
            $pdo = $this->connection;
            $pdo->beginTransaction();
            $statement = $pdo->prepare('DELETE FROM contacts WHERE id = :id');
            $statement->bindParam(':id',$id, \PDO::PARAM_INT);

            $numberrows= $statement->execute();
            $pdo->commit();


            return $numberrows;

        } catch (\PDOException $exception){
            $pdo->rollBack();
            throw new ModelException("PDO Exception.", 0, $exception);
        }
    }
}
