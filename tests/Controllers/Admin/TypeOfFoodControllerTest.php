<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class TypeOfFoodControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\TypeOfFoodController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\TypeOfFoodController::class);
        $this->assertNotNull($controller);
    }

    public function setUp()
    {
        parent::setUp();
        $authUser = \App\Models\AdminUser::first();
        $this->be($authUser, 'admins');
    }

    public function testGetList()
    {
        $response = $this->action('GET', 'Admin\TypeOfFoodController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\TypeOfFoodController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $typeOfFood = factory(\App\Models\TypeOfFood::class)->make();
        $this->action('POST', 'Admin\TypeOfFoodController@store', [
                '_token' => csrf_token(),
            ] + $typeOfFood->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $typeOfFood = factory(\App\Models\TypeOfFood::class)->create();
        $this->action('GET', 'Admin\TypeOfFoodController@show', [$typeOfFood->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $typeOfFood = factory(\App\Models\TypeOfFood::class)->create();

        $name = $faker->name;
        $id = $typeOfFood->id;

        $typeOfFood->name = $name;

        $this->action('PUT', 'Admin\TypeOfFoodController@update', [$id], [
                '_token' => csrf_token(),
            ] + $typeOfFood->toArray());
        $this->assertResponseStatus(302);

        $newTypeOfFood = \App\Models\TypeOfFood::find($id);
        $this->assertEquals($name, $newTypeOfFood->name);
    }

    public function testDeleteModel()
    {
        $typeOfFood = factory(\App\Models\TypeOfFood::class)->create();

        $id = $typeOfFood->id;

        $this->action('DELETE', 'Admin\TypeOfFoodController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkTypeOfFood = \App\Models\TypeOfFood::find($id);
        $this->assertNull($checkTypeOfFood);
    }

}
