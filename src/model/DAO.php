<?php
/**
 * Created by PhpStorm.
 * User: bpeeten
 * Date: 30/10/17
 * Time: 20:59
 */

namespace model;

interface DAO
{
    public function findAll();
    public function findById($id);
    public function addObject($object);
    public function updateById($object);
    public function removeById($id);
}