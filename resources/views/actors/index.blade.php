@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16 py-8">
        <div class="popular-actors">
            <h2 class="uppercase tracking-wider text-yellow-100 text-lg font-semibold">
                Popular Actors
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularActors as $actor)


                    <div class="actor mt-8">
                        <a href="{{route('actors.show', $actor['id'])}}">
                            <img src="{{ $actor['profile_path'] }}" alt="">
                        </a>
                        <div class="mt-2">
                            <a href="{{route('actors.show', $actor['id'])}}">
                                {{ $actor['name'] }}
                            </a>
                            <div class="text-sm truncate text-gray-400">
                                {{ $actor['known_for'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="page-load-status">
            <p class="infinite-scroll-request spinner my-8 text-4xl">&nbsp;</p>
            <p class="infinite-scroll-last">End of content</p>
            <p class="infinite-scroll-error">No more pages to load</p>
        </div>
        {{-- <div class="flex justify-betweem mt-16">
            @if ($previouss)
                <a href="/actors/page/{{ $previouss }}" class="mr-4">Previous</a>
            @endif
            @if ($next)
                <a href="/actors/page/{{ $next }}">Next</a>
            @endif
        </div> --}}
    </div>
@endsection
@section('scripts')
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        let elem = document.querySelector('.grid');
        let infScroll = new InfiniteScroll(elem, {
            // options
            path: '/actors/page/@{{#}}',
            append: '.actor',
            history: false,
            status: '.page-load-status',
        });

        

    </script>

@endsection
