<?php

namespace Tests\Feature\Manage;

use Tests\TestCase;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use App\VendorsIntegration\VendorsIntegrationInterface;
use App\VendorsIntegration\Responses\ItemResponses\EbayItemResponse;
use App\Events\Products\ProductCreatedFromVendor;

/**
 * TODO: Extend this testing class to validation testing
 */
class createProductFromVendorTest extends TestCase
{
    protected $category;

    protected $vendor;

    public function setUp()
    {
        parent::setUp();

        // $this->withoutExceptionHandling();

        $this->signinAsAdmin();

        $this->vendor = Vendor::where('key', 'ebay')->first();

        $this->category = create(Category::class);

        $this->mockVendorIntegration(123123);

        Event::fake();
    }

    /** @test */
    public function an_admin_can_create_product_from_vendor_with_vendor_product_id()
    {
        $response = $this->postJson("/manage/api/vendors/{$this->vendor->id}/product", [
            'title' => 'somthing',
            'description' => 'else',
            'item_id' => 123123,
            'categories_ids' => [$this->category->id],
        ])->assertStatus(204);

        $this->assertDatabaseHas('products', [
            'title' => 'somthing',
            'vendor_product_id' => '123123',
        ]);

        Event::assertDispatched(ProductCreatedFromVendor::class, function ($event) {
            return Product::find(1)->id == $event->product->id;
        });
    }

    /** @test */
    public function title_is_required_when_creating_product_from_vendor()
    {
        $response = $this->postJson("/manage/api/vendors/{$this->vendor->id}/product", [
            'title' => '',
            'description' => 'else',
            'item_id' => 123123,
            'categories_ids' => [$this->category->id],
        ])->json();

        $this->assertArrayHasKey('title', $response['errors']);
    }

    /** @test */
    public function item_id_is_required_when_creating_product_from_vendor()
    {
        $response = $this->postJson("/manage/api/vendors/{$this->vendor->id}/product", [
            'title' => 'asd',
            'description' => 'else',
            'item_id' => null,
            'categories_ids' => [$this->category->id],
        ])->json();

        $this->assertArrayHasKey('item_id', $response['errors']);
    }

    /** @test */
    public function categories_ids_must_be_valid_when_creating_product_from_vendor()
    {
        $response = $this->postJson("/manage/api/vendors/{$this->vendor->id}/product", [
            'title' => 'asd',
            'description' => 'else',
            'item_id' => 'asd',
            'categories_ids' => [999, 998, 'asd',$this->category->id],
        ])->json();

        $this->assertArrayHasKey('categories_ids.0', $response['errors']);
        $this->assertArrayHasKey('categories_ids.1', $response['errors']);
        $this->assertArrayHasKey('categories_ids.2', $response['errors']);

        $this->assertArrayNotHasKey('categories_ids.3', $response['errors']);
    }

    protected function mockVendorIntegration($itemId)
    {
        $vendorIntegrationMock = \Mockery::mock(VendorsIntegrationInterface::class);
        $vendorIntegrationMock->shouldReceive('getItemById')
            ->with(123123)
            ->andReturn(new EbayItemResponse(
                json_decode('{"items":[{
                    "itemId": 123123,
                    "price": {"value": 123123},
                    "image": {"imageUrl": "http://example.com"},
                    "itemAffiliateWebUrl": "http://example.com"
                }]}')
            ));

        $this->app->instance(VendorsIntegrationInterface::class, $vendorIntegrationMock);
    }


}
