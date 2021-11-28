
<div>
    <div class="alert-face">تعديل بيانات الشركة</div>
    <button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>

    <div class="modal-face">

        {!! Form::open(["id"=>"myForm","method"=>"PATCH","class"=>"form-style-2"]) !!}
         <div class="mymodal">
            <table class="iteminli">
                <tr>
                    <td><label for="comp_name">اسم الشركة  <span class="req">*</span></label> </td>
                    <td><input id="comp_name" class="form-control" name="comp_name"  value="{{ $company->comp_name }}" type="text" /></td>

                </tr>

                <tr>
                    <td><label for="email">البريد الإلكتروني  <span class="req">*</span></label> </td>
                    <td><input id="email" class="form-control" name="email"  value="{{ $company->email }}" type="email" /></td>

                </tr>

                <tr>
                    <td><label for="phone">الهاتف  <span class="req">*</span></label>  </td>
                    <td><input id="phone" class="form-control" value="{{ $company->phone }}" name="phone" type="text" /></td>
                </tr>
                <tr>
                    <td><label for="url">الموقع الإلكتروني</label></td>
                    <td><input id="url" class="form-control" value="{{ $company->url }}" name="url" type="text" /></td>
                </tr>
                <tr>
                    <td><label for="facebook">فيسبوك</label></td>
                    <td><input id="facebook" class="form-control" value="{{ $company->facebook }}" name="facebook" type="text" /></td>
                </tr>
                <tr>
                    <td><label for="city_id">المدينة  <span class="req">*</span></label></td>
                    <td>
                        <select id="city_id" name="city_id">

                            @foreach($city as $city)
                                @if($city->city_id == $company->city_id)
                                    <option value="{{$city->city_id}}"
                                            selected="selected">{{ $city->city_name }}</option>
                                    @continue
                                @endif
                                <option value="{{$city->city_id}}">{{$city->city_name}}</option>
                            @endforeach
                        </select>
                    </td>

                </tr>
                <tr>
                    <td><label for="address">العنوان  <span class="req">*</span></label></td>
                    <td><input id="address" class="form-control" value="{{ $company->address }}" name="address" type="text" /></td>
                </tr>

                <tr>

                    <td><label for="domain_id">مجال الشركة  <span class="req">*</span></label>

                        </label>
                    </td>
                    <td>
                        <select id="domain_id" name="domain_id">

                            @foreach($domain_type as $domain)
                            @if($domain->domain_id == $company->domain_id)
                            <option value="{{$domain->domain_id}}"
                                    selected="selected">{{$domain->domain_name}}</option>
                            @continue
                            @endif
                            <option value="{{$domain->domain_id}}">{{$domain->domain_name}}</option>
                            @endforeach
                        </select>
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

    var name = "<?php echo $user; ?>" ;
    $('#myForm').submit(function(e){
        e.preventDefault();
        var dataObject =  $("#myForm").serialize()
        editSaveRestCompany(name,'edit-info','#info',dataObject);
    });

</script>
