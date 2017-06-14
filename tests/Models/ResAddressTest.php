<?php namespace Tests\Models;

use App\Models\ResAddress;
use Tests\TestCase;

class ResAddressTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\ResAddress $resAddress */
        $resAddress = new ResAddress();
        $this->assertNotNull($resAddress);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\ResAddress $resAddress */
        $resAddressModel = new ResAddress();

        $resAddressData = factory(ResAddress::class)->make();
        foreach( $resAddressData->toFillableArray() as $key => $value ) {
            $resAddressModel->$key = $value;
        }
        $resAddressModel->save();

        $this->assertNotNull(ResAddress::find($resAddressModel->id));
    }

}
