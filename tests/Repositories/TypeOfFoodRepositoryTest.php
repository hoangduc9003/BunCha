<?php namespace Tests\Repositories;

use App\Models\TypeOfFood;
use Tests\TestCase;

class TypeOfFoodRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\TypeOfFoodRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TypeOfFoodRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $typeOfFoods = factory(TypeOfFood::class, 3)->create();
        $typeOfFoodIds = $typeOfFoods->pluck('id')->toArray();

        /** @var  \App\Repositories\TypeOfFoodRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TypeOfFoodRepositoryInterface::class);
        $this->assertNotNull($repository);

        $typeOfFoodsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(TypeOfFood::class, $typeOfFoodsCheck[0]);

        $typeOfFoodsCheck = $repository->getByIds($typeOfFoodIds);
        $this->assertEquals(3, count($typeOfFoodsCheck));
    }

    public function testFind()
    {
        $typeOfFoods = factory(TypeOfFood::class, 3)->create();
        $typeOfFoodIds = $typeOfFoods->pluck('id')->toArray();

        /** @var  \App\Repositories\TypeOfFoodRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TypeOfFoodRepositoryInterface::class);
        $this->assertNotNull($repository);

        $typeOfFoodCheck = $repository->find($typeOfFoodIds[0]);
        $this->assertEquals($typeOfFoodIds[0], $typeOfFoodCheck->id);
    }

    public function testCreate()
    {
        $typeOfFoodData = factory(TypeOfFood::class)->make();

        /** @var  \App\Repositories\TypeOfFoodRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TypeOfFoodRepositoryInterface::class);
        $this->assertNotNull($repository);

        $typeOfFoodCheck = $repository->create($typeOfFoodData->toFillableArray());
        $this->assertNotNull($typeOfFoodCheck);
    }

    public function testUpdate()
    {
        $typeOfFoodData = factory(TypeOfFood::class)->create();

        /** @var  \App\Repositories\TypeOfFoodRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TypeOfFoodRepositoryInterface::class);
        $this->assertNotNull($repository);

        $typeOfFoodCheck = $repository->update($typeOfFoodData, $typeOfFoodData->toFillableArray());
        $this->assertNotNull($typeOfFoodCheck);
    }

    public function testDelete()
    {
        $typeOfFoodData = factory(TypeOfFood::class)->create();

        /** @var  \App\Repositories\TypeOfFoodRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TypeOfFoodRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($typeOfFoodData);

        $typeOfFoodCheck = $repository->find($typeOfFoodData->id);
        $this->assertNull($typeOfFoodCheck);
    }

}
