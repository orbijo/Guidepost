@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card article">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title"><a href="{{route('posts.show', $post->id)}}">{{ $post->title }}</a></h5>
                @if (Auth::check())
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <button class="btn" type="button">
                            <i class="fa fa-arrow-up"></i>
                        </button>
                        <button class="btn" type="button">
                            <i class="fa fa-arrow-down"></i>
                        </button>
                    </div>
                @endif
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <footer class="blockquote-footer">
                    {{ $post->user->name }} <cite title="Source Title">{{ $post->updated_at->diffForHumans() }}</cite>
                </footer>
                <span class="badge badge-danger badge-pill">{{ $post->votes }}</span>
            </div>
        </div>
        <img src="{{ asset('storage/'.$post->img_url) }}" class="card-img-top" alt="{{ $post->title }}">
        <div class="card-body">
            <p class="card-text">
                {{ $post->body }}
            </p>
        </div>
        <div class="accordion" id="accordion{{$post->id}}">
            <div class="card">
                <div class="card-header">Comments</div>
                @if (count($post->comments)>0)
                <div class="card-body comments pt-2 pb-3">
                    @if (Auth::user())
                        <form action="{{ route('comments.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <textarea placeholder="Comment" class="form-control" name="content" id="content" rows="3"></textarea>
                            </div>
                            <input type="number" value="{{$post->id}}" hidden name="pid">
                            <input type="number" name="cid" hidden disabled >
                            <input type="submit" class="btn btn-outline-danger">
                        </form>
                    @endif
                    @foreach ($post->comments as $comment)
                        <div class="row pt-5 mx-0">
                            <div class="col-2 text-center">
                                <div>
                                <a href="{{route('users.show', $comment->user->id)}}"><img class="user rounded-circle" src="{{asset('storage/'.$comment->user->img_url)}}" alt="Commentor"></a>
                                    <a class="d-none d-md-block" href="{{route('users.show', $comment->user->id)}}">{{ $comment->user->name }}</a>
                                </div>
                                @if (Auth::check())
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <button class="btn" type="button">
                                            <i class="fa fa-arrow-up"></i>
                                        </button>
                                        <button class="btn" type="button">
                                            <i class="fa fa-arrow-down"></i>
                                        </button>
                                    </div>
                                @endif
                                <div>
                                    <span class="badge badge-danger badge-pill">{{ $comment->votes }}</span>
                                </div>
                            </div>
                            <div class="col-10 text-wrap">
                                {{ $comment->content }}
                            </div>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col">
                                        <div class="card reply pl-5">
                                            @if (Auth::user())
                                                <form action="{{ route('comments.store') }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <textarea placeholder="Reply" class="form-control" name="content" id="reply" rows="1"></textarea>
                                                    </div>
                                                    <input type="number" value="{{$post->id}}" hidden name="pid">
                                                    <input type="number" value="{{$comment->id}}" hidden name="cid">
                                                    <input type="submit" class="btn btn-outline-danger float-right">
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($comment->comments)
                                @foreach ($comment->comments as $reply)
                                    <div class="container-fluid border-top mt-3 pt-3">
                                        <div class="accordion pl-5" id="accordionReply{{$comment->id}}">
                                            
                                            <div class="card-body comments py-2">
                                                <div class="row">
                                                    <div class="col-2 text-center">
                                                        <div>
                                                            <a href="{{route('users.show', $reply->user->id)}}"><img class="user rounded-circle" src="{{asset('storage/'.$reply->user->img_url)}}" alt="Commentor"></a>
                                                            <a class="d-none d-md-block" href="{{route('users.show', $reply->user->id)}}">{{$reply->user->name}}</a>
                                                        </div>
                                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                            @if (Auth::check())
                                                                <button class="btn" type="button">
                                                                    <i class="fa fa-arrow-up"></i>
                                                                </button>
                                                                <button class="btn" type="button">
                                                                    <i class="fa fa-arrow-down"></i>
                                                                </button>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <span class="badge badge-danger badge-pill">{{$reply->votes}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-10 text-wrap">
                                                        {{$reply->content}}
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    </div>
                                    
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                </div>
                @else
                    @if (Auth::check())
                        <div class="card-body">
                            <form action="{{ route('comments.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <textarea placeholder="Be the first to comment" class="form-control" name="content" id="content" rows="3"></textarea>
                                </div>
                                <input type="number" value="{{$post->id}}" hidden name="pid">
                                <input type="number" value="" hidden disabled name="cid">
                                <input type="submit" class="btn btn-outline-danger float-right">
                            </form>
                        </div>
                    @else
                    <div class="card-body">
                        <div class="form-group">
                            <textarea disabled placeholder="Login first to comment" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    @endif
                    
                @endif
            </div>
        </div>
    </div>
</div>