<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form method="post" action={{url("user/store")}}>
    <table>
        {{csrf_field()}}
        {{--<input type="hidden" name="__token" value="{{csrf_token()}}"/>--}}
        <tr>
            <td>用户名</td>
            <td><input type="text" name="name" value=""/></td>
        </tr>
        <tr>
            <td>密码</td>
            <td><input type="password" name="password" value=""/></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="提交"/></td>
        </tr>
    </table>
</form>

</body>
</html>