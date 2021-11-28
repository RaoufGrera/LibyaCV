<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />

    <style>
        table td tr {
            border: #000 solid 1px;
        }
        .hr {

            border-color: #BDBDBD;
        }
        .post {
        }

        .textb {
            font-size: 16px;
        }

        .texts {
            color: rgb(54, 54, 54);
            font-size: 14px;

        }

        .infop {
            color: rgb(54, 54, 54);
            font-size: 14px;

        }

        .posttitle {

            color: #464646;
            font-size: 18px;
        }

        .infocont {
            vertical-align: middle;
            font-size: 14px;
        }
        table .top {
            border-right: 3px solid #b40e09;

        }
        table.first {

        }
        table.firstinfo {
            border-top: 1px solid #eaeaea;
        }
        table.firstcont {
            border-top: 1px solid #eaeaea;
        }

        .imgseeker{
            border: 1px solid #999;
            max-height: 225px;
            max-width: 200px;
            padding: 2px;


        }
    </style>
</head>
<body>

<?php
$protocol  = empty($_SERVER['HTTPS']) ? 'http' : 'https';

$datereg = date("Y");
$age = $datereg - $job_seeker->birth_day; ?>

<table style="border-spacing:0;">
    <tr>
        <?php if($job_seeker->image !=""){ ?>

        <td style="" rowspan="6"><span style="line-height:16.8;display: block"></span><img class="imgseeker" height="160" width="160"
                                             src="<?php if($job_seeker->image !=""){echo $protocol."://".$_SERVER['SERVER_NAME'].'/images/seeker/'.$job_seeker->image;} else { echo  $protocol."://".$_SERVER['SERVER_NAME'].'/images/test.jpg';} ?>" /></td>
        <?php } ?>
        <td height="50" colspan="2"><span
                style="font-size: 26px;color:#b40e09;"><?php echo $job_seeker->fname . " " . $job_seeker->lname; ?></span>
        </td>
    </tr>
    <tr>
        <td style="width:80px;" height="23"><span class="infocont">الجنسية: </span></td><td height="23"><span class="infop"><?php echo $job_seeker->nat_name; ?></span></td>
    </tr>
    <tr>
        <td height="23"><span class="infocont">العنوان: </span></td>
        <td height="23"><span class="infop"><?php echo $job_seeker->city_name;
                if ($job_seeker->address != "") {
                    echo " - " . $job_seeker->address;
                } ?></span>
        </td>
    </tr>
    <tr>
        <td height="23"><span class="infocont">العمر:</span></td><td height="15"><span class="infop"><?php echo $age . " سنة"; ?></span></td>
    </tr>
    <tr>
        <td height="23"><span class="infocont">الهاتف:</span></td>
        <td height="23"><span class="infop"><?php echo $job_seeker->phone; ?></span>
        </td>
    </tr>
    <tr>
        <td height="26"><span class="infocont">البريد:</span></td>
        <td height="26"><span class="infop"><?php echo $job_seeker->email; ?></span>
        </td>
    </tr>

</table>

<?php if (!empty($job_seeker->goal_text)) { ?>
    <table class="firstcont" style="border-spacing:0"><tr><td height="25"><span class="posttitle">الهدف الوظيفي</span></td></tr></table>

    <table class="first" style="border-spacing:0">
        <tr>
            <td height="1" style="line-height:0.6;"></td>
        </tr>
        <tr>

            <td><span class="texts"><?php echo $job_seeker->goal_text ?></span></td>
        </tr>
    </table>
<?php } ?>

<?php if (count($seeker_ed) > 0) { ?>
    <table  style="border-spacing:0" class="firstcont"><tr><td height="1" style="line-height:0.6;"><span> </span></td>
        </tr>
        <tr>
            <td  class="top" style="line-height:0.7;" height="10">&nbsp;<span class="posttitle">المؤهل العلمي</span></td>
        </tr>
    </table>
<br>
     <table  class="first" style="border-spacing:0">
        <?php
        $toEnd = count($seeker_ed);
        foreach ($seeker_ed as $row) { ?>
            <tr>
                <td colspan="2" height="1" style="line-height:0.6;"><span> </span></td>
            </tr>
            <tr>
                <td width="4"></td><td width="530" height="10"><span class="textb"><?php echo $row->univ_name." ".$row->faculty_name; ?></span></td><td height="8"><span class="textb"><?php echo $row->start_date . " - " . $row->end_date; ?></span></td>
            </tr>
            <tr>
                <td width="4"></td><td height="18">
<span class="texts"><?php $edt=  str_replace("/"," / ",$row->edt_name); echo $edt; if(!empty($row->sed_name)){echo  "، " . $row->sed_name;}
    if (!empty($row->avg)) {
        echo "، " . $row->avg;
    } ?></span>
                </td>
            </tr>
<?php   if (0 !== --$toEnd) { ?> <tr><td width="6" height="1" style="line-height:0.1;"></td><td width="300" height="2" style="line-height:0.2; border-bottom: 1px solid #efefef;">&nbsp;&nbsp;<span></span></td></tr> <?php } ?>

        <?php } ?></table>  <?php
} ?>

