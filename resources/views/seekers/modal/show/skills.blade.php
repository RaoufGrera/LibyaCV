<div class="post icon-tasks">المهارات<span>    <a  class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('skills');">+أضافة</a>
</span></div>
<div class="contpost">
   {{--  @if (count($seeker_skills)== 0)
        <span class="texts">هل تملك مهارات مثل استخدام برنامج محرر النصوص او خبرة في تصفح أدخال البيانات أو غيرها من المهارات ، يمكنك كتابتها هنا .</span>
        <br><br>
    @endif --}}

    @foreach($seeker_skills as $row)
        <b><span> {{ $row->skills_name }} </span></b><br>
        <span class="texts"> المستوي: {{ $row->level_name }}</span>
        <br>

        <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('skills',{{$row->skills_id}});">  تعديل</a>

      <input type="button" class="btn btn-danger btn-sm" onclick="return  deleteItem('skills/{{ $row->skills_id }}','#skills','#skills')" value="حذف" />
            <br><br>
    @endforeach

</div>