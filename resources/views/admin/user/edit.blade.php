<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
  @include('admin.public.style')
  @include('admin.public.script')
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="x-body">
        <form class="layui-form">
            <input id="user_id" type="hidden" value="{{ $user->user_id }}">
            <div class="layui-form-item">
                <label for="username" class="layui-form-label">
                    <span class="x-red">*</span>您将要修改
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="username" disabled  name="username" required="" lay-verify="required"
                           autocomplete="off" class="layui-input" value="{{ $user->user_name }}">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>您唯一的登入名<span style="color: red;">（此项不可修改）</span>
                </div>
            </div>
          <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">
                  <span class="x-red">*</span>邮箱
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_email" name="email" required="" lay-verify="email"
                  autocomplete="off" class="layui-input" value="{{ $user->email }}" />
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>将会成为您找回密码邮箱
              </div>
          </div>
          {{--<div class="layui-form-item">--}}
              {{--<label for="L_username" class="layui-form-label">--}}
                  {{--<span class="x-red">*</span>昵称--}}
              {{--</label>--}}
              {{--<div class="layui-input-inline">--}}
                  {{--<input type="text" id="L_username" name="username" required="" lay-verify="nikename"--}}
                  {{--autocomplete="off" class="layui-input" value="{{ $user->user_name }}" />--}}
              {{--</div>--}}
          {{--</div>--}}
          <div class="layui-form-item">
              <label for="L_pass" class="layui-form-label">
                  <span class="x-red">*</span>密码
              </label>
              <div class="layui-input-inline">
                  <input type="password" placeholder="不修改留空" id="L_pass" name="pass" required="" lay-verify="pass"
                  autocomplete="off" class="layui-input" >
              </div>
              <div class="layui-form-mid layui-word-aux">
                  6到16个字符
              </div>
          </div>
            <div class="layui-form-item">
                <label for="phone" class="layui-form-label">
                    <span class="x-red">*</span>手机
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="phone" name="phone" required="" lay-verify="phone"
                           autocomplete="off" class="layui-input" value="{{ $user->phone }}">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>
                </div>
            </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  修改
              </button>
          </div>
      </form>
    </div>
    <script>
      layui.use(['form','layer'], function(){
          $ = layui.jquery;
        var form = layui.form
        ,layer = layui.layer;
      
        //自定义验证规则
        form.verify({
          nikename: function(value){
            if(value.length < 5){
              return '昵称至少得5个字符啊';
            }
          }
            ,email:[/^\w+((.\w+)|(-\w+))@[A-Za-z0-9]+((.|-)[A-Za-z0-9]+).[A-Za-z0-9]+$/,'邮箱有误']
            ,phone:function (value) {
                if(value.length != 11){
                    return '手机号码有误';
                }
            }
//          ,pass: [/(.+){6,12}$/, '密码必须6到12位']
//          ,repass: function(value){
//              if($('#L_pass').val()!=$('#L_repass').val()){
//                  return '两次密码不一致';
//              }
//          }
        });

        //监听提交
        form.on('submit(edit)', function(data){
          console.log(data);
          var uid = $("input[name='user_id']").val();
          if(!uid) {
              layer.alert('无法修改',{icon:5});
          }
            $.ajax({
                type:'POST',
                url:'/admin/user'+uid,
                dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:data.field,
                success:function (data) {
                    //console.log(data);
                    if(data.status == 1){
                        layer.alert(data.msg,{icom:6},function () {
                            parent.location.reload(true);
                        });
                    }else{
                        layer.alert(data.msg,{icon:5});
                    }
                },
                error:function () {

                }
            })
//          //发异步，把数据提交给php
//          layer.alert("修改", {icon: 6},function () {
//              // 获得frame索引
//              var index = parent.layer.getFrameIndex(window.name);
//              //关闭当前frame
//              parent.layer.close(index);
//          });
          return false;
        });
        
        
      });
  </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>