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

    public function testFindById_idExists_ContactObject()
    {
        $id = 1;
        $first_name  = "testFirstName";
        $last_name   = "testLastName";
        $email_adres = "test@gmail.com";
        $contact     = new Contacts($id, $first_name, $last_name, $email_adres);
        $this->connection->exec("INSERT INTO contacts (id, first_name, last_name, email_address) VALUES (1,
                                                                                                        '$first_name', 
                                                                                                        '$last_name',
                                                                                                        '$email_adres'");
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

    public function testAddNewObject_objectIsAdded_ContactObject()
    {
        $id = 1;
        $first_name  = "testFirstName";
        $last_name   = "testLastName";
        $email_adres = "test@gmail.com";
        $contact     = new Contacts($id, $first_name, $last_name, $email_adres);
        $this->connection->exec("INSERT INTO contacts (id, first_name, last_name, email_address) VALUES (1,
                                                                                                        '$first_name', 
                                                                                                        '$last_name',
                                                                                                        '$email_adres'");
        $contactDAO    = new PDOContactsDAO($this->connection);
        $actualContact = $contactDAO->findById($id);
        $this->assertEquals($contact, $actualContact);
    }

    public function testRemoveObjectById_objectIsRemoved_Null()
    {
        $first_name  = "testFirstName1";
        $last_name   = "testLastName1";
        $email_adres = "test1@gmail.com";
        $contact     = new Contacts(1, $first_name, $last_name, $email_adres);

        $this->fillDBWithData();
        $this->connection->exec("DELETE FROM contacts WHERE id = 1");

        $contactDAO    = new PDOContactsDAO($this->connection);
        $actualContact = $contactDAO->findById(1);
        $this->assertEquals($contact, $actualContact);
    }


    /**
     * @expectedException model\ModelException
     **/
    public function testFindContactById_tableContactDoesntExist_ModelException()
    {
        $this->connection->exec("DROP TABLE contacts");
        $contactDAO=new PDOContactsDAO($this->connection);
        $actualContact = $contactDAO->findById(1);

    }

    // Helper function to fill the DB with dummy data.
    public function fillDBWithData()
    {
        $first_name_1  = "testFirstName1";
        $last_name_1  = "testLastName1";
        $email_adres_1 = "test1@gmail.com";

        $first_name_2  = "testFirstName2";
        $last_name_2  = "testLastName2";
        $email_adres_2 = "test2@gmail.com";

        // Add a first contact in the DB.
        $this->connection->exec("INSERT INTO contacts (id, first_name, last_name, email_address) VALUES (1,
                                                                                                        '$first_name_1', 
                                                                                                        '$last_name_1',
                                                                                                        '$email_adres_1'");
        // Add a 2nd contact in the DB.
        $this->connection->exec("INSERT INTO contacts (id, first_name, last_name, email_address) VALUES (2,
                                                                                                        '$first_name_2', 
                                                                                                        '$last_name_2',
                                                                                                        '$email_adres_2'");
    }
}