@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 pt-16">
    <div class="popular-tv">
        <h2 class="uppercase tracking-wider text-yellow-100 text-lg font-semibold">
            Popular TV Shows
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            {{-- {{dd($popular_movies)}} --}}
            @foreach ($popularTv as $tv)
                <x-tv-card :tv="$tv" />
            @endforeach




        </div>
    </div>
    <div class="top-rated-shows mt-24">
        <h2 class="uppercase tracking-wider text-yellow-100 text-lg font-semibold">
           Top Rated Shoes
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($topRatedTv as $tv)
                <x-tv-card :tv="$tv"  />
            @endforeach

        </div>
    </div>
</div>
@endsection