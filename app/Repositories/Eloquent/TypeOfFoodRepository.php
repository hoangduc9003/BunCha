<?php namespace App\Repositories\Eloquent;

use \App\Repositories\TypeOfFoodRepositoryInterface;
use \App\Models\TypeOfFood;

/**
 *
 * @method \App\Models\TypeOfFood[] getEmptyList()
 * @method \App\Models\TypeOfFood[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\TypeOfFood[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\TypeOfFood create($value)
 * @method \App\Models\TypeOfFood find($id)
 * @method \App\Models\TypeOfFood[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\TypeOfFood[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\TypeOfFood update($model, $input)
 * @method \App\Models\TypeOfFood save($model);
 */

class TypeOfFoodRepository extends SingleKeyModelRepository implements TypeOfFoodRepositoryInterface
{

    public function getBlankModel()
    {
        return new TypeOfFood();
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
