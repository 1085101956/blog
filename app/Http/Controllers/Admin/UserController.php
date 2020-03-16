<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Model\User;

class UserController extends Controller
{
    /**
     * 显示列表页
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        //请求提交的请求参数
        $input = $request->all();
        //var_dump($input);
        $user = User::orderBy('user_id','asc')
            ->where(function ($query) use ($request){
                $username = $request->input('username');
                if(!empty($username)){
                    $query->where('user_name','like','%'.$username.'%');
                }
                $email = $request->input('email');
                if(!empty($email)){
                    $query->where('email',$email);
                }
                $phone = $request->input('phone');
                if(!empty($phone)){
                    $query->where('phone',$phone);
                }
            })->paginate($request->input('num')?$request->input('num'):3);
        return view('admin.user.list',compact('user','request'));
    }

    /**
     * 返回一个添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * 执行添加操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->all();
        $rule = [
            'username'  => 'required|between:2,18',
            'pass'  => 'required|between:4,18|alpha_dash',
            'phone' => 'required',
            'email' => 'required',
        ];

        $msg = [
            'username.required' => '用户名称不能为空',
            'username.between'  => '用户名长度必须在4-18之间',
            'pass.required' => '密码不能为空',
            'pass.between'  => '密码必须在4-18位之间',
            'pass.alpha_dash'   => '密码必须是数字字母下划线',
            'email.required'     => '邮箱不能为空',
            'phone.required'    => '手机号码不能为空',
        ];

        if($post['repass'] != $post['pass'])
            return ['status' => 0,'msg' => '密码不一致'];
        //$validator = Validator::make('需要验证的表单数据','验证规则','错误提示信息');
        $validator = Validator::make($post,$rule,$msg);
        if($validator->fails()) {
            return ['status' => 0,'msg' => json_decode(json_encode($validator->errors()))];
        }
        $data = array(
            'user_name' => $post['username'],
            'user_pass' => md5(md5($post['pass'])),
            'email'     => $post['email'],
            'phone'     =>  $post['phone'],
            'create_time'   => time(),
        );
        $res = User::create($data);
        if($res) {
            return ['status' => 1,'msg' => '成功'];
        }
        return ['status' => 0,'msg' => '添加失败'];
    }

    /**
     * 显示一条数据
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 返回一个修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit',compact('user'));
    }

    /**
     * 执行一个修改操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 执行一个删除操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
