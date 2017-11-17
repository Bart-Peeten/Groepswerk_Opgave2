<?php
/**
 * Created by PhpStorm.
 * User: bpeeten
 * Date: 30/10/17
 * Time: 21:02
 */

namespace model;

class PDOContactRepository implements ContactRepository
{
    private $contactDAO = null;

    public function __construct(PDOContactsDAO $contactDAO)
    {
        echo 'construct repos';
        $this->contactDAO = $contactDAO;
    }

    public function findContactById($id)
    {
        $person=null;
        if ($this->isValidId($id)) {
            echo 'findbyidh';
            $person = $this->contactDAO->findById($id);
        }
        return $person;
    }

    public function findContacts()
    {
        echo 'repo';
        $contacts = $this->contactDAO->findAll();
        return $contacts;
    }

    private function isValidId($id)
    {
        if (is_string($id) && ctype_digit(trim($id))) {
            $id=(int)$id;
        }
        return is_integer($id) and $id >= 0;
    }
}