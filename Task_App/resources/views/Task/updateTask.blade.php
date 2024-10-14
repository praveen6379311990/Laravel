@extends('index.index')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<link rel="stylesheet" href="{{ asset('css/updateTask.css') }}">
@section('main')
    <div class="updateTask">
        <h2>Edit Task</h2>
        @foreach ($idTasks as $idTask)
            <form action="/updatedTask/{{ $idTask->id }}" method="POST" id="taskForm">
                @csrf

                <label for="taskname">Task Name</label>
                <input type="text" name="taskname" placeholder="Enter your Task Name" value={{ $idTask->taskname }}
                    required>
                <div class="editor-container">
                    <div class="toolbar">
                        <button type="button" onclick="document.execCommand('bold', false, '')"><i
                                class="fas fa-bold"></i></button>
                        <button type="button" onclick="document.execCommand('italic', false, '')"><i
                                class="fas fa-italic"></i></button>
                        <button type="button" onclick="document.execCommand('underline', false, '')"><i
                                class="fas fa-underline"></i></button>
                        <button type="button"
                            onclick="document.execCommand('createLink', false, prompt('Enter URL:', 'http://'))"><i
                                class="fas fa-link"></i></button>
                        <button type="button" onclick="document.execCommand('justifyLeft', false, '')"><i
                                class="fas fa-align-left"></i></button>
                        <button type="button" onclick="document.execCommand('justifyCenter', false, '')"><i
                                class="fas fa-align-center"></i></button>
                        <button type="button" onclick="document.execCommand('justifyRight', false, '')"><i
                                class="fas fa-align-right"></i></button>
                        <button type="button" onclick="document.execCommand('insertUnorderedList', false, '')"><i
                                class="fas fa-list-ul"></i></button>
                    </div>
                    <div class="divider"></div>
                    <div id="editor" contenteditable="true">
                        {{ $idTask->description }}
                    </div>
                </div>
                <input type="hidden" name="description" id="description" value=''>
                <label for="date">Date</label>
                <input type="date" name="date" id="datePicker" value={{ $idTask->date }} required>
                <label for="priority">Priority</label>
                <select name="priority" id="priority" required>
                    <option value="">None</option>
                    <option value="low" {{ $idTask->priority == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ $idTask->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ $idTask->priority == 'high' ? 'selected' : '' }}>High</option>
                </select>
                <label for="assignTask">Assign Task</label>
                <select name="assignTask" id="assignTask" required>
                    <option value="" {{ $idTask->assignTask == '' ? 'selected' : '' }}>None</option>
                    @foreach ($availableUser as $user)
                        <option value={{ $user }} {{ $idTask->assignTask == $user ? 'selected' : '' }}>
                            {{ $user }}</option>
                    @endforeach
                </select>
                <label for="processOfWork">Process Of Work</label>
                <select name="processOfWork" id="processOfWork" required>
                    <option value="">None</option>
                    <option value="inProcess"{{ $idTask->processOfWork == 'inProcess' ? 'selected' : '' }}>In Process
                    </option>
                    <option value="completed"{{ $idTask->processOfWork == 'completed' ? 'selected' : '' }}>Completed
                    </option>
                </select>
                <button type="submit" name="submit">Submit</button>
            </form>
        @endforeach
    </div>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        document.getElementById('taskForm').addEventListener('submit', function(event) {
            var editorContent = document.getElementById('editor').innerHTML;
            document.getElementById('description').value = editorContent;
        });
    });
</script>
