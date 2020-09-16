@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-itme-center">
                            <h2>{{$question->title}}</h2>
                            <div class="ml-auto">
                                <a href="{{ route('question.index')}}" class="btn btn-outline-secondary">Back To All Questions</a>
                            </div>
                        </div>
                    </div>
                    <hr>
    
                    <div class="media">
                        @include('shared._vote',[
                            'model' => $question
                        ])
                        <div class="media-body">
                            {!! $question->body_html !!}
                            <div class="float-right">
                                @include('shared._author',[
                                    'model' => $question,
                                    'label' => 'Asked'
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('answers._index',[
        'answerCount'   => $question->answers_count,
        'answers'       => $question->answers
    ])

    @include('answers._create')
</div>
@endsection
