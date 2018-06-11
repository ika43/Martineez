@if($user->id == session()->get('user')[0]->getId())
<div class="container">
    <div class="row justify-content-center">
        <div>
            <button type="button" class="btn btn-primary mb-4 text-center" data-toggle="modal" data-target="#exampleModal">
                Upload Photo
            </button>
        </div>
    </div>
</div>
@endif
    <div class="row text-center text-lg-center">

        @foreach($gallery as $item)
        <div class="col-lg-3 col-md-4 col-xs-6">
            <a href="{{$item->src}}" class="d-block mb-4 h-100" data-lightbox="roadtrip">
                <img class="img-fluid img-thumbnail" src="{{$item->src}}" alt="">
            </a>
        </div>
        @endforeach
    </div>