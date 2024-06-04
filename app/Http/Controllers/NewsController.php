<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function news() 
    {
        if (!Auth::check()) {
            return redirect('admin');
        }
        return view('admin.news.news_management');
    }
    public function create_news() 
    {
        if (!Auth::check()) {
            return redirect('admin');
        }
        return view('admin.news.add_news');
    }
}
