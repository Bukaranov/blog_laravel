<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;

class IndexController extends BaseController
{
    public function __invoke()
    {
        $users = User::all();
        return view('admin.user.index', compact('users')) ;
    }
}
