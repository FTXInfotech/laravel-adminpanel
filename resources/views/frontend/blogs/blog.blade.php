
         

<div class="card">
  <div class="card-header">
     <a href="dashboard/blogs/{{$blog->id}}">
            <h2 class="blog-post-title">{{$blog->name}}</h2>
     </a>
  </div>
  <div class="card-body">
    <h5 class="card-title"> {{$blog->created_at->toFormattedDateString()}}</h5>
    <img src="{{asset['img/' ,$blog->featured_image]}}" alt="Card image cap">
    <p class="card-text">{{ substr(strip_tags($blog->content), 0, 50) }}
              {{ strlen(strip_tags($blog->content)) > 50 ? "... " : "" }} .</p>          
    <a href="dashboard/blogs/{{$blog->id}}" class="btn btn-primary">Read More</a>
  </div>
</div>