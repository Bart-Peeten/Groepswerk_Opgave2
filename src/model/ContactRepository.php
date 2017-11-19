<?php
/**
 * Created by PhpStorm.
 * User: bpeeten
 * Date: 30/10/17
 * Time: 21:01
 */

namespace model;

interface ContactRepository
{
    public function findContactById($id);
    public function findAllContacts();
    public function addNew($jsonObject);
    public function removeById($id);


}