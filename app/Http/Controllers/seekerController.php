<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use TCPDF;
class seekerController extends Controller
{
    //
    protected  $guard = 'seekers';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function  index(){

        return view('seeker');
    }
  /*  public function index($id){
        
/*                 // create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'rtl';
$lg['a_meta_language'] = 'ar';
$lg['w_page'] = 'page';




         //$job_seeker = job_seeker::find($id);
        $job_seeker = DB::table('job_seeker')
        ->join('job_city','job_city.city_id','=','job_seeker.city_id')
        ->join('job_nat','job_nat.nat_id','=','job_seeker.nat_id')
        ->where('job_seeker.user_id','=',$id)->First();

            // set some language-dependent strings (optional)
$pdf->setLanguageArray($lg);
            $pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('السيرة الذاتية');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

            
            $cvid=$job_seeker->user_id;

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $job_seeker->fname." ".$job_seeker->lname, 'www.libyacv.com/ibrahim45');

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
        $seeker_ed = DB::table('job_ed')
            ->join('job_domain','job_domain.domain_id','=','job_ed.domain_id')
            ->join('job_ed_type','job_ed_type.edt_id','=','job_ed.edt_id')
            ->where('job_ed.user_id','=',$id)
            ->orderby('job_ed.end_date','DESC')->get();
        
        $seeker_exp = DB::table('job_exp')
            ->join('job_domain','job_domain.domain_id','=','job_exp.domain_id')
            ->where('job_exp.user_id','=',$id)
            ->orderby('job_exp.end_date','DESC')->get();
 
                $seeker_lang = DB::table('job_lang_seeker')
                    ->join('job_lang','job_lang.lang_id','=','job_lang_seeker.lang_id')
                    ->join('job_level','job_level.level_id','=','job_lang_seeker.level_id')
                    ->where('job_lang_seeker.user_id','=',$id)
                    ->orderby('job_lang_seeker.level_id','DESC')->get();
                    
        $seeker_skilles = DB::table('job_skilles')
            ->join('job_level','job_level.level_id','=','job_skilles.level_id')
            ->where('job_skilles.user_id','=',$id)
            ->orderby('job_skilles.level_id','DESC')->get();
        
        $seeker_hobby = DB::table('job_hobby')
        ->where('job_hobby.user_id','=',$id)->get();
            
            $seeker_info = DB::table('job_info')
        ->where('job_info.user_id','=',$id)
        ->orderby('job_info.info_date','DESC')->get();
           
            
            
               $data= $pdf->writeHTML(view('viewView.cv')->with('id',$id)->withJob_seeker($job_seeker)
            ->with('id',$id)
            ->with('seeker_ed',$seeker_ed)
            ->with('seeker_exp',$seeker_exp)
            ->with('seeker_lang',$seeker_lang)
            ->with('seeker_skilles',$seeker_skilles)
            ->with('seeker_hobby',$seeker_hobby)
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
/*$pdf->Output($cvid."-CV".".pdf", 'I');
        return view('seekerView.seeker')->withJob_seeker($job_seeker)
            ->with('id',$id)
            ->with('seeker_ed',$seeker_ed)
            ->with('seeker_exp',$seeker_exp)
            ->with('seeker_lang',$seeker_lang);*/
            /*
            
             $job_seeker = DB::table('job_seeker')
        ->join('job_city','job_city.city_id','=','job_seeker.city_id')
        ->join('job_nat','job_nat.nat_id','=','job_seeker.nat_id')
        ->where('job_seeker.user_id','=',$id)->First();
         
        $seeker_ed = DB::table('job_ed')
            ->join('job_domain','job_domain.domain_id','=','job_ed.domain_id')
            ->join('job_ed_type','job_ed_type.edt_id','=','job_ed.edt_id')
            ->where('job_ed.user_id','=',$id)
            ->orderby('job_ed.end_date','DESC')->get();
        
        $seeker_exp = DB::table('job_exp')
            ->join('job_domain','job_domain.domain_id','=','job_exp.domain_id')
            ->where('job_exp.user_id','=',$id)
            ->orderby('job_exp.end_date','DESC')->get();
 
                $seeker_lang = DB::table('job_lang_seeker')
                    ->join('job_lang','job_lang.lang_id','=','job_lang_seeker.lang_id')
                    ->join('job_level','job_level.level_id','=','job_lang_seeker.level_id')
                    ->where('job_lang_seeker.user_id','=',$id)
                    ->orderby('job_lang_seeker.level_id','DESC')->get();
        
        
        $seeker_skilles = DB::table('job_skilles')
            ->join('job_level','job_level.level_id','=','job_skilles.level_id')
            ->where('job_skilles.user_id','=',$id)
            ->orderby('job_skilles.level_id','DESC')->get();
        
                $seeker_hobby = DB::table('job_hobby')
        ->where('job_hobby.user_id','=',$id)->get();
            
                     $seeker_info = DB::table('job_info')
        ->where('job_info.user_id','=',$id)->get();
           
        return view('seekerView.seeker')->withJob_seeker($job_seeker)
            ->with('id',$id)
            ->with('seeker_ed',$seeker_ed)
            ->with('seeker_exp',$seeker_exp)
            ->with('seeker_lang',$seeker_lang)
            ->with('seeker_skilles',$seeker_skilles)
            ->with('seeker_hobby',$seeker_hobby)
            ->with('seeker_info',$seeker_info);
    }*/
    public function addnews(){
        
        return Response::json(input::get('titel'));
    }
    public function modal($id){
        return view('seekerView.modal_add_exp');
    }
    
    public function added($id){
        
                     $ed_type = DB::table('job_ed_type')->get();
        $domain_type = DB::table('job_domain')->get();
        return view('seekerView.add_ed')
            ->with('ed_type',$ed_type)
            ->with('domain_type',$domain_type);
        
    }
    
      public function inserted($id,Request $request){
        
          $ed_name = $request->select('ed_name');
                  
        return redirect('profile/'.$id);
            
     
        
    }
}
