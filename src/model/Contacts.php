<?php
/**
 * Created by PhpStorm.
 * User: bpeeten
 * Date: 30/10/17
 * Time: 21:43
 */

class Contacts implements \JsonSerializable
{
    private $id;
    private $first_name;
    private $last_name;
    private $email_address;

    public function __construct($id, $first_name, $last_name, $email_address)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email_address= $email_address;
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
        return $this->first_name;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return mixed
     */
    public function getEmailAdres()
    {
        return $this->email_address;
    }

    /**
     * @param mixed $emailAdres
     */
    public function setEmailAdres($email_address)
    {
        $this->emailAdres = $email_address;
    }




    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'emailAdres' => $this->email_address
        ];
    }
}