<div class="contpost">
    <img class="imgseeker"
         src= @if($job_seeker->image !=""){{asset('images/seeker/300px_'.$job_seeker->code_image .'_'. $job_seeker->image)}} @else @if($job_seeker->gender =='m') {{asset('images/simple/male.png')}} @else {{asset('images/simple/female.png')}}  @endif @endif />
    <br>
    <br>
</div>
