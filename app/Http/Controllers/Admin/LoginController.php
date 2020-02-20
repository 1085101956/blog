<?php

namespace App\Http\Controllers\Admin;

use App\Org\Code;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //
    public function login() {
        return view('admin.login');
    }
    public function code() {
        $code = new Code();
        return $code->make();
    }
}
