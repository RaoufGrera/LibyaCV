@extends('layouts.header-modal')
@section('content')
<div>
    <div class="alert-face">تعديل بيانات الخدمة</div>
    <button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>
    <div class="modal-face">

        {!! Form::open(["id"=>"myForm","method"=>"PATCH","class"=>"form-style-2"]) !!}
        <div class="mymodal">
        <table>
            <tr>
                <td>
                    <label for="title">
                        العنوان
                        <span class="req">*</span>

                    </label>
                </td>
                <td>

                    <input class="form-control" autocomplete="off" id="title" name="title" type="text" required   value="{{ $services->title }}" maxlength="120" placeholder="العنوان"/>

                   </td>

            </tr>

            <tr>
                <td>
                    <label for="dom_name">المجال
                        <span class="req">*</span>
                    </label>
                </td>
                <td>
                    <select id="dom_name" name="dom_name">

                        @foreach($domain_type as $domain)
                            @if($domain->domain_id == $services->domain_id)
                                <option value="{{$domain->domain_id}}"
                                        selected="selected">{{$domain->domain_name}}</option>
                                @continue
                            @endif
                            <option value="{{$domain->domain_id}}">{{$domain->domain_name}}</option>
                        @endforeach
                    </select>
                </td>

            </tr>
            <tr>
                <td>
                    <label for="city_name">المدينة
                        <span class="req">*</span>
                    </label>
                </td>
                <td>


                    <select id="city_name" name="city_name">

                        @foreach($city as $item)
                            @if($item->city_id == $services->city_id)
                                <option value="{{$item->city_id}}"
                                        selected="selected">{{$item->city_name}}</option>
                                @continue
                            @endif
                                <option value="{{$item->city_id}}">{{$item->city_name}}</option>
                        @endforeach
                    </select>
                </td>

            </tr>


            <tr>
                <td>
                    <label for="body">تفاصيل الخدمة</label>
                </td>
                <td>
                    <textarea  requiredmaxlength="3000" style="max-height:300px;width:225px ; max-width:300px;height:200px; min-height:150px;" rows="80" name="body" id="body">{{  $services->body }}</textarea>
                </td>
            </tr>


        </table>
        </div>
        <div class="modal-footer">
            <input name="insert_edd" type="submit" value="حفظ" class="btn btn-info"/>
            <a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();'
               class="btn btn-default ">إلغاء</a>
        </div>


        {!! Form::close() !!}
     </div>

</div>
<script type="text/javascript">
    var id =  <?php echo $services->services_id; ?>;

    $('#myForm').submit(function(e){
        e.preventDefault();
        $(this).find(':submit').attr('disabled','disabled');
        var dataObject =  $("#myForm").serialize();
        editSaveRest('services/'+id,'#services','#services',dataObject);
    });

 </script>
<script   type="text/javascript" src="{{asset('js/app.js')}}"></script>
@stop