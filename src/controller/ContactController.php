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
        $this->contactView->show(['contacts' => $contact], $statuscode);
    }

    public function handleFindContacts()
    {
        $statuscode=200;
        $contacts= [] ;
        try {
            $contacts = $this->contactRepository->findAllContacts();
        } catch (ModelException $exception) {
             $statuscode=500;
        }

        $this->contactView->show(['contacts' => $contacts],$statuscode);

    }

    public function handleAddContactByObject($jsonObject)
    {
        $statuscode=200;
        try {
            $contacts = $this->contactRepository->addNew($jsonObject);
        } catch (ModelException $exception) {
            $statuscode=500;
        }
    }


    public function handleDeleteContactById($id)
    {

    }

}