<!DOCTYPE html>
<html>
<head>
  <title>Blog Application</title>
  <link rel="stylesheet" type="text/css" href="{{ url('css/frontend/bootstrap.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('css/frontend/style.css') }}">
  <script type="text/javascript" href="{{ url('js/frontend/bootstrap.js') }}"></script>
  <script type="text/javascript" href="{{ url('js/frontend/jQuery-3.1.0.js') }}"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Laravel Blog</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#"> Home <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item active">
              <a class="nav-link" href="#"> About <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item active">
              <a class="nav-link" href="#"> Blog <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item active">
              <a class="nav-link" href="#"> Contact Us <span class="sr-only">(current)</span></a>
            </li>
        </ul>
      </div>
        
           <form  action="/search" method="get" class="form-inline">
               <input type="text"  name="q" placeholder="Search.."/>
                   <button type="submit">Search</button>
           </form>
        
  </nav>


</body>
</html>