@inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header')
@section('title', trans("page.job-application"))

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.company')

            <div class="col-md-9 ">

                <br>
                <h5 class="title-page"> طلبات التوظيف</h5>
                <br>
                @if(session('error'))
                    <div class="alert alert-warning">


                        <strong>تنبيه!</strong> {{  session('error') }}
                    </div>
                @endif

                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>المسمي الوظيفي</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($myJob as $job)
                        <tr>
                            <td>
                                <div style="
    border-bottom: 1px solid #f5f5f5;
    padding-bottom: 3px;
    margin-bottom: 4px;
">
                                    <a href="/company-profile/{{$user}}/job-application/{{ $job->desc_id }}">{{ $job->job_name }}</a>
                                </div>
                                <div class="jobApp"><span>الناشر</span>
                                    <a href="/user/{{ $job->user_name }}"><span>{{ $job->fname }} {{ $job->lname }} </span></a></div>

                                <div class="jobApp"><span>عدد المشاهدات</span><span>{{ $job->see_it }}</span></div>

                                <div class="jobApp"><span>طلبات التوظيف </span><span> <a href="/company-profile/{{$user}}/job-application/{{ $job->desc_id }}">{{ $job->req_count }}</a></span></div>

                               </td>
                            <td>

                                <div style="
    border-bottom: 1px solid #f5f5f5;
    padding-bottom: 3px;
    margin-bottom: 4px;
">

                                <a class="btn btn-default btn-block" href="/company-profile/{{$user}}/job-application/{{ $job->desc_id }}">عرض طلبات التوظيف</a>

                                </div>

                                <div class="jobApp"><span>الحالة</span><span>
                                            @if($job->is_active == '0') نشط
                                        @else غير نشط
                                        @endif
                                        </span></div>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script language="javascript">
        function deleteItem() {
            if (confirm("هل أنت متأكد من الحذف؟")) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@stop
