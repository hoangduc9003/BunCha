<?php namespace App\Models;



class TypeOfFood extends Base
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'type_of_foods';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_name',
        'slug',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\TypeOfFoodPresenter::class;

    // Relations
    
    // Utility Functions

    /*
     * API Presentation
     */
    public function toAPIArray()
    {
        return [
            'id' => $this->id,
            'type_name' => $this->type_name,
            'slug' => $this->slug,
        ];
    }

}
