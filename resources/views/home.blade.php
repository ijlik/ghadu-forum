@extends('layouts.app')

@section('menu')

@guest
  <li class="active"><a href="/">Home</a></li>
  <li><a href="/topics">Support Topics</a></li>
  <li><a href="/register">Create Account</a></li>
  <li><a href="#" data-toggle="modal" data-target="#LoginModal"><i class="material-icons">lock</i> Login</a></li>
@else
  <li class="active"><a href="/">Home</a></li>
  <li><a href="/topics">Support Topics</a></li>
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
<section class="section welcome welcome_01 bg1">
            <div class="container">
                <div class="row">
                    <div class="content col-md-8 col-md-offset-2">
                      <div class="welcome-text text-center">
                            @if(!Auth::user())
                            <h1>Find <strong>the answer</strong> of your problems</h1>
                            <p>Welcome to the Ghadu Forum! Search your answers with the search box above, or if you're stuck you can create a support ticket.</p>
                            @else
                            <h1>Search your <strong>problems about farming</strong></h1>
                            @endif
                        </div>
                        <div class="widget clearfix">
                            <div class="panel panel-primary">
                                <div class="panel-body">
                                    <form class="site-search">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="How may I help you today?">
                                        </div>
                                        <div class="form-group clearfix"> <!-- inline style is just to demo custom css to put checkbox below input above -->
                                            <div class="checkbox pull-left">
                                                <label>
                                                    <input type="checkbox"> &nbsp;Topics
                                                </label>
                                                <label>
                                                    <input type="checkbox"> &nbsp;Forums
                                                </label>
                                                <label>
                                                    <input type="checkbox"> &nbsp;Knowledge Base
                                                </label>
                                            </div>
                                            <div class="submit-button pull-right">
                                                <a class="btn btn-raised btn-info gr" href="#"><i class="material-icons">search</i> Search</a>
                                            </div>
                                        </div>
                                    </form><!-- end well -->
                                </div>
                            </div>
                        </div><!-- end widget -->
                    </div><!-- end col -->
                </div><!-- end container -->
            </div><!-- end container -->
        </section><!-- end section -->

        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="topic_top row clearfix">
                            <div class="col-md-9 hidden-xs">
                                <p>Showing 1-10 of {{$ticket->count()}} Topics</p>
                            </div>

                            <div class="col-md-3 text-right">
                                <select class="form-control">
                                    <option>Popular topics</option>
                                    <option>Newest topics</option>
                                    <option>Older topics</option>
                                </select>
                            </div>
                        </div><!-- end shop-top -->

                        <aside class="topic-page topic-list blog-list forum-list single-forum">
                            @foreach($ticket as $data)
                            <article class="well btn-group-sm clearfix">
                                <div class="topic-desc row-fluid clearfix">
                                    <div class="col-sm-2 text-center publisher-wrap">
                                        <img src="/assets/images/uploads/{{ \App\User::find($data->id_user)->avatar }}" alt="" class="avatar img-circle img-responsive">
                                        <h5>{{ \App\User::find($data->id_user)->name }}</h5>
                                        <small class="offline">Offline</small>
                                    </div>
                                    <div class="col-sm-10">

                                        <footer class="topic-footer clearfix">
                                            <div class="pull-left">
                                                <ul class="list-inline tags">
                                                    <li><a href="#">{{ \App\Category::find($data->id_category)->nama }}</a></li>
                                                </ul>
                                                <!-- end tags -->
                                            </div>
                                        </footer>

                                        <h4> <a href="/ticket/{{$data->id}}">{{ $data->title }}</a></h4>
                                        <div class="blog-meta clearfix">
                                            <small><a href="#">{{ \App\Like::where('id_ticket','=',$data->id)->where('is_like','=',1)->get()->count() }} Likes</a></small>
                                            <small><a href="#">{{ \App\Like::where('id_ticket','=',$data->id)->where('is_like','=',0)->get()->count() }} UnLikes</a></small>
                                            <small><a href="#">{{ \App\Answer::where('id_ticket','=',$data->id)->get()->count() }} Answers</a></small>
                                            <small><?php $time = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('F\\, j Y  h:i:s'); echo $time; ?></small>
                                        </div>

                                        <p>{{ substr($data->detail,0,221) }}</p>
                                      
                                        <a href="/ticket/{{$data->id}}" class="readmore" title="">View full question →</a>
                                    </div>
                                </div><!-- end tpic-desc -->
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
                                                 <input type="hidden" name="id_ticket" value="{{ $data->id }}">
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
                                        <a class="btn btn-default btn-fab btn-fab-mini" href="/like/{{ $data->id }}" data-toggle="tooltip" data-placement="bottom" title="Like">
                                            <i class="material-icons">thumb_up</i>
                                        </a>
                                        <a class="btn btn-default btn-fab btn-fab-mini" href="/unlike/{{ $data->id }}" data-toggle="tooltip" data-placement="bottom" title="Un Like">
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
                            @endforeach
                            <article class="well btn-group-sm clearfix">
                                <ul class="pagination">
                                    <li class="disabled"><a href="javascript:void(0)">&laquo;</a></li>
                                    <li class="active"><a href="javascript:void(0)">1</a></li>
                                    <li><a href="javascript:void(0)">2</a></li>
                                    <li><a href="javascript:void(0)">3</a></li>
                                    <li><a href="javascript:void(0)">4</a></li>
                                    <li><a href="javascript:void(0)">&raquo;</a></li>
                                </ul>
                            </article>
                        </aside>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end section -->
@endsection