<?php if (count($seeker_exp) > 0) { ?>
    <table class="firstcont" style="border-spacing:0">
        <tr>
            <td height="1" style="line-height:0.6;"><span> </span></td>
        </tr>
        <tr>
            <td  class="top" style="line-height:0.7;" height="10">&nbsp;<span class="posttitle">الخبرة</span></td>
        </tr>
    </table>
    <table class="first" style="border-spacing:0">
        <?php
        $toEnd = count($seeker_exp);
        foreach ($seeker_exp as $row) { ?>
            <tr>
                <td  colspan="2" height="1" style="line-height:0.6;"><span> </span></td>
            </tr>
            <tr>
                <td width="4"></td><td width="490" height="10"><span class="textb"><?php echo $row->exp_name; ?></span></td><td height="8"><span class="textb"><?php echo date('Y-m', strtotime($row->start_date)) . " - "; if ($row->state == 0) {echo date('Y-m', strtotime($row->end_date));} else {echo "الي حد الأن";} ?></span></td>
            </tr>
            <tr>
                <td width="4"></td><td height="19">
                    <span class="texts"><?php echo "في " . $row->compe_name; ?></span>
                </td>
            </tr>


            <?php if (!(empty($row->exp_desc))) { ?>
                <tr>
                    <td width="4"></td><td height="1"><span style="
                                                     font-size:13px;"><?php echo nl2br($row->exp_desc); ?></span></td>
                </tr>
            <?php } ?>

            <?php   if (0 !== --$toEnd) { ?> <tr><td width="6" height="1" style="line-height:0.1;"></td><td width="300" height="2" style="line-height:0.2; border-bottom: 1px solid #efefef;">&nbsp;&nbsp;<span></span></td></tr> <?php } ?>


        <?php } ?> </table> <?php } ?>

<?php if (count($seeker_lang) > 0) { ?>
    <table class="firstcont" style="border-spacing:0">
        <tr>
            <td height="1" style="line-height:0.6;"><span> </span></td>
        </tr>
        <tr>
            <td class="top" style="line-height:0.7;" height="10">&nbsp;<span class="posttitle">اللغات</span></td>
        </tr>
    </table>

    <table class="first" style="border-spacing:0">
        <?php
        $toEnd = count($seeker_lang);
        foreach ($seeker_lang as $row) { ?>
            <tr>
                <td colspan="2" height="1" style="line-height:0.6;"></td>
            </tr>
            <tr>
                <td colspan="2"><span class="textb"><?php echo $row->lang_name; ?></span></td>
            </tr>
            <tr>
                <td colspan="2"><span class="texts"><?php echo "المستوي: " . $row->level_name; ?></span></td>
            </tr>
            <?php   if (0 !== --$toEnd) { ?> <tr><td width="6" height="1" style="line-height:0.1;"></td><td width="300" height="2" style="line-height:0.2; border-bottom: 1px solid #efefef;">&nbsp;&nbsp;<span></span></td></tr> <?php } ?>


        <?php } ?> </table> <?php } ?>



<?php if (count($seeker_skills) > 0) { ?>

    <table class="firstcont" style="border-spacing:0">
        <tr>
            <td  height="1" style="line-height:0.6;"><span> </span></td>
        </tr>
        <tr>
            <td class="top" style="line-height:0.7;" height="10">&nbsp;<span class="posttitle">المهارات</span></td>
        </tr>
    </table>


    <table class="first" style="border-spacing:0">
        <?php foreach ($seeker_skills as $row) { ?>
            <tr>
                <td colspan="2" height="1" style="line-height:0.6;"></td>
            </tr>
            <tr>
                <td height="20"><span class="textb"><?php echo $row->skills_name; ?></span></td>
            </tr>
            <tr>
                <td><span class="texts"><?php echo "المستوي: " . $row->level_name; ?></span></td>
            </tr>
        <?php } ?> </table> <?php } ?>

<?php $i = 0;
$choby = count($seeker_hobby);
if (count($seeker_hobby) > 0) { ?>
    <table class="firstcont" style="border-spacing:0">
        <tr>
            <td  height="1" style="line-height:0.6;"><span> </span></td>
        </tr>
        <tr>
            <td class="top" style="line-height:0.7;" height="10">&nbsp;<span class="posttitle">الهوايات</span></td>
        </tr>
    </table>


    <table class="first" style="border-spacing:0">
        <tr>
            <td  height="1" style="line-height:0.6;"></td>
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
    </table>
<?php } ?>


<?php if (count($seeker_info) > 0) { ?>
    <table class="firstcont" style="border-spacing:0">
        <tr>
            <td  height="1" style="line-height:0.6;"><span> </span></td>
        </tr>
        <tr>
            <td class="top" style="line-height:0.7;" height="10">&nbsp;<span class="posttitle">معلومات اضافية</span></td>
        </tr>
    </table>
    <table class="first" style="border-spacing:0">
        <?php foreach ($seeker_info as $row) { ?>
            <tr>
                <td height="1" style="line-height:0.6;"></td>
            </tr>
            <tr>
                <td width="590" height="20"><span class="textb"><?php echo $row->info_name; ?></span></td> <td><span class="texts"><?php echo  $row->info_date; ?></span></td>
            </tr>
            <tr>
                <td  width="100%" colspan="2"><span class="texts"><?php echo nl2br($row->info_text); ?></span></td>
            </tr>
        <?php } ?> </table> <?php } ?>

