<?php

namespace PHPCRUD\CRUD\utils;


function protectData(string &$data): void
{
    $data = htmlspecialchars($data, ENT_QUOTES, "UTF-8");
}
