<?php
/**
 * Created by PhpStorm.
 * User: bpeeten
 * Date: 30/10/17
 * Time: 21:00
 */

namespace model;

class PDOContactsDAO
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
                throw new \ModelException("Problem with PDOStatement");
            }
            $statement->execute();
            $contacts = null;
            $statement->setFetchMode(\PDO::FETCH_ASSOC);
            //$statement->fetchAll(\PDO::FETCH_ASSOC);

//            foreach ($results as $result) {
//                $contacts[] = new Contacts($result["id"].val(), $result["first_name"], $result["last_name"], $result["email_address"]);
//            }
            $i = 0;
            if($statement->rowCount() >0){
                while($result = $statement->fetch(\PDO::FETCH_ASSOC)){
                    $contacts[$i] = new Contacts("1","Y","B","J");
                    $i++;
                    echo "hello";
                }
            }else{
                $contacts[0] = new Contacts("1","Y","B","J");
                echo "hello";
            }


            return $contacts;
        } catch (\PDOException $exception) {
            throw new ModelException("PDO Exception.", 0, $exception);
        };
    }

    public function findContactById($id)
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
}