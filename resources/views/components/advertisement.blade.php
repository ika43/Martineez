
<div  class="col-sm banner d-flex justify-content-end pr-0">
    <div class="card side-banner">
        <div class="banner-sticky">
            @if(count($adv)>=1)
            @foreach($adv as $item)
            <div class="mb-3 banner-background">
                <img class="card-img-top" src="{{$item->src}}" alt="{{$item->alt}}">
                <div class="card-body">
                    <p><small>{{$item->text}}</small></p>
                </div>
            </div>
            @endforeach
            @else
            <div class="mb-3 banner-background">
                <img class="card-img-top" src="{{asset('images/banner.jpeg')}}">
                <div class="card-body">
                    <p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
                @endif
        </div>
    </div>
</div>
