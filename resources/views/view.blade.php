@extends('layout.home')

@section('title', 'Home')	

@section('content')
			<section class="post-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class=" col-lg-8" style="overflow:auto;">
                        <div class="single-page-post">
                           {{--  <img class="img-fluid" src="img/single.jpg" alt=""> --}}
                            <div class="top-wrapper ">
                                <div class="row d-flex justify-content-between">
                                    <h2 class="col-lg-8 col-md-12 text-uppercase">
                                        {{$blog->title}}
                                    </h2>
                                    <div class="col-lg-4 col-md-12 right-side d-flex justify-content-end">
                                        <div class="desc">
                                           <h2>{{$author->name}}</h2>
                                            <h3>{{$blog->updated_at}}</h3>
                                        </div>
                                     
                                    </div>
                                </div>
                            </div>
                            <div class="single-post-content">
                                <p>{{$blog->discription}}
                                </p>
                            
                           

                            <!-- Start nav Area -->
                         
                            
                        </div>
                            <!-- End nav Area -->
                            
                        </div>
                    </div>
                    <div class="col-lg-4 sidebar-area ">


                        <div class="single_widget about_widget">
                            <img src="img/asset/s-img.jpg" alt="">
                            <h2 class="text-uppercase">{{$author->name}}</h2>
                            <p>
                               {{$author->email}}
                            </p>
                            <div class="social-link">
                                <a href="#"><button class="btn"><i class="fa fa-facebook" aria-hidden="true"></i> Like</button></a>
                                <a href="#"><button class="btn"><i class="fa fa-twitter" aria-hidden="true"></i> follow</button></a>
                            </div>
                        </div>                                               
                    </div>
                </div>
            </div>    
        </section>
			
@endsection