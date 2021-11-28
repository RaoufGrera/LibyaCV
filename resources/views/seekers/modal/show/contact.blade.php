<?php
/**
 * Created by PhpStorm.
 * User: Lenovo1
 * Date: 6/24/2016
 * Time: 6:23 AM
 */?>
<div class="post icon-share"> معلومات الأتصال<span>    <a class="btn btn-default btn-sm" onclick="ShowEditModal('edit-contact');" >  تعديل</a>
</span></div>
<div class="contpost">
    <label>Webiste: </label><a href="http://www.{{ $job_seeker->website }}">{{$job_seeker->website}}</a><br>

    <label>Facebook: </label><a href="https://www.facebook.com/{{ $job_seeker->facebook }}"> {{ ($job_seeker->facebook == "" ) ? "" : "https://www.facebook.com/".$job_seeker->facebook }}  </a><br>
    <label>Twitter: </label><a href="https://www.twitter.com/{{ $job_seeker->twitter }}">{{ ($job_seeker->twitter == "" ) ? "" : "https://www.twitter.com/".$job_seeker->twitter }}</a><br>
    <label>Linkedin: </label><a href="https://www.linkedin.com/{{ $job_seeker->linkedin }}">{{ ($job_seeker->linkedin == "" ) ? "" : "https://www.linkedin.com/".$job_seeker->linkedin }}</a><br>
    <label>Instagram: </label><a href="https://www.instagram.com/{{ $job_seeker->instagram }}" >{{ ($job_seeker->instagram == "" ) ? "" : "https://www.instagram.com/".$job_seeker->instagram }}</a><br>
    <label>Goodreads: </label><a href="https://www.goodreads.com/{{ $job_seeker->goodreads }}" >{{ ($job_seeker->goodreads == "" ) ? "" : "https://www.goodreads.com/".$job_seeker->goodreads }}</a><br>
    <br>

</div>

