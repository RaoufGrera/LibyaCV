@extends('layouts.header')
@section('content')
    <script type="application/javascript">
        function Toggle(item) {
            objReq = document.getElementById(item);
            visible = (objReq.style.display != "none")
            if (visible) {
                objReq.style.display = "none";
            } else {
                objReq.style.display = "block";
            }
        }

    </script>
    <div class="container">
        <div class="row">
            @include('layouts.admins')
            <div class="col-md-9 ">
                <br>

                <h5 class="title-page"> لوحة التحكم - السير</h5>
                <br>
                <div class="cont contpost">
                    @if(session('error'))
                        <div class="alert alert-warning">
                            <a href="javascript:void(0);" class="close" data-dismiss="alert"
                               aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> {{  session('error') }}
                        </div>
                    @endif

                        <div class="col-lg-4">
                            <div class="info-box">
                                <span class="info-box-icon green"><i class="icon-eye icolor"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">المشاهدات</span>
                                    <span class="info-box-number"><?php echo count($allSeekers); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="info-box">
                                <span class="info-box-icon red"><i class="icon-eye icolor"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">المحظورين</span>
                                    <span class="info-box-number"><?php echo count($allSeekers); ?></span>
                                </div>
                            </div>
                        </div>

                <table class="table">
                    <thead>
                    <th>id</th>
                    <th>اسم</th>
                    <th>يوزر</th>
                    <th>بريد</th>
                    <th>هاتف</th>
                    <th>مفعل</th>
                    </thead>
                    <tbody>
                    @foreach($allSeekers as $seeker)
                        <tr>
                        <td>{{ $seeker->seeker_id }}</td>
                        <td>{{ $seeker->fname }} {{ $seeker->lname }}</td>
                        <td><a href="/administrator/seeker/{{ $seeker->user_name }}">{{ $seeker->user_name }}</a></td>
                        <td>{{ $seeker->email }}</td>
                        <td>{{ $seeker->phone }}</td>
                        <td>
                            @if($seeker->confirmed == 1)
                                <span>م</span>
                            @else
                                <span>غ</span>
                            @endif
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                        <?php



                        $pagination = "";
                        $page = (isset($_GET['page']) ? $_GET['page'] : 1);
                        $firstpage = 1;
                        $lastpage = $page_count;
                        $loopcounter = ((($page + 2) <= $lastpage) ? ($page + 2) : $lastpage);
                        $startCounter = ((($page - 2) >= 3) ? ($page - 2) : 1);
                        if ($page_count >= 1) {
                            $get_herf_page = '';
                            $pagination .= '<div class="pagen" >';
                            if ($startCounter >= 3) {
                                $pagination .= '<a  href="' . $_SERVER['PHP_SELF'] . '?page=1">1</a>';
                                $pagination .= " ... ";
                            }


                            for ($i = $startCounter; $i <= $loopcounter; $i++) {

                                if ($page == $i)
                                    $pagination .= '<a class="current">' . $page . '</a>';
                                else
                                    $pagination .= '<a href="/administrator/seeker?page=' . $i . '">' . $i . '</a>';
                            }
                            if ($page <= $lastpage - 3) {
                                $pagination .= " ... ";
                                $pagination .= '<a href="/administrator/seeker?page=' . $page_count . '">' . $page_count . '</a>';
                            }
                            $pagination .= '</div>';


                        }
                        echo $pagination;


                        ?>

                </div>
            </div>
        </div>
        <nav id="bottom" class="bottom">
            <table>
                <tr>
                    <td><span class="clicker t">إنتقل &#x25BE;&nbsp;</span>
                        <div class="subs">
                            <div class="wrp2">
                                <ul class="navul">
                                    <a href="#contact">معلومات الأتصال</a>
                                    <a href="#golas">الهدف الوظيفي</a>
                                    <a href="#education">المؤهل العلمي</a>
                                    <a href="#experience">الخبرة</a>
                                    <a href="#language">اللغات</a>
                                    <a href="#specialtys">التخصصات</a>
                                    <a href="#skills">المهارات</a>
                                    <a href="#certificate">الشهادات</a>
                                    <a href="#training">التدريب</a>
                                    <a href="#hobby">الهويات</a>
                                    <a href="#info">معلومات إضافية</a>
                                </ul>

                            </div>
                        </div>
                    </td>

                </tr>
            </table>
        </nav>
    </div>

    <script language="javascript">
        function deleteItem(a, b, c) {
            if (confirm("هل أنت متأكد من الحذف؟")) {
                var token = '{{ Session::token() }}';
                var data = {
                    '_token': token,
                    '_method': 'delete',
                };
                deleteRest(a, b, c, data);
                return true;
            } else {
                return false;
            }
        }
    </script>
@stop