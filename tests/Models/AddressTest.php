<?php namespace Tests\Models;

use App\Models\Address;
use Tests\TestCase;

class AddressTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Address $address */
        $address = new Address();
        $this->assertNotNull($address);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Address $address */
        $addressModel = new Address();

        $addressData = factory(Address::class)->make();
        foreach( $addressData->toFillableArray() as $key => $value ) {
            $addressModel->$key = $value;
        }
        $addressModel->save();

        $this->assertNotNull(Address::find($addressModel->id));
    }

}
