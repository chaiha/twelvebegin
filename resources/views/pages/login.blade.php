@extends('layouts.master')

@section('content')
@section('styles')
    {{ Html::style('css/signin.css') }}
@stop
<!-- Services Section -->
 <div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
        <form action="login" method="POST" />
            {{csrf_field()}}
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

        </div>
    </div>
</div>

@endsection