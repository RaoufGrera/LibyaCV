<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{

    public function showBlog()
    {
        return view('blog.blog');
    }
    public function showArabicBlog()
    {
        return view('blog.arabic');
    }
        public function showEnglishBlog(){
        return view('blog.english');
    }
    public function TemplateArabicCV1()
    {
      //  $book = Book::where('uuid', $uuid)->firstOrFail();
        $pathToFile = storage_path('app/files/Template_Arabic_CV.docx');
        return response()->download($pathToFile);
    }

    public function TemplateEnglishCV1()
    {
      //  $book = Book::where('uuid', $uuid)->firstOrFail();
        $pathToFile = storage_path('app/files/free_resume_with_photo_english.docx');
        return response()->download($pathToFile);
    }

    public function TemplateEnglishCVGrey()
    {
        $pathToFile = storage_path('app/files/free_resume_with_photo_english_grey.docx');
        return response()->download($pathToFile);
    }

    public function TemplateEnglishCVBlue()
    {
        $pathToFile = storage_path('app/files/freecv_resume_en_blue.docx');
        return response()->download($pathToFile);
    }
}
