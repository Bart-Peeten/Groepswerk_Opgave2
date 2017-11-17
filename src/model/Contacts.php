<?php
/**
 * Created by PhpStorm.
 * User: bpeeten
 * Date: 30/10/17
 * Time: 21:43
 */

namespace model;

class Contacts implements \JsonSerializable
{
    private $id;
    private $firstName;
    private $lastName;
    private $emailAdres;

    public function __construct($id, $firstName, $lastName, $emailAdres)
    {
        $this->id         = $id;
        $this->firstName  = $firstName;
        $this->lastName   = $lastName;
        $this->emailAdres = $emailAdres;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmailAdres()
    {
        return $this->emailAdres;
    }

    /**
     * @param mixed $emailAdres
     */
    public function setEmailAdres($emailAdres)
    {
        $this->emailAdres = $emailAdres;
    }




    public function jsonSerialize()
    {
        return [
            'id'         => $this->id,
            'firstName'  => $this->firstName,
            'lastName'   => $this->lastName,
            'emailAdres' => $this->emailAdres
        ];
    }
}