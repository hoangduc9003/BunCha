<?php namespace App\Repositories\Eloquent;

use \App\Repositories\AddressRepositoryInterface;
use \App\Models\Address;

/**
 *
 * @method \App\Models\Address[] getEmptyList()
 * @method \App\Models\Address[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\Address[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\Address create($value)
 * @method \App\Models\Address find($id)
 * @method \App\Models\Address[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\Address[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\Address update($model, $input)
 * @method \App\Models\Address save($model);
 */

class AddressRepository extends SingleKeyModelRepository implements AddressRepositoryInterface
{

    public function getBlankModel()
    {
        return new Address();
    }

    public function rules()
    {
        return [
        ];
    }

    public function messages()
    {
        return [
        ];
    }

}
