<?php
/**
 * Created by PhpStorm.
 * User: 林志伟
 * Date: 2020/2/23
 * Time: 22:46
 */
namespace App\Http\Controllers\Admin;

use App\Org\Code;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator;
use App\Model\User;

class Index extends Controller
{
    public function index(){
        return view('layouts.admin');
    }
}