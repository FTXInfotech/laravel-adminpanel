<!DOCTYPE html>
<html>
<head>
  <title>Blog Application</title>
  <link rel="stylesheet" type="text/css" href="{{ url('css/frontend/bootstrap.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('css/frontend/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/frontend/bootstrap.min.map') }}">
 

</head>
<body>
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/home">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/about">About</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/contact">Contact Me</a>
      </li> 

      <li class="nav-item">
        <button type="button" class="btn btn-secondary btn-sm">
           Notification <span class="badge badge-secondary">9</span>
            <span class="sr-only">unread messages</span>
       </button>
     </li>
      
    </ul>
   
     <form class="form-inline my-2 my-lg-0" method="POST" action="/search" >
        <div class="nav-item">
         <select id="search"  class="js-example-basic-single" name="state">
            <option></option>
             @foreach($blogtags as $blogtag)
                   <option value="{{ $blogtag->id }}">{{$blogtag->name}}</option>
            @endforeach
         </select>

       </div>
       &nbsp
      <div class="nav-item">
            <a class="btn btn-secondary btn-sm" href="/search">Search</a>
      </div>
     
    
  </div>
</nav>

 <script type="text/javascript" href="{{ url('js/frontend/bootstrap.js') }}"></script>
  <script type="text/javascript" href="{{ url('js/frontend/jQuery-3.1.0.js') }}"></script>
  <script type="text/javascript" href="{{ url('js/select2.min.js') }}"></script>
    <script type="text/javascript">
     $("#search").select2({
          placeholder: "Select a tag",
          allowClear: true
    });
   </script>
 </form>  
</body>
</html>