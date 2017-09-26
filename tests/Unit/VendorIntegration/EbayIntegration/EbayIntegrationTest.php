<?php

namespace Tests\Unit;

use Tests\TestCase;
use GuzzleHttp\Client as HttpClient;
use App\VendorsIntegration\EbayIntegration;
use App\VendorsIntegration\Exceptions\ItemNotFoundException;
use App\VendorsIntegration\Exceptions\VendorNotFoundException;
use App\VendorsIntegration\Exceptions\VendorAuthenticationFailedException;
use App\VendorsIntegration\Responses\ItemResponses\EbayItemResponse;

class EbayIntegrationTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function if_config_dont_exist_it_throw_VendorNotFoundException()
    {
        $this->expectException(VendorNotFoundException::class);

        new EbayIntegration('noWayThereIsVendorWithThisKey', new HttpClient);
    }

    /** @test */
    public function it_throw_VendorAuthenticationFailedException_when_authnthication_failed()
    {
        $httpClient = $this->createTestHttpClient([
            [ 'status' => 401 ]
        ]);

        $this->expectException(VendorAuthenticationFailedException::class);

        new EbayIntegration('ebay', $httpClient);
    }

    /** @test */
    public function it_throw_ItemNotFoundException_when_item_not_found()
    {
        $httpClient = $this->createTestHttpClient([
            [ 'status' => 200, 'body' => '{"access_token": "123"}' ],
            [ 'status' => 404 ]
        ]);

        $this->expectException(ItemNotFoundException::class);

        $itegration = new EbayIntegration('ebay', $httpClient);
        $itegration->getItemById(123123);
    }

    /** @test */
    public function its_return_EbayItemResponse_when_the_request_getItemById_success()
    {
        $httpClient = $this->createTestHttpClient([
            [ 'status' => 200, 'body' => '{"access_token": "123"}' ],
            [ 'status' => 200, 'body' => '{"items":[{
                "itemId": 123123,
                "price": {"value": 123123},
                "image": {"imageUrl": "http://example.com"},
                "itemAffiliateWebUrl": "http://example.com"
            }]}' ]
        ]);

        $itegration = new EbayIntegration('ebay', $httpClient);
        $response = $itegration->getItemById(123123);

        $this->assertInstanceOf(EbayItemResponse::class, $response);
    }
}
