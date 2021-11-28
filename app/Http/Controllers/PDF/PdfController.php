<?php

namespace App\Http\Controllers\PDF;

//use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;

use Illuminate\Http\Request;
use DB;
use Auth;
use TCPDF;
use App\Helpers;
use Redis;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PdfController extends Controller
{
    public function showPdf(){


        $html= "<html><head><meta charset='utf-8'></head><body>عبد</body></html>";
       return PDF::loadHTML("
       <div id='myprint' class='container printthis'>
 

        <div class='row'>
            <div class='col-lg-12'>

                <style type='text/css' media='print'>
                    @font-face { font-family: 'JF Flat';
                          font-weight: normal;
                        font-style: normal;
                    }
                    .printthis{
                        display: block !important;
                        opacity: 1 !important ;


                    }
                    @media  print {
                        thead {display: table-header-group;}
                        #myprint{
                            margin: 0;
                        }


                        @font-face { font-family: 'JF Flat';
                              font-weight: normal;
                            font-style: normal;
                        }

                    }
                    #myprint{



                    }


                    .notprint{
                        display: block;
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
                        font-family: 'JF Flat';
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


                    @media  print {
                        thead {display: table-header-group;}
                        #myprint{
                            margin: 0;
                        }


                        @font-face { font-family: 'JF Flat';
                            font-weight: normal;
                            font-style: normal;
                        }

                    }

                    .printthis{
                       /* opacity: 0;*/
                        display: block;
                    }

                    table .top > span:first-child {
                        float: right;
                        border: 9px solid #569480;
                        border-left: 0;
                        border-right: 5px solid #569480;       }

                </style>
                <table width='100%' class='printthis'>
                    <thead>
                    <tr>
                        <th>
                            <div id='print-head'>
                                <table>
                                    <tbody><tr>
                                        <td rowspan='2' style='padding-left:10px; '> <img width='40' height='40' src='https://www.libyacv.com/images/pdf/lcv2.png'></td>

                                        <td><span style='font-size: 20px;color:#13745d !important;'>&#8235;عبدالرؤوف </span>
                                        </td>

                                    </tr>

                                </tbody></table>

                                <br>
                            </div>
                        </th>

                    </tr>
                    </thead>
                    <tbody>








                    

                    <tr><td></td></tr>
                    <tr>
                        <td width='100%'>
                            <table>
                                <tbody><tr>


                                    <td style='width:110px;'><img width='16' height='16' src='https://www.libyacv.com/images/pdf/flag.png'>
                                        <span class='infop'>ليبيا</span>
                                    </td>

                                    <td width=' 90 '>
                                        <img style='line-height:0.8;' width='16' height='16' src=' https://www.libyacv.com/images/pdf/map.png'>
                                        <span class='infop'>  طرابلس</span>
                                    </td>
                                    <td style='width:120px;' height='15'><span class='infocont'><img width='16' height='16' src='https://www.libyacv.com/images/pdf/calendar.png'></span> <span class='infop'>29 سنة</span></td>
                                    
                                    <td width='212'><span class='infocont'><img width='16' height='16' src='https://www.libyacv.com/images/pdf/mail.png'></span>
                                        <span class='infop'>laralibyajob@gmail.com</span>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>





                    
                                        <tr>
                        <td><hr></td>
                    </tr>
                    <tr>
                        <td class='top'><span></span><span class='posttitle'>المؤهل العلمي</span></td>
                    </tr>




                                        <tr>
                        <td colspan='2' height='1'><span> </span></td>
                    </tr>
                    <tr>

                        <td width='530'><span class='textb'>جامعة العلمين كلية الاقتصاد</span>

                            <span class='numb'>2004 - 2013</span>
                        </td>

                    </tr>
                    <tr>
                        <td height='18'>
<span class='texts'>بكالوريوس</span>
                        </td>
                    </tr>
                    
                       
                    
                    
                    
                    

                    
                    
                    

                    



                    </tbody>
                </table>
            </div>
        </div>
    </div>
       ")->setPaper('a4', 'landscape')->setWarnings(false)->download('myfile.pdf');

        /*return view('modal.pdf')
            ->with('user_name',$user_name);*/
    }

    public function printPdf(){
        $id = session('seeker_id');
        $priceNow = session('price');
        if($priceNow >250){
            DB::table('seekers')
                ->where('seeker_id',$id)
                ->update([
                    'price' => $priceNow - 250,
                ]);

            session()->put('price', ($priceNow - 250));

            return response()->json( true );
        }else
            return response()->json( false );



    }

        public function show(){


       /*     $html ="


           $mpdf = new \Mpdf\Mpdf();
            //$html= "<html><head><meta charset='utf-8' http-equiv='Content-Type'></head><body><style>@import url('https://fonts.googleapis.com/css?family=Lalezar'); * { font-family:  'Lalezar', serif; }</style><hr>بسم الله</body></html>";


            $mpdf->autoScriptToLang = true;
$mpdf->autoLangToFont = true;

            $mpdf->WriteHTML($html);
            $mpdf->Output();

*/
            $redis = Redis::connection();

            //  $id = Auth::guard('seekers')->user()->seeker_id;
            $isNew = false;
            if(Session::has('seeker_id')){
                $id = session('seeker_id');
                $job_seeker = Helpers::getDataSeeker('seekers',$id,$isNew);

            } else{

                $id = Auth::guard('seekers')->user()->seeker_id;
                $job_seeker = Helpers::getDataSeeker('seekers',$id,!$isNew);
            }

          /*  if(session('pay_cv') =="0")
                return "<span class='center'>"."لتحميل السيرة الذاتية يتوجب عليك شراء هذه الخدمة من المتجر."."</span>";
*/
                    $seeker_ed = Helpers::getDataSeeker('ed',$id,$isNew);
            $seeker_exp = Helpers::getDataSeeker('exp',$id,$isNew);
            $seeker_lang = Helpers::getDataSeeker('lang',$id,$isNew);
            $seeker_spec = Helpers::getDataSeeker('spec',$id,$isNew);
            $seeker_skills = Helpers::getDataSeeker('skills',$id,$isNew);
            $seeker_cert = Helpers::getDataSeeker('cert',$id,$isNew);
            $seeker_train = Helpers::getDataSeeker('train',$id,$isNew);
            $seeker_hobby = Helpers::getDataSeeker('hobby',$id,$isNew);
            $seeker_info = Helpers::getDataSeeker('info',$id,$isNew);
            $myCompany = Helpers::getDataSeeker('seekerCompany',$id,$isNew);

            $html= "<html><head><meta charset='utf-8' http-equiv='Content-Type'></head><body><style>@import url('https://fonts.googleapis.com/css?family=Lalezar'); * { font-family:  'Lalezar', serif; }</style>بسم الله</body></html>";

        /*  $data=['id'=> $id,
             'job_seeker'=> $job_seeker,
                'myCompany'=> $myCompany,
               'myCompany1'=> $myCompany,
                'seeker_ed'=> $seeker_ed,
                'seeker_exp'=> $seeker_exp,
                'seeker_lang'=> $seeker_lang,
                'seeker_spec'=> $seeker_spec,
               'seeker_skills'=> $seeker_skills,
                'seeker_cert'=> $seeker_cert,
               'seeker_train'=> $seeker_train,
                'seeker_info'=> $seeker_info,
                'seeker_hobby'=> $seeker_hobby];
            //$pdf = PDF::loadView('pdf.invoice', $data);

        //    return PDF::loadView('seekers.download',$data)->setPaper('a4', 'landscape')->setWarnings(false)->download('myfile.pdf');

            $dompdf = new Dompdf();
            $htmll = <<<'ENDHTML'
<html>
 <body>
  <h1>بسم الله</h1>
 </body>
</html>
ENDHTML;

            $dompdf->loadHtml($html);
            $dompdf->render();

            $dompdf->stream("hello.pdf");
*/

            //    return $dompdf->download('invoice.pdf');

            return view('seekers.download')
                ->with('id', $id)
                ->with('job_seeker', $job_seeker)
                ->with('myCompany', $myCompany)
                ->with('myCompany1', $myCompany)
                ->with('seeker_ed', $seeker_ed)
                ->with('seeker_exp', $seeker_exp)
                ->with('seeker_lang', $seeker_lang)
                ->with('seeker_spec', $seeker_spec)
                ->with('seeker_skills', $seeker_skills)
                ->with('seeker_cert', $seeker_cert)
                ->with('seeker_train', $seeker_train)
                ->with('seeker_info', $seeker_info)
                ->with('seeker_hobby', $seeker_hobby);
        }
    public function pdf1(){
        $time_start =microtime(true);

        $id = session('seeker_id');


// ... or send to client for inline display


        $saved_cv = DB::table('seekers')
                ->select('save_cv')
                ->where('seeker_id',$id)
                ->first();

            if($saved_cv->save_cv == 0 ){
                return redirect('/profile/download')->with('error','حسابك استنفذ العدد المسموح به من التحميلات الرجاء الأنتظار لشهر المقبل.');
            }

        DB::table('seekers')
            ->where('seeker_id',$id)->update(['save_cv' => DB::raw('save_cv - 1')]);

           $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'rtl';
        $lg['a_meta_language'] = 'ar';
        $lg['w_page'] = 'page';





        //$job_seeker = job_seeker::find($id);
        $job_seeker = DB::table('seekers')
            ->join('job_city','job_city.city_id','=','seekers.city_id')
            ->join('job_nat','job_nat.nat_id','=','seekers.nat_id')
            ->where('seekers.seeker_id','=',$id)->First();


        $seeker_ed = DB::table('job_ed')
            ->join('job_domain', 'job_domain.domain_id', '=', 'job_ed.domain_id')
            ->join('job_edt', 'job_edt.edt_id', '=', 'job_ed.edt_id')
            ->join('univ', 'univ.univ_id', '=', 'job_ed.univ_id')
            ->Leftjoin('faculty', 'faculty.faculty_id', '=', 'job_ed.faculty_id')
            ->Leftjoin('spec_ed', 'spec_ed.sed_id', '=', 'job_ed.sed_id')
            ->where('job_ed.seeker_id', '=', $id)
            ->orderby('job_ed.end_date', 'DESC')->get();


        $seeker_exp = DB::table('job_exp')
            ->join('job_domain', 'job_domain.domain_id', '=', 'job_exp.domain_id')
            ->join('comp_exp', 'comp_exp.compe_id', '=', 'job_exp.compe_id')
            ->where('job_exp.seeker_id', '=', $id)
            ->orderby('job_exp.state', 'DESC')
            ->orderby('job_exp.end_date', 'DESC')->get();

        $seeker_lang = DB::table('job_lang_seeker')
            ->join('job_lang','job_lang.lang_id','=','job_lang_seeker.lang_id')
            ->join('job_level','job_level.level_id','=','job_lang_seeker.level_id')
            ->where('job_lang_seeker.seeker_id','=',$id)
            ->orderby('job_lang_seeker.level_id','DESC')->get();

        $seeker_skills = DB::table('job_skills')
            ->join('job_level','job_level.level_id','=','job_skills.level_id')
            ->where('job_skills.seeker_id','=',$id)
            ->orderby('job_skills.level_id','DESC')->get();

        $seeker_spec = DB::table('spec_seeker')
            ->join('spec', 'spec.spec_id', '=', 'spec_seeker.spec_id')
            ->where('spec_seeker.seeker_id', '=', $id)
            ->orderby('spec_seeker.seeker_id', 'DESC')->get();

        $seeker_cert = DB::table('job_certificate')
            ->join('job_cert', 'job_cert.cert_id', '=', 'job_certificate.cert_id')
            ->where('job_certificate.seeker_id', '=', $id)->get();


        $seeker_train = DB::table('job_training')
            ->where('job_training.seeker_id','=',$id)
            ->orderby('train_date', 'DESC')->get();

        $seeker_hobby = DB::table('job_hobby')
            ->join('hobby', 'hobby.hobby_id', '=', 'job_hobby.hobby_id')
            ->where('job_hobby.seeker_id','=',$id)->get();

        $seeker_ref = DB::table('job_reference')
            ->where('job_reference.seeker_id','=',$id)->get();

        $seeker_info = DB::table('job_info')
            ->where('job_info.seeker_id','=',$id)
            ->orderby('info_date', 'DESC')->get();
       return view('viewView.cv')
            ->with('id',$id)
            ->with('job_seeker',$job_seeker)
            ->with('seeker_ed',$seeker_ed)
            ->with('seeker_exp',$seeker_exp)
            ->with('seeker_lang',$seeker_lang)
            ->with('seeker_skills',$seeker_skills)
            ->with('seeker_hobby',$seeker_hobby)
            ->with('seeker_cert',$seeker_cert)
            ->with('seeker_train',$seeker_train)
            ->with('seeker_spec',$seeker_spec)
            ->with('seeker_ref',$seeker_ref)
            ->with('seeker_info',$seeker_info);

        // set some language-dependent strings (optional)
        $pdf->setLanguageArray($lg);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('libyacv.com');
        $pdf->SetTitle('السيرة الذاتية');
        $pdf->SetSubject('cv');
        $pdf->SetKeywords('libyacv.com,asasna,pdf,jobs');


        $cvid=$id;

// set default header data
        $pdf->SetHeaderData('lcv2.png', 10, ' '.$job_seeker->fname." ".$job_seeker->lname,' '. 'Abdurraouf Hassan Grera');

// set header and footer fonts
        $pdf->setHeaderFont(Array('HacenLiner', '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array('HacenLiner', '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setCellHeightRatio(1.4);

        $pdf->SetFont('HacenLiner', '', 16);

// add a page
        $pdf->AddPage();



        $pdf->writeHTML(view('viewView.cv')
            ->with('id',$id)
            ->with('job_seeker',$job_seeker)
            ->with('seeker_ed',$seeker_ed)
            ->with('seeker_exp',$seeker_exp)
            ->with('seeker_lang',$seeker_lang)
            ->with('seeker_skills',$seeker_skills)
            ->with('seeker_hobby',$seeker_hobby)
            ->with('seeker_cert',$seeker_cert)
            ->with('seeker_train',$seeker_train)
            ->with('seeker_spec',$seeker_spec)
            ->with('seeker_ref',$seeker_ref)
            ->with('seeker_info',$seeker_info)->render(),true,false,true,false,'');


        $pdf->Output($job_seeker->user_name."-cv".".pdf", 'I');

        return view('exam.exams');

    }
    public function pdf2(){
        $id = Auth::guard('seekers')->user()->seeker_id;

        $saved_cv = DB::table('seekers')
            ->select('save_cv')
            ->where('seeker_id',$id)
            ->first();

        if($saved_cv->save_cv == 0 ){
            return redirect('/profile/download')->with('error','حسابك استنفذ العدد المسموح به من التحميلات الرجاء الأنتظار لشهر المقبل.');
        }

        DB::table('seekers')
            ->where('seeker_id',$id)->update(['save_cv' => DB::raw('save_cv - 1')]);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'rtl';
        $lg['a_meta_language'] = 'ar';
        $lg['w_page'] = 'page';





        //$job_seeker = job_seeker::find($id);
        $job_seeker = DB::table('seekers')
            ->join('job_city','job_city.city_id','=','seekers.city_id')
            ->join('job_nat','job_nat.nat_id','=','seekers.nat_id')
            ->where('seekers.seeker_id','=',$id)->First();


        $seeker_ed = DB::table('job_ed')
            ->join('job_domain', 'job_domain.domain_id', '=', 'job_ed.domain_id')
            ->join('job_edt', 'job_edt.edt_id', '=', 'job_ed.edt_id')
            ->join('univ', 'univ.univ_id', '=', 'job_ed.univ_id')
            ->Leftjoin('faculty', 'faculty.faculty_id', '=', 'job_ed.faculty_id')
            ->Leftjoin('spec_ed', 'spec_ed.sed_id', '=', 'job_ed.sed_id')
            ->where('job_ed.seeker_id', '=', $id)
            ->orderby('job_ed.end_date', 'DESC')->get();


        $seeker_exp = DB::table('job_exp')
            ->join('job_domain', 'job_domain.domain_id', '=', 'job_exp.domain_id')
            ->join('comp_exp', 'comp_exp.compe_id', '=', 'job_exp.compe_id')
            ->where('job_exp.seeker_id', '=', $id)
            ->orderby('job_exp.state', 'DESC')
            ->orderby('job_exp.end_date', 'DESC')->get();

        $seeker_lang = DB::table('job_lang_seeker')
            ->join('job_lang','job_lang.lang_id','=','job_lang_seeker.lang_id')
            ->join('job_level','job_level.level_id','=','job_lang_seeker.level_id')
            ->where('job_lang_seeker.seeker_id','=',$id)
            ->orderby('job_lang_seeker.level_id','DESC')->get();

        $seeker_skills = DB::table('job_skills')
            ->join('job_level','job_level.level_id','=','job_skills.level_id')
            ->where('job_skills.seeker_id','=',$id)
            ->orderby('job_skills.level_id','DESC')->get();

        $seeker_spec = DB::table('spec_seeker')
            ->join('spec', 'spec.spec_id', '=', 'spec_seeker.spec_id')
            ->where('spec_seeker.seeker_id', '=', $id)
            ->orderby('spec_seeker.seeker_id', 'DESC')->get();

        $seeker_cert = DB::table('job_certificate')
            ->join('job_cert', 'job_cert.cert_id', '=', 'job_certificate.cert_id')
            ->where('job_certificate.seeker_id', '=', $id)->get();


        $seeker_train = DB::table('job_training')
            ->where('job_training.seeker_id','=',$id)
            ->orderby('train_date', 'DESC')->get();

        $seeker_hobby = DB::table('job_hobby')
            ->join('hobby', 'hobby.hobby_id', '=', 'job_hobby.hobby_id')
            ->where('job_hobby.seeker_id','=',$id)->get();

        $seeker_ref = DB::table('job_reference')
            ->where('job_reference.seeker_id','=',$id)->get();

        $seeker_info = DB::table('job_info')
            ->where('job_info.seeker_id','=',$id)
            ->orderby('info_date', 'DESC')->get();


        // set some language-dependent strings (optional)
        $pdf->setLanguageArray($lg);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('libyacv.com');
        $pdf->SetTitle('السيرة الذاتية');
        $pdf->SetSubject('cv');
        $pdf->SetKeywords('libyacv.com,asasna,pdf,jobs');


        $cvid=$job_seeker->seeker_id;

// set default header data
        $pdf->SetHeaderData('lcv2.png', 10, ' '.$job_seeker->fname." ".$job_seeker->lname,' '. 'www.libyacv.dev/user/'.$job_seeker->user_name);

// set header and footer fonts
        $pdf->setHeaderFont(Array('HacenLiner', '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array('HacenLiner', '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setCellHeightRatio(1.4);

        $pdf->SetFont('HacenLiner', '', 16);

// add a page
        $pdf->AddPage();



        $pdf->writeHTML(view('viewView.cv1')
            ->with('id',$id)
            ->with('job_seeker',$job_seeker)
            ->with('seeker_ed',$seeker_ed)
            ->with('seeker_exp',$seeker_exp)
            ->with('seeker_lang',$seeker_lang)
            ->with('seeker_skills',$seeker_skills)
            ->with('seeker_hobby',$seeker_hobby)
            ->with('seeker_cert',$seeker_cert)
            ->with('seeker_train',$seeker_train)
            ->with('seeker_spec',$seeker_spec)
            ->with('seeker_ref',$seeker_ref)
            ->with('seeker_info',$seeker_info)->render(),true,false,true,false,'');

        $pdf->Output($job_seeker->user_name."-cv".".pdf", 'I');



    }

    public function postPdf($user_name){
        $seekers_id = Auth::guard('seekers')->user()->seeker_id;

    /*    $saved_cv = DB::table('seekers')
            ->select('saved_cv')
            ->where('seeker_id',$seekers_id)
            ->first();

        if($saved_cv->saved_cv == 0 ){
            echo "ماتقدرش تحمل و";
            die();
        }
/*/
        $job_id = DB::table('seekers')->
            select('seeker_id')
            ->where('seekers.user_name','=',$user_name)->first();
       $id = $job_id->seeker_id;

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'rtl';
        $lg['a_meta_language'] = 'ar';
        $lg['w_page'] = 'page';





        //$job_seeker = job_seeker::find($id);
        $job_seeker = DB::table('seekers')
            ->join('job_city','job_city.city_id','=','seekers.city_id')
            ->join('job_nat','job_nat.nat_id','=','seekers.nat_id')
            ->where('seekers.seeker_id','=',$id)->First();


        $seeker_ed = DB::table('job_ed')
            ->join('job_domain', 'job_domain.domain_id', '=', 'job_ed.domain_id')
            ->join('job_edt', 'job_edt.edt_id', '=', 'job_ed.edt_id')
            ->join('univ', 'univ.univ_id', '=', 'job_ed.univ_id')
            ->Leftjoin('faculty', 'faculty.faculty_id', '=', 'job_ed.faculty_id')
            ->Leftjoin('spec_ed', 'spec_ed.sed_id', '=', 'job_ed.sed_id')
            ->where('job_ed.seeker_id', '=', $id)
            ->orderby('job_ed.end_date', 'DESC')->get();


        $seeker_exp = DB::table('job_exp')
            ->join('job_domain', 'job_domain.domain_id', '=', 'job_exp.domain_id')
            ->join('comp_exp', 'comp_exp.compe_id', '=', 'job_exp.compe_id')
            ->where('job_exp.seeker_id', '=', $id)
            ->orderby('job_exp.state', 'DESC')
            ->orderby('job_exp.end_date', 'DESC')->get();

        $seeker_lang = DB::table('job_lang_seeker')
            ->join('job_lang','job_lang.lang_id','=','job_lang_seeker.lang_id')
            ->join('job_level','job_level.level_id','=','job_lang_seeker.level_id')
            ->where('job_lang_seeker.seeker_id','=',$id)
            ->orderby('job_lang_seeker.level_id','DESC')->get();

        $seeker_skills = DB::table('job_skills')
            ->join('job_level','job_level.level_id','=','job_skills.level_id')
            ->where('job_skills.seeker_id','=',$id)
            ->orderby('job_skills.level_id','DESC')->get();

        $seeker_spec = DB::table('spec_seeker')
            ->join('spec', 'spec.spec_id', '=', 'spec_seeker.spec_id')
            ->where('spec_seeker.seeker_id', '=', $id)
            ->orderby('spec_seeker.seeker_id', 'DESC')->get();

        $seeker_cert = DB::table('job_certificate')
            ->join('job_cert', 'job_cert.cert_id', '=', 'job_certificate.cert_id')
            ->where('job_certificate.seeker_id', '=', $id)->get();


        $seeker_train = DB::table('job_training')
            ->where('job_training.seeker_id','=',$id)
            ->orderby('train_date', 'DESC')->get();

        $seeker_hobby = DB::table('job_hobby')
            ->join('hobby', 'hobby.hobby_id', '=', 'job_hobby.hobby_id')
            ->where('job_hobby.seeker_id','=',$id)->get();

        $seeker_ref = DB::table('job_reference')
            ->where('job_reference.seeker_id','=',$id)->get();

        $seeker_info = DB::table('job_info')
            ->where('job_info.seeker_id','=',$id)
            ->orderby('info_date', 'DESC')->get();


        // set some language-dependent strings (optional)
        $pdf->setLanguageArray($lg);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Abdalrouf Hassan Grera');
        $pdf->SetTitle('السيرة الذاتية');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');


        $cvid=$job_seeker->seeker_id;

// set default header data
        $pdf->SetHeaderData('lcv2.png', 10, ' '.$job_seeker->fname." ".$job_seeker->lname,' '. 'www.libyacv.dev/user/'.$user_name);

// set header and footer fonts
        $pdf->setHeaderFont(Array('HacenLiner', '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array('HacenLiner', '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setCellHeightRatio(1.4);

        $pdf->SetFont('HacenLiner', '', 16);

// add a page
        $pdf->AddPage();



       $pdf->writeHTML(view('viewView.cv1')
           ->with('id',$id)
           ->with('job_seeker',$job_seeker)
            ->with('seeker_ed',$seeker_ed)
            ->with('seeker_exp',$seeker_exp)
            ->with('seeker_lang',$seeker_lang)
            ->with('seeker_skills',$seeker_skills)
            ->with('seeker_hobby',$seeker_hobby)
            ->with('seeker_cert',$seeker_cert)
            ->with('seeker_train',$seeker_train)
            ->with('seeker_spec',$seeker_spec)
            ->with('seeker_ref',$seeker_ref)
            ->with('seeker_info',$seeker_info)->render(),true,false,true,false,'');

        //

// output the HTML content

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// add a page
        /*$pdf->Cell(0, 12, 'بسم الله',0,1,'C');
        $htmlcontent = 'تمَّ بِحمد الله حلّ مشكلة الكتابة باللغة Libya في ملفات الـ<span color="#FF0000">PDF</span> مع دعم الكتابة <span color="#0000FF">من اليمين إلى اليسار</span> و<span color="#009900">الحركَات</span> .<br />تم الحل بواسطة <span color="#993399">صالح المطرفي و Asuni Nicola</span>  . ';
        */
// set LTR direction for english translation
//$pdf->setRTL(false);

// print newline
//$pdf->Ln();
// ---------------------------------------------------------

//Close and output PDF document/*
        $pdf->Output($user_name."-cv".".pdf", 'I');



    }

    public function getCv($id){
        $job_seeker = DB::table('seekers')
            ->join('job_city','job_city.city_id','=','seekers.city_id')
            ->join('job_nat','job_nat.nat_id','=','seekers.nat_id')
            ->where('seekers.seeker_id','=',$id)->First();

        $seeker_ed = DB::table('job_ed')
            ->join('job_domain','job_domain.domain_id','=','job_ed.domain_id')
            ->join('job_edt','job_edt.edt_id','=','job_ed.edt_id')
            ->where('job_ed.seeker_id','=',$id)
            ->orderby('job_ed.end_date','DESC')->get();

        $seeker_exp = DB::table('job_exp')
            ->join('job_domain','job_domain.domain_id','=','job_exp.domain_id')
            ->where('job_exp.seeker_id','=',$id)
            ->orderby('job_exp.state','DESC')
            ->orderby('job_exp.end_date','DESC')->get();

        $seeker_lang = DB::table('job_lang_seeker')
            ->join('job_lang','job_lang.lang_id','=','job_lang_seeker.lang_id')
            ->join('job_level','job_level.level_id','=','job_lang_seeker.level_id')
            ->where('job_lang_seeker.seeker_id','=',$id)
            ->orderby('job_lang_seeker.level_id','DESC')->get();

        $seeker_skills = DB::table('job_skills')
            ->join('job_level','job_level.level_id','=','job_skills.level_id')
            ->where('job_skills.seeker_id','=',$id)
            ->orderby('job_skills.level_id','DESC')->get();

        $seeker_cert = DB::table('job_certificate')
            ->where('job_certificate.seeker_id','=',$id)->get();

        $seeker_train = DB::table('job_training')
            ->where('job_training.seeker_id','=',$id)->get();

        $seeker_hobby = DB::table('job_hobby')
            ->where('job_hobby.seeker_id','=',$id)->get();

        $seeker_ref = DB::table('job_reference')
            ->where('job_reference.seeker_id','=',$id)->get();

        $seeker_info = DB::table('job_info')
            ->where('job_info.seeker_id','=',$id)->get();

        return view('viewView.cv')
            ->with('id',$id)
            ->with('job_seeker',$job_seeker)
            ->with('seeker_ed',$seeker_ed)
            ->with('seeker_exp',$seeker_exp)
            ->with('seeker_lang',$seeker_lang)
            ->with('seeker_skills',$seeker_skills)
            ->with('seeker_hobby',$seeker_hobby)
            ->with('seeker_info',$seeker_info);
    }
}
