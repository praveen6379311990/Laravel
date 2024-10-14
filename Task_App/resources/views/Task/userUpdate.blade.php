@extends('index.index')
<link rel="stylesheet" href="{{ asset('css/userUpdate.css') }}">
@section('main')
    <div class="updateTask">
        <h2>Update Status of Task</h2>
        @foreach ($idTasks as $idTask)
            <li>{{ $idTask->taskname }}</li>
            <li>{{ $idTask->description }}</li>
            <li>{{ $idTask->date }}</li>
            <li>{{ $idTask->priority }}</li>
            <li>{{ $idTask->assignTask }}</li>
            <form action="/updateduserTask/{{ $idTask->id }}" method="POST" id="taskForm">
                @csrf
                <label for="processOfWork">Process Of Work</label>
                <select name="processOfWork" id="processOfWork" required>
                    <option value="">None</option>
                    <option value="inProcess" {{ $idTask->processOfWork == 'inProcess' ? 'selected' : '' }}>In Process
                    </option>
                    <option value="completed" {{ $idTask->processOfWork == 'completed' ? 'selected' : '' }}>Completed
                    </option>
                </select>
                <button type="submit" name="submit">Submit</button>
            </form>
        @endforeach
    </div>
@endsection
