@extends('layouts.app')

@section('menu')

@guest
  <li><a href="/">Home</a></li>
  <li class="active"><a href="/topics">Support Topics</a></li>
  <li><a href="/register">Create Account</a></li>
  <li><a href="#" data-toggle="modal" data-target="#LoginModal"><i class="material-icons">lock</i> Login</a></li>
@else
  <li><a href="/">Home</a></li>
  <li class="active"><a href="/topics">Support Topics</a></li>
  <li><a href="/my-ticket">Submit Tickets</a></li>
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
                    <h1>Available Topics</h1>
                    <ul class="breadcrumb">
                        <li><a href="javascript:void(0)">Home</a></li>
                        <li class="active">All topics</li>
                    </ul>
                </div><!-- end title -->
            </div><!-- end container -->
        </section><!-- end section -->

        <section class="section lb">
            <div class="container">
              @foreach($category as $data)
                <div class="row">
                  @foreach($data as $result)                    
                  <div class="col-md-4">
                        <div class="widget">
                            <div class="custom-module">
                                <?php $ticket = \App\Ticket::where('id_category','=',$result->id)->get(); ?>
                                <h4 class="module-title"><i class="material-icons">web</i> {{ $result->nama }} ({{ $ticket->count() }})</h4>
                                <div class="list-group">
                                    <div class="list-group-item">
                                    @if($ticket->count() != 0)
                                    @if($ticket->count() > 5)
                                    <?php for($i=0; $i < 5; $i++) { ?>
                                    <div class="list-group-item">
                                        <div class="row-content">
                                            <p class="list-group-item-heading"><a href="/ticket/{{ $ticket[$i]->id }}"><i class="material-icons">description</i> {{ $ticket[$i]->title }}</a></p>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    @else
                                    <?php for($i=0; $i < $ticket->count(); $i++) { ?>
                                    <div class="list-group-item">
                                        <div class="row-content">
                                            <p class="list-group-item-heading"><a href="/ticket/{{ $ticket[$i]->id }}"><i class="material-icons">description</i> {{ $ticket[$i]->title }}</a></p>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    @endif
                                    @endif
                                    </div>
                                </div>
                                @if($ticket->count() > 5)
                                <a href="#" class="readmore" title="">View all tickets →</a>
                                @endif
                            </div><!-- end custom-module -->
                        </div><!-- end widget -->
                    </div><!-- end col -->
                  @endforeach
                </div><!-- end row -->

                <hr class="invis">
              @endforeach
            </div><!-- end container -->
        </section><!-- end section -->
@endsection