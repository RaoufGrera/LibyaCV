@inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header')
@section('title', trans("page.my-job"))

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.seeker')
            <div class="col-md-9 ">

                <br>
                <h5 class="title-page">إدارة الوظائف</h5>
                <br>
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- bannerTextPicNormal -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-9929016091047307"
                     data-ad-slot="3134149901"
                     data-ad-format="auto"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
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
                    <td>{{ $job->job_name }}</td>
                    <td>
                        {!! Form::open(['action' =>array('Company\PostJobController@destroy',$user,$job->desc_id),"method"=>"DELETE"]) !!}

                        <a href="/company-profile/{{ $user }}/job/{{ $job->desc_id }}/edit">تعديل</a>
                        {!! Form::submit("حذف ",(["onclick"=>"return deleteItem()","class"=>" btn-link delete-cv"])) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
                </tbody>
                </table>
                <a href="/company-profile/{{ $user }}/job/create">إضافة</a>
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