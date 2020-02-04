<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persons extends Model {

    protected $table = 'persons';
    //protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'email', 'comment'];

    const LIMIT = 5;
    const ERROR_STATUS = ['error' => 'Error',
        'succes' => 'Succes',
        'email_empty' => 'Empty',
        'email_incorect' => 'Incorect'
    ];

    /**
     * @param array $data
     * 
     * @return type
     */
    public static function create_(array $data) {

        $return = Persons::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'comment' => $data['comment']
        ]);

        return $return;
    }

}
