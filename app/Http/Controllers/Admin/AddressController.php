<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\AddressRepositoryInterface;
use App\Http\Requests\Admin\AddressRequest;
use App\Http\Requests\PaginationRequest;

class AddressController extends Controller
{

    /** @var \App\Repositories\AddressRepositoryInterface */
    protected $addressRepository;


    public function __construct(
        AddressRepositoryInterface $addressRepository
    )
    {
        $this->addressRepository = $addressRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\PaginationRequest $request
     * @return \Response
     */
    public function index(PaginationRequest $request)
    {
        $offset = $request->offset();
        $limit = $request->limit();
        $count = $this->addressRepository->count();
        $models = $this->addressRepository->get('id', 'desc', $offset, $limit);
        return view('pages.admin.addresses.index', [
            'models'  => $models,
            'count'   => $count,
            'offset'  => $offset,
            'limit'   => $limit,
            'baseUrl' => action('Admin\AddressController@index'),
        ]);
    }

    /**
     * Get countries and cities data from json
     *
     */
    protected function getCountry(){

        $countries = \GuzzleHttp\json_decode(file_get_contents(storage_path('country/countriesToCities.json'), true));
        return $countries;
    }

    /**
     *
     * Get list city
     */
    public function getCityList($country){
        $countries = $this->getCountry();
        return $countries->$country;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response
     */
    public function create()
    {
        $countries = $this->getCountry();
        return view('pages.admin.addresses.edit', [
            'isNew'     => true,
            'countries' => $countries,
            'address' => $this->addressRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Response
     */
    public function store(AddressRequest $request)
    {
//        dd($request->all());
//        $input = $request->only(['address_detail','country','city','district']);
        for ($i = 0; $i < count($request->get('address_detail')); $i++)
        {
            $input['address_detail'] = $request->get('address_detail')[$i];
            $input['country'] = $request->get('country')[$i];
            $input['city'] = $request->get('city')[$i];
            $input['district'] = $request->get('district')[$i];
            $model = $this->addressRepository->create($input);
        }

//        $input['is_enabled'] = $request->get('is_enabled', 0);

        if (empty( $model )) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\AddressController@index')
            ->with('message-success', trans('admin.messages.general.create_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Response
     */
    public function show($id)
    {
        $model = $this->addressRepository->find($id);
        if (empty( $model )) {
            abort(404);
        }

        $countries = $this->getCountry();

        return view('pages.admin.addresses.edit', [
            'isNew' => false,
            'countries' => $countries,
            'address' => $model,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param      $request
     * @return \Response
     */
    public function update($id, AddressRequest $request)
    {
        /** @var \App\Models\Address $model */
        $model = $this->addressRepository->find($id);
        if (empty( $model )) {
            abort(404);
        }
        $input = $request->only(['address_detail','country','city','district']);
        
        $input['is_enabled'] = $request->get('is_enabled', 0);
        $this->addressRepository->update($model, $input);

        return redirect()->action('Admin\AddressController@show', [$id])
                    ->with('message-success', trans('admin.messages.general.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Response
     */
    public function destroy($id)
    {
        /** @var \App\Models\Address $model */
        $model = $this->addressRepository->find($id);
        if (empty( $model )) {
            abort(404);
        }
        $this->addressRepository->delete($model);

        return redirect()->action('Admin\AddressController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

}
