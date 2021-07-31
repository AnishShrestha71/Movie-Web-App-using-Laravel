<?php

namespace App\Http\Controllers;

use App\ViewModels\ActorsViewModel;
use App\ViewModels\ActorViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    protected function index($page = 1)
    {
        $popularActors = Http::withToken(config('services.tmdb.tokens'))
            ->get('https://api.themoviedb.org/3/person/popular?page=' . $page)
            ->json()['results'];

        $viewModel = new ActorViewModel($popularActors, $page);

        return view('actors.index', $viewModel);
    }
    protected function show($id)
    {
        $actor = Http::withToken(config('services.tmdb.tokens'))
            ->get('https://api.themoviedb.org/3/person/' . $id)
            ->json();

        $social = Http::withToken(config('services.tmdb.tokens'))
            ->get('https://api.themoviedb.org/3/person/' . $id . '/external_ids')
            ->json();

        $credits = Http::withToken(config('services.tmdb.tokens'))
        ->get('https://api.themoviedb.org/3/person/' . $id . '/combined_credits')
        ->json();
        $viewModel = new ActorsViewModel($actor, $social, $credits);
        return view('actors.show', $viewModel);
    }
}
