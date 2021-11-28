<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>إستعادة كلمة السر</h2>
<div>
    <span>أضغظ علي الرابط التالي لإستعادة كلمة السر.</span><br>
    <a href="{{ $link = url('password/reset', $token).'?email='.$email }}"> {{ $link }} </a>

</div>
</body>
</html>