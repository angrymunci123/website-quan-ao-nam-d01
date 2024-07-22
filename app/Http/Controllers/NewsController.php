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
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $news = News::paginate(10);
        Paginator::useBootstrap();
        return view('admin.news.news_list', compact('news'))->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create_news()
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        return view('admin.news.add_news');
    }

    public function save_news(Request $request)
    {
        if (!Auth::check()) {
            return redirect('admin');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $title = $request->title;
        $content = $request->content;
        $user_id = auth()->id();
        $image = time() . $request->image->getClientOriginalName();
        $request->image->move(public_path('image'), $image);
        DB::table('news')->insert([
            'user_id' => $user_id,
            'title' => $title,
            'content' => $content,
            'image' => $image,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect("/admin/news")->with('notification', 'Tạo Tin Tức Mới Thành Công!');;
    }

    public function delete_news($news_id)
    {
        if (!Auth::check()) {
            return view('admin');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $news = News::findOrFail($news_id);
        $news->delete();
        return redirect('/admin/news')->with('notification', 'Xóa Tin Tức Thành Công!');
    }

    public function edit_news($news_id)
    {
        if (!Auth::check()) {
            return view('admin');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $news = News::where('news_id', $news_id)->get();
        return view('admin.news.update_news', compact('news'));
    }
    
    public function update_news(Request $request, $news_id)
    {
        if (!Auth::check()) {
            return view('admin');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $title = $request->title;
        $content = $request->content;
        $user_id = Auth::id();
        $image = time() . $request->image->getClientOriginalName();
        $request->image->move(public_path('image'), $image);

        DB::table('news')->where("news_id", "=", "$news_id")->update([
            'user_id' => $user_id,
            'title' => $title,
            'content' => $content,
            'image' => $image,
            'updated_at' => now(),
        ]);
        return redirect('/admin/news')->with('success', 'Sửa Tin Tức Thành Công!');
    }

    public function view_news(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $news_id = $request->news_id;
        $news_detail = DB::table('news')->where('news_id', '=', $news_id)->get();
        return view('admin.news.news_detail', compact('news_detail'));
    }
}
