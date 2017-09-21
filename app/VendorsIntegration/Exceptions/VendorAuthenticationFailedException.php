<?php
namespace App\VendorsIntegration\Exceptions;

use App\VendorsIntegration\Exceptions\BaseException;
use Log;

class VendorAuthenticationFailedException extends BaseException
{
    /**
     * Create VendorAuthenticationFailedException Class
     *
     * @param string $message
     */
    public function __construct($message = 'Auth request to the vendor was failed')
    {
        parent::__construct($message);
    }

    /**
     * Report about the exception
     *
     * @return void
     */
    public function report()
    {
        // TODO: catch the vendor integration and log that there is a problem
    }

}
