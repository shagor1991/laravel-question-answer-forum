<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests\AskQuestionRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions= Question::with('user')->latest()->paginate(5);
        return view('questions.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions= new Question();
        return view('questions.create',compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {        
        $request->user()->questions()->create($request->only('title','body'));

        return redirect()->route('question.index')->with('success','Your question has been submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        // $question= Question::findOrFail($id);
        $question->increment('views',1);

        return view('questions.show',compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $question= Question::findOrFail($id);
        $this->authorize('update', $question);
        return view('questions.edit',compact('question'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, $id)
    {
        $question= Question::findOrFail($id);
        if(\Gate::denies('update-question',$question)){
            abort(403,'Access Denied');
        }

        $question->update($request->only('title','body'));
        return redirect()->route('question.index')->with('success','Your question has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question= Question::findOrFail($id);
        if(\Gate::denies('delete-question',$question)){
            abort(403,'Access Denied');
        }

        $question->delete();
        return redirect()->route('question.index')->with('success','Your question has been deleted!');
          
    }
}
