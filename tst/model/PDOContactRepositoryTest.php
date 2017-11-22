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
use \model\PDOContactRepository;

class PDOContactRepositoryTest extends TestCase
{
    protected $mockContactDAO;

    public function setUp()
    {

        $this->mockContactsDAO = $this->getMockBuilder(PDOContactsDAO::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function tearDown()
    {
        $this->mockContactsDAO = null;
    }

    public function testFindContactById_idExists_ContactObject()
    {
        $id = 1;
        $first_name = 'testFirstName';
        $last_name = 'testLastName';
        $email_adress = 'test@gmail.com';
        $contact = new Contacts($id, $first_name, $last_name, $email_adress);
        $this->mockContactDAO->expects($this->atLeastOnce())
            ->method('findById')
            ->with($this->equalTo($id))
            ->will($this->returnValue($contact));

        $contactRepository = new PDOContactRepository($this->mockContactDAO);
        $actualContact = $contactRepository->findContactById($id);
        $this->assertEquals($contact, $actualContact);
    }

    public function testFindContactById_idDoesNotExist_Null()
    {
        $id = 1;
        $this->mockContactDAO->expects($this->atLeastOnce())
            ->method('findById')
            ->with($this->equalTo($id))
            ->will($this->returnValue(null));

        $contactRepository = new PDOContactRepository($this->mockContactDAO);
        $actualContact = $contactRepository->findContactById($id);
        $this->assertNull($actualContact);
    }

    public function testRemoveContactById_contactIsRemoved_Numberrows()
    {
        $id = 1;
        $numberrows = 1;
        $this->mockContactDAO->expects($this->atLeastOnce())
                             ->method('removeById')
                             ->with($this->equalTo($id))
                             ->will($this->returnValue($numberrows));

        $contactRepository = new PDOContactRepository($this->mockContactDAO);
        $actualNumberRows = $contactRepository->removeContactById($id);
        $this->assertEquals($numberrows, $actualNumberRows);
    }

    /**
     * @dataProvider invalidIDProvider
     */
    public function testFindContactById_invallidID_Null($id)
    {
        $contactRepository = new PDOContactRepository($this->mockContactDAO);
        $actualContact     = $contactRepository->findContactById($id);
        $this->assertNull($actualContact);
    }


    public function invalidIDProvider()
    {
        return [
            ["a"],
            ["-1"],
            [-1],
            [new stdClass()]
        ];
    }
}