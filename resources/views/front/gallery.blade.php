@extends('layouts.front_app')
@section('content')
<section>
    <div class="container-fluid">
         <div class="gallery">
            <div class="grid-container">
                @forelse ($gallery as $key => $img)
                    <div>
                        <img class='grid-item grid-item-{{ $key+1 }}' src="{{ asset('uploads/gallery/'.$img->image) }}" alt=''>
                    </div>
                @empty
                    <div class="text-center">
                        <h4>No Data Found.</h4>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
