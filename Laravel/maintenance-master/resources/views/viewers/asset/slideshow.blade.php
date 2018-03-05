@if($asset->images->count() > 0)

    <div class="col-md-8">
        <div id="asset-image-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @if($asset->images->count() > 1)
                    @foreach($asset->images as $image)
                        @if($asset->images->first()->id == $image->id)
                            <li data-target="#asset-image-carousel" class="active"></li>
                        @else
                            <li data-target="#asset-image-carousel"></li>
                        @endif
                    @endforeach
                @endif
            </ol>
            <div class="carousel-inner">
                @foreach($asset->images as $image)
                    <div class="item @if($asset->images->first()->id == $image->id) active @endif">
                        <img class="img-responsive img-center"
                             src="{{ route('maintenance.assets.images.download', [$asset->id, $image->id]) }}">
                    </div>
                @endforeach
            </div>
            @if($asset->images->count() > 1)
                <a class="left carousel-control" href="#asset-image-carousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#asset-image-carousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            @endif
        </div>
    </div>

@else
    <h5>There are no asset images to display.</h5>
@endif
