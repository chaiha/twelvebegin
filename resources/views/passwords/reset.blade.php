@if (Session::get('error'))
  <div class="alert alert-error">
    {{ Session::get('error') }}
  </div>
@endif

{{ Form::open(array('route' => array('reset.password.complete'))) }}
  <input type="text" name="user_id" id="user_id" value="" />
  {{ Form::password('old_password', array('placeholder'=>'current password', 'required'=>'required')) }}
  {{ Form::password('password', array('placeholder'=>'new password', 'required'=>'required')) }}
  {{ Form::password('password_confirmation', array('placeholder'=>'new password confirmation', 'required'=>'required')) }}
  {{ Form::submit('Reset Password', array('class' => 'btn')) }}
{{ Form::close() }}