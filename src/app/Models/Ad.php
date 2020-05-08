<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    /*
     *
     * user_id
        title
        description
        date_posted
        image
        phone
        email
        country
        latitude
        longitude
        end_date
     */

    protected $primaryKey = 'id';
    protected $increment = true;
    const CREATED_AT = 'date_posted';
    protected $dateFormat = 'Y.m.d';
    protected $table = 'ads';
    protected $casts = [
        'user_id' => 'integer',
        'title' => 'string',
        'date_posted' => 'date',
        'image' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'latitude' => 'float',
        'longitude' => 'float',
        'end_date' => 'date'
    ];

}
