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
                    <h1>List Ticket</h1>
                    <ul class="breadcrumb">
                        <li><a href="javascript:void(0)">Home</a></li>
                        <li class="active">My Ticket</li>
                    </ul>
                </div><!-- end title -->
            </div><!-- end container -->
        </section><!-- end section -->

        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                          @if(!is_null($status))
                          <div class="alert alert-{{ $status }} alert-dismissible">
                             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                             {{ $message }}
                          </div>
                          @endif
                        <div class="widget">
                            <div class="custom-module">
                                <h4 class="module-title"><i class="material-icons">create</i> Create New Ticket</h4>
                                <form action="/my-ticket" method="POST">
                                  {{ csrf_field() }}
                                  <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Subject of your ticket" name="title">
                                    <small id="emailHelp" class="form-text text-muted">Please use simple subject in your topic.</small>
                                  </div>
                                  <div class="form-group">
                                    <select class="form-control" id="exampleSelect1" name="id_category">
                                      <option>Please select topic's category</option>
                                      @foreach($category as $data)
                                      <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleTextarea" class="col-md-4 control-label">Detail of topic</label>
                                    <textarea class="form-control" id="exampleTextarea" rows="7" name="detail"></textarea>
                                  </div>
                                  <button type="submit" class="btn btn-raised btn-info gr">Create Ticket</button>
                                </form>
                            </div><!-- end custom-module -->
                        </div><!-- end widget -->
                    </div><!-- end col -->
                  
                    <div class="col-md-4">
                        <div class="widget">
                            <div class="custom-module">
                                <h4 class="module-title"><i class="material-icons">web</i> Your Ticket (21)</h4>
                                <div class="list-group">
                                    @if($ticket->count() != 0)
                                    @if($ticket->count() > 5)
                                    <?php for($i=0; $i < 5; $i++) { ?>
                                    <div class="list-group-item">
                                        <div class="row-content">
                                            <p class="list-group-item-heading"><a href="/my-ticket/{{ $ticket[$i]->id }}"><i class="material-icons">description</i> {{ substr($ticket[$i]->title,0,23) }}</a><a onclick="confirm()" href="/my-ticket/delete/{{ $ticket[$i]->id }}" class="btn btn-danger"><i class="material-icons">delete</i></a></p>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    @else
                                    <?php for($i=0; $i < $ticket->count(); $i++) { ?>
                                    <div class="list-group-item">
                                        <div class="row-content">
                                            <p class="list-group-item-heading"><a href="/my-ticket/{{ $ticket[$i]->id }}"><i class="material-icons">description</i> {{ substr($ticket[$i]->title,0,23) }}</a><a onclick="confirm()" href="/my-ticket/delete/{{ $ticket[$i]->id }}" class="btn btn-danger"><i class="material-icons">delete</i></a></p>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    @endif
                                    @endif
                                </div>
                                @if($ticket->count() > 5)
                                <a href="#" class="readmore" title="">View all tickets →</a>
                                @endif
                            </div><!-- end custom-module -->
                        </div><!-- end widget -->
                    </div><!-- end col -->
                </div><!-- end row -->

                <hr class="invis">
                
            </div><!-- end container -->
        </section><!-- end section -->
        <script> 
          function confirm() {
            alert("Your ticket has ben deleted");
          }
          
        </script>
@endsection