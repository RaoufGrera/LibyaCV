@inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header')
@section('title', trans("page.download"))

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12 ">
                <br>
                <h5 class="title-page"> تحميل السيرة الذاتية</h5>
                <br>


                <div id="capture" style="padding: 10px; background: #f5da55">
                    <h4 onclick="p()" style="color: #000; ">Hello world!</h4>
                </div>
                    <h4>القوالب</h4>
                    <hr>

                <div class="col-md-12">

                    <div class="col-md-4 m10"><a class="btn btn-block btn-default" onclick="print()">
                            <h1>مثال على شكل الخط</h1>
                            <br><br><span>تحميل السيرة الذاتية</span></a>
                    </div>
                </div>



            </div>
            <div id="target">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque quis eleifend elit. Donec lectus sem, scelerisque sit amet facilisis quis, gravida a lacus. Nunc at lorem egestas, gravida lorem quis, pulvinar ante. Quisque id tempus libero. Mauris hendrerit nunc risus, ac laoreet lectus gravida et. Nam euismod magna ac enim posuere sagittis. Fusce at egestas enim, eu hendrerit enim.
            </div>

            <button onclick="takeScreenShot()">to image</button>

        </div>

    </div>

    <script language="javascript">
        window.takeScreenShot = function() {
            html2canvas(document.getElementById("target"), {
                onrendered: function (canvas) {
                    document.body.appendChild(canvas);
                },
                width:320,
                height:220
            });
        }
        function p(){
            var quality = 1;
            html2canvas(document.querySelector("#capture"),{scale: quality}).then(canvas => {

            let pdf = new jsPDF('p', 'mm', 'a4');

            pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, 211, 298);
            pdf.save("cCCC.pdf");
        });
        }
        function print() {
            const filename  = 'ThisIsYourPDFFilename.pdf';

            var r = new html2canvas();
            html2canvas(document.querySelector("#myprint")).then(canvas => {
                document.body.appendChild(canvas)
        });
            html2canvas(document.querySelector('#myprint')).then(canvas => {
                let pdf = new jsPDF('p', 'mm', 'a4');
            pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, 211, 298);
            pdf.save(filename);
        });
        }
        function deleteItem() {
            if (confirm("هل أنت متأكد من الحذف؟")) {
                return true;
            } else {
                return false;
            }
        }

        function PrintElem(elem) {


            var divElements = document.getElementById(elem).innerHTML;
            //Get the HTML of whole page
            //  var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.write('<html><head><title>' + document.title + '</title>');
            document.write('</head><body >');
            document.write(divElements);
            //Print Page
            document.write('</body></html>');

            window.print();
        }

    </script>
    <div id="myprint" class="container printthis">
<script type="text/javascript">
    window.onafterprint = function(){
        location.reload();}
