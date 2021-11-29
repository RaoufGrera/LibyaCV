<div class="col-md-3">

    <ul class="nav nav-list">

        <li><span class="menus "><strong>المادافكر</strong></span>
        </li>


         <li><a class="side-title" href="/administrator/dashboard"></i> {{ Auth::guard('admins')->user()->user_name }}</a></li>

        <li><a href="/administrator/dashboard" class="icon-connectdevelop">لوحة الأعدادات</a></li>
        <li><a href="/administrator/seeker" class="icon-list-alt"> السيرة الذاتية</a></li>
        @if(basename($_SERVER['REQUEST_URI']) == 'profile')
        <ul class="listcv"><li><a href="#contact" class="icon-share">معلومات الأتصال</a></li><li><a href="#golas" class="icon-award">الهدف الوظيفي</a></li><li><a href="#education" class="icon-graduation-cap">المؤهل العلمي</a></li><li><a href="#experience" class="icon-briefcase">الخبرة</a></li><li><a href="#language" class="icon-globe">اللغات</a></li><li><a href="#specialtys" class="icon-sitemap">التخصصات</a></li><li><a href="#skills" class="icon-tasks">المهارات</a></li><li><a href="#certificate" class="icon-newspaper">الشهادات</a></li><li><a href="#training" class="icon-vcard">التدريب والدورات</a></li><li><a href="#hobby" class="icon-brush">الهوايات</a></li><li><a href="#reference" class="icon-bookmark">المعرفون</a></li><li><a href="#info" class="icon-street-view">معلومات إضافية</a></li></ul>
        @endif
        <li>
            <a href="/administrator/shop" class="icon-users-1">طلبات الشراء</a>
        </li>

        <li>
            <a href="/administrator/redis" class="icon-paper-plane">  طلبات التوظيف</a>
        </li>

        <li>
            <a href="/administrator/exam" class="icon-eye"> إدارة الأختبارات</a>
        </li>
        <li>
            <a href="/profile/settings" class="icon-cog-2">أعدادات الحساب</a>
        </li>
        <li><span class="menus comp "><strong>الشركة</strong></span>
        </li>

    </ul>

</div>