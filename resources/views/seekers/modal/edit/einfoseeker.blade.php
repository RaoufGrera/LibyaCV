@extends('layouts.header-modal')
@section('content')
<div>
    <div class="alert-face" >تعديل المعلومات الشخصية</div>
    <button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>

    <div class="modal-face">
        {!! Form::open(["id"=>"myForm","method"=>"PATCH","class"=>"form-style-2"]) !!}
        <div class="mymodal">
         <table class="iteminli" >
             <tr>
                 <td><label for="fname">الأسم  <span class="req">*</span></label></td>
                 <td><input id="fname" class="form-control" value="{{ $info->fname }}" name="fname" type="text" required /></td>
             </tr>


             <tr>
                 <td><label for="about">عنوان مختصر</label></td>
                 <td><input id="about" class="form-control" value="{{ $info->about }}"  maxlength="200" name="about" type="text" /></td>
             </tr>
             <tr>
                 <td>
                     <label class="control-label" for="fdate">
                         تاريخ الميلاد
                         <span  class="req">*</span>
                     </label>
                 </td>


                 <td class="day">
                     <?php $time = strtotime($info->birth_day);?>
                     <select id="fdate" name="fdate"  tabindex="3" >

                         <?php

                         for($i=1;$i<=31;$i++){
                             echo "<option ";
                             if(date('d',$time) == $i){
                                 echo " selected " ;
                             }
                             echo "value=\"$i\">$i</option>\n";
                         }
                         ?>
                     </select>
                     -
                     <select  name="fdate1"  >

                         <?php

                         for($i=1;$i<=12;$i++){
                             echo "<option ";
                             if(date('m',$time) == $i){
                                 echo " selected " ;
                             }

                             echo "value=\"$i\">$i</option>\n";
                         }
                         ?>
                     </select>
                     -
                     <select name="fdate2"   >

                         <?php

                         for($i=1955;$i<=2010;$i++){
                             echo "<option ";
                             if(date("Y",$time) == $i){
                                 echo " selected " ;
                             }
                             echo "value=\"$i\">$i</option>\n";
                         }
                         ?>
                     </select>
                 </td>

             </tr>
             <tr>
                 <td>
                     <label for="edt">المؤهل
                         <span class="req">*</span>
                     </label>
                 </td>
                 <td>
                     <select id="edt" name="edt">

                         @foreach($edt as $item)
                             @if($item->edt_id == $info->edt_id)
                                 <option value="{{ $item->edt_id }}"
                                         selected="selected">{{ $item->edt_name }}</option>
                                 @continue
                             @endif
                             <option value="{{ $item->edt_id }}">{{ $item->edt_name }}</option>
                         @endforeach
                     </select>
                 </td>
             </tr>
             <tr>
                 <td>
                     <label for="domain">المجال
                         <span class="req">*</span>
                     </label>
                 </td>
                 <td>
                     <select id="domain" name="domain">

                         @foreach($domain as $item)
                             @if($item->domain_id == $info->domain_id)
                                 <option value="{{ $item->domain_id }}"
                                         selected="selected">{{ $item->domain_name }}</option>
                                 @continue
                             @endif
                             <option value="{{ $item->domain_id }}">{{ $item->domain_name }}</option>
                         @endforeach
                     </select>
                 </td>
             </tr>

             <tr>
                 <td>
                     <label for="city">المدينة
                         <span class="req">*</span>
                     </label>
                 </td>
                 <td>
                     <select id="city" name="city">

                         @foreach($city as $citys)
                             @if($citys->city_id == $info->city_id)
                                 <option value="{{ $citys->city_id }}"
                                         selected="selected">{{ $citys->city_name }}</option>
                                 @continue
                             @endif
                             <option value="{{ $citys->city_id }}">{{ $citys->city_name }}</option>
                         @endforeach
                     </select>
                 </td>
             </tr>
             <tr>
                 <td><label for="address">العنوان  </label></td>
                 <td><input id="address" class="form-control" value="{{ $info->address }}" name="address" type="text"  /></td>
             </tr>
             <tr>
                 <td><label for="address">البريد الإلكتروني  </label></td>
                 <td><input id="address" class="form-control" value="{{ $info->email1 }}" name="email" type="text"  /></td>
             </tr>
             <tr>
                 <td><label for="phone">الهاتف  </label>  </td>
                 <td><input id="phone" class="form-control" pattern="[0-9]{10}" title="رقم الهاتف." value="{{ $info->phone }}" name="phone" type="text"  <?php  /*if(!$info->phoned_date) echo "disabled"; */ ?> />
                     <span style="font-size: 80%;">********09
                     </span></td>

             </tr>


             <tr>
                 <td>
                     <label for="sex">الجنس
                         <span class="req">*</span>
                     </label>
                 </td>
                 <td>
                     <select id="sex" name="sex">

                         <option value="m"
                             @if($info->gender =="m")
                                         selected="selected"
                             @endif
                         >ذكر</option>
                         <option value="f"
                                 @if($info->gender =="f")
                                 selected="selected"
                                 @endif
                         >أنثي</option>
                     </select>
                 </td>
             </tr>
        </table>
</div>
        <div class ="modal-footer">
            {!! Form::submit("حفظ",["class"=>"btn btn-info"]) !!}
            <a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-default ">إلغاء</a>

        </div>


        {!! Form::close() !!}

    </div>

</div>

<script type="text/javascript">

    $('#myForm').submit(function(e){
        e.preventDefault();
        var dataObject =  $("#myForm").serialize();
        editSave('edit-info','#personal-information','#personal-information',dataObject);
    });
</script>
@stop