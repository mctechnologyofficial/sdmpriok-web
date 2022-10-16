{{-- <div class="carousel slide carousel-fade" data-ride="carousel" id="carouselExample1">
    <ol class="carousel-indicators">
        @foreach ($home as $slider)
            @if ($slider->type == "Slider Picture" && $slider->row == "Row 1")
                <li class="active" data-slide-to="{{ $slider->id }}" data-target="#carouselExample1"></li>
            @endif
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach ($home as $key => $slider1)
            @if ($slider1->type == "Slider Picture" && $slider1->row == "Row 1")
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img alt="img" class="d-block w-100" src="{{ Storage::url($slider1->image) }}">
                </div>
            @endif
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExample1" role="button" data-slide="prev">
        <i class="fa fa-angle-left fs-30" aria-hidden="true"></i>
    </a>
    <a class="carousel-control-next" href="#carouselExample1" role="button" data-slide="next">
        <i class="fa fa-angle-right fs-30" aria-hidden="true"></i>
    </a>
</div> --}}

<div class="slider">
    @foreach ($slide as $slider1)
        @if ($slider1->type == "Slider Picture" && $slider1->row == "Row 1")
            <div class="m-2">
                <img alt="img" class="d-block w-100 rounded" src="{{ Storage::url($slider1->image) }}">
            </div>
        @endif
    @endforeach
</div>
