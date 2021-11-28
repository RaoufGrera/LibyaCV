 @inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header')
 @section('title', trans("page.manage-users"))

 @section('content')
    <div class="container"  >
        <div class="row">

            @include('layouts.company')

            <div class="col-lg-9 ">
                <br>
                <h5 class="title-page"> الشركة</h5>
                <br>
                <img id="loading" src="/images/loading.gif" style="display: none">

                <div class="cont">
                    @if(session('error'))
                        <div class="alert alert-warning">
                            <a href="javascript:void(0);" class="close" data-dismiss="alert"
                               aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> {{  session('error') }}
                        </div>
                    @endif

                        <div class="alert alert-warning" style="position: relative">


                            <strong>تنبيه!</strong> عند اضافة موظف جديد يطلب اعادة تسجيل الدخول لذلك المستخدم حتي يتم تحديث بيانته بشكل صحيح.
                        </div>
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th>الموظف</th>
                                <th>التحكم</th>
                            </tr>
                            </thead>
                            <tbody>
                    @foreach($allUsers as $item)

                        <tr>
                            <td>{{ $item->fname.' '.$item->lname }}</td>
                            <td>
                                @if($item->level !="a")
                                {!! Form::open(['action' =>array('Company\CompanyController@destroyUser',$user,$item->seeker_id),"method"=>"DELETE"]) !!}
                                    <a class="pointer" onclick="ShowEditModalRESTfulCompany('users','{{ $user }}','{{ $item->manager_id }}');">تعديل</a>

                                @endif
                                    @if($item->level !="a")

                                    {!! Form::submit("حذف ",(["onclick"=>"return deleteItem()","class"=>" btn-link delete-cv"])) !!}
                                {!! Form::close() !!}
                                    @endif

                            </td>
                        </tr>
                    @endforeach
                            </tbody>
                        </table>
                         <a class="pointer" onclick="ShowEditModalRESTfulCompany('users','{{ $user }}');">+أضافة</a>

                        <script language="javascript">
                            function deleteItem() {
                                if (confirm("هل أنت متأكد من الحذف؟")) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                        </script>
            </div>
        </div>
    </div>
    </div>
@stop