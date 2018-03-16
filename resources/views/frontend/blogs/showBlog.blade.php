@extends('frontend/user/dashboard')
@section('content')
   <div class="col-md-8 blog-main">
   <h1>{{$blog->name}}</h1>
   {{$blog->content}}
    </div>
 @endsection

     
 
