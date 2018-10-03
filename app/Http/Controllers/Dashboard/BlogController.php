<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BlogArticleCreateRequest;
use App\Http\Requests\Dashboard\BlogArticleUpdateRequest;
use App\Models\BlogArticle;
use App\Models\BlogCategory;
use DB;

class BlogController extends Controller
{
    protected $views_path ='dashboardV2.blogs.';

    public function index(Request $request)
    {
        $index = $request->get('page' , 1);
        $data['counter_offset'] = ($index * 20) - 20;
        $data['resources'] = BlogArticle::orderBy('id','DESC')->paginate(20);

        return view($this->views_path.'index',$data);
    }

    public function show(BlogArticle $blog)
    {
        $data['resource'] = $blog;

        return view($this->views_path.'show' ,$data);
    }

    public function create()
    {
        $data['categories'] = BlogCategory::pluck('name' ,'id')->toArray();

        return view($this->views_path.'create' ,$data);
    }

    public function store(BlogArticleCreateRequest $request)
    {
        $input = $request->all();
        // dd($input);
        $blog = BlogArticle::create($input);
        if ($categories = $request->get('categories')) {
            $categories_id = [];
            foreach ($categories as $category) {
                if (is_numeric($category)) {
                    $categories_id[] = $category;
                    continue;
                }
                $find_category = BlogCategory::where('name' ,$category)->first();
                if ($find_category) {
                    $categories_id[] = $find_category->id;
                    continue;
                }
                $new_category = BlogCategory::create(['name' => $category]);
                $categories_id[] = $new_category->id;
            }

            $blog->categories()->sync($categories_id);
        }
        alert()->success('Published successfully.', 'Success');
        return redirect()->route('dashboard.blog.index');
    }

    public function edit(BlogArticle $blog)
    {
        $data['resource'] = $blog;
        $data['categories'] = BlogCategory::pluck('name' ,'id')->toArray();

        return view($this->views_path.'edit' ,$data);
    }

    public function update(BlogArticleUpdateRequest $request ,BlogArticle $blog)
    {
        $input = $request->all();

        if ($request->has('cover_image')) {
            $file_path = public_path($blog->upload_distination.$blog->cover_image);
            if ($blog->cover_image && file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $blog->update($input);


        if ($categories = $request->get('categories')) {
            $categories_id = [];
            foreach ($categories as $category) {
                if (is_numeric($category)) {
                    $categories_id[] = $category;
                    continue;
                }
                $find_category = BlogCategory::where('name' ,$category)->first();
                if ($find_category) {
                    $categories_id[] = $find_category->id;
                    continue;
                }
                $new_category = BlogCategory::create(['name' => $category]);
                $categories_id[] = $new_category->id;
            }

            $blog->categories()->sync($categories_id);
        }
        alert()->success('Updated successfully.', 'Success');
        return redirect()->route('dashboard.blog.index');
    }

    public function destroy(BlogArticle $blog)
    {
        $file_path = public_path($blog->upload_distination.$blog->cover_image);
        if ($blog->cover_image && file_exists($file_path)) {
            unlink($file_path);
        }
        DB::table('blog_articles')->where('id' ,$blog->id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
}
