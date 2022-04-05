<div>
    <div id="imagesCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset($img) }}" class="img" alt="Product Image" id="current">
            </div>
            @forelse (json_decode($productos) as $k => $image)
            <div class="carousel-item">
                <img src="{{ $image }}" class="img" alt="Product Image" id="current">
            </div>
           
            @empty

            @endforelse
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#imagesCarousel"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon btn-primary rounded"
                aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#imagesCarousel"
            data-bs-slide="next">
            <span class="carousel-control-next-icon btn-primary rounded"
                aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
