<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\VendorsIntegration\VendorsIntegrationManager;
use App\VendorsIntegration\Integrations\VendorsIntegrationInterface;
use App\VendorsIntegration\Exceptions\VendorNotFoundException;

class VendorsIntegrationManagerTest extends TestCase
{
    /** @test */
    public function it_return_an_implements_of_VendorIntegrationInterface()
    {
        $vendorIntegrationManager = new VendorsIntegrationManager(1);

        $this->assertInstanceOf(VendorsIntegrationInterface::class ,$vendorIntegrationManager->getVendorIntegration());
    }

    /** @test */
    public function it_return_the_vendor_database_id()
    {
        $vendorIntegrationManager = new VendorsIntegrationManager(1);

        $this->assertEquals(1, $vendorIntegrationManager->getVendorId());
    }

    /** @test */
    public function it_throw_VendorNotFoundException_when_there_is_no_vendor_record_at_database()
    {
        $this->expectException(VendorNotFoundException::class);

        $vendorIntegrationManager = new VendorsIntegrationManager(null);
    }

}
