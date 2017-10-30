<?php
/**
 * Created by PhpStorm.
 * User: bpeeten
 * Date: 30/10/17
 * Time: 20:59
 */

interface DAO
{
    public function findAll();
    public function findContactById($id);
    public function addNewContact();
    public function removeContactById($id);
}