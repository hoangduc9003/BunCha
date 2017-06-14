<?php namespace App\Models;



class ResAddress extends Base
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'res_addresses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'restaurant_id',
        'address_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\ResAddressPresenter::class;

    // Relations
        public function restaurant()
    {
        return $this->belongsTo(\App\Models\Restaurant::class, 'restaurant_id', 'id');
    }

    public function address()
    {
        return $this->belongsTo(\App\Models\Address::class, 'address_id', 'id');
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
            'address_id' => $this->address_id,
        ];
    }

}
