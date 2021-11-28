<div class="contpost" style="padding-right: 0;">
<img class="imgcompany" style="    max-width: 160px;
"
     src= @if($company->image !=""){!! asset('images/company/300px_'.$company->code_image.'_'.$company->image) !!} @else {!! asset('images/simple/company.png')  !!}  @endif >
 </div>