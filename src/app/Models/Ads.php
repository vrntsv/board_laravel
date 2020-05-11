<?php


namespace App;
use Carbon\Carbon;


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



    public function getAllAds($currentPage)
    {

        if ($currentPage == 1) {
            $lower = $currentPage - 1;

        } else {
            $lower = ($currentPage - 1) * 15;
        }

        $upper = $lower + 15;
        $ad = Ads::skip($lower)->take($upper)->get();
        return $ad;

    }

    public function getLastPage()
    {
        $count = Ads::all()->count();
        return floor($count/15 + 1);
    }

    public function getAdById($id)
    {
        $ad = Ads::where('id', $id)->get();
        return $ad;
    }


    public function createAd(
        $userId,
        $title,
        $description,
        $phone,
        $country,
        $email,
        $endDate,
        $image,
        $latitude,
        $longitude
    )
    {

        Ads::insert(
            [
                'user_id' => $userId,
                'title' => $title,
                'description' => $description,
                'end_date' => $endDate,
                'image' => $image,
                'phone' => $phone,
                'email' => $email,
                'country' => $country,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]
        );
    }

    public function updateAd(
        $id,
        $title,
        $description,
        $phone,
        $country,
        $email,
        $endDate,
        $image,
        $latitude,
        $longitude
    )
    {

        Ads::where('id', $id)->update(
            [
                'title' => $title,
                'description' => $description,
                'end_date' => $endDate,
                'image' => $image,
                'phone' => $phone,
                'email' => $email,
                'country' => $country,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]
        );
    }

}
