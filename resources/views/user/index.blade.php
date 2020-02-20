<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="/js/layer/jquery.js"></script>
    <script src="/js/layer/layer.js"></script>
</head>
<body>
    <table>
        <tr>
            <td>ID</td>
            <td>用户名</td>
            <td>密码</td>
            <td>操作</td>
        </tr>
        @foreach($list as $v)
        <tr>
            <td>{{$v->user_id}}</td>
            <td>{{$v->user_name}}</td>
            <td>{{$v->user_pass}}</td>
            <td><a href='/user/edit/{{$v->user_id}}'>修改</a>||<a href="javascript:" onclick="del_ment(this,{{$v->user_id}})">删除</a></td>
        </tr>
        @endforeach
    </table>
<style>
    table,tr,td{
        border:1px solid black;
    }
</style>
<script>
    function del_ment(obj,id) {
        //询问框
        layer.confirm('是否确认删除', {
            btn: ['确认','取消'] //按钮
        }, function(){
            $.get('/user/del/'+id,function (data) {
                if(data['status'] == 1) {
                    $(obj).parents('tr').remove();
                    layer.msg('成功',{icon:6})
                }else{
                    layer.msg(data.message,{icon:5})
                }
//                console.log(data)
            })
        }, function(){
//            layer.msg('也可以这样', {
//                time: 20000, //20s后自动关闭
//                btn: ['明白了', '知道了']
//            });
        });
    }
</script>
</body>
</html>
