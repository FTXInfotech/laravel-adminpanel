<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select from Avtars or upload your photo</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(array('route' => 'frontend.user.profile-picture.update', 'files' => true)) !!}
        <div class="form-group">
          <label for="profile_pic">
            <img src="{{url('/').'/img/frontend/profile-picture/pic-1.png'}}" height=80 width=80>
            {!! Form::radio('profile_pic') !!}
          </label>
        </div>
        <div class="form-group">
          <label for="profile_pic">
            <img src="{{url('/').'/img/frontend/profile-picture/pic-2.png'}}" height=80 width=80>
            {!! Form::radio('profile_pic') !!}
          </label>
        </div>
        <div class="form-group">
          <label for="profile_pic">
            <img src="{{url('/').'/img/frontend/profile-picture/pic-3.png'}}" height=80 width=80>
            {!! Form::radio('profile_pic') !!}
          </label>
        </div>
        <div class="form-group">
          {!! Form::file('profile_picture', ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
          {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
          {!! Form::reset('Reset', ['class' => 'btn btn-primary']) !!}
        </div>
          
        {!! Form::close() !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>