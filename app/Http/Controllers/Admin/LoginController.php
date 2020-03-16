<?php
namespace App\Http\Controllers\Admin;

use App\Org\Code;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator;
use App\Model\User;

class LoginController extends Controller
{
    //登录页面
    public function login() {
        if(!empty(Session()->get('user')['user_name']) && !empty(Session()->get('user')['user_id'])){
            return redirect('admin/index');
        }
        return view('admin.login');
    }
    public function index(){
        if(empty(Session()->get('user')['user_name']) && empty(Session()->get('user')['user_id'])) {
            return redirect('admin/login');
        }
        return view('admin.index');
    }
    public function welcome(){
        return view('admin.welcome');
    }
    //code
    public function code() {
        $code = new Code();
        return $code->make();
    }

    public function doLogin(Request $request) {
        $post = $request->except('_token');//获取除token外的全部
        //进行表单验证
        $rule = [
            'username'  => 'required|between:2,18',
            'password'  => 'required|between:4,18|alpha_dash',
        ];
        $msg = [
            'username.required' => '用户名称不能为空',
            'username.between'  => '用户名长度必须在4-18之间',
            'password.required' => '密码不能为空',
            'password.between'  => '密码必须在4-18位之间',
            'password.alpha_dash'   => '密码必须是数字字母下划线',
            'code.required'     => '验证码不能为空',
        ];
        //$validator = Validator::make('需要验证的表单数据','验证规则','错误提示信息');
        $validator = Validator::make($post,$rule,$msg);
        if($validator->fails()) {
            //var_dump(json_decode(json_encode($validator->errors())));exit;
            return  redirect('admin/login')
                ->withErrors($validator)
                ->withInput();
        }
        if(strtolower($post['code']) != strtolower(Session()->get('code')))
            return redirect('admin/login')->with('errors','验证码错误');
        //验证是否有此用户
        //$user_id = \DB::select("select user_id from blog_user where user_name = '".$post['username']."'");
        $user = User::where('user_name',$post['username'])->first();
        if(!$user)
            return redirect('admin/login')->with('errors','用户名称尚未注册');
        $user = $user->toArray();
        if(md5(md5($post['password'])) != $user['user_pass']){
            return redirect('admin/login')->with('errors','密码错误，请重试');
        }
        session()->put('user',$user);
        return redirect('admin/index');
    }
    public function logout() {
        //清空session
        session()->flush();
        return redirect('admin/login');
    }
}
