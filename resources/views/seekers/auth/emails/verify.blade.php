<!DOCTYPE html>
<html lang="ar">
    <head>
        <meta charset="utf-8">
    </head>
<body style="font-family: 'Segoe UI'; background-color: #fafafa;border: 2px solid #ddd;direction: rtl">
<h2 style="text-align: center; padding: 15px; font-weight: 100">موقع ليبيا سي في</h2>
<span style="text-align: center; padding: 1px;display: block;margin: 0 auto;">www.libyacv.com</span>
<div style="margin: 25px 0;padding: 20px 15px; background-color: #f8f8f8">
   <span>لتفعيل الحساب أضغظ علي الرابط التالي.</span><br>
    <a href="{{ $link = URL::to('https://www.libyacv.com/register/verify/'.$confirmation_code) }}"> {{ $link }} </a><br>

</div>
</body>
</html>