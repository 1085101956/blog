<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台登录</title><!-- X-admin2.0 -->
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('admin/css/font.css')}}">
	<link rel="stylesheet" href="{{asset('admin/css/xadmin.css')}}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{asset('admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('admin/js/xadmin.js')}}"></script>

</head>
<body class="login-bg">
    
    <div class="login">
        <div class="message">blog管理登录</div>
        @if (@count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @if(is_object($errors))
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    @else
                        <li>{{ $errors }}</li>
                    @endif
                </ul>
            </div>
        @endif

        <div id="darkbannerwrap"></div>
        
        <form method="post" class="layui-form" action="{{url('admin/doLogin')}}">
            {{csrf_field()}}
            <input name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input name="code" style="height:50px;width: 170px;float: left;" lay-verify="required" placeholder="验证码"  type="text" class="layui-input">
            <img src="{{url('admin/code')}}" alt="验证码" style="float: right;" onclick="this.src='{{url('admin/code')}}?'+Math.random()">
            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
        </form>
    </div>

    <script>
//        $(function  () {
//            layui.use('form', function(){
//              var form = layui.form;
//              // layer.msg('玩命卖萌中', function(){
//              //   //关闭后的操作
//              //   });
//              //监听提交
//              form.on('submit(login)', function(data){
//                alert(888)
//                layer.msg(JSON.stringify(data.field),function(){
//                    location.href='index.html'
//                });
//                return false;
//              });
//            });
//        })


    </script>

    
    <!-- 底部结束 -->
    {{--<script>--}}
    {{--//百度统计可去掉--}}
    {{--var _hmt = _hmt || [];--}}
    {{--(function() {--}}
      {{--var hm = document.createElement("script");--}}
      {{--hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";--}}
      {{--var s = document.getElementsByTagName("script")[0]; --}}
      {{--s.parentNode.insertBefore(hm, s);--}}
    {{--})();--}}
    {{--</script>--}}
</body>
</html>