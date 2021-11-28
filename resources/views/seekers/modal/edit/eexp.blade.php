@extends('layouts.header-modal')
@section('content')
<div>
    <div class="alert-face">تعديل الخبرة</div>
    <button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>

    <div class="modal-face">

        {!! Form::open(["id"=>"myForm","method"=>"PATCH","class"=>"form-style-2"]) !!}
        <div class="mymodal">
            <table class="iteminli">
                <tr>
                    <td>
                        <label for="exp_comp">الشركة<span class="req">*</span></label>
                    </td>
                    <td>
                        <div class="input-group">
                            <input id="exp_comp" name="exp_comp" type="text" class="form-control" autocomplete="off"  value="{{ $seeker_exp->compe_name }}" maxlength="120" placeholder="الشركة"/>
                            <ul id="expResults" class="lists">

                            </ul>
                        </div>                    </td>
                    <td>
                        <div class="tooltip exp_comp_val validation"></div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="exp_name">المسمي الوظيفي<span class="req">*</span>
                        </label>
                    </td>
                    <td>
                        <input class="form-control" id="exp_name" name="exp_name" type="text" value="{{ $seeker_exp->exp_name }}"
                               maxlength="150" placeholder="المسمي الوظيفي"/>
                    </td>
                    <td>
                        <div class="tooltip exp_name_val validation"></div>
                    </td>
                </tr>


                <tr>
                    <td>
                        <label for="dom_id">
                            القطاع
                            <span class="req">*</span>
                        </label>
                    </td>
                    <td>
                        <select id="dom_id" name="dom_id">
                            @foreach($domain_type as $domain)
                                @if($domain->domain_id == $seeker_exp->domain_id)
                                    <option value="{{$domain->domain_id}}"
                                            selected="selected">{{$domain->domain_name}}</option>
                                    @continue
                                @endif
                                <option value="{{$domain->domain_id}}">{{$domain->domain_name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <div class="tooltip dom_id_val validation">

                        </div>
                    </td>
                </tr>


                <tr>
                    <td>
                        <label for="exp_desc">
                            الأنجازات

                        </label>
                    </td>
                    <td>
                        <textarea maxlength="1200"
                                  style="max-height:150px; max-width:230px; height:100px; min-height:100px;" rows="80"
                                  name="exp_desc" id="exp_desc">{{ $seeker_exp->exp_desc }}</textarea>
                    </td>

                </tr>

                <tr>
                    <td>
                        <label for="start_date">
                            المدة من
                            <span class="req">*</span>
                        </label>
                    </td>


                    <td class="day">

                        <select name="start_date_m">
                            <?php
                            $time = strtotime($seeker_exp->start_date);
                            $start_time_m = date('m', $time);
                            $start_time_y = date('Y', $time);

                            for ($i = 12; $i >= 1; $i--) {
                                echo "<option ";
                                if ($start_time_m == $i) {
                                    echo " selected ";
                                }
                                echo "value=\"$i\">$i</option>\n";
                            }
                            ?>
                        </select>
                        -
                        <select name="start_date_y">

                            <?php
                            $y = date("Y");
                            for ($i = $y; $i >= 1950; $i--) {
                                echo "<option ";
                                if ($start_time_y == $i) {
                                    echo " selected ";
                                }
                                echo "value=\"$i\">$i</option>\n";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="end_date_m">
                            الي
                            <span class="req">*</span>
                        </label>
                    </td>
                    <td class="day">
                        <select name="end_date_m">
                            <?php
                            $time = strtotime($seeker_exp->end_date);
                            $end_time_m = date('m', $time);
                            $end_time_y = date('Y', $time);

                            for ($i = 12; $i >= 1; $i--) {
                                echo "<option ";
                                if ($end_time_m == $i)
                                    echo " selected ";
                                echo "value=\"$i\">$i</option>\n";
                            }
                            ?>
                        </select>
                        -

                        <select name="end_date_y">
                            <option value="1" <?php if ($seeker_exp->state == 1) {
                                echo " selected ";
                                $end_time_y = 2222;
                            } ?> >لحد الأن
                            </option>
                            <?php
                            $y = date("Y");
                            for ($i = $y; $i >= 1950; $i--) {
                                echo "<option ";
                                if ($end_time_y == $i)
                                    echo " selected ";
                                echo "value=\"$i\">$i</option>\n";
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <div class="tooltip start_date_val validation">

                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
            <input name="insert_exp" type="submit" value="حفظ" class="btn btn-info"/>
            <a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();'
               class="btn btn-default ">إلغاء</a>
        </div>


        {!! Form::close() !!}

    </div>

</div>

<script type="text/javascript" src="{{asset('js/script_exp.js')}}"></script>
<script type="text/javascript">
    var id =  <?php echo $seeker_exp->exp_id; ?> ;
    $('#myForm').submit(function(e){
        e.preventDefault();
        var dataObject =  $("#myForm").serialize();
        editSaveRest('experience/'+id,'#experience','#experience',dataObject);});
        $("#exp_comp").delayKeyup(function() {searchAjax("#exp_comp","exp","#expResults");},700);
        $("#exp_comp").blur(function(){$("#expResults").fadeOut(500);})
                .focus(function() {$("#expResults").show();});
</script>
<script   type="text/javascript" src="{{asset('js/app.js')}}"></script>
@stop