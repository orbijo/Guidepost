@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col d-md-none mb-2">
            <div class="card">
                <div class="card-header">Recommended</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Recommended Posts Here...
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="container-fluid">
                <!-- Articles -->
                @isset($posts)
                    @foreach ($posts as $post)
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
                            <img src="{{ asset('storage/'.$post->img_url) }}" class="card-img-top limit-h" alt="{{ $post->title }}">
                            <div class="card-body">
                                <p class="card-text text-truncate">
                                    {{ $post->body }}
                                </p>
                            </div>
                            <div class="accordion" id="accordion{{$post->id}}">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center" id="heading{{$post->id}}">
                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$post->id}}" aria-expanded="true" aria-controls="collapseOne">
                                                Show Top Comments
                                            </button>
                                    </div>
                                    @if (count($post->comments)>0)
                                        <div id="collapse{{$post->id}}" class="collapse" aria-labelledby="heading{{$post->id}}" data-parent="#accordion{{$post->id}}">
                                            <div class="card-body comments py-2">
                                                {{-- Comments --}}
                                                @foreach ($post->comments as $comment)
                                                    <div class="row">
                                                        <div class="col-2 text-center">
                                                            <div><img class="user rounded-circle" src="{{asset('storage/'.$comment->user->img_url)}}" alt="Commentor"></div>
                                                            <a href="{{route('users.show', $comment->user->id)}}">{{ $comment->user->name }}</a>
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
                                                        @if ($comment->comments)
                                                            @foreach ($comment->comments as $reply)
                                                                <div class="container-fluid">
                                                                    <div class="accordion pl-5" id="accordionReply{{$comment->id}}">
                                                                        <div class="card reply">
                                                                        <div class="card-text d-flex justify-content-between align-items-center"
                                                                            id="headingReply{{$comment->id}}">
                                                                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                                                                    data-target="#collapseReply{{$comment->id}}" aria-expanded="true"
                                                                                    aria-controls="collapseReply{{$comment->id}}">
                                                                                    Show replies
                                                                                </button>
                                                                        </div>
                                                                        <div id="collapseReply{{$comment->id}}" class="collapse" aria-labelledby="headingReply{{$comment->id}}"
                                                                            data-parent="#accordionReply{{$comment->id}}">
                                                                            <div class="card-body comments py-2">
                                                                                <div class="row">
                                                                                    <div class="col-2 text-center">
                                                                                        <img class="user rounded-circle" src="{{asset('storage/'.$reply->user->img_url)}}" alt="Commentor">
                                                                                        <a href="{{route('users.show', $reply->user->id)}}">{{$reply->user->name}}</a>
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
                                                                                        <span class="badge badge-danger badge-pill">{{$reply->votes}}</span>
                                                                                    </div>
                                                                                    <div class="col-10 text-wrap">
                                                                                        {{$reply->content}}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                @endforeach
                                                {{-- End Comments --}}
                                            </div>
                                        </div>
                                    @else
                                        <div id="collapse{{$post->id}}" class="collapse" aria-labelledby="heading{{$post->id}}" data-parent="#accordion{{$post->id}}">
                                            <div class="card-body comments py-2">
                                                No comments...
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset
                    
                <!-- End Articles -->
            </div>
        </div>
        <div class="col-md-4 d-none d-md-block">
            <div class="card">
                <div class="card-header">Recommended</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Recommended Posts Here...
                </div>
            </div>
        </div>
    </div>
</div>
@if(count($errors) > 0)
    <script type="application/javascript">
            $(document).ready(function(){
                $('#createModal').modal('show');
            });      
    </script>
@endif
@endsection