<div  class="post icon-newspaper">الشهادات<span>    <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('certificate');">+أضافة</a>
</span> &nbsp;</div>
<div class="contpost">
   {{--  @if (count($seeker_cert)== 0)
        <span class="texts">هل لديك شهادات أخري بأسثناء الشهادات العلمية المعروفة ، يمكنك ذكرها هنا .</span>
        <br><br>
    @endif --}}

    @foreach($seeker_cert as $row)
        <b><span> {{ $row->cert_name }} </span></b><br>
        <span class="texts"> سنة: {{ $row->cert_date }}</span>
        <br>

        <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('certificate',{{$row->certificate_id}});">  تعديل</a>

        <input type="button" class="btn btn-danger btn-sm" onclick="return  deleteItem('certificate/{{ $row->certificate_id }}','#certificate','#certificate')" value="حذف" />


        <br><br>
    @endforeach

</div>
