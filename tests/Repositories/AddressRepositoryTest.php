<?php namespace Tests\Repositories;

use App\Models\Address;
use Tests\TestCase;

class AddressRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\AddressRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AddressRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $addresses = factory(Address::class, 3)->create();
        $addressIds = $addresses->pluck('id')->toArray();

        /** @var  \App\Repositories\AddressRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AddressRepositoryInterface::class);
        $this->assertNotNull($repository);

        $addressesCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Address::class, $addressesCheck[0]);

        $addressesCheck = $repository->getByIds($addressIds);
        $this->assertEquals(3, count($addressesCheck));
    }

    public function testFind()
    {
        $addresses = factory(Address::class, 3)->create();
        $addressIds = $addresses->pluck('id')->toArray();

        /** @var  \App\Repositories\AddressRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AddressRepositoryInterface::class);
        $this->assertNotNull($repository);

        $addressCheck = $repository->find($addressIds[0]);
        $this->assertEquals($addressIds[0], $addressCheck->id);
    }

    public function testCreate()
    {
        $addressData = factory(Address::class)->make();

        /** @var  \App\Repositories\AddressRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AddressRepositoryInterface::class);
        $this->assertNotNull($repository);

        $addressCheck = $repository->create($addressData->toFillableArray());
        $this->assertNotNull($addressCheck);
    }

    public function testUpdate()
    {
        $addressData = factory(Address::class)->create();

        /** @var  \App\Repositories\AddressRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AddressRepositoryInterface::class);
        $this->assertNotNull($repository);

        $addressCheck = $repository->update($addressData, $addressData->toFillableArray());
        $this->assertNotNull($addressCheck);
    }

    public function testDelete()
    {
        $addressData = factory(Address::class)->create();

        /** @var  \App\Repositories\AddressRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AddressRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($addressData);

        $addressCheck = $repository->find($addressData->id);
        $this->assertNull($addressCheck);
    }

}
