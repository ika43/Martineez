<div id="notf{{$item->id}}" class="d-flex justify-content-center">
    <div id="post" class="list-group mb-5">
        <div class="list-group-item list-group-item-action flex-column align-items-start pb-0">
            <div class="w-100 justify-content-between">
                @if(session()->get('user')[0]->getId()==$item->uid)
                    <button class="btnDel" rel="{{$item->id}}"><img src="{{asset('images/btnDel.png')}}"></button>
                @endif
                <h6 class="mb-1">{{$item->firstname." ".$item->lastname}}</h6>
                <small>{{\Carbon\Carbon::parse($item->created_at)->format('d.m.Y  \a\t H:i')}}</small>
            </div>
            <figure class="figure mb-0">
                <p class="text-justify h4">{{$item->title}}</p>

            </figure>
            <hr class="my-0">
            <div class="container py-1">
                <div class="row">
                    <button class="ajax-link a-like-com" rel="{{$item->id}}">

                        <div class="container">
                            <div class="row">
                                <i class="material-icons mx-1">favorite_border</i>Like
                            </div>
                        </div>

                    </button>
                    <button class="a-like-com commPost" rel="{{$item->id}}">

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
                <a id="{{$item->id}}" href="" class="a-like-com num viewLikes" rel="{{$item->id}}">{{$item->numLike}} person like</a>
            </div>
        @else
            <div class="list-group-item list-group-item-action flex-column align-items-start">
                <a id="{{$item->id}}" href="" class="a-like-com"></a>
            </div>
            @endif
        @if($item->numComment!=0)
            <div id="{{$item->id}}showComm" class="list-group-item list-group-item-action flex-column align-items-start pb-2">
                <a href="" class="viewComment" rel="{{$item->id}}">View Comment</a>
            </div>
        @endif
        <div id="{{$item->id."comm"}}"></div>
    </div>
</div>