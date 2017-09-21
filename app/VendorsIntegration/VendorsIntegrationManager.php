<?php
namespace App\VendorsIntegration;

use App\Models\Vendor;
use GuzzleHttp\Client as HttpClient;
use App\VendorsIntegration\Exceptions\VendorNotFoundException;

class VendorsIntegrationManager
{
    /**
     * Choosen vendor id
     *
     * @var mixed
     */
    protected $vendorId;

    /**
     * Choosen vendor model
     *
     * @var Vendor
     */
    protected $vendorModel;

    /**
     * the class of the integration with the vendor
     *
     * @var mixed
     */
    protected $vendorIntegrationClass;

    /**
     * create VendorsManage calss
     *
     * @param mixed $vendorId
     */
    public function __construct($vendorId)
    {
        $this->vendorId = $vendorId;

        $this->chooseVendorIntegration();
    }

    /**
     * return VendorIntegrationClass
     *
     * @return mixed
     */
    public function getVendorIntegration()
    {
        return $this->vendorIntegrationClass;
    }

    /**
     * return the vendor database id
     *
     * @return mixed
     */
    public function getVendorId()
    {
        return $this->vendorId;
    }

    /**
     * return the vendor model
     *
     * @return Vendor
     */
    public function getVendorModel()
    {
        return $this->vendorModel;
    }

    /**
     * Returns the Vendor Integration that was choosen
     *
     * @return VendorsIntegrationInterface
     */
    protected function chooseVendorIntegration()
    {
        $vendorRecord = $this->getVendor();

        $vendorConfigKeys = $this->getVendorConfigKeys($vendorRecord->key);

        return $this->vendorIntegrationClass = new $vendorRecord->class_path(
            $vendorConfigKeys, new HttpClient
        );
    }

    /**
     * Get the vendor Record from the database
     *
     * @return mixed
     */
    protected function getVendor()
    {
        if (!$this->vendorId || !$vendor = Vendor::find($this->vendorId)) {
            throw new VendorNotFoundException();
        }

        return $this->vendorModel = $vendor;
    }

    /**
     * get the config keys of the vendor
     *
     * @param  integer $vendorKey
     * @return array
     */
    protected function getVendorConfigKeys($vendorKey)
    {
        if (!$keys = config("vendors-integrations.{$vendorKey}")) {
            throw new VendorNotFoundException("the vendor key '{$vendorKey}' doesn't have config keys");
        }

        return $keys;
    }


}
