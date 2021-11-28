<div class="post icon-globe">اللغات<span>    <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('language');">+أضافة</a>
</span></div>
<div class="contpost">
  {{--  @if (count($seeker_lang)== 0)
        <span class="texts">هذا الجزء خاص بذكر اللغات التي لك ألمام بها ، يمكنك تحديد مستواك في اللغة .</span>
        <br><br>
    @endif --}}

@foreach($seeker_lang as $row)
        <b><span> {{ $row->lang_name }} </span></b><br>
        <span class="texts"> المستوي: {{ $row->level_name }}</span>
        <br>
            <a  class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('language',{{$row->job_lang_id}});">
                        تعديل</a>

            <input type="button" class="btn btn-danger btn-sm" onclick="return  deleteItem('language/{{ $row->job_lang_id }}','#language','#language')" value="حذف" />


            <br><br>
    @endforeach

</div>