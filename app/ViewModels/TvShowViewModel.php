<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    public $tv;
    public function __construct($tv)
    {
        $this->tv = $tv;
    }

    public function tv()
    {
        return collect($this->tv)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $this->tv['poster_path'],
            'vote_average' => $this->tv['vote_average'] * 10 . '%',
            'first_air_date' => $this->tv['first_air_date'],
            'genres' => collect($this->tv['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->tv['credits']['crew'])->take(4),
            'cast' => collect($this->tv['credits']['cast'])->take(10),
            'images' => collect($this->tv['images']['backdrops'])->take(10),
        ]);
    }
}
