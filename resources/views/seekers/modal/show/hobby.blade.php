<div  class="post icon-brush">الهوايات<span><a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('hobby');">+أضافة</a>
</span></div>
<div  class="contpost">

@foreach($seeker_hobby as $row)

    <b><span> {{ $row->hobby_name }} </span> </b>
    <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('hobby',{{ $row->job_hobby_id}});"> تعديل</a>
    <input type="button" class=" btn btn-danger btn-sm" onclick="return  deleteItem('hobby/{{ $row->job_hobby_id }}','#hobby','#hobby')" value="حذف" />
    <br>
    <br>
@endforeach

</div>