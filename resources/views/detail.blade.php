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
                    <h1>{{ $ticket->title }}</h1>
                    <ul class="breadcrumb">
                        <li><a href="javascript:void(0)">Home</a></li>
                        <li><a href="/topics">Topics</a></li>
                        <li class="active">{{ $ticket->title }}</li>
                    </ul>
                </div><!-- end title -->
            </div><!-- end container -->
        </section><!-- end section -->

        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <aside class="topic-page topic-list blog-list forum-list single-forum">
                            <article class="well btn-group-sm clearfix">
                                <div class="topic-meta clearfix">
                                  @if(Auth::user())
                                    <div class="pull-left">
                                        <a class="btn btn-default btn-fab btn-fab-mini" href="/like/{{ $ticket->id }}" data-toggle="tooltip" data-placement="bottom" title="Like">
                                            <i class="material-icons">thumb_up</i>
                                        </a>
                                        <a class="btn btn-default btn-fab btn-fab-mini" href="/unlike/{{ $ticket->id }}" data-toggle="tooltip" data-placement="bottom" title="Un Like">
                                            <i class="material-icons">thumb_down</i>
                                        </a>
                                        <a class="btn btn-default btn-fab btn-fab-mini" href="#" data-toggle="tooltip" data-placement="bottom" title="Bookmark">
                                            <i class="material-icons">bookmark_border</i>
                                        </a>
                                    </div>
                                    <!-- end left -->
                                  @endif
                                    <div class="pull-right">
                                        <div class="customshare">
                                            <div class="list">
                                                <div class="btn btn-default btn-fab btn-fab-mini"><i class="material-icons">share</i>
                                                    <ul class="list-inline">
                                                        <li><a href="#" class="tw"><i class="fa fa-twitter"></i></a></li>
                                                        <li><a href="#" class="fb"><i class="fa fa-facebook"></i></a></li>
                                                        <li><a href="#" class="gp"><i class="fa fa-google-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end right -->
                                </div>
                                <!-- end topic-meta -->
                                <div class="topic-desc row-fluid clearfix">
                                    <div class="col-sm-2 text-center publisher-wrap">
                                        <img src="/assets/images/uploads/{{ \App\User::find($ticket->id_user)->avatar }}" alt="" class="avatar img-circle img-responsive">
                                        <h5>{{ \App\User::find($ticket->id_user)->name }}</h5>
                                        <small class="offline">Offline</small>
                                    </div>
                                    <div class="col-sm-10">
                                        <h4> {{ $ticket->title }}</h4>
                                        <div class="blog-meta clearfix">
                                            <small><a href="#">{{ \App\Like::where('id_ticket','=',$ticket->id)->where('is_like','=',1)->get()->count() }} Likes</a></small>
                                            <small><a href="#">{{ \App\Like::where('id_ticket','=',$ticket->id)->where('is_like','=',0)->get()->count() }} UnLikes</a></small>
                                            <small><a href="#">{{ $answer->count() }} Answers</a></small>
                                            <small><?php $time = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ticket->created_at)->format('F\\, j Y  h:i:s'); echo $time; ?></small>
                                        </div>

                                        <p>{{ $ticket->detail }}</p>

                                        <hr class="invis1">

                                        <footer class="topic-footer clearfix">
                                            <div class="pull-left">
                                                <ul class="list-inline tags">
                                                    <li><a href="#">{{ \App\Category::find($ticket->id_category)->nama }}</a></li>
                                                </ul>
                                            </div>
                                        </footer>
                                    </div>
                                </div><!-- end tpic-desc -->
                                @if($answer->count() != 0)
                                @foreach($answer as $data)
                                <div class="topic-desc row-fluid clearfix">
                                    <div class="col-sm-2 text-center publisher-wrap">
                                        <img src="/assets/images/uploads/{{ (is_null(\App\User::find($data->id_user)->avatar)) ? 'team_01.jpg' : \App\User::find($data->id_user)->avatar }}" alt="" class="avatar img-circle img-responsive">
                                        <h5>{{ \App\User::find($data->id_user)->name }}</h5>
                                        <small class="online">Online</small>
                                    </div>
                                    <div class="col-sm-10">
                                        @if($data->is_valid == 1)
                                        <header class="topic-footer clearfix">
                                            <ul class="list-inline tags">
                                                <li class="verified"><a href="#">Accepted Answer</a></li>
                                            </ul>
                                        </header>
                                        @endif
                                        <div class="blog-meta clearfix">
                                            <small><?php $time = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('F\\, j Y  h:i:s'); echo $time; ?></small>
                                        </div>

                                        <p>{{ $data->jawaban }}</p>
                                    </div>
                                </div><!-- end tpic-desc -->
                                @endforeach
                                @endif
                                @if(Auth::user())
                                <div id="reply" class="forum-answer topic-desc clearfix">
                                    <div class="row">
                                        <div class="col-sm-2 text-center publisher-wrap">
                                            <img src="/assets/images/uploads/{{ (is_null(Auth::user()->avatar)) ? 'team_01.jpg' : Auth::user()->avatar }}" alt="" class="avatar img-circle img-responsive">
                                            <h5>{{ Auth::user()->name }}</h5>
                                            <small class="online">Online</small>
                                        </div>

                                        <div class="col-md-10">
                                            
                                            <div class="form-group">
                                               <form action="/reply" method="POST">
                                                 {{ csrf_field() }}
                                                 <input type="hidden" name="id_ticket" value="{{ $ticket->id }}">
                                                  <label for="textArea" class="col-md-2 control-label">Reply</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" rows="4" id="textArea" name="jawaban"></textarea>
                                                    <button class="btn btn-raised btn-info gr" type="submit">Reply</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div><!-- end answer -->
                                @endif

                                <div class="topic-meta clearfix">
                                  @if(Auth::user())
                                    <div class="pull-left">
                                        <a class="btn btn-default btn-fab btn-fab-mini" href="/like/{{ $ticket->id }}" data-toggle="tooltip" data-placement="bottom" title="Like">
                                            <i class="material-icons">thumb_up</i>
                                        </a>
                                        <a class="btn btn-default btn-fab btn-fab-mini" href="/unlike/{{ $ticket->id }}" data-toggle="tooltip" data-placement="bottom" title="Un Like">
                                            <i class="material-icons">thumb_down</i>
                                        </a>
                                        <a class="btn btn-default btn-fab btn-fab-mini" href="#" data-toggle="tooltip" data-placement="bottom" title="Bookmark">
                                            <i class="material-icons">bookmark_border</i>
                                        </a>
                                    </div>
                                    <!-- end left -->
                                  @endif
                                    <div class="pull-right">
                                        <div class="customshare">
                                            <div class="list">
                                                <div class="btn btn-default btn-fab btn-fab-mini"><i class="material-icons">share</i>
                                                    <ul class="list-inline">
                                                        <li><a href="#" class="tw"><i class="fa fa-twitter"></i></a></li>
                                                        <li><a href="#" class="fb"><i class="fa fa-facebook"></i></a></li>
                                                        <li><a href="#" class="gp"><i class="fa fa-google-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end right -->
                                </div>
                                <!-- end topic-meta -->
                            </article>
                            <ul class="pager">
                                <li><a class="withripple" href="javascript:void(0)"><i class="material-icons">chevron_left</i></a></li>
                                <li><a class="withripple" href="javascript:void(0)"><i class="material-icons">chevron_right</i></a></li>
                            </ul>
                        </aside>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end section -->
@endsection