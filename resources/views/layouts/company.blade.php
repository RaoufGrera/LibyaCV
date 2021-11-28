<div class="col-lg-3">
    <ul class="nav nav-list">
<br>
        <li><span class="side-title ">الباحث عن عمل</span></li>

        <li><a href="/profile/dashboard" class="icon-home"></i> {{ trans("page.dashboard") }} </a></li>
         <li><span class="side-title ">
                 شركـة @if(session('user_name_company') != "" )
                    {{ session('user_name_company') }}
                    @endif
</span>

        </li>

        <li><a href="/company-profile/{{ session('user_name_company') }}/" class="  icon-doc-text"> بيانات الشركة </a></li>
        <li  ><a href="/company-profile/{{ session('user_name_company') }}/job/create" class="icon-plus"> أعلن عن وظيفة </a></li>

        <li><a href="/company-profile/{{ session('user_name_company') }}/job/" class=" icon-briefcase"> إدارة الوظائف </a></li>
        <li><a href="/company-profile/{{ session('user_name_company') }}/job-application" class=" icon-braille"> طلبات التوظيف </a></li>

     </ul>

</div>