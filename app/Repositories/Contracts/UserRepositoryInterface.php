<?php


namespace App\Repositories\Contracts;


use App\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{

    public function getModel() : Model;

    public function all() : Collection;

    public function findById(int $id) : User;


}
