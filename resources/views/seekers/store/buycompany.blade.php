@extends('layouts.header-modal')
@section('content')
<div>
    <div class="alert-face">تمييز الشركة</div>
    <button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>
    <div class="modal-face">

        {!! Form::open(["id"=>"myForm","method"=>"POST","class"=>"form-style-2"]) !!}
        <div class="mymodal">
            <table>
                <tr>
                    <td>
                        @if(session('user_name_company') !="" )

                        <span>تمييز شركة</span> <strong>{{ $company->comp_name }}</strong>
                        <br>

                        @else
                            <span>ليس لديك شركة.</span>
                        @endif
                    </td>


                </tr>

            </table>
        </div>
        <div class="modal-footer">
            @if(session('user_name_company') !="" )<input type="submit" value="تأكيد الشراء" class="btn btn-info"  />@endif
            <a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-default">إلغاء</a>
        </div>


        {!! Form::close() !!}

    </div>
</div>
<script type="text/javascript">
    $('#myForm').submit(function(e){
        e.preventDefault();
        var dataObject =  $("#myForm").serialize();
        confirmPay('company',dataObject);
        $(this).attr('disabled', 'disabled');
    });
</script>
@stop