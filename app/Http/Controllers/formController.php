<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\episode;
use App\Models\formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class formController extends Controller
{
    public function index(){
       $form = formation::with('user')
       ->select('formations.*', DB::raw(
           '(SELECT COUNT(DISTINCT(user_id))
            FROM completions
            INNER JOIN episodes ON completions.episode_id = episodes.id
            WHERE episodes.formation_id = formations.id

           ) AS participants'
       ))
       
       ->withCount('episodes')->latest()->get();
       
        return Inertia::render('Formations/Index' ,[
            'form' => $form
        ]);
    }

    public function show(int $id) {
        $forms = formation::where('id', $id)->with('episodes')->first();
        $watched = auth()->user()->episodes;

        return Inertia::render('Formations/show' ,[
            'forms' => $forms,
            'watched'=> $watched
        ]);
    }
    public function store(Request $request)
    {
        $request->validate ([
            'title'=> ['required'],
            'description'=> ['required'],
            'episodes'=> ['required','array'],
            'episodes.*.title' =>['required'],
            'episodes.*.description' =>['required'],
            'episodes.*.video_url' =>['required'],
        ]);
       $course= formation::create($request ->all());

        foreach($request->input('episodes') as $episode)
        {
            $episode['formation_id'] = $course->id;
            episode::create($episode);
        }

        return Redirect::route('dashboard')->with('message','felicitations la formation a bien ete mise en ligne');
    }

    public function edit(int $id){

        $forms = formation::where('id', $id)->with('episodes')->first();

        return Inertia::render('Formations/Edit',[
            'forms' => $forms
        ]);

        
    }

    public function update(Request $request)
    {

    $course = formation::where('id', $request->id)->with('episodes')->first();
    $this->authorize('update',$course);

     

     $course ->update($request->all());
     $course->episodes()->delete();

     foreach($request->episodes as $episode){
         $episode['formation_id'] = $course->id;
         episode::create($episode);
         
     }
     return Redirect::route('dashboard')->with('message','felicitations la formation a bien eté modifiée');

    }

    public function toggleProgress(Request $request){

       $id = $request->input('episodeId');
       $user = auth()->user();

       $user->episodes()->toggle($id);

       return $user->episodes;

    }
}
