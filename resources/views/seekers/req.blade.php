 @inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header')
 @section('title',trans("page.job-application"))

 @section('content')

    <div class="container">
        <div class="row">
            @include('layouts.seeker')
            <div class="col-md-9 ">
                <br>
                <h5 class="title-page"> طلبات التوظيف</h5>
                <br>

                <div class="cont">
                    @if(session('error'))
                        <div class="alert alert-warning">
                            <a href="javascript:void(0);" class="close" data-dismiss="alert"
                               aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> {{  session('error') }}
                        </div>
                    @endif

                    <div>


<br>
                            @if(count($myjobs) > 0)

                            @foreach($myjobs as $item)

                                <div class="cv-div" id="req-{{$item->req_id}}">


                                    <div class="cv-body">
                                        <a href="javascript:void(0)" class="icon-block b t" onclick="ShowModal('job','{{$item->desc_id }}');"></a>
                                        <div class="devimgjob">
                                            <a href="/job/{{$item->desc_id }}"><img class="imgjob-view"
                                                                                         src= @if($item->image  != ''){{asset('images/company/140px_'.$item->code_image.'_'.$item->image )}} @else {{asset('images/simple/140px_company.png')}} @endif /></a>
                                            <span class="icon-eye a" > {{ $item->see_it  }}</span></div>

                                        <table class="line">
                                            <tr>

                                                <td>
                                                    <span class="display"><a  id="cvname" href="/job/{{ $item->desc_id  }}">{{$item->job_name }} </a>  </span>
                                                    <span class="r"><a class="weight" href="/c/{{$item->comp_user_name  }}">{{ $item->comp_name  }}</a> </span>

                                                </td>
                                            </tr>

                                            <tr>

                                                <td >
                                                    <span>تاريخ الطلب:  {{$item->req_date}}</span>&nbsp;&nbsp; &nbsp;<span class="icon-minus-circled end">{{$item->job_end }}</span>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php
                                                    $data="قيد المعالجة";
                                                    if($item->req_event == 0 ){
                                                        if($item->see ==1)
                                                            $data="تم مشاهدة السيرة الذاتية";
                                                    }else if($item->req_event == 1 ){
                                                        $data="تمت الموافقة";
                                                    }else{
                                                        $data="تم الرفض";
                                                    }
                                                    ?>
                                                  <span>حالة الوظيفة: </span> {{$data}} @if($item->req_event ==0)<button onclick="return  deleteItem('{{$item->req_id}}')"    class="btn btn-sm btn-danger " >إلغاء التقدم للوظيفة</button>@endif

                                                </td>
                                            </tr>
                                        </table>


                                    </div>
                                </div>





                                    @endforeach
                        @else
                                <div class="alert alert-info" style="position: relative;">
                            <span>لم تقم بالتقدم لأي وظيفة.</span>
                                </div>
                        @endif

                                </div>


                    </div>
                </div>
            </div>

        </div>

        <script language="javascript">


            function deleteItem(a) {
                var myButton = $('#req-'+a);
                if (confirm("هل أنت متأكد من إلغاء التقدم للوظيفة؟")) {
                    var token = '{{ Session::token() }}';
                    var data = {
                        '_token' : token,
                        '_method' : 'delete',
                    };
                    $.post('/profile/job-application/'+ a,(data))
                        .done(function( data )  {
                              if(data.check )
                                $('<div class="alert alert-success fixed"><span>تنبيه! </span>قد تم الغاء تقدمك للوظيفة بنجاح</div>').insertAfter('#req-'+a).delay(2000).fadeOut();

                            myButton.remove();
                        });
                     return true;
                } else {
                    return false;
                }
            }
        </script>
@stop