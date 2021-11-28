<div class="post icon-sitemap">التخصصات<span>    <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('specialtys');">+أضافة</a>
</span></div>
<div class="contpost">
   {{--  @if (count($seeker_spec)== 0)
        <span class="texts">هل تملك مهارات مثل استخدام برنامج محرر النصوص او خبرة في تصفح أدخال البيانات أو غيرها من المهارات ، يمكنك كتابتها هنا .</span>
        <br><br>
    @endif--}}

    @foreach($seeker_spec as $row)
            <span class="btn btn-default" style="cursor: context-menu;" > {{ $row->spec_name }}</span>

          <input type="button" class="btn btn-danger btn-sm" onclick="return  deleteItem('specialtys/{{ $row->spec_seeker_id }}','#specialtys','#specialtys')" value="حذف" />

            <br><br>
    @endforeach


</div>