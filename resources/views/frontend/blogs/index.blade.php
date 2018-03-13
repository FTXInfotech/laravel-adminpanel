@extends('frontend/user/dashboard')
@section('content')

 <div class="w3-content w3-display-container">
  <img class="mySlides" src="{{url('img/frontend/slider-image/laravel_tut.jpg')}}" style="width:100%">
  <img class="mySlides" src="{{url('img/frontend/slider-image/laravel1.png')}}" style="width:100%">
  <img class="mySlides" src="{{url('img/frontend/slider-image/laravel-simple-leader.png')}}" style="width:100%">
  

  <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
  <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
</div>

<script>
  var slideIndex = 1;
  showDivs(slideIndex);

  function plusDivs(n) {
    showDivs(slideIndex += n);
  }

  function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    if (n > x.length) {slideIndex = 1}    
    if (n < 1) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    x[slideIndex-1].style.display = "block";  
  }
</script>



   <div class="row">

       @include('frontend.sidebars.left_sidebar')

       <div class="col-md-6 col-md-offset-1" >
       	  <h2>Latest Blogs</h2>
       	  <hr>
          @foreach($blogs as $blog)
             @include('frontend.blogs.blog')
             <hr>
          @endforeach
         
          <div class="text-center">
            <center>
     	       {!! $blogs->links() !!}
             </center>
           </div>
           
	   </div>

      @include('frontend.sidebars.right_sidebar')
   </div>
@endsection


