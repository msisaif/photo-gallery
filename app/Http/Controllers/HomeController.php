<?php

namespace App\Http\Controllers;

use App\Http\Resources\PhotoResource;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if(! $request->flag === true) {
            return Inertia::render('Home/Index');
        }

        $search = $request->search;

        $photos = Photo::query()
            ->when($search, function ($query, $search) {
                $query->where('link', 'regexp', str_replace(' ', '|', $search));
            })
            // ->inRandomOrder()
            ->whereNotNull('link')
            ->paginate(12);

        return PhotoResource::collection($photos);
    }
}
