@extends('auth.layouts')

@section('content')

<form action="{{ route('dashboard') }}" method="GET">
    @csrf
    <button type="submit" class="btn btn-secondary btn-sm back-button">Back</button>
</form>
<!-- start section portfolios -->
<div id="portfolios" class="text-left paddsection">

    <div class="section-heading text-center">
        <h2>Portfolios</h2>
    </div>
    <div class="d-flex justify-content-end">
        <form action="{{ route('ApiCreateGallery') }}" method="GET">
            @csrf
            <button type="submit" class="btn btn-primary btn-sm edit-button">Tambah Porto</button>
        </form>
    </div>
    
    <div class="container" style="margin-top: 80px;">
        <div class="portfolio-block">
            <div class="row">
                @foreach ($data as $post)
                    <div class="card-portfolios" style="width: 390px; margin: 10px 20px">
                        <a href="{{ asset('storage/posts_image/' . $post->picture) }}" data-lightbox="gallery">
                            <img src="{{ asset('storage/posts_image/' . $post->picture) }}" class="card-img-top" style="width:375px; height:235px" alt="Portfolio Image">
                        </a>							
                        <div class="card-body" style="margin-top: 10px;">
                            <h5 class="card-title"><a href="{{ $post->link }}" style="color: black">{{ $post->title }}</a></h5>
                            <p class="card-text">{{ $post->description }}</p>
                        </div>
                        <div class="d-flex justify-content-end">
                            <form action="{{ route('editPorto', ['id' => $post->id]) }}" method="GET" class="m-2">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm edit-button">Edit</button>
                                </form>							
                            <form action="{{ route('deletePorto', $post->id) }}" method="POST"class="m-2">
                                @csrf
                                @method('DELETE') 
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                        
                        
                    </div>
                    
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
<!-- End section journal -->