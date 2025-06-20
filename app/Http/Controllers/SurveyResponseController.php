<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\SurveyResponse;

class SurveyResponseController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'survey_id'    => 'required|integer|exists:surveys,id',
            'user_id'      => 'required|integer|exists:users,id',
            'name'         => 'required|string',
            'location'     => 'required|array',
            'audio_file'   => 'required|file|mimes:mp3,wav,ogg',
            'verification' => 'nullable|string',
            'verified_by'  => 'nullable|integer',
            'father_name'  => 'nullable|string',
            'address'      => 'nullable|string',
            'state'        => 'nullable|string',
            'city'         => 'nullable|string',
            'block'        => 'nullable|string',
            'pincode'      => 'nullable|string|max:6',
            'answers'      => 'required|array',
            'answers.*.question' => 'required|string',
            'answers.*.answer'   => 'required|string',
        ]);

        if ($request->hasFile('audio_file')) {
            $file = $request->file('audio_file');
            $path = $file->store('audio_files', 'public');
            $validated['audio_file'] = $path;
        }

        $validated['location'] = json_encode($validated['location']);

        $response = SurveyResponse::create($validated);

        foreach ($request->input('answers') as $item) {
            Answer::create([
                'survey_response_id' => $response->id,
                'question' => $item['question'],
                'answer' => $item['answer'],
                'ai_answer' => '',
            ]);
        }

        return response()->json([
            'message' => 'Survey response saved successfully.',
            'data' => $response
        ]);
    }
}
