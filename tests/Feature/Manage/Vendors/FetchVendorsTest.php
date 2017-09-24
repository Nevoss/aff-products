<?php

namespace Tests\Feature\Manage\Vendors;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Vendor;
use Tests\TestCase;

class FetchVendorsTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->signinAsAdmin();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function an_admin_can_fetch_all_of_the_vendors()
    {
        Vendor::truncate();

        $vendor = create(Vendor::class);

        $response = $this->getJson('/manage/api/vendors')->json();

        $this->assertCount(1, $response['data']);
        $this->assertEquals($vendor->id, $response['data'][0]['id']);
    }

    /** @test */
    public function an_admin_can_fiter_vendors_by_there_activation()
    {
        Vendor::truncate();

        $vendor = create(Vendor::class);
        $unActiveVendor = create(Vendor::class, [
            'class_path' => null,
        ]);

        $response = $this->getJson('/manage/api/vendors?active=1')->json();

        $this->assertCount(1, $response['data']);
        $this->assertEquals($vendor->id, $response['data'][0]['id']);
    }

}
