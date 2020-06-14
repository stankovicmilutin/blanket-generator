@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Dashboard</h4>
                            <p class="card-category">Latest 15 blankets</p>
                        </div>

                        <div class="col-6 text-right">
                            <a class="btn btn-primary" href="{{ route('blankets.create') }}">Create new blanket</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Module</th>
                            <th>Course</th>
                            <th>Exam date</th>
                            <th>Created at</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($blankets as $blanket)
                            <tr>
                                <td>{{ $blanket->id }}</td>
                                <td>{{ $blanket->template->course->module->name }}</td>
                                <td>{{ $blanket->template->course->name }}</td>
                                <td>{{ $blanket->date->format('d.m.Y') }}</td>
                                <td>{{ $blanket->created_at->format('d.m.Y') }}</td>
                                <td>
                                    <a href="/blankets/{{ $blanket->id }}"><button class="btn btn-sm btn-primary">
                                            <i class="fa fa-eye"></i>View</button></a>

                                    @if ($blanket->file_path)
                                        <a href="{{ $blanket->file_path }}" target="_blank">
                                            <button class="btn btn-sm btn-danger"><i class="fa fa-file-pdf-o"></i>PDF</button>
                                        </a>
                                    @else
                                        PDF not generated
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
