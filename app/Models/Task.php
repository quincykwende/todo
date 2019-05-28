<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'text', 'is_completed'
    ];

    /**
     * Relationship; A task belongs to a user
     *
     */
    public function user(){
        return $this->belongsTo('App\Model\User');
    }
}