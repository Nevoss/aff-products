<?php

namespace Tests\Feature\Manage;

use Tests\TestCase;
use App\Models\Vendor;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\VendorsIntegration\VendorsIntegrationInterface;
use App\VendorsIntegration\Responses\ItemResponses\EbayItemResponse;

/**
 * TODO: Extend this testing class to validation testing
 */
class createProductFromVendorTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->signinAsAdmin();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function an_admin_can_create_product_from_vendor_with_vendor_product_id()
    {
        $itemId = 172874319724;

        $vendorIntegrationMock = $this->mockVendorIntegration($itemId);
        $this->app->instance(VendorsIntegrationInterface::class, $vendorIntegrationMock);

        $category = create(Category::class);

        $vendor = Vendor::where('key', 'ebay')->first();

        $response = $this->postJson("/manage/api/vendors/{$vendor->id}/product", [
            'title' => 'somthing',
            'description' => 'else',
            'item_id' => $itemId,
            'categories_ids' => [$category->id],
        ])->assertStatus(204);

        $this->assertDatabaseHas('products', [
            'title' => 'somthing',
            'description' => 'else',
            'vendor_product_id' => '123123',
        ]);
    }

    protected function mockVendorIntegration($itemId)
    {
        $vendorIntegrationMock = \Mockery::mock(VendorsIntegrationInterface::class);
        $vendorIntegrationMock->shouldReceive('getItemById')
            ->with(172874319724)
            ->andReturn(new EbayItemResponse(
                json_decode('{"items":[{
                    "itemId": 123123,
                    "price": {"value": 123123},
                    "image": {"imageUrl": "http://example.com"},
                    "itemAffiliateWebUrl": "http://example.com"
                }]}')
            ));

        return $vendorIntegrationMock;
    }


}
