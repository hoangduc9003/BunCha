<?php namespace Tests\Models;

use App\Models\Restaurant;
use Tests\TestCase;

class RestaurantTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Restaurant $restaurant */
        $restaurant = new Restaurant();
        $this->assertNotNull($restaurant);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Restaurant $restaurant */
        $restaurantModel = new Restaurant();

        $restaurantData = factory(Restaurant::class)->make();
        foreach( $restaurantData->toFillableArray() as $key => $value ) {
            $restaurantModel->$key = $value;
        }
        $restaurantModel->save();

        $this->assertNotNull(Restaurant::find($restaurantModel->id));
    }

}
