
    <style type="text/css" media="print">

.printthis{
    display: block !important;
}
        @media print {
            thead {display: table-header-group;}
        }
        .notprint{
            display: none;
        }
        @page
        {

            size: auto;   /* auto is the initial value */
            margin: 5mm;  /* this affects the margin in the printer settings */

        }


        /* print only */


        #print-head {
            height: 60px;


            border-bottom: 1px solid #000000;
        }


.printthis{
    opacity: 1 !important ;
}

        body {
            margin: 15mm;
            margin-top: 0;
            margin-bottom: 30mm;
            -webkit-print-color-adjust: exact;
            direction: rtl;
            line-height: 1.8em;
            font-size: 16px;
            font-family: "droid arabic naskh";
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
            line-height: 1.8;
        }
        .hr {

            border-color: #BDBDBD;
        }
        .post {
        }

.numb{
    color: rgb(54, 54, 54);
    font-size: 100%;
    float: left;
}
.textb {
    font-size: 100%;
}

.texts {
    color: rgb(54, 54, 54);
    font-size: 90%;

}

        .infop {
            color: rgb(54, 54, 54);
            font-size: 85%;
            /* vertical-align: middle;*/
        }

        .posttitle {

            color: #464646 !important;
            font-size: 110%;
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
        .printthis{
            opacity: 1;
        }
        #print-head {
            height: 60px;


            border-bottom: 1px solid #000000;
        }


        table td tr {
            /*  border-bottom: 1px solid #ddd;
               margin-bottom: 13px; */
            line-height: 1.8;
        }
        .hr {

            border-color: #BDBDBD;
        }
        .post {
        }

        .numb{
            color: rgb(54, 54, 54);
            font-size: 100%;
            float: left;
        }
        .textb {
            font-size: 100%;
        }

        .texts {
            color: rgb(54, 54, 54);
            font-size: 90%;

        }

        .infop {
            color: rgb(54, 54, 54);
            font-size: 85%;
           /* vertical-align: middle;*/
        }

        .posttitle {

            color: #464646 !important;
            font-size: 110%;
            padding-right: 4px;

            line-height: 1.2;
        }

        .hrr{
            display: inline-block;
            width: 80%;

        }
        .infocont {
            vertical-align: top;
            /*font-size: 16px;*/
        }
        table .top > span:first-child {
            float: right;
            border: 10px solid #fff;
            border-left: 0;
            border-right: 7px solid #569480;        }
        table .top > span:last-child {
            padding-left:8px;
        }
        .tdcontent{
            padding-top: 10px;
        }
        table.first {

        }
        table.firstinfo {
            border-top: 1px solid #eaeaea;
        }
        @media print{
            .printthis{
                display: block !important;
            }
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
<div class="container">
    <div class="row">

        <div class="col-md-12 ">
            <a href="javascript:print()" class="notprint">طباعة</a>
            <button class="print notprint">طباعة </button>

            <table width="100%" class="printthis">
                <thead>
                <tr>
                    <th>
            <div id="print-head">
                <table>
                    <tr>
                        <td rowspan="2" style="padding-left:10px; "> <img   width="40" height="40" src="{{asset('images/pdf/lcv2.png')}}" /></td>

                        <td><span style="font-size: 14px;color: #464646 !important;">{{ $job_seeker->fname . " ".$job_seeker->lname }}</span></td>

                    </tr>
                    <tr>

                        <td><span style="color: #777 !important; font-size: 90%;">www.libyacv.dev/user/{{ $job_seeker->user_name }}</span></td>
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


    <tr>

        <td height="60" colspan="8"><span
                style="font-size: 20px;color:#13745d !important;"><?php echo $job_seeker->fname . " " . $job_seeker->lname; ?></span>
        </td>
    </tr>
    <tr>
        <td width="100%"
>
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

<td colspan="2" height="10" ><span> </span></td>



        <?php
        $toEnd = count($seeker_ed);
        foreach ($seeker_ed as $row) { ?>
            <tr>
                <td colspan="2" height="1" ><span> </span></td>
            </tr>
            <tr>

                <td width="530"><span class="textb"><?php echo $row->univ_name." ".$row->faculty_name; ?></span>

                    <span class="numb"><?php echo $row->end_date . " - " . $row->start_date; ?></span>
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
                 <span class="numb"><?php if ($row->state == 0) {echo date('Y-m', strtotime($row->end_date));} else {echo "الي حد الأن";}  echo  " - ".date('Y-m', strtotime($row->start_date)); ?></span>
               </td>
            </tr>
            <tr>
                <td height="19">
                    <span class="texts"><?php echo "في " . $row->compe_name; ?></span>
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
            <td class="top"  height="10">        <span></span>
                <span class="posttitle">اللغات</span></td>
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
        <tr>
            <td class="top"  height="10">&nbsp;        <span></span>
                <span class="posttitle">التخصصات</span></td>
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
            <td class="top"  height="10">&nbsp;        <span></span>
                <span class="posttitle">المهارات</span></td>
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
            <td class="top"  height="10">        <span></span>
                 <span class="posttitle">الشهادات</span></td>
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
            <td class="top"  height="10">        <span></span>
                <span class="posttitle">التدريب والدورات</span></td>
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
            <td class="top"  height="10">        <span></span>
                <span class="posttitle">الهوايات</span></td>
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
            <td class="top"  height="10">        <span></span>
                <span class="posttitle">معلومات اضافية</span></td>
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

