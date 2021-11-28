<div><h4>عن الشركة</h4></div>
<div class="contpost">
    @if(empty($company->services))
        <span class='texts'> هذا الجزء مخصص لتقديم نبذة عن الشركة وعرض خدماتها.</span>
    @endif
    <span>{!!  nl2br(e($company->services)) !!}</span><br><br>
    <a class="btn btn-primary" onclick="ShowEditModalRESTfulCompany('services','{{ $user }}');">تعديل</a>
    <br>
</div>