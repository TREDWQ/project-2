<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\lesson;
use App\Models\Tag;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RelationshipController extends Controller
{
    public function userLessons($id)
    {
        $user = User::findOrFail($id)->lessons;
        $fields = array();
        $filtered = array();
        foreach ($user as $lesson) {
            $fields['Title'] = $lesson->title;
            $fields['Content'] = $lesson->body;
            $filtered[] = $fields;
        }

        return new JsonResponse([
            'data' => $filtered
        ],200);
    }
    public function lessonTags($id)
    {
        $lesson = Lesson::findOrFail($id)->tags;
        $fields = array();
        $filtered = array();
        foreach ($lesson as $tag) {
            $fields['Tag'] = $tag->name;
            $filtered[] = $fields;
        }

        return new JsonResponse([
            'data' => $filtered
        ],200);
    }


    public function tagLessons($id)
    {
        $tag = Tag::findOrFail($id)->lessons;
        $fields = array();
        $filtered = array();
        foreach ($tag as $lesson) {
            $fields['Title'] = $lesson->title;
            $fields['Content'] = $lesson->body;
            $filtered[] = $fields;
        }

        return new JsonResponse([
            'data' => $filtered
        ],200);
    }
    }


