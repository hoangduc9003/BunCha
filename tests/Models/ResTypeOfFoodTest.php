<?php namespace Tests\Models;

use App\Models\ResTypeOfFood;
use Tests\TestCase;

class ResTypeOfFoodTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\ResTypeOfFood $resTypeOfFood */
        $resTypeOfFood = new ResTypeOfFood();
        $this->assertNotNull($resTypeOfFood);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\ResTypeOfFood $resTypeOfFood */
        $resTypeOfFoodModel = new ResTypeOfFood();

        $resTypeOfFoodData = factory(ResTypeOfFood::class)->make();
        foreach( $resTypeOfFoodData->toFillableArray() as $key => $value ) {
            $resTypeOfFoodModel->$key = $value;
        }
        $resTypeOfFoodModel->save();

        $this->assertNotNull(ResTypeOfFood::find($resTypeOfFoodModel->id));
    }

}
