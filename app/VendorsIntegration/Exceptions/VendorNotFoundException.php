<?php
namespace App\VendorsIntegration\Exceptions;

use App\VendorsIntegration\Exceptions\BaseException;

class VendorNotFoundException extends BaseException
{
    /**
     * Create VendorNotFoundException Class
     * @param string $message
     */
    public function __construct($message = 'Vendor not found')
    {
        parent::__construct($message);
    }
}
