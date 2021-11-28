<div class="post icon-briefcase">الخبرة      <i style="font-size:80%;"><?php echo '' . floor(session('exp_sum')/12) . ' سنة و' .session('exp_sum')%12 . ' شهر.';?></i><span>    <a class="btn btn-default btn-sm" onclick="ShowEditModalRESTful('experience');">+أضافة</a>
</span></div>
<div class="contpost">
  {{--   @if (count($seeker_exp) == 0)
        <span class='texts'>أذا كنت حديث التخرج ولم تعمل من قبل فيفضل ترك هذا الجزاء فارغاً ، إذا كانت  لديك خبرة سابقة  يمكنك ذكرها هنا .</span>
        <br>
        <br>
    @endif --}}

    @foreach($seeker_exp as $row)
        <b><span>{{$row->exp_name}}</span></b>
        <br>
        <span class='texts '>في {{$row->compe_name}}
            <br>
            {{ date('Y-m',strtotime($row->start_date)) }} -
            @if($row->state ==0)
                {{ date('Y-m',strtotime($row->end_date)) }}
            @else
                الي حد الأن
            @endif
            <br>
                                 مجال الشركة {{$row->domain_name}}
            <br>
            {!! nl2br(e($row->exp_desc)) !!}
                            </span>
            <br>
            <a  class="btn btn-default  btn-sm" onclick="ShowEditModalRESTful('experience',{{$row->exp_id}});" >  تعديل</a>

            <input type="button" class=" btn btn-danger  btn-sm" onclick="return  deleteItem('experience/{{ $row->exp_id }}','#experience','#experience')" value="حذف" />


            <br><br>
    @endforeach

</div>