</script>

        <div class="row">
            <div class="col-lg-12">

                <style type="text/css" media="print">
                    @font-face { font-family: "JF Flat";
                        src:  url('/css/font/jf.woff') format('woff'),
                        url('/css/font/jf.ttf') format('truetype');
                        font-weight: normal;
                        font-style: normal;
                    }
                    .printthis{
                        display: block !important;
                        opacity: 1 !important ;


                    }
                    @media print {
                        thead {display: table-header-group;}
                        #myprint{
                            margin: 0;
                        }


                        @font-face { font-family: "JF Flat";
                            src:  url('/css/font/jf.woff') format('woff'),
                            url('/css/font/jf.ttf') format('truetype');
                            font-weight: normal;
                            font-style: normal;
                        }

                    }
                    #myprint{



                    }


                    .notprint{
                        display: none;
                    }

                    @page:first
                    {

                        size: auto;


                        margin: 0 0 0 0 ;

                    }
                    @page
                    {

                        size: auto;

                        margin: 0 ;

                    }

                    /* print only */


                    #print-head {
                         height: 50px;
                        padding-top: 10mm;

                        border-bottom: 1px solid #000000;
                    }
                    body {
                      /*  min-height: 297mm;*/
                        margin: 10mm auto;
                        margin-top:0 ;
                        margin-bottom: 15mm;
                        padding: 0 15mm 15mm 15mm;
                        -webkit-print-color-adjust: exact;
                        direction: rtl;
                        line-height: 1.8em;
                        font-size: 16px;
                        font-family: "JF Flat";
                        overflow: auto;
                        float: none;
                        background-color: #fff;
                    }



                    #education{
                        border-right:4px solid #dd1144;
                    }
                    table td tr {
                        /*  border-bottom: 1px solid #ddd;
                           margin-bottom: 13px; */
                        line-height: 1.4;
                    }
                    .hr {

                        border-color: #BDBDBD;
                    }
                    .post {
                    }

                    .numb{
                        color: rgb(54, 54, 54);
                        font-size: 90%;
                        float: left;
                    }
                    .textb {
                        font-size: 90%;
                    }

                    .texts {
                        color: rgb(54, 54, 54);
                        font-size: 80%;

                    }

                    .infop {
                        color: rgb(54, 54, 54);
                        font-size: 75%;
                        /* vertical-align: middle;*/
                    }

                    .posttitle {

                        color: #464646 !important;
                        font-size: 100%;
                        padding-right: 4px;
                        line-height: 1.2;
                    }

                    .infocont {
                        vertical-align: top;
                        font-size: 16px;
                    }



                    .tdcontent{
                        padding-top: 10px;
                    }
                    table.first {

                    }
                    table.firstinfo {
                        border-top: 1px solid #eaeaea;
                    }
                    hr{
                        margin-top: 6px;
                        margin-bottom: 6px;
                    }
                    table.firstcont {
                        margin-top: 15px;
                        width: 100%;
                        border-collapse: separate;
                        border-spacing: 0px 14px;
                        /* padding: 8px; */
                        /* padding-bottom: 12px; */
                        border-top: 1px solid #d0d0d0;
                        /* margin: 8px; */
                    }

                    .imgseeker{
                        border: 1px solid #999;
                        max-height: 225px;
                        max-width: 200px;
                        padding: 2px;


                    }
                </style>

                <style>


                    @media print {
                        thead {display: table-header-group;}
                        #myprint{
                            margin: 0;
                        }


                        @font-face { font-family: "JF Flat";
                            src:  url('/css/font/jf.woff') format('woff'),
                            url('/css/font/jf.ttf') format('truetype');
                            font-weight: normal;
                            font-style: normal;
                        }

                    }

                    .printthis{
                       /* opacity: 0;*/
                        display: none;
                    }

                    table .top > span:first-child {
                        float: right;
                        border: 9px solid #569480;
                        border-left: 0;
                        border-right: 5px solid #569480;       }

                </style>
                <table width="100%" class="printthis">
                    <thead>
                    <tr>
                        <th>
                            <div id="print-head">
                                <table>
                                    <tr>
                                        <td rowspan="2" style="padding-left:10px; "> <img   width="40" height="40" src="{{asset('images/pdf/lcv2.png')}}" /></td>

                                        <td><span style="font-size: 20px;color:#13745d !important;"><?php echo $job_seeker->fname . " " . $job_seeker->lname; ?></span>
                                        </td>

                                    </tr>

                                </table>

                                <br>
                            </div>
                        </th>

                    </tr>
                    </thead>
                    <tbody>








                    <?php
                    $protocol  = empty($_SERVER['HTTPS']) ? 'http' : 'https';

                    $countAddress = strlen($job_seeker->address);
                    $sizes = ($countAddress * 6) + 90 ;

                    $countMail = strlen($job_seeker->email);
                    $sizeMali = ($countMail * 6) + 80 ;
                    $datereg = date("Y");
                    $age = $datereg - date("Y",strtotime($job_seeker->birth_day));

                    ?>


                    <tr><td></td></tr>
                    <tr>
                        <td width="100%">
                            <table>
                                <tr>


                                    <td style="width:110px;"><img   width="16" height="16" src="{{asset('images/pdf/flag.png')}}" />
                                        <span class="infop"><?php echo $job_seeker->nat_name; ?></span>
                                    </td>

                                    <td width=" <?php echo $sizes; ?> ">
                                        <img style="line-height:0.8;" width="16" height="16" src=" {{asset('images/pdf/map.png')}}" />
                                        <span class="infop">  <?php echo $job_seeker->city_name;  if ($job_seeker->address != "") {echo " - " . $job_seeker->address;}  ?></span>
                                    </td>
                                    <td style="width:120px;" height="15"><span class="infocont"><img width="16" height="16" src="{{asset('images/pdf/calendar.png')}}" /></span> <span class="infop"><?php echo $age . " سنة"; ?></span></td>
                                    <?php if($job_seeker->phone != ""){ ?>
                                    <td width="170" height="23"><span class="infocont"><img width="16" height="16" src="{{asset('images/pdf/smartphone.png')}}" /></span>
                                        <span class="infop"><?php echo $job_seeker->phone; ?></span>
                                    </td>
                                    <?php } ?>

                                    <td width="<?php echo $sizeMali; ?>"  ><span class="infocont"><img width="16" height="16" src="{{asset('images/pdf/mail.png')}}" /></span>
                                        <span class="infop"><?php echo $job_seeker->email; ?></span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>





                    <?php if (!empty($job_seeker->goal_text)) { ?>
                    <tr>
                        <td><hr></td>
                    </tr>
                    <tr>
                        <td class="top">
                            <span></span>

                            <div class="firstcont " > <span class="posttitle">الهدف الوظيفي</span> </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdcontent">
                            <span class="texts"><?php echo $job_seeker->goal_text ?></span>

                        </td>
                    </tr>
                    <?php } ?>

                    <?php if (count($seeker_ed) > 0) { ?>
                    <tr>
                        <td><hr></td>
                    </tr>
                    <tr>
                        <td class="top"><span></span><span class="posttitle">المؤهل العلمي</span></td>
                    </tr>




                    <?php
                    $toEnd = count($seeker_ed);
                    foreach ($seeker_ed as $row) { ?>
                    <tr>
                        <td colspan="2" height="1" ><span> </span></td>
                    </tr>
                    <tr>

                        <td width="530"><span class="textb"><?php echo $row->univ_name." ".$row->faculty_name; ?></span>

                            <span class="numb"><?php echo $row->start_date . " - " . $row->end_date; ?></span>
                        </td>

                    </tr>
                    <tr>
                        <td height="18">
<span class="texts"><?php $edt=  str_replace("/"," / ",$row->edt_name); echo $edt; if(!empty($row->sed_name)){echo  "، " . $row->sed_name;}
    if (!empty($row->avg)) {
        echo "، " . $row->avg;
    } ?></span>
                        </td>
                    </tr>
                    <?php   if (0 !== --$toEnd) { ?> <tr> <td><hr class="hrr"></td></tr> <?php } ?>

                    <?php } ?>   <?php
                    } ?>

                    <?php if (count($seeker_exp) > 0) { ?>
                    <tr>
                        <td><hr></td>
                    </tr>

                    <tr>
                        <td  class="top"  height="10">        <span></span>
                            <span class="posttitle">الخبرة</span></td>
                    </tr>

                    <?php
                    $toEnd = count($seeker_exp);
                    foreach ($seeker_exp as $row) { ?>
                    <tr>
                        <td  colspan="2" height="1" ><span> </span></td>
                    </tr>
                    <tr>
                        <td width="490" height="10"><span class="textb"><?php echo $row->exp_name; ?></span>
                            <span class="numb"><?php  echo date('Y-m', strtotime($row->start_date)) . " - "; if ($row->state == 0) {echo date('Y-m', strtotime($row->end_date));} else {echo "الى حد الأن";} ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td height="19">
                            <span class="texts"><?php echo "فى " . $row->compe_name; ?></span>
                        </td>
                    </tr>


                    <?php if (!(empty($row->exp_desc))) { ?>
                    <tr>
                        <td height="1"><span class="texts" style="
                                                     font-size:13px;"><?php echo nl2br($row->exp_desc); ?></span></td>
                    </tr>
                    <?php } ?>

                    <?php   if (0 !== --$toEnd) { ?>
                    <tr>

                        <td><hr></td></tr> <?php } ?>


                    <?php } ?>   <?php } ?>

                    <?php if (count($seeker_lang) > 0) { ?>

                    <tr>
                        <td><hr></td>
                    </tr>
                    <tr>
                        <td class="top"  height="10"><span></span><span class="posttitle">اللغات</span></td>
                    </tr>



                    <?php
                    $toEnd = count($seeker_lang);
                    $i = 0;
                    ?>
                    <tr>
                        <td   height="1" ></td>
                    </tr>
                    <tr>
                        <td  ><?php foreach ($seeker_lang as $row) {?>
                            <span class="textb"> <?php
                                echo  $row->lang_name; ?></span><span class="texts"><?php echo " (".$row->level_name.") "; ?> <?php
                                $i++;
                                if ($i < $toEnd) {
                                    echo " - ";
                                }?> </span> <?php
                            } ?></td>
                    </tr>

                    <?php } ?>

                    <?php $i = 0;
                    $cspec = count($seeker_spec);
                    if (count($seeker_spec) > 0) { ?>

                    <tr>
                        <td><hr></td>
                    </tr>
                    <tr><!--&nbsp;-->
                        <td class="top"  height="10"><span></span><span class="posttitle">التخصصات</span></td>
                    </tr>




                    <tr>
                        <td  height="1" ></td>
                    </tr>
                    <tr>
                        <td height="20"><span class="textb"><?php foreach ($seeker_spec as $row) {
                                    echo $row->spec_name;
                                    $i++;
                                    if ($i < $cspec) {
                                        echo " - ";
                                    }
                                } ?> </span></td>
                    </tr>

                    <?php } ?>

                    <?php
                    $toEndSkills = count($seeker_skills);

                    if (count($seeker_skills) > 0) { ?>


                    <tr>
                        <td><hr></td>
                    </tr>
                    <tr>
                        <td class="top"  height="10"><span></span><span class="posttitle">المهارات</span></td>
                    </tr>




                    <?php foreach ($seeker_skills as $row) { ?>
                    <tr>
                        <td  colspan="2" height="1" ><span> </span></td>
                    </tr>
                    <tr>
                        <td  colspan="2" height="20"><span class="textb"><?php echo $row->skills_name; ?></span><span class="texts"><?php echo " (".$row->level_name.") "; ?></span></td>
                    </tr>

                    <?php   if (0 !== --$toEndSkills) { ?>
                    <tr>

                        <td><hr></td>
                    </tr> <?php } ?>


                    <?php } ?>   <?php } ?>


                    <?php
                    $toEndCert = count($seeker_cert);

                    if (count($seeker_cert) > 0) { ?>

                    <tr>
                        <td><hr></td>
                    </tr>

                    <tr>
                        <td class="top"  height="10"><span></span><span class="posttitle">الشهادات</span></td>
                    </tr>




                    <?php foreach ($seeker_cert as $row) { ?>
                    <tr>
                        <td  colspan="2" height="1" ><span> </span></td>
                    </tr>
                    <tr>
                        <td width="590" height="20"><span class="textb"><?php echo $row->cert_name; ?></span>
                            <span class="numb"><?php echo $row->cert_date; ?></span></td>
                    </tr>

                    <?php   if (0 !== --$toEndCert) { ?> <tr><td width="6" height="1" style="line-height:0.1;"></td><td width="300" height="2" style="line-height:0.2; border-bottom: 1px solid #efefef;">&nbsp;&nbsp;<span></span></td></tr> <?php } ?>


                    <?php } ?>   <?php } ?>

                    <?php
                    $toEndTrain = count($seeker_train);

                    if (count($seeker_train) > 0) { ?>

                    <tr>
                        <td><hr></td>
                    </tr>

                    <tr>
                        <td class="top"  height="10"><span></span><span class="posttitle">التدريب والدورات</span></td>
                    </tr>




                    <?php foreach ($seeker_train as $row) { ?>
                    <tr>
                        <td  colspan="2" height="1" ><span> </span></td>
                    </tr>
                    <tr>
                        <td width="590" height="20"><span class="textb"><?php echo $row->train_name; ?></span>
                            <span class="numb"><?php echo $row->train_date; ?></span></td>
                    </tr>
                    <tr>
                        <td  colspan="2" ><span class="texts"><?php echo "الجهة: " . $row->train_comp; ?></span></td>
                    </tr>
                    <?php   if (0 !== --$toEndTrain) { ?><!-- <tr><td width="6" height="1" style="line-height:0.1;"></td>
                <td width="300" height="2" style="line-height:0.2; border-bottom: 1px solid #efefef;">&nbsp;&nbsp;<span></span></td></tr>--> <?php } ?>


                    <?php } ?>   <?php } ?>

                    <?php $i = 0;
                    $choby = count($seeker_hobby);
                    if (count($seeker_hobby) > 0) { ?>
                    <tr>
                        <td><hr></td>
                    </tr>

                    <tr>
                        <td class="top"  height="10"><span></span><span class="posttitle">الهوايات</span></td>
                    </tr>





                    <tr>
                        <td height="20"><span class="textb"><?php foreach ($seeker_hobby as $row) {
                                    echo $row->hobby_name;
                                    $i++;
                                    if ($i < $choby) {
                                        echo " - ";
                                    }
                                } ?> </span></td>
                    </tr>

                    <?php } ?>


                    <?php
                    $toEndInfo = count($seeker_info);
                    if (count($seeker_info) > 0) { ?>

                    <tr>
                        <td><hr></td>
                    </tr>
                    <tr>
                        <td class="top"  height="10"><span></span><span class="posttitle">معلومات اضافية</span></td>
                    </tr>

                    <?php foreach ($seeker_info as $row) { ?>
                    <tr>
                        <td colspan="2" height="1" ></td>
                    </tr>
                    <tr>
                        <td colspan="2" width="590" height="20"><span class="textb"><?php echo $row->info_name; ?></span> <span class="numb"><?php echo  $row->info_date; ?></span></td>
                    </tr>
                    <tr>
                        <td colspan="2" width="590" colspan="2"><span class="texts"><?php echo nl2br($row->info_text); ?></span></td>
                    </tr>
                    <?php   if (0 !== --$toEndInfo) { ?> <tr><td width="6" height="1" style="line-height:0.1;"></td><td width="300" height="2" style="line-height:0.2; border-bottom: 1px solid #efefef;">&nbsp;&nbsp;<span></span></td></tr> <?php } ?>

                    <?php } ?>   <?php } ?>




                    </tbody>
                </table>
            </div>
        </div>
    </div>


@stop