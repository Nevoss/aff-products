<?php
//
// namespace Tests\Unit;
//
// use Tests\TestCase;
// use App\VendorsIntegration\Integrations\EbayIntegration;
// use App\VendorsIntegration\Exceptions\ItemNotFoundException;
// use App\VendorsIntegration\Exceptions\VendorAuthenticationFailed;
// use App\VendorsIntegration\Exceptions\VendorAuthenticationFailedException;
// use App\VendorsIntegration\Responses\ItemResponses\EbayItemResponse;
//
//
// class EbayIntegrationTest extends TestCase
// {
//     public function setUp()
//     {
//         parent::setUp();
//
//         $this->withoutExceptionHandling();
//     }
//
//     /** @test */
//     public function it_throw_VendorAuthnthicationEception_on_wrong_keys()
//     {
//         $this->expectException(VendorAuthenticationFailedException::class);
//
//         $client = $this->createTestHttpClient([
//             ['status' => 401]
//         ]);
//
//         $ebayIntegration = new EbayIntegration(config('vendors-integrations.ebay'), $client);
//     }
//
//     /** @test */
//     public function it_throw_ItemNotFouncException_on_wrong_item_id()
//     {
//         $this->expectException(ItemNotFoundException::class);
//
//         $client = $this->createTestHttpClient([
//             ['status' => 200],
//             ['status' => 404]
//         ]);
//
//         $ebayIntegration = new EbayIntegration(config('vendors-integrations.ebay'), $client);
//
//         $ebayIntegration->getItemById(1);
//     }
//
//     /** @test */
//     public function it_can_fetch_an_item_from_eaby_with_id()
//     {
//         $client = $this->createTestHttpClient([
//             ['status' => 200, 'body' => '{"access_token": DemoAccessToken}'],
//             ['status' => 200]
//         ]);
//
//         $ebayIntegration = new EbayIntegration(config('vendors-integrations.ebay'), $client);
//
//         $response = $ebayIntegration->getItemById(191766779468);
//
//         $this->assertInstanceOf(EbayItemResponse::class, $response);
//     }
//
//
// }
