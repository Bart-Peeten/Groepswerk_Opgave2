<?php
/**
 * Created by PhpStorm.
 * User: bpeeten
 * Date: 30/10/17
 * Time: 22:01
 */

namespace controller;

use model\ContactRepository;
use model\ModelException;
use view\ContactJsonView;

class ContactController
{
    private $contactRepository;
    private $contactView;
    public function __construct(ContactRepository $contactRepository, ContactJsonView $contactView)
    {

        $this->contactRepository = $contactRepository;
        $this->contactView = $contactView;
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
        $contacts= [] ;
        try {
            $contacts = $this->contactRepository->findContacts();
        } catch (ModelException $exception) {
             $statuscode=500;
        }

        $this->contactView->show(['contacts' => $contacts],$statuscode);

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

    public function handleAddContactById($id)
    {

    }
}