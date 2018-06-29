@extends('layouts.app')

@section('menu')
<li><a href="/">Home</a></li>
<li><a href="/topics">Support Topics</a></li>
<li class="active"><a href="/register">Create Account</a></li>
<li><a href="#" data-toggle="modal" data-target="#LoginModal"><i class="material-icons">lock</i> Login</a></li>
@endsection


@section('content')
<section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="widget">
                            <div class="custom-module">
                                <h4 class="module-title"><i class="material-icons">lock</i> Create Account</h4>

                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <form class="sidebar-login" action="{{ route('register') }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="text" class="form-control" placeholder="Name" name="name">
                                            @if ($errors->has('name'))
                                              <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                              </span>
                                            @endif
                                            <input type="email" class="form-control" placeholder="Email Address" name="email">
                                            @if ($errors->has('email'))
                                              <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                              </span>
                                            @endif
                                            <input type="password" class="form-control" placeholder="Password" name="password">
                                            @if ($errors->has('password'))
                                              <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                              </span>
                                            @endif
                                            <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                                            
                                            <button type="submit" class="btn btn-raised btn-info gr">Create Account</button>
                                        </form> 

                                    </div>
                                </div>
                            </div><!-- end custom-module -->
                        </div><!-- end widget -->
                    </div>
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end section -->
@endsection
