<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户修改</title>
</head>
<body>
<form method="post" action={{url("user/update")}}>
    <table>
        {{csrf_field()}}
        {{--<input type="hidden" name="__token" value="{{csrf_token()}}"/>--}}
        <input type="hidden" name="id" value="{{$list->user_id}}"/>
        <tr>
            <td>用户名</td>
            <td><input type="text" name="name" value="{{$list->user_name}}"/></td>
        </tr>
        <tr>
            <td>密码</td>
            <td><input type="password" name="password" value="{{$list->user_pass}}"/></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="修改"/></td>
        </tr>
    </table>
</form>

</body>
</html>