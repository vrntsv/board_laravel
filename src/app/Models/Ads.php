<?php


namespace App;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{


    protected $primaryKey = 'id';
    protected $increment = true;
    const CREATED_AT = 'date_posted';
    protected $table = 'ads';
    public $timestamps = false;
    protected $casts = [
        'user_id' => 'integer',
        'title' => 'string',
        'image' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    protected $dates = [
        'end_date'
    ];

    protected $attributes = [
        'image' => null,
    ];

    public function __construct(array $attributes = array())
    {
        $this->setRawAttributes(array(
            'date_posted' => Carbon::now()
        ), true);
        parent::__construct($attributes);
    }

    
    public function getAllAds()
    {
        $ad = DB::table('ads')->orderBy('id', 'DESC')->paginate(15);
        return $ad;
    }


    public function getAdById($id)
    {
        $ad = Ads::where('id', $id)->get();
        return $ad;
    }




}
