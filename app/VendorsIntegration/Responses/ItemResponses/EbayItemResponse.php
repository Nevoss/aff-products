<?php
namespace App\VendorsIntegration\Responses\ItemResponses;

use App\VendorsIntegration\Responses\ItemResponses\ItemResponseInterface;

class EbayItemResponse implements ItemResponseInterface
{
    /**
     * Hold the ebay original Response
     *
     * @var mixed
     */
    protected $itemOriginalResponse;

    /**
     * create EbayItemResponse class
     *
     * @param Object $itemOriginalResponse
     */
    public function __construct($itemOriginalResponse)
    {
        $this->itemOriginalResponse = $itemOriginalResponse;
    }
}
