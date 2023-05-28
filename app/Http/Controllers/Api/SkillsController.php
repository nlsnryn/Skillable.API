<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSkillsRequest;

class SkillsController extends Controller
{
    public function index() {
        $skills = Skill::where('user_id', auth()->user()->id)->get();

        return response()->json($skills);
    }

    public function store(Request $request) {
        $request->validate([
            'technology' => 'required|max:255',
            'skill' => 'unique:skills,skill,NULL,id,user_id,' . auth()->user()->id,
        ]);

        $skill = Skill::create([
            'user_id' => auth()->user()->id,
            'technology' => $request->technology,
            'skill' => $request->skill
        ]);
        return response()->json([
            'skill' => $skill,
        ]);
    }

    public function update(Request $request, Skill $skill) {
        if($skill->user_id !== auth()->user()->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $request->validate([
            'technology' => 'required|max:255',
            'skill' => 'unique:skills,skill,NULL,id,user_id,' . auth()->user()->id,
        ]);

        $skill->update([
            'technology' => $request->technology,
            'skill' => $request->skill
        ]);

        return response()->json($skill);
    }

    public function show(Skill $skill) {
        if($skill->user_id !== auth()->user()->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        return response()->json($skill);
    }

    public function destroy(Skill $skill) {
        if($skill->user_id !== auth()->user()->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $skill->delete();

        return response()->json('Successfully deleted.');
    }
}
