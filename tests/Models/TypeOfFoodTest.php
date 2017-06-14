<?php namespace Tests\Models;

use App\Models\TypeOfFood;
use Tests\TestCase;

class TypeOfFoodTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\TypeOfFood $typeOfFood */
        $typeOfFood = new TypeOfFood();
        $this->assertNotNull($typeOfFood);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\TypeOfFood $typeOfFood */
        $typeOfFoodModel = new TypeOfFood();

        $typeOfFoodData = factory(TypeOfFood::class)->make();
        foreach( $typeOfFoodData->toFillableArray() as $key => $value ) {
            $typeOfFoodModel->$key = $value;
        }
        $typeOfFoodModel->save();

        $this->assertNotNull(TypeOfFood::find($typeOfFoodModel->id));
    }

}
