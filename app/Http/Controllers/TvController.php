<?php

namespace App\Http\Controllers;

use App\ViewModels\TvShowViewModel;
use App\ViewModels\TvViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    public function index()
    {
        $popularTV = Http::withToken(config('services.tmdb.tokens'))
            ->get('https://api.themoviedb.org/3/tv/popular')
            ->json()['results'];

        $topRatedTV =  Http::withToken(config('services.tmdb.tokens'))
            ->get('https://api.themoviedb.org/3/tv/top_rated')
            ->json()['results'];

        $genres =  Http::withToken(config('services.tmdb.tokens'))
            ->get('https://api.themoviedb.org/3/genre/tv/list')
            ->json()['genres'];

        $viewModel = new TvViewModel(
            $popularTV,
            $topRatedTV,
            $genres,
        );

        return view('tv.index', $viewModel);
    }

    public function show($id)
    {
        $tv = Http::withToken(config('services.tmdb.tokens'))
            ->get('https://api.themoviedb.org/3/tv/' . $id . '?append_to_response=credits,videos,images')
            ->json();

        $viewModel = new TvShowViewModel(
            $tv
        );

        return view('tv.show', $viewModel);
    }
}
