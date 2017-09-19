<?php
namespace App\VendorsIntegration\Exceptions;

use App\VendorsIntegration\Exceptions\BaseException;

class VendorAuthenticationFailedException extends BaseException
{
    /**
     * Create VendorAuthenticationFailedException Class
     * @param string $message
     */
    public function __construct($message = 'Auth request to the vendor was failed')
    {
        parent::__construct($message);
    }
}
