<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Response;

class SurveyController extends Controller
{
    public function index()
    {
        $survey = Survey::firstOrCreate(['title' => 'Encuesta de Satisfacción']);
        $responses = $survey->responses()->get();
        return view('surveys.index', compact('survey', 'responses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'q1' => 'required|string',
            'q2' => 'required|string',
            'q3' => 'required|string',
            'q4' => 'required|string',
            'q5' => 'required|string',
        ]);

        Response::create([
            'survey_id' => 1,
            'user_name' => $request->user_name,
            'q1' => $request->q1,
            'q2' => $request->q2,
            'q3' => $request->q3,
            'q4' => $request->q4,
            'q5' => $request->q5,
        ]);

        return redirect()->route('surveys.index')->with('success', 'Respuesta guardada');
    }
}