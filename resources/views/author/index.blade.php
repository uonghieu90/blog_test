@extends('layout.app')

@section('title', 'Author')
@section('header', 'Dashboard')
{{-- @section('sidebar')
    @parent

@endsection --}}
@section('nav')
    <li class="active"><a href="index.html"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
		
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Blog <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="{{route("blog")}}">
						<span class="fa fa-arrow-right">&nbsp;</span> All Blogs
					</a></li>
					<li><a class="" href="{{route("edit_blog")}}">
						<span class="fa fa-arrow-right">&nbsp;</span> Create blog
					</a></li>
				</ul>
			</li>
@endsection
@section('content')
    <p>This is my body content.</p>
@endsection