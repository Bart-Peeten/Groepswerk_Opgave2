<?php
/**
 * Created by PhpStorm.
 * User: bpeeten
 * Date: 30/10/17
 * Time: 22:01
 */

namespace controller;

use ContactRepository;
use ModelException;

class ContactController
{
    private $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function handleFindContactById($id)
    {
        $statuscode=200;
        $contact=null;
        try {
            $contact = $this->contactRepository->findContactById($id);
            if ($contact==null) {
                $statuscode=204;
            }
        } catch (ModelException $exception) {
            $statuscode=500;
        }
        //$this->personView->show(['contact' => $contact], $statuscode);
    }

    public function handleFindContacts()
    {
        $statuscode=200;
        $contacts=[];
        try {
            $contacts = $this->contactRepository->findContacts();
        } catch (ModelException $exception) {
            $statuscode=500;
        }
    }

    public function handleDeleteContactById($id)
    {

    }

    public function handleAddContactByObject($jsonObject)
    {
    }

    public function handleAddContact()
    {

    }
}