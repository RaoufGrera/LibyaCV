@extends('layouts.header-modal')
@section('content')
    <div>
        <div class="alert-face">تقرير</div>
        <button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>
        <div class="modal-face">

            {!! Form::open(["id"=>"myForm","method"=>"POST","class"=>"form-style-2"]) !!}
            <div class="mymodal">
                <table>
                    <tr>
                        <td>
                            @if(session('seeker_id') !=null)
                            <span>السبب</span>
                        </td>
                        <td>
                            <input type="text" name="text">
                            @else
                                <span>هذه الخدمة متاحة للمسجلين فقط.</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                @if(session('seeker_id') !=null)<input type="submit" value="إبلاغ" class="btn btn-info"  />@endif
                <a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-default">إلغاء</a>
            </div>


            {!! Form::close() !!}

        </div>
    </div>
    <script type="text/javascript">
        $('#myForm').submit(function(e){
            var name = "<?php echo $user_name; ?>";
            e.preventDefault();
            var dataObject =  $("#myForm").serialize();
            sendBlock('cv',name,dataObject);
            $(this).attr('disabled', 'disabled');
        });
    </script>
@stop