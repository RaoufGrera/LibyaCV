<div class="post icon-vcard"> التدريب والدورات<span>    <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('training');">+أضافة</a>
</span></div>
<div class="contpost">


    @foreach($seeker_train as $row)
        <b><span> {{ $row->train_name }} </span></b><br>
        <span class="texts"> الجهة: {{ $row->train_comp }}</span><br>
        <span class="texts"> سنة: {{ $row->train_date }}</span>
        <br>

        <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('training',{{$row->train_id}});">  تعديل</a>

        <input type="button" class="btn btn-danger btn-sm" onclick="return  deleteItem('training/{{ $row->train_id }}','#training','#training')" value="حذف" />


        <br><br>
    @endforeach

</div>
