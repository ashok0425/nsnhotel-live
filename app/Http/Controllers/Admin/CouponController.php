<?php

namespace App\Http\Controllers\Admin;


use App\Commons\Response;
use App\Models\Coupon;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Corporate;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function index(Request $request)
    {
     

        $posts = Coupon::query();      
        // Get all posts
        $posts = $posts->orderBy('id', 'desc')->get();     
        return view('admin.coupon.post_list', [
            'posts' => $posts,
        ]);
    }

    public function pageCreate(Request $request)
    {
        $post = Post::find($request->id);

        return view('admin.coupon.post_add', [
            'post' => $post,
        ]);
    }
   

    public function create(Request $request)
    {
       
        $data = $request->all();
        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb');
            $thumb_file = $this->uploadImage($thumb, '');
            $data['thumb'] = $thumb_file;
        }

//        return $data;

        $post = new Coupon();
        $post->fill($data)->save();
        return redirect()->back()->with('success', 'Create Coupon success!');
    }
    public function edit(Request $request,$id){
  $coupon=Coupon::find($id);
  return view('admin.coupon.post_edit',compact('coupon'));
    }

    public function update(Request $request)
    {
          $data = $request->all();
        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb');
            $thumb_file = $this->uploadImage($thumb, '');
            $data['thumb'] = $thumb_file;
        }

//        return $data;

        $post =Coupon::find($request->id);
        $post->fill($data)->save();
        return redirect()->back()->with('success', 'Update Coupon success!');
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return back()->with('success', 'Delete post success!');
    }

    public function updateStatus(Request $request)
    {
        $data = $this->validate($request, [
            'status' => 'required',
        ]);

        $model = Post::find($request->post_id);
        $model->fill($data);

        if ($model->save()) {
            return $this->response->formatResponse(200, $model, 'Update post status success!');
        }
    }


    public function createPostTest()
    {
//        App::setLocale('fr');
//        config(['app.locale' => 'fr']);

        $data = [
            'en' => [
                'title' => "Test TA"
            ],
            'fr' => [
                'title' => "Test TV"
            ]
        ];


        $test = Post::query()
            ->first();

        return $test;

    }


}
