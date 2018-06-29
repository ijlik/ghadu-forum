@extends('layouts.app')

@section('menu')

@guest
  <li><a href="/">Home</a></li>
  <li><a href="/topics">Support Topics</a></li>
  <li><a href="/register">Create Account</a></li>
  <li><a href="#" data-toggle="modal" data-target="#LoginModal"><i class="material-icons">lock</i> Login</a></li>
@else
  <li><a href="/">Home</a></li>
  <li><a href="/topics">Support Topics</a></li>
  <li class="active"><a href="/my-ticket">Submit Tickets</a></li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
      {{ Auth::user()->name }} <span class="caret"></span>
    </a>

    <ul class="dropdown-menu" role="menu">
      <li><a href="/notification" ><i class="material-icons">notifications</i> Notifications</a></li>
      <li><a href="/profile" ><i class="material-icons">person</i> Profile</a></li>
      @if(Auth::user()->id == 1)
      <li><a href="/category" ><i class="material-icons">category</i> Category</a></li>
      @endif
      <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="material-icons">exit_to_app</i>  Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
      </li>
    </ul>
  </li>
@endguest

@endsection

@section('content')
<section class="section">
            <div class="container">
                <div class="page-title text-center">
                    <h1>404 NOT FOUND</h1>
                    <p>Make sure your url is valid</p>
                    <ul class="breadcrumb">
                        <li><a href="javascript:void(0)">Home</a></li>
                        <li class="active">My Ticket</li>
                    </ul>
                </div><!-- end title -->
            </div><!-- end container -->
        </section><!-- end section -->
@endsection