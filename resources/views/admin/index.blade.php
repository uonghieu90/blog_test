@extends('layout.app')

@section('title', 'Admin')
@section('header', 'Dashboard')
{{-- @section('sidebar')
    @parent

@endsection --}}
@section('nav')
    <li class="active"><a href="{{route("admin.index")}}"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
		
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Blog <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="{{route("blog_admin")}}">
						<span class="fa fa-arrow-right">&nbsp;</span> All Blogs
					</a></li>
				</ul>
			</li>
@endsection
@section('content')
    <p>This is my body content.</p>
@endsection