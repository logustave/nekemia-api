<?php

namespace App\Http\Controllers;

use App\Models\v1\Admin;
use App\Models\v1\Blog;
use App\Models\v1\Faq;
use Illuminate\Http\Request;
use App\Models\v1\Category;
use Illuminate\View\View;
class AcceuilController extends Controller
{
    public function index(Request $request){
        $get_total_blog= (new Blog()) -> getAllBlog($request);
        $get_total_category= (new Category()) -> getAllCategory();
        $get_total_faq= (new Faq()) -> getAllFaq();
        $get_total_admin= (new Admin()) -> getAllAdmin();
        $get_last_blog = (new Blog()) -> getLastFiveBlog();
        return View('index',[

            'nbr_blog'=>count($get_total_blog['object']),
            'nbr_category'=>count($get_total_category['object']),
            'nbr_faq'=>count($get_total_faq['object']),
            'nbr_admin'=>count($get_total_admin['object']),
            'last_blog'=>$get_last_blog['object']

            ]);
//        return count($get_total_category['object']);
    }
}
