<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use yii\web\User;

class IndexController extends Controller
{
    public function __invoke()
    {
        return redirect()->route('post.index');
    }
}
