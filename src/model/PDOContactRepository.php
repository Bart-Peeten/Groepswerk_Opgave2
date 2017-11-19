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
        $this->contactDAO = $contactDAO;
    }

    public function findContactById($id)
    {
        $person = null;
        if ($this->isValidId($id)) {
            $person = $this->contactDAO->findById($id);
        }
        return $person;
    }

    public function findAllContacts()
    {
        $contacts = $this->contactDAO->findAll();
        return $contacts;
    }

    public function addNew($jsonObject)
    {
        // TODO: Implement addNew() method.
    }

    public function removeById($id)
    {
        // TODO: Implement removeById() method.
    }

    private function isValidId($id)
    {
        if (is_string($id) && ctype_digit(trim($id))) {
            $id=(int)$id;
        }
        return is_integer($id) and $id >= 0;
    }
}