<?php
$title=empty($blog)?"":$blog->title;
$description=empty($blog)?"":$blog->discription;
$id=empty($blog)?"":$blog->id;
?>
@extends('layout.app')
@section('title', 'Author')
<?php if(empty($blog)){?>
@section('header', 'Create blog')
<?php }else{?>
@section('header', 'Edit blog')
<?php } ?>
{{-- @section('sidebar')
    @parent

@endsection --}}
@section('nav')

    <li class=""><a href="{{route("author.index")}}""><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
		
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Blog <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children " id="sub-item-1">
					<li><a class="" href="{{route("blog")}}">
						<span class="fa fa-arrow-right">&nbsp;</span> All Blogs
					</a></li>
					<li><a class="active" href="{{route("edit_blog")}}">
						<span class="fa fa-arrow-right">&nbsp;</span> Create blog
					</a></li>

				</ul>
			</li>
}
@endsection
@section('content')
   <div class="panel-body">
						<form class="form-horizontal" action="{{route('store_blog')}}" method="post">
							<fieldset>
								 @csrf
								<!-- Name input-->
								<?php if(!empty($blog)){?>
								     <input type="hidden" name="id"
								     value={{$id}}>
									<?php } ?>
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Title</label>
									<div class="col-md-9">
										<input id="title" name="title" placeholder="Your title" class="form-control" type="text" value={{$title}}>
									</div>
								</div>
							
								
								<!-- Message body -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="description">Description</label>
									<div class="col-md-9">
										<textarea class="form-control" id="description" name="description" placeholder="Please enter your description here..." rows="5" value={{$description}}>{{$description}}</textarea>
									</div>
								</div>
								
								<!-- Form actions -->
								<div class="form-group">
									<div class="col-md-12 widget-right">
										<button type="submit" class="btn btn-default btn-md pull-right">Submit</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
@endsection

