<?php namespace App\Models;



class Restaurant extends Base
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'restaurants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'res_name',
        'description',
        'opening_hour',
        'closing_hour',
        'smoking_area',
        'note',
        'slug',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\RestaurantPresenter::class;

    // Relations
    
    // Utility Functions

    /*
     * API Presentation
     */
    public function toAPIArray()
    {
        return [
            'id' => $this->id,
            'res_name' => $this->res_name,
            'description' => $this->description,
            'opening_hour' => $this->opening_hour,
            'closing_hour' => $this->closing_hour,
            'smoking_area' => $this->smoking_area,
            'note' => $this->note,
            'slug' => $this->slug,
        ];
    }

}
