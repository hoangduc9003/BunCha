<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class AddressControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\AddressController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\AddressController::class);
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
        $response = $this->action('GET', 'Admin\AddressController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\AddressController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $address = factory(\App\Models\Address::class)->make();
        $this->action('POST', 'Admin\AddressController@store', [
                '_token' => csrf_token(),
            ] + $address->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $address = factory(\App\Models\Address::class)->create();
        $this->action('GET', 'Admin\AddressController@show', [$address->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $address = factory(\App\Models\Address::class)->create();

        $name = $faker->name;
        $id = $address->id;

        $address->name = $name;

        $this->action('PUT', 'Admin\AddressController@update', [$id], [
                '_token' => csrf_token(),
            ] + $address->toArray());
        $this->assertResponseStatus(302);

        $newAddress = \App\Models\Address::find($id);
        $this->assertEquals($name, $newAddress->name);
    }

    public function testDeleteModel()
    {
        $address = factory(\App\Models\Address::class)->create();

        $id = $address->id;

        $this->action('DELETE', 'Admin\AddressController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkAddress = \App\Models\Address::find($id);
        $this->assertNull($checkAddress);
    }

}
