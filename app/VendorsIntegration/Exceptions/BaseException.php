<?php
namespace App\VendorsIntegration\Exceptions;

class BaseException extends \Exception
{
    /**
     * Create BaseException Class
     *
     * @param string $message
     */
    public function __construct($message)
    {
        parent::__construct($message);
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @return Response
     */
    public function render()
    {
        return response()->json([
            'message' => 'Vendor integration failed.',
            'errors' => [
                'vendor_integration' => [ 'Somthing went wrong please try agian later.' ]
            ]
        ], 500);
    }
}
