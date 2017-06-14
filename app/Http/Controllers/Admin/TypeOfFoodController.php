<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\TypeOfFoodRepositoryInterface;
use App\Http\Requests\Admin\TypeOfFoodRequest;
use App\Http\Requests\PaginationRequest;
use Illuminate\Http\File;

class TypeOfFoodController extends Controller
{

    /** @var \App\Repositories\TypeOfFoodRepositoryInterface */
    protected $typeOfFoodRepository;


    public function __construct(
        TypeOfFoodRepositoryInterface $typeOfFoodRepository
    )
    {
        $this->typeOfFoodRepository = $typeOfFoodRepository;
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
        $count = $this->typeOfFoodRepository->count();
        $models = $this->typeOfFoodRepository->get('id', 'desc', $offset, $limit);

        return view('pages.admin.type-of-foods.index', [
            'models'  => $models,
            'count'   => $count,
            'offset'  => $offset,
            'limit'   => $limit,
            'baseUrl' => action('Admin\TypeOfFoodController@index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response
     */
    public function create()
    {
        return view('pages.admin.type-of-foods.edit', [
            'isNew'     => true,
            'typeOfFood' => $this->typeOfFoodRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Response
     */
    public function store(TypeOfFoodRequest $request)
    {
        $input = $request->only(['type_name']);
        
        $input['is_enabled'] = $request->get('is_enabled', 0);
        if(!empty($input['type_name'])){
            $input['slug'] = str_slug($input['type_name']);
        }
        $model = $this->typeOfFoodRepository->create($input);

        if (empty( $model )) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\TypeOfFoodController@index')
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
        $model = $this->typeOfFoodRepository->find($id);
        if (empty( $model )) {
            abort(404);
        }

        return view('pages.admin.type-of-foods.edit', [
            'isNew' => false,
            'typeOfFood' => $model,
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
    public function update($id, TypeOfFoodRequest $request)
    {
        /** @var \App\Models\TypeOfFood $model */
        $model = $this->typeOfFoodRepository->find($id);
        if (empty( $model )) {
            abort(404);
        }
        $input = $request->only(['type_name']);
        if(!empty($input['type_name'])){
            $input['slug'] = str_slug($input['type_name']);
        }
        
        $input['is_enabled'] = $request->get('is_enabled', 0);
        $this->typeOfFoodRepository->update($model, $input);

        return redirect()->action('Admin\TypeOfFoodController@show', [$id])
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
        /** @var \App\Models\TypeOfFood $model */
        $model = $this->typeOfFoodRepository->find($id);
        if (empty( $model )) {
            abort(404);
        }
        $this->typeOfFoodRepository->delete($model);

        return redirect()->action('Admin\TypeOfFoodController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

}
