@extends('index.index')
<link rel="stylesheet" href="{{ asset('css/task.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@section('main')
    <div class="container">
        <h3>Manage Task</h3>
        @if ($role == 'admin')
            <div class="createUser">
                <div class="box">
                    <a class="button" href="#popup1" style="width: 100%">Add New</a>
                </div>
                <div id="popup1" class="overlay">
                    <div class="popup">
                        <h2>Add Task</h2>
                        <a class="close" href="#">&times;</a>
                        <form action="/addTasks" method="POST" id="taskForm">
                            @csrf
                            <label for="taskname">Task Name</label>
                            <input type="text" name="taskname" placeholder="Enter your Task Name" required>
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
                                    <button type="button"
                                        onclick="document.execCommand('insertUnorderedList', false, '')"><i
                                            class="fas fa-list-ul"></i></button>
                                </div>
                                <div class="divider"></div>
                                <div id="editor" contenteditable="true">
                                    Edit your text here...
                                </div>
                            </div>
                            <input type="hidden" name="description" id="description" value=''>
                            <label for="date">Date</label>
                            <input type="date" name="date" id="datePicker" value="" required>
                            <label for="priority">Priority</label>
                            <select name="priority" id="priority" required>
                                <option value="">None</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                            <label for="assignTask">Assign Task</label>
                            <select name="assignTask" id="assignTask" required>
                                <option value="">None</option>
                                @foreach ($availableUser as $user)
                                    <option value={{ $user }}>{{ $user }}</option>
                                @endforeach
                            </select>
                            <label for="processOfWork">Process Of Work</label>
                            <select name="processOfWork" id="processOfWork" required>
                                <option value="">None</option>
                                <option value="inProcess">In Process</option>
                                <option value="completed">Completed</option>
                            </select>
                            <button type="submit" name="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        <div class="task-container">
            @if ($role == 'admin')
                @foreach ($allTasks as $task)
                    <div class="task-card">
                        <div class="header">
                            <!-- three dot menu -->
                            @if ($role == 'admin')
                                <div class="dropdown">
                                    <!-- three dots -->
                                    <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown.call(this, event)">
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                    </ul>
                                    <!-- menu -->
                                    <div class="dropdown-content">
                                        <a href="{{ url('/editTask/' . $task['id']) }}">Edit</a>
                                        <a href="{{ url('/deleteTask/' . $task['id']) }}">Delete</a>
                                    </div>
                                </div>
                            @endif
                            @if ($role == 'user')
                                <div class="dropdown">
                                    <!-- three dots -->
                                    <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown.call(this, event)">
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                    </ul>
                                    <!-- menu -->
                                    <div class="dropdown-content">
                                        <a href="{{ url('/editTaskUser/' . $task['id']) }}">Edit</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="listOfTask">
                            <ul>
                                <li><strong>Status:</strong> <span class="task-status">{{ $task['processOfWork'] }}</span>
                                </li>
                                <li><strong>Assigned To:</strong> <span class="task-assign">{{ $task['assignTask'] }}</span>
                                </li>
                                <li><strong>Date:</strong> <span class="task-date">{{ $task['date'] }}</span></li>
                                <li><strong>Task Name:</strong> <span class="task-name">{{ $task['taskname'] }}</span></li>
                                <li><strong>Priority:</strong> <span class="task-priority">{{ $task['priority'] }}</span>
                                </li>
                                <li><strong>Description:</strong> <span
                                        class="task-description">{{ $task['description'] }}</span></li>
                            </ul>
                        </div>

                    </div>
                @endforeach
            @elseif ($role == 'user')
                @foreach ($tasks as $task)
                    <div class="task-card">
                        <div class="header">
                            <!-- three dot menu -->
                            @if ($role == 'admin')
                                <div class="dropdown">
                                    <!-- three dots -->
                                    <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown.call(this, event)">
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                    </ul>
                                    <!-- menu -->
                                    <div class="dropdown-content">
                                        <a href="{{ url('/editTask/' . $task['id']) }}">Edit</a>
                                        <a href="{{ url('/deleteTask/' . $task['id']) }}">Delete</a>
                                    </div>
                                </div>
                            @endif
                            @if ($role == 'user')
                                <div class="dropdown">
                                    <!-- three dots -->
                                    <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown.call(this, event)">
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                    </ul>
                                    <!-- menu -->
                                    <div class="dropdown-content">
                                        <a href="{{ url('/editTaskUser/' . $task['id']) }}">Edit</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="listOfTask">
                            <ul>
                                <li><strong>Status:</strong> <span class="task-status">{{ $task['processOfWork'] }}</span>
                                </li>
                                <li><strong>Assigned To:</strong> <span
                                        class="task-assign">{{ $task['assignTask'] }}</span>
                                </li>
                                <li><strong>Date:</strong> <span class="task-date">{{ $task['date'] }}</span></li>
                                <li><strong>Task Name:</strong> <span class="task-name">{{ $task['taskname'] }}</span>
                                </li>
                                <li><strong>Priority:</strong> <span class="task-priority">{{ $task['priority'] }}</span>
                                </li>
                                <li><strong>Description:</strong> <span
                                        class="task-description">{{ $task['description'] }}</span></li>
                            </ul>
                        </div>

                    </div>
                @endforeach
            @endif

        </div>
    </div>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        document.getElementById('datePicker').valueAsDate = new Date();

        document.getElementById('taskForm').addEventListener('submit', function(event) {
            var editorContent = document.getElementById('editor').innerHTML;
            document.getElementById('description').value = editorContent;
        });
    });

    function toggleOptions(button) {
        const options = button.nextElementSibling;
        options.style.display = options.style.display === 'none' || options.style.display === '' ? 'block' :
            'none';
    }

    function showDropdown(event) {
        event.stopPropagation();

        var dropdown = this.parentElement.querySelector(".dropdown-content");

        var allDropdowns = document.querySelectorAll(".dropdown-content");
        allDropdowns.forEach(function(d) {
            if (d !== dropdown) {
                d.classList.remove("show");
            }
        });

        dropdown.classList.toggle("show");
    }

    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>
