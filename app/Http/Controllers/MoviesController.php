<?php

namespace App\Http\Controllers;

use App\ViewModels\MovieViewModel;
use App\ViewModels\MovieViewModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    public function index()
    {

        $popularMovies = Http::withToken(config('services.tmdb.tokens'))
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json()['results'];

        $nowPlayings =  Http::withToken(config('services.tmdb.tokens'))
            ->get('https://api.themoviedb.org/3/movie/now_playing')
            ->json()['results'];

        $genres =  Http::withToken(config('services.tmdb.tokens'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        
        // dd($nowPlaying);
        // return view('index', [
        //     'popular_movies' => $popularMovies,
        //     'genres' => $genres,
        //     'nowPlaying' => $nowPlaying,
        // ]);

        $viewModel = new MovieViewModel(
            $popularMovies,
            $nowPlayings,
            $genres,
        );

        return view('index',$viewModel);
    }

    public function show($id)
    {
        $movie = Http::withToken(config('services.tmdb.tokens'))
            ->get('https://api.themoviedb.org/3/movie/' . $id . '?append_to_response=credits,videos,images')
            ->json();

       

        // dd($movie);

        // return view('show', [
        //     'movie' => $movie,
           
        // ]);

        $viewModel = new MovieViewModels(
           $movie
        );

        return view('show',$viewModel);
    }
}
