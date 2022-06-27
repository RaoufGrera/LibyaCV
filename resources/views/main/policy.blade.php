@inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header')
@section('title',trans("page.policy"))
@section('keywords',trans("desc.keywords"))
@section('image',asset('images/logo/logofb.jpg'))
@section('url',trans('desc.url'))
@section('description',trans('desc.description'))
@section('content')

    <div class="container">
        <div class="row">
        <div class="col-md-12 ">
                <br>
                <h5 class="title-page"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">privacy policy</font></font></h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
              
                   
                    The data inside the system. Visitors can view all vacancies and resumes that have been approved to appear by the user to the general visitors.
                   </font></font><li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">The user can control the appearance of his resume and its hiding from the search results and from display within the system</font></font></li>
           
                   <h5 class="title-page"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Register with Facebook</font></font></h5>
                   <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">We will collect the following data:
                   </font></font></li>
                    <ul>
                      
                <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Name: name</font></font></li>
                <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Email: email</font></font></li>
             
        </ul>
        <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
            We add your "e-mail" and  "your name on Facebook" to your personal account in the application and your CV 
          </font></font></li>
                   <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">You can delete this data, and all the data you enter into the system yourself through the service to permanently delete the account from the application</font></font></li>


                   <h5 class="title-page"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Permanently delete the account from the system</font></font></h5>

                   <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">When logging in, from the drop-down list of the account icon on the right of the application, choose Settings</font></font></li>
                   <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">The settings screen will open and you can click on the delete account button to delete all the Facebook data that has been collected, which is the name and email, as well as all the data you entered for your CV will be deleted and your account will be completely deleted from the application</font></font></li>
                 
   


                 </div>
        </div>

    </div>
@stop