<?php
namespace App\VendorsIntegration\Exceptions;

use App\VendorsIntegration\Exceptions\BaseException;

class ItemNotFoundException extends BaseException
{
    /**
     * Create ItemNotFoundException Class
     * @param string $message
     */
    public function __construct($message = 'The request item not found')
    {
        parent::__construct($message);
    }
}
