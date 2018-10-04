<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\BlogPostCommentRequest;
use App\Models\BlogArticle;
use App\Models\BlogCategory;
use App\Models\BlogComment;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data['articles'] = BlogArticle::where(function($query) use($request){
            $query->where('id' ,'<>' ,NULL);

            if ($search = $request->get('search')) {
                $query->where('title' ,'LIKE' ,'%' . $search . '%')
                ->orWhere('short_description' ,'LIKE' ,'%' . $search . '%')
                ->orWhere('body' ,'LIKE' ,'%' . $search . '%');
            }
            if ($tag = $request->get('tag')) {
                $query->whereHas('categories' ,function($query) use($tag){
                    $query->where('name' ,$tag);
                });
            }
        })->with(['categories' ,'comments'])->paginate(10);
        $data['popular_articles'] = BlogArticle::orderBy('views' ,'DESC')->take(3)->get();
        $data['tags'] = BlogCategory::with('articles')->get();

        return view('site.blog' ,$data);
    }

    public function show(BlogArticle $blog)
    {
        $blog->views++;
        $blog->save();
        $data['article'] = $blog;

        $data['next_id'] = BlogArticle::where('id' ,'>' ,$blog->id)->orderBy('views' ,'DESC')->first();
        $data['prev_id'] = BlogArticle::where('id' ,'<' ,$blog->id)->orderBy('views' ,'DESC')->first();

        $data['popular_articles'] = BlogArticle::orderBy('views' ,'DESC')->take(3)->get();
        $data['tags'] = BlogCategory::with('articles')->get();
        return view('site.blog-article' ,$data);
    }

    public function comment(Request $request ,BlogArticle $blog)
    {
        $input = $request->all();
        $client = auth()->guard('client')->user();
        $input['client_id'] = $client->id;

        BlogComment::create($input);

        alert()->success('Comment sent successfully.', 'Success');
        return redirect()->back();
    }
}
