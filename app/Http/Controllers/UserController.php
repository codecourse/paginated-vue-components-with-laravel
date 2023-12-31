<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Transformers\UserTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);
        $usersCollection = $users->getCollection();

        return fractal()
            ->collection($usersCollection)
            ->transformWith(new UserTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($users))
            ->toArray();
    }
}
