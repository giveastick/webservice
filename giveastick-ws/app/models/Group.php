<?php
class Group extends Eloquent{

    protected $fillable = array('tag');
    protected $softDelete = true;
}