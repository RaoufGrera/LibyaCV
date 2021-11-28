@component('mail::message')
# تفعيل حساب موقع ليبيا سي في www.libyacv.com

نأمل منك الضغظ علي الزر تفعيل الحساب وذلك لتفعيل حسابك في موقع "ليبيا سي في" للتوظيف.
 @component('mail::button', ['url' => '/register/verify/'.$email_token])
تفعيل
@endcomponent

شكراً,<br>
{{ config('app.name') }}
@endcomponent
