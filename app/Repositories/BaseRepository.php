<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Repositories;

use Flobbos\Crudable\Crudable;
use Flobbos\Crudable\Contracts\Crud;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements Crud
{

    use Crudable;

    /**
     *
     * @var Model
     */
    protected $model = null;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * 
     * @param Model $model
     */
    public function setModel(Model $model)
    {
        $this->model = $model;
    }

}