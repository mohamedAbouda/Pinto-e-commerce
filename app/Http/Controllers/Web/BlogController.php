<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\BlogPostCommentRequest;
use App\Models\BlogCategory;
use App\Models\BlogPost;
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
        if ($request->has('catId')) {
            $data['posts'] = BlogPost::where('blog_category_id' , $request->get('catId'))
            ->orderBy('created_at' ,'DESC')->paginate(20);
        }else{
            $data['posts'] = BlogPost::orderBy('created_at' ,'DESC')->paginate(20);
        }
        $data['blog_categories'] = BlogCategory::get();
        return view('web.blog.index',$data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $blog)
    {
        $data['post'] = $blog;
        $data['blog_categories'] = BlogCategory::get();
        return view('web.blog.show' , $data);
    }

    public function comment(BlogPostCommentRequest $request , BlogPost $post)
    {
        $input = $request->all();
        $input['blog_post_id'] = $post->id;
        $saved = BlogComment::create($input);
        if ($saved) {
            return redirect()->back()->with('success', 'Comment sent successfully.');
        }
        return redirect()->back()->withErrors(['msg' => 'Something went wrong please try again later.']);
    }
}
