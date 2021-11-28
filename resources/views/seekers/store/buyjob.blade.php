 @inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header-modal')
@section('content')
<div>
    <div class="alert-face">تمييز وظيفة شاغرة</div>
    <button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>
    <div class="modal-face">

        {!! Form::open(["id"=>"myForm","method"=>"POST","class"=>"form-style-2"]) !!}
        <div class="mymodal">
            <table>
                <tr>
                    <td>
                        @if(count($job) !=0 && session('user_name_company') !="" )

                        <label for="ed_name">
                            أختر وظيفة
                            <span class="req">*</span>

                        </label>
                    </td>
                    <td>


                        <select id="job" name="job">

                            @foreach($job as $item)
                                <option value="{{$item->desc_id}}">{{$item->job_name}}</option>
                            @endforeach
                        </select></td>
                    <td>
                        <div class="tooltip ed_name_val validation">

                        </div>

                        @else
                            <span>ليس لديك وظائف شاغرة.</span>
                        @endif
                    </td>
                </tr>

            </table>
            <br>
            <br>
            <br>
            <br>
        </div>
        <div class="modal-footer">
            @if(count($job) !=0 && session('user_name_company') !="" )  <input type="submit" value="تأكيد الشراء" class="btn btn-info"  /> @endif
            <a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-default">إلغاء</a>
        </div>


        {!! Form::close() !!}

    </div>
</div>
<script type="text/javascript">
    $('#myForm').submit(function(e){
        e.preventDefault();
        var dataObject =  $("#myForm").serialize();
        confirmPay('job',dataObject);
        $(this).attr('disabled', 'disabled');
    });
</script>
@stop