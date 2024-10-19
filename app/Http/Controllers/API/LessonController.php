<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Middleware;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Resources\Lesson as LessonResource;


class LessonController extends Controller
{

    public static function middleware(): array
    {
      return [
      new Middleware(middleware:'auth:api',except:['index','show']),
      ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit =$request->input('limit') <= 50 ? $request->input('limit') :15;
        $lesson = LessonResource::collection(Lesson::paginate($limit));
        return $lesson->response()->setStatusCode(200, "Lesson Returned Succefully");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lesson = new LessonResource( Lesson::create($request->all()));
        return $lesson->response()->setStatusCode(200);  
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lesson = new LessonResource(Lesson::findOrfail($id));
        return $lesson->response()->setStatusCode(200, "Lesson Returned Succefully")
        ->header('Additional Header', 'Ture');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $idlesson = Lesson::findOrFail($id);
        $this->authorize('update', $idlesson);
        $user = new LessonResource(Lesson::findOrfaill($id));
        $user->update($request->all());

        return $user->response()->setStatusCode(200, "Lesson Updated Succefully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $idlesson = Lesson::findOrFail($id);
        $this->authorize('delete', $idlesson);
        lesson::findOrfail($id)->delete;
        return 204;
    }
}
