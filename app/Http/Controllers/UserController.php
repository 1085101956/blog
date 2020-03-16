<?php
/**
 * Created by PhpStorm.
 * User: 林志伟
 * Date: 2020/2/19
 * Time: 22:00
 */
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
class UserController extends Controller {
    /**
     * 获取一个添加页面
     */
    public function add() {
        return view("user/add");
    }

    /**
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     * 渲染页面
     */
    public function index() {
        $list = User::get();
        return view('user/index',['list' => $list]);
        //return view('user.list')->with('user',$list);
        //return view('user.list',compact('user'));
    }
    /**
     * 执行用户添加操作
     */
    public function store(Request $request) {
        $all = $request->except('_token');//获取除token外的全部
        $input = $request->all();var_dump($input);exit;
        $id = User::create(['user_name' => $input['name'],'user_pass' => $all['password']]);
        if($id) {
            return redirect('user/index');
        }
        return back();
    }
    public function edit ($id) {
        //根据Id修改
        $user = User::find($id);
        //return view('user/edit',['list' => $user]);
        return view('user/edit',['list' => $user]);
    }
    public function update(Request $request){
        $input = $request->all();var_dump($input);
        $user = User::find($input['id']);
        $id = $user->update(['user_name' => $input['name'],'user_pass' => $input['password']]);
        if($id) {
            return redirect('user/index');
        }
        return back();
    }
    public function destroy($id) {
        $user = User::find($id);
        $re = $user->delete();
        if($re) {
            return ['status' => 1,'msg' => '成功'];
        }
        return ['status' => 0,'msg' => '失败'];
    }
}