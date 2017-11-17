<?php

namespace view;

interface JsonView
{
    public function show(array $data, $statusCode);
}
