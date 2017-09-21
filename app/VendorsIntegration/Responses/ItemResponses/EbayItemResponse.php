<?php
namespace App\VendorsIntegration\Responses\ItemResponses;

use App\VendorsIntegration\Responses\ItemResponses\ItemResponseAbstract;

class EbayItemResponse extends ItemResponseAbstract
{
    /**
     * convert original response object to ItemResponseAbstrat class
     *
     * @return void
     */
    protected function convert()
    {
        $itemData = $this->itemOriginalResponse->items[0];

        $this->itemId = $itemData->itemId;
        $this->price = $itemData->price->value;
        $this->image = $itemData->image->imageUrl;
        $this->link = $itemData->itemAffiliateWebUrl;
    }
}
