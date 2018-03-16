 <div class="col-md-3" >
          <h2> Right-Sidebar</h2>
          <hr>
  <div class="card" style="width: 18rem;">
  <div class="card-header">
    Trending Posts
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Cras justo odio</li>
    <li class="list-group-item">Dapibus ac facilisis in</li>
    <li class="list-group-item">Vestibulum at eros</li>
  </ul>
</div>
&nbsp

<div class="card" style="width: 18rem;">
  <div class="card-header">
    Latest Blog
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Cras justo odio</li>
    <li class="list-group-item">Dapibus ac facilisis in</li>
    <li class="list-group-item">Vestibulum at eros</li>
  </ul>
</div>
&nbsp


<div class="card" style="width: 18rem;">
  <div class="card-header">
    Monthly Archives
  </div>
  <div class="list-group list-group-flush">
      @foreach($archives as $state)
          <a href="/Dashboard/?month={{ $state['month'] }} &year={{ $state['year'] }}">{{ $state['month'].' '.$state['year'] }}
          </a>
      @endforeach
  </div>
</div>
 

  </div>