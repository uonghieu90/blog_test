@extends('layout.home')

@section('title', 'Home')	

@section('content')
			<!-- Start category Area -->
			<section class="category-area section-gap" id="news">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-70 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">Latest News </h1>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua.</p>
							</div>
						</div>
					</div>						
					<div class="active-cat-carusel">
						@foreach ($blogs as $blog)
    
                        <a href={{route('view_blog',['id'=>$blog->id])}}>
						<div class="item single-cat">
							<img src="img/c1.jpg" alt="">
							<p class="date">{{substr($blog->updated_at,0,10)}}</p>
							<h4><a href="#">{{$blog->title}}</a></h4>
						</div>
						 @endforeach
							</a>
							<div style="clear: both;"></div>					
					</div>											{{ $blogs->links() }}	
				</div>	
			</section>
			<!-- End category Area -->
			
@endsection