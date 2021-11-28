<div class="contpost">
    <img class="imgcover"

         src= @if($company->cover !=""){!! asset('images/cover/'.$company->code_cover.'_'.$company->cover) !!}
            @else
        {!! asset('images/cover/simplecover.png') !!}
            @endif >
</div>