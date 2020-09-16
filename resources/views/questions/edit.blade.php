@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-itme-center">
                        <h2>Update Question</h2>
                        <div class="ml-auto">
                            <a href="{{ route('question.index')}}" class="btn btn-outline-secondary">Back To All Questions</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('question.update',$question->id) }}" method="post">
                        @method('put')
                        @include('questions._form',['btn_text'=>'Update Question'])
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
