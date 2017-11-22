<?php
/**
 * Created by PhpStorm.
 * User: bpeeten
 * Date: 21/11/17
 * Time: 21:27
 */

use PHPUnit\Framework\TestCase;
use \model\Contacts;
use \model\PDOContactsDAO;

class PDOContactDAOTest extends TestCase
{
    public function setUp()
    {
        $this->connection = new PDO('sqlite::memory:');
        $this->connection->exec('CREATE TABLE contacts (
                        id INT, 
                        first_name VARCHAR(40),
                        last_name VARCHAR(40),
                        email_address VARCHAR(100),
                        PRIMARY KEY (id)
                   )');
    }

    public function tearDown()
    {
        $this->connection=null;
    }

    public function testFindById_idExists_PersonObject()
    {
        $id = 1;
        $first_name  = "testFirstName";
        $last_name   = "testLastName";
        $email_adres = "test@gmail.com";
        $contact     = new Contacts($id, $first_name, $last_name, $email_adres);
        $this->connection->exec("INSERT INTO contacts (id, first_name, last_name, email_address) VALUES (1,
                                                                                                        '$first_name', 
                                                                                                        '$last_name'),
                                                                                                        '$email_adres';");
        $contactDAO    = new PDOContactsDAO($this->connection);
        $actualContact = $contactDAO->findById($id);
        $this->assertEquals($contact, $actualContact);
    }

    public function testFindById_idDoesNotExist_Null()
    {
        $id=1;
        $contactDAO=new PDOContactsDAO($this->connection);
        $actualContact = $contactDAO->findById($id);
        $this->assertNull($actualContact);
    }

    /**
     * @expectedException model\ModelException
     **/
    public function testFindPersonById_tablePersonDoesntExist_ModelException()
    {
        $this->connection->exec("DROP TABLE contacts");
        $contactDAO=new PDOContactsDAO($this->connection);
        $actualContact = $contactDAO->findById(1);
    }
}