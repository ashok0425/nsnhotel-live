

@php
    use App\Models\Post;
    $posts = Post::query()
            ->with('categories')
            ->with('user')
            ->where('type','blog')
            ->where('status', 1)->limit(6)->orderBy('id','desc')->get();
@endphp
	<div class="blogsslider d-none d-md-block mt-5 mb-0">

		<div class="container">
		<h2 class="pl-0 pl-md-3 font-weight-bold text-dark font_22 mb-3">Recent Blog</h2>
			
			<div id="nsnhotelsblogsliders" class="owl-carousel">
				@foreach($posts as $post)
				<div class="nsnrecentstoriesbox">
					<img data-src="{{getImageUrl($post->thumb)}}" class="img-fluid lazy" alt="{{$post->title}}"  />
					<div class="nsnrecentstoriesboxcontent">
						<div class="nsndatestamp">{{ date('M j, Y', strtotime($post->created_at)) }}</div>
						<ul>
						@foreach($post['categories'] as $cat)
						<li><a href="{{route('post_list', $cat->slug)}}" title="{{$cat->name}}"><i class="fa fa-tags"></i> {{$cat->name}}</a></li>
						@endforeach
						</ul>
				<a href="{{route('post_detail', [$post->slug, $post->id])}}">

						<h2 class="custom-fw-700 custom-text-white custom-fs-20">{{$post->title}}</h2>
						
				</a>
						  
					</div>
			</div>
				@endforeach
			</div>
		</div>
	</div>
<br>