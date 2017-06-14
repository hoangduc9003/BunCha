<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\TypeOfFoodRepositoryInterface;

class TypeOfFoodRequest extends BaseRequest
{

    /** @var \App\Repositories\TypeOfFoodRepositoryInterface */
    protected $typeOfFoodRepository;

    public function __construct(TypeOfFoodRepositoryInterface $typeOfFoodRepository)
    {
        $this->typeOfFoodRepository = $typeOfFoodRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->typeOfFoodRepository->rules();
    }

    public function messages()
    {
        return $this->typeOfFoodRepository->messages();
    }

}
