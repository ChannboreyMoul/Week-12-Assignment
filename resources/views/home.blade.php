@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    {{ __('Todo List Items') }}
                </div>

                <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ url('/todos') }}" class="row" method="POST">
                            @csrf
                            <div class="col-9">
                                <input type="text" class="form-control " name="task" placeholder="Add new task">
                            </div>
                            <div class="col-3">
                                <button class="btn btn-primary " type="submit">Save</button>
                            </div>
                        </form>
                    <hr>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <!-- <div class="container-xl"> -->
                    <div class="table-responsive">
                        <div class="table-wrapper">
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Todo Items <i class="fa fa-sort"></i></th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($todos as $todo)
                                        <tr>
                                            <td>{{ $todo->id }}</td>
                                            <td>{{ $todo->task }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $loop->index }}" aria-expanded="false">
                                                    Edit
                                                </button>
                                                <form action="{{ url('todos/'.$todo->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                                </form>

                                                <div class="collapse mt-2" id="collapse-{{ $loop->index }}">
                                                    <div class="card card-body">
                                                        <form action="{{ url('todos/'.$todo->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="text" name="task" value="{{ $todo->task }}">
                                                            <button class="btn btn-secondary btn-sm" type="submit">Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        
                        </div>
                    </div>  
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>
@endsection
