<?php
namespace view;

class ContactJsonView implements JsonView
{
    public function show(array $data, $statuscode)
    {
        echo 'et';
        header('Content-Type: application/json');
        http_response_code($statuscode);
        $contacts = $data['contacts'];
        echo json_encode($contacts);
    }
}
