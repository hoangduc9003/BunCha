<?php namespace App\Models;



class Address extends Base
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'addresses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address_detail',
        'country',
        'city',
        'district',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\AddressPresenter::class;

    // Relations
    
    // Utility Functions

    /*
     * API Presentation
     */
    public function toAPIArray()
    {
        return [
            'id' => $this->id,
            'address_detail' => $this->address_detail,
            'country' => $this->country,
            'city' => $this->city,
            'district' => $this->district,
        ];
    }

}
