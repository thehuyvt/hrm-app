<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    private $model;
    abstract public function findAll();
    abstract public function save($request);
    abstract public function update($request, $id);
    abstract public function delete($id);
    abstract public function findById($id);
}
