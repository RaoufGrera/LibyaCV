<table style="float: right">
    <tr>

        <td colspan="2">
            <span><a id="cvname" href="/user/{{ $job_seeker->user_name }}">{{$job_seeker->fname}} {{$job_seeker->lname}}  </a></span><br>

            <span class="texts">{{ $job_seeker->about }}</span>
        </td>
    </tr>

    <tr>
        <td>
 <span class="icon-location"> {{$job_seeker->city_name}}
     @if($job_seeker->address != "")
         - {{$job_seeker->address}}
     @endif
                        </span>
        </td>
    </tr>
    <tr>

        <td>
            <span class="icon-calendar"><?php $datereg = date("Y");
                $age = $datereg - date("Y",strtotime($job_seeker->birth_day));
                echo $age . " سنة"; ?></span>
        </td>
    </tr>
    <tr>

        <td>
            <span class="icon-mail"> {{$job_seeker->email}}</span>
        </td>
    </tr>
    <tr>

        <td>
            <span class=" icon-mobile">{{$job_seeker->phone}}</span>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <br>

            <a  class="btn btn-default btn-sm" onclick="ShowEditModal('edit-info');" >  تعديل</a>
            <a  href="/profile/download"  class="btn btn-default btn-sm"  >تحميل السيرة الذاتية   <img width="18" src="{{ asset('images/home/printer30.png') }}" /></a>

            <a style="margin-left: 20px;" class="btn btn-danger btn-sm  icon-retweet"  onclick="ShowEditModal('update-cv');"   >تحديث السيرة الذاتية في نتائج البحث</a>
            <br>
        </td>
    </tr>
</table>