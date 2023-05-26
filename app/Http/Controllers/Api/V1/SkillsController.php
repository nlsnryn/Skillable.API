<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSkillsRequest;
use App\Models\Skill;

class SkillsController extends Controller
{
    public function index() {
        $skills = Skill::all();

        return response()->json($skills);
    }

    public function store(StoreSkillsRequest $request) {
        $user = Skill::create($request->validated());
        
        return response()->json($user);
    }

    public function update(StoreSkillsRequest $request, Skill $skill) {
        $skill->update($request->validated());

        return response()->json($skill);
    }

    public function show(Skill $skill) {
        return response()->json($skill);
    }

    public function destroy(Skill $skill) {
        $skill->delete();

        return response()->json('Successfully deleted.');
    }
}
