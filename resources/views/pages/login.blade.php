@extends('layouts.master')

@section('content')
@section('styles')
    {{ Html::style('css/signin.css') }}
@stop
<!-- Services Section -->
 <div class="container">

     {{!! Form::open(['action' => 'Controller@method','class' => 'sign-in','method'=>'POST') !!}}
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div>

@endsection