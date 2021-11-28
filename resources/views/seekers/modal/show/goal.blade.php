{{--@if(empty($job_seeker->goal_text))
    <span class='texts'> هذا الجزء مخصص لذكر هدفك الوظيفي، ماهي المهام والأهداف التي لديك التي تستيطع أن تقدمها والتي تطمح اليها.</span>
@endif --}}
<span>{{$job_seeker->goal_text}}</span>
@if(!empty($job_seeker->goal_text))
    <br><br>
    @endif
