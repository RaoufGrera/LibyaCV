 @inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header')
@section('content')
 <script type="application/javascript" >
function Toggle(item) {
   objReq=document.getElementById(item);
   visible=(objReq.style.display!="none")
   if (visible) {
     objReq.style.display="none";
   } else {
      objReq.style.display="block";
   }
}
</script>
        <div class="container">
            <div class="row">
                <div class="col-md-3 ">  
                     
                    <ul class="nav nav-list   ">
					
						<li><span class="menus  "><strong>القائمة الرئيسية</strong></span>
						</li>
                        <li class="active" > <a href="dashboard.php"></i>لوحة التحكم</a> </li>
                        <li class="active" > <a href="profile.php"></i>السيرة الذاتية</a> </li>

				
						<li>
								<a href="seekerreq.php"> طلبات التوظيف</a>
							</li>
							<li>
							<a href="seekersave.php">الوظائف المحفوظة</a>
							</li>
						<li >
                            <a href="settings.php">أعدادات الحساب</a>
                        </li>
                    </ul>
                   
                </div>
         
                <div class="col-md-9 "> <div class="cont"> 
                           <div class="list">  
                               					<?php 
						$filename="../images/seeker/";
						if($job_seeker->image !=""){
						$filename = '../../public/images/seeker/'.$job_seeker->image; }
						?>
								<img class="imgseeker"  src=<?php if($job_seeker->image !=""){echo $filename;}else {echo "../../images/test.jpg";}?> >  </img>
	
             <br>
            <table>
            <tr>
               
                     <td colspan="2" >
             <span ><a id="cvname" href="/user/{{ $job_seeker->user_name }}">{{$job_seeker->fname}} {{$job_seeker->lname}}  </a></span><br>
                </td>
                </tr>
                <tr>
                <td>
<label>الجنسية: </label>
                </td>
                    <td>
<span> {{$job_seeker->nat_name}}</span>
                </td>
                </tr>
                    <tr>
                    <td>
                    
<label>العنوان:</label>                </td>
                    <td>
 <span> {{$job_seeker->city_name}}
                        @if($job_seeker->address != "")
                        - {{$job_seeker->address}}
                        @endif
                        </span>
                </td>
                    </tr>
                <tr>
                <td>
<label>العمر:</label>
                </td>
                    <td>
<span><?php $datereg=date("Y"); $age =  $datereg - $job_seeker->birth_day  ; echo $age." سنة"; ?></span>
                </td>
                </tr>
                <tr>
                <td>
                <label>البريد:</label>
                </td>
                <td>
                <span> {{$job_seeker->email}}</span>
                </td>
                </tr>
                <tr>
                <td>
                <label>الهاتف:</label>
                </td>
                <td>
                <span>{{$job_seeker->phone}}</span>
                </td>
                </tr>
            </table>
 
        </div>
                  
 
                    <div>
                        @if(!empty($job_seeker->goal_text))
                         <div  class="post">
                    الهدف الوظيفي 
                        </div>
                        <div class="contpost">
                        <span>{{$job_seeker->goal_text}}</span>
                            </div>
                        <br>
                        <br>
                        @endif
                        @if (count($seeker_ed) > 0)
                        	<div class="post">
	                       المؤهل العلمي
                        </div>
                        <div class="contpost">
                            
	

 
  
                            @foreach($seeker_ed as $row)

                            <b><span>{{$row->univ}} </span></b>
                          <br>
                            <span class='texts '>{{$row->edt_name}} ,  {{$row->specialty}}
                            @if(!empty($row->avg))
                                ,{{$row->avg}}
                            @endif
                                <br>
                                {{$row->start_date}} - {{$row->end_date}}
                           
                            <br>
                            المجال {{$row->domain_name}}
                            </span>
                            <br>
                            <a class="facebox" href="{{$id}}/added"><img src="../../public/images/edit.png" alt="تعديل"/> تعديل</a>
	<a class="facebox" href="modal_delete_goal.php"><img src="../../public/images/remove.png"/> حذف</a>
                            <br><br>
  
                            @endforeach

                        </div>
                        @endif
                        @if (count($seeker_exp) > 0)
                        	<div class="post">
	                       الخبرة
                        </div>
                        <div class="contpost">
                            @foreach($seeker_exp as $row)
                            <b><span>{{$row->exp_name}}</span></b>
                            <br>
                            <span class='texts '>في {{$row->exp_comp}} 
                                <br>
                                    {{ date('Y-m',strtotime($row->start_date)) }} -
                                @if($row->state ==0)
                                	{{ date('Y-m',strtotime($row->end_date)) }}
                                @else
                                الي حد الأن
                                @endif
                                <br>
                                 مجال الشركة {{$row->domain_name}}
                                <br>
                                {!! nl2br(e($row->exp_desc)) !!}
                            </span>
                                
                            
                            <br><br>
                            @endforeach
                            </div>
                        @endif
                        @if (count($seeker_lang) > 0)
                        	<div class="post">
	                       اللغات
                        </div>
                        <div class="contpost">
                            @foreach($seeker_lang as $row)
                            <b><span> {{ $row->lang_name }} </span></b><br>
                            <span class="texts"> المستوي: {{ $row->level_name }}</span><br><br>
                            @endforeach
                            </div>
                         @endif
                        </div>
                    <span><a class="facebox" href="{{$id}}/modal">facebox</a></span>
                    <br>
                     <span><a href='javascript:Toggle("ed")' > أظهار</a></span>
                    <div id="ed">
                       
                       {!! Form::open(array( 'id'=>'add')) !!}
                    {!! Form::text('title','',array('class'=>'form-control','id'=>'title')) !!}
                        <br>
                    {!! Form::button('Send',array('class'=>'btn btn-success','id'=>'send')) !!}
                    {!! Form::close() !!}
                    </div>
                    <table class="table">
                        <tr>
                            <th>الأسم</th>
                            <th>الجد</th>
                            <th>الميلاد</th>
                            <th>الجنسية</th>

                        </tr>
                        
                        <tr>
                        <td>{{  $job_seeker->fname }} </td>
                        <td>{{ $job_seeker->lname }} </td>
                        <td>{{ $job_seeker->birth_day }} </td>
                        <td>{{ $job_seeker->nat_name }} </td>
                            
                        </tr>
                        
                        

                    </table>
               
           
            </div>
                </div>   
            </div>
        
        </div>
@stop