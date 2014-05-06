<?php
namespace App\Models;

class StickLine extends \Eloquent{

    protected $table = 'sticklines';
    protected $fillable = array('channelTag', 'nickname', 'credit', 'giver', 'reseted_at');
    
}