<div id="notf{{$item->id}}" class="d-flex justify-content-center">
    <div class="list-group mb-5" style="max-width: 542px !important;">
        <div class="list-group-item list-group-item-action flex-column align-items-start pb-0">
            <div class="w-100 justify-content-between">
                @if(session()->get('user')[0]->getId()==$item->uid)
                    <button class="btnDel" rel="{{$item->id}}"><img src="{{asset('images/btnDel.png')}}"></button>
                    @endif



                <h6 class="mb-1"><img src="

                                    @if(isset($item->srcProfil))
                                    {{$item->srcProfil}}
                                    @else
                                    {{asset('images/blank-profile.png')}}
                                      @endif

                                      " class="rounded-circle mb-2 mr-2 xs-img"/>{{$item->firstname." ".$item->lastname}}</h6>
                <small>{{\Carbon\Carbon::parse($item->created_at)->format('d.m.Y  \a\t H:i')}}</small>
            </div>
            <p class='h4'>{{$item->title}}</p>
            <figure class="figure mb-0">
                <a href="{{$item->srcPost}}" data-lightbox="{{$item->id}}"><img src="{{$item->srcPost}}" class="figure-img img-fluid rounded"></a>
                <figcaption class="figure-caption"></figcaption>
            </figure>
            <div class="container pb-1">
                <div class="row">
                    <button class="ajax-link a-like-com" rel="{{$item->id}}">

                        <div class="container">
                            <div class="row">
                                <i class="material-icons mx-1">favorite_border</i>Like
                            </div>
                        </div>

                    </button>
                    <button class="commPost a-like-com" rel="{{$item->id}}">

                        <div class="container">
                            <div class="row">
                                <i class="material-icons ml-3 mr-1">folder_open</i>Comment
                            </div>
                        </div>

                    </button>


                </div>


            </div>
        </div>
        @if($item->numLike!=0)
        <div class="list-group-item list-group-item-action flex-column align-items-start">
                <a id="{{$item->id}}" href="" class="a-like-com viewLikes" rel="{{$item->id}}">{{$item->numLike}} person like</a>
        </div>
            @else
            <div class="list-group-item list-group-item-action flex-column align-items-start">
                <a id="{{$item->id}}" href="" class="a-like-com"></a>
            </div>
        @endif
        @if($item->numComment!=0)
            <div class="list-group-item list-group-item-action flex-column align-items-start pb-2" id="{{$item->id}}showComm">
                <a href="" class="viewComment" rel="{{$item->id}}">View Comment</a>
            </div>
        @endif
        <div id="{{$item->id."comm"}}"></div>
</div>
</div>