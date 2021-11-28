
<?php
/**
 * Created by PhpStorm.
 * User: Lenovo1
 * Date: 6/25/2016
 * Time: 6:01 AM
 */?>
<div class="post icon-info">معلومات أضافية<span>    <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('info');">+أضافة</a>
</span></div>
<div class="contpost">

    @foreach($seeker_info as $row)
        <b><span> {{ $row->info_name }} </span></b><br>
       @if($row->info_text != "")
        <p style="
            padding-right: 6px;
    margin-top: 6px;
    background-color: #fbfbfb;
    border-right: 3px solid #d1d1d1;
    color: #585858;
    line-height: 2.6;
        ">
            {!! nl2br(e($row->info_text)) !!}
        </p>
     @endif
        <span class="texts"> سنة: {{ $row->info_date }}</span>
        <br>
        <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('info',{{$row->info_id}});">  تعديل</a>

         <input type="button" class="btn btn-danger btn-sm" onclick="return  deleteItem('info/{{ $row->info_id }}','#info','#info')" value="حذف" />

        <br><br>
    @endforeach

</div>
