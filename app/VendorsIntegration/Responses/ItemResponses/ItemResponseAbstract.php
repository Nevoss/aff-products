<?php
namespace App\VendorsIntegration\Responses\ItemResponses;

abstract class ItemResponseAbstract
{
    /**
     * Hold the ebay original Response
     *
     * @var mixed
     */
    protected $itemOriginalResponse;

    /**
     * item original id
     *
     * @var integer
     */
    protected $itemId;

    /**
     * item price
     *
     * @var float
     */
    protected $price;

    /**
     * image url
     *
     * @var string
     */
    protected $image;

    /**
     * affiliate link
     *
     * @var string
     */
    protected $link;

    /**
     * create ItemResponseAbstract astract class
     *
     * @param Object $itemOriginalResponse
     */
    public function __construct($itemOriginalResponse)
    {
        $this->itemOriginalResponse = $itemOriginalResponse;

        $this->convert();
    }

    /**
     * all the props of this class can get but not can set
     *
     * @param  mixed $propName
     * @return mixed         
     */
    public function __get($propName)
    {
        return $this->{$propName};
    }

    /**
     * This function convert the response of the original response
     * to the current abstract class
     *
     */
    abstract protected function convert();
}
