<?php
/**
 * Created by PhpStorm.
 * User: bpeeten
 * Date: 30/10/17
 * Time: 22:01
 */

class ContactController
{
    private $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function handleFindPersonById($id)
    {
        $statuscode=200;
        $person=null;
        try {
            $person = $this->contactRepository->findContactById($id);
            if ($person==null) {
                $statuscode=204;
            }
        } catch (ModelException $exception) {
            $statuscode=500;
        }
        //$this->personView->show(['person' => $person], $statuscode);
    }

    public function handleFindPersons()
    {
        $statuscode=200;
        $persons=[];
        try {
            $persons = $this->contactRepository->findContacts();
        } catch (ModelException $exception) {
            $statuscode=500;
        }
    }
}