@extends('layouts.header-modal')
@section('content')
<div>
    <div class="alert-face">أضافة مؤهل علمي جديد</div>
    <button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>
    <div class="modal-face">

        {!! Form::open(["id"=>"myForm","method"=>"POST","class"=>"form-style-2"]) !!}
        <div class="mymodal">
        <table>
            <tr>
                <td>
                    <label for="ed_name">
                        المؤهل العلمي
                        <span class="req">*</span>

                    </label>
                </td>
                <td>


                    <select id="ed_name" name="ed_name">
                        <option value="0" selected="selected">
                            المؤهل
                        </option>
                        @foreach($ed_type as $ed_types)
                            <option value="{{$ed_types->edt_id}}">{{$ed_types->edt_name}}</option>
                        @endforeach
                    </select></td>
                <td>
                    <div class="tooltip ed_name_val validation">

                    </div>
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
                        <option value="0" selected="selected">
                            المجال
                        </option>
                        @foreach($domain_type as $domain)
                            <option value="{{$domain->domain_id}}">{{$domain->domain_name}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <div class="tooltip dom_name_val validation">

                    </div>
                </td>
            </tr>


            <tr>
                <td>
                    <label for="university">
                        الجامعة
                        <span class="req">*</span>
                    </label>
                </td>
                <td>
                    <div class="input-group">
                    <input class="form-control" autocomplete="off" id="university" name="univ" type="text"    value="" maxlength="120" placeholder="الجامعة"/>
                    <ul id="univResults" class="lists">

                    </ul>
</div>
                </td>
                <td>
                    <div class="tooltip univ_val validation">

                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="faculty">
الكلية

                    </label>
                </td>
                <td>
                    <div class="input-group">
                    <input class="form-control" id="faculty"  autocomplete="off" name="faculty" type="text" value="" maxlength="120" placeholder="الكلية إذا وجدت..."/>
                    <ul id="facultyResults" class="lists">

                    </ul>
                    </div>
                </td>
                <td>

                </td>
            </tr>

            <tr>
                <td>
                    <label for="specialty">
                        التخصص

                    </label>
                </td>
                <td>
                    <div class="input-group">
                    <input class="form-control"  id="specialty"  autocomplete="off" name="specialty" type="text" value="" maxlength="120" placeholder="التخصص"/>
                    <ul id="specialtyResults" class="lists">

                    </ul>
        </div>
                </td>

            </tr>
            <tr>
                <td><label for="avg_num">
                        المعدل
                    </label></td>
                <td>
                    <input class="form-control"  id="avg_num" name="avg_num" type="text" placeholder="المعدل"/>

                </td>
            </tr>

            <tr>
                <td>
                    <label for="start_date">
                        المدة
                        <span class="req">*</span>
                    </label>
                </td>


                <td class="day">

                    <select id="start_date" name="start_date" class="field select medium">
                        <option value="0" selected="selected">
                            من
                        </option>
                        <?php
                        $y = date("Y");
                        for ($i = $y; $i >= 1960; $i--) {
                            echo "<option ";
                            echo "value=\"$i\">$i</option>\n";
                        }
                        ?>
                    </select>
                    -
                    <select name="end_date">
                        <option value="0" selected="selected">
                            إلي
                        </option>
                        <?php
                        $y = date("Y") + 8;
                        for ($i = $y; $i >= 1960; $i--) {
                            echo "<option ";
                            echo "value=\"$i\">$i</option>\n";
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <div class="tooltip startend_val validation">

                    </div>
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
        <script type="text/javascript" src="{{asset('js/script_ed.js')}}"></script>
    </div>

</div>
<script type="text/javascript">
    $('#myForm').submit(function(e){

        e.preventDefault();
        $(this).find(':submit').attr('disabled','disabled');

        var dataObject =  $("#myForm").serialize();
        editSaveRest('education','#education','#education',dataObject);
    });

    $("#university").delayKeyup(function() {searchAjax("#university","univ","#univResults");},700);$("#university").blur(function(){$("#univResults").fadeOut(500);}) .focus(function() {$("#univResults").show();});
    $("#faculty").delayKeyup(function() {searchAjax("#faculty","faculty","#facultyResults");},700);$("#faculty").blur(function(){$("#facultyResults").fadeOut(500);}) .focus(function() {$("#facultyResults").show();});
    $("#specialty").delayKeyup(function() {searchAjax("#specialty","speced","#specialtyResults");},700);$("#specialty").blur(function(){$("#specialtyResults").fadeOut(500);}) .focus(function() {$("#specialtyResults").show();});
</script>
<script   type="text/javascript" src="{{asset('js/app.js')}}"></script>
@stop