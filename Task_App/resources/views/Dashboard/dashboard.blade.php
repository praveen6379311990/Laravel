@extends('index.index')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@section('main')
    <?php
    $userCount = 0;
    $taskCount = 0;
    $taskCompleted = 0;

    if ($role == 'admin') {
        foreach ($allTask as $task) {
            $taskCount++;

            if ($task->processOfWork == 'completed') {
                $taskCompleted++;
            }
        }
    } elseif ($role == 'user') {
        foreach ($tasks as $task) {
            $taskCount++;

            if ($task->processOfWork == 'completed') {
                $taskCompleted++;
            }
        }
    }

    ?>

    <div class="container">
        @if ($role == 'admin')
            <?php
            foreach ($allUser as $user) {
                $userCount++;
            }
            ?>
            <div class="userss">
                <p>Total Users</p>
                <span>{{ $userCount }}</span>
            </div>
        @endif
        <div class="tasks">
            <p>Total Tasks</p>
            <span>{{ $taskCount }}</span>
        </div>
        <div class="completed">
            <p>Completed</p>
            <span>{{ $taskCompleted }}</span>
        </div>
    </div>
@endsection
