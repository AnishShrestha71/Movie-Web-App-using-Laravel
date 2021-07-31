<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $popularMovies;
    public $nowPlaying;
    public $genres;
    public function __construct($popularMovies, $nowPlayingMovies, $genres)
    {

        $this->popularMovies = $popularMovies;
        $this->nowPlaying = $nowPlayingMovies;
        $this->genres = $genres;
    }
    public function popularMovies()
    {
        return $this->formatMovies($this->popularMovies);
    }
    public function nowPlayingMovies()
    {
        return $this->formatMovies($this->nowPlaying);
    }

    public function genresss()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }
    private function formatMovies($movie)
    {


        return collect($movie)->map(function ($movies) {
            $genresFormatted = collect($movies['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genresss()->get($value)];
            })->implode(', ');
            if (isset($movie['release_date'])) {
                $releaseDate = $movie['release_date'];
            } elseif (isset($movie['first_air_date'])) {
                $releaseDate = $movie['first_air_date'];
            } else {
                $releaseDate = '';
            }
            
            return collect($movies)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $movies['poster_path'],
                'vote_average' => $movies['vote_average'] * 10 . '%',
                'release_date' => Carbon::parse($releaseDate)->format('M d, Y'),
                'genres' => $genresFormatted,
            ]);
        });
    }
}
