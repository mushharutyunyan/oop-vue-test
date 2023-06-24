<?php

namespace App\Requests;

use System\Request;

class ParseUrlRequest extends Request
{

    public function __construct()
    {
        parent::__construct();
    }

    function validate(): bool
    {
        $this->errors->setMessage('ValidationError');
        if(!isset($this->data['url'])) {
            $this->errors->pushError('Url param is required');
            return false;
        }
        if (!filter_var($this->data['url'], FILTER_VALIDATE_URL)) {
            $this->errors->pushError('Please enter valid url');
            return false;
        }
        return true;
    }
}