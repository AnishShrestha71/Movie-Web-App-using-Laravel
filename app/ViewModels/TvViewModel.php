<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $popularTV;
    public $topRatedTV;
    public $genres;

    public function __construct($popularTV, $topRatedTV, $genres)
    {

        $this->popularTV = $popularTV;
        $this->topRatedTV = $topRatedTV;
        $this->genres = $genres;
    }
    public function popularTv()
    {
        return $this->formatMovies($this->popularTV);
    }
    public function topRatedTv()
    {
        return $this->formatMovies($this->topRatedTV);
    }

    public function genresss()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }
    private function formatMovies($tv)
    {


        return collect($tv)->map(function ($tvshows) {
            $genresFormatted = collect($tvshows['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genresss()->get($value)];
            })->implode(', ');
            if (isset($tvshows['first_air_date'])) {
                $releaseDate = $tvshows['first_air_date'];
            } elseif (isset($tvshows['first_air_date'])) {
                $releaseDate = $tvshows['first_air_date'];
            } else {
                $releaseDate = '';
            }
            
            return collect($tvshows)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $tvshows['poster_path'],
                'vote_average' => $tvshows['vote_average'] * 10 . '%',
                'release_date' => Carbon::parse($releaseDate)->format('M d, Y'),
                'genres' => $genresFormatted,
            ]);
        });
    }
}
