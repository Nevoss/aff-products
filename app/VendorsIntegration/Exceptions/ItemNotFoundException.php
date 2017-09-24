<?php
namespace App\VendorsIntegration\Exceptions;

use App\VendorsIntegration\Exceptions\BaseException;

class ItemNotFoundException extends BaseException
{
    /**
     * Create ItemNotFoundException Class
     *
     * @param string $message
     */
    public function __construct($message = 'The request item not found')
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
            'message' => 'Cannot find item with the requested id',
            'errors' => [
                'vendor_integration' => [ 'Cannot find item with the requested id' ]
            ]
        ], 422);
    }
}
