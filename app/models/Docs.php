<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Docs extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'docs';

    /**
     * Fillable fields for documentations
     *
     * @var array
     */
    protected $fillable = ['title','text','order'];

    /**
     * The database table used for SoftDeleting
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
//    protected $hidden = array('password', 'remember_token');

}
