<?php
/**
 * Created by PhpStorm.
 * User: Lenovo1
 * Date: 6/22/2016
 * Time: 5:20 AM
 */
?>

<div  class="post icon-graduation-cap"> المؤهل العلمي <span>    <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('education');">+أضافة</a>
</span></div>
<div   class="contpost" style="display: block">

    @if(session('errorEducation'))
        <div class="alert alert-warning">
            <a href="javascript:void(0);" class="close"  data-dismiss="alert"    aria-label="close">&times;</a>

            <strong>تنبيه!</strong> خطاء في الإدخال
        </div>
    @endif

    {{-- @if (count($seeker_ed) == 0)
        <span class='texts'>هذا الجزء مخصص لذكر المؤهلات العلمية الخاصة بك ، إذا كنت تملك شهادة البكالوريس أو شهادة أعلي منها يفضل عدم ذكرك لشهادتك الثانوية، إذاكان معدلك جيد أو اكثر فيفضل ذكر معدلك</span>
        <br><br>
    @endif--}}

    @foreach($seeker_ed as $row)

        <b><span>{{$row->univ_name}} {{$row->faculty_name}} </span></b>
        <br>
        <span class='texts '>{{$row->edt_name}}
            @if(!empty($row->sed_name))، {{$row->sed_name}}@endif
            @if(!empty($row->avg))، {{$row->avg}}@endif
            <br>
            {{$row->start_date}} - {{$row->end_date}}

            <br>المجال
            {{$row->domain_name}}</span>
            <br>
         <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('education','{{$row->ed_id}}');" >  تعديل</a>
           <input type="button" class=" btn btn-danger btn-sm" onclick="return  deleteItem('education/{{ $row->ed_id }}','#education','#education')" value="حذف" />

        <br><br>
    @endforeach


</div>
