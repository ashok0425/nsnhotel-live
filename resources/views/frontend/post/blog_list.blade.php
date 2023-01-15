@extends('frontend.layouts.template-home')
@php
$blog_title_bg = "style='background-image:url(/assets/images/img-bg-blog.png)'";
@endphp
@section('main')

<div class="midarea">
	<div class="breadcrumarea">
		<img src="../assets/images/blogs.jpg" class="img-fluid" alt="About Us">
		<div class="breadcrumareacontent">
			<p><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span></p>
			<h1>Blogs</h1>
			<p class="shortdescription">Browse the Latest Articles from our Blog.</p>
		</div>
	</div>
	<div class="pageindicator">
		<div class="container">
			<ul>
				<li><a href="">Home</a></li>
				<li><a href="" class="active">Blogs</a></li>
			</ul>
		</div>
	</div>
	<div class="blogsslider">
		<div class="container">
			<div id="nsnhotelsblogslider" class="owl-carousel">
				@foreach($posts as $post)
					<div class="nsnrecentstoriesbox">
						<a href="{{route('post_detail', [$post->slug, $post->id])}}">
							<img src="{{getImageUrl($post->thumb)}}" class="img-fluid" alt="{{$post->title}}" />
							<div class="nsnrecentstoriesboxcontent">
								<div class="nsndatestamp">{{ date('M j, Y', strtotime($post->created_at)) }}</div>
								<ul>
								@foreach($post['categories'] as $cat)
								<li><a href="{{route('post_list', $cat->slug)}}" title="{{$cat->name}}"><i class="fa fa-tags"></i> {{$cat->name}}</a></li>
								@endforeach
								</ul>
								<h2>{{$post->title}}</h2>
							
								  
							</div>
						</a>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
<div class="pagination">
	{{$posts->render('frontend.common.pagination')}}
</div>         
@stop