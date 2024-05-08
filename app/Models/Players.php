<?php

/**
 * 
 */
namespace App\Models;

/**
 * 
 */
use Illuminate\Database\Eloquent\Model;

/**
 * 
 */
class Players extends Model {
    
    protected $table = 'players';

    public $timestamps = false;

    protected $fillable = array('id', 'name', 'nivel', 'goalkeeper', 'absent', 'created_at');

}