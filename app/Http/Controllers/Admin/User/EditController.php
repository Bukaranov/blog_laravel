<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\Category;
use App\Models\Tag;
use App\Models\User;

class EditController extends BaseController
{
    public function __invoke(User $user)
    {
        $roles = User::getRoles();

        return view('admin.user.edit', compact('user', 'roles')) ;
    }
}
