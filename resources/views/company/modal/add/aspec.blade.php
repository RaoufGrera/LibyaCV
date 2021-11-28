@extends('layouts.header-modal')
@section('content')
    <div>
        <div class="alert-face">أضافة تخصص جديد</div>
        <button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>


        <div class="modal-face">

            {!! Form::open(["id"=>"myForm","method"=>"POST","class"=>"form-style-2"]) !!}
            <div class="mymodal">


                <table class="iteminli">

                    <tr>
                        <td>
                            <label for="spec">
                                التخصص
                                <span class="req">*</span>
                            </label>
                        </td>
                        <td>
                            <div class="input-group">
                                <input class="form-control" id="specSeeker"  name="specSeeker" autocomplete="off" type="text" />
                                <ul id="specSeekerResults" class="lists">

                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <br>
                            <br>
                            <br>

                            <br>
                            <br>
                            <br>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <input type="submit" value="حفظ" class="btn btn-info"/>
                <a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();'
                   class="btn btn-default ">إلغاء</a>
            </div>


            {!! Form::close() !!}

        </div>


    </div>

    <script type="text/javascript">
        $('#myForm').submit(function(e){
            e.preventDefault();
            var name = '<?php echo $user; ?>';
            var dataObject =  $("#myForm").serialize();
            editSaveRestCompany(name,'specialty','#specialty',dataObject);
        });
        $("#specSeeker").delayKeyup(function() {
            searchAjax("#specSeeker","speccompany","#specSeekerResults");
        },700);
        $("#specSeeker").blur(function(){
                    $("#specSeekerResults").fadeOut(500);
                })
                .focus(function() {
                    $("#specSeekerResults").show();
                });
    </script>
    <script   type="text/javascript" src="{{asset('js/app.js')}}"></script>
@stop