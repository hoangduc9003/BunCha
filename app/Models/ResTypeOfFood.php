<?php namespace App\Models;



class ResTypeOfFood extends Base
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'res_type_of_foods';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'restaurant_id',
        'food_type_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\ResTypeOfFoodPresenter::class;

    // Relations
        public function restaurant()
    {
        return $this->belongsTo(\App\Models\Restaurant::class, 'restaurant_id', 'id');
    }

    public function foodType()
    {
        return $this->belongsTo(\App\Models\FoodType::class, 'food_type_id', 'id');
    }


    // Utility Functions

    /*
     * API Presentation
     */
    public function toAPIArray()
    {
        return [
            'id' => $this->id,
            'restaurant_id' => $this->restaurant_id,
            'food_type_id' => $this->food_type_id,
        ];
    }

}
