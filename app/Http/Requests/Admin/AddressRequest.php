<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\AddressRepositoryInterface;

class AddressRequest extends BaseRequest
{

    /** @var \App\Repositories\AddressRepositoryInterface */
    protected $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
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
        return $this->addressRepository->rules();
    }

    public function messages()
    {
        return $this->addressRepository->messages();
    }

}
