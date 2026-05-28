<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $projects->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/project.css') }}">
</head>
<body>
    <dialog id="dialog">
<form method="POST" class="form_create" action="{{ route('projectboard.createtask', $projects->unique_id) }}">
    @csrf
    <button id="exit">exit</button>
    <input class="input" type="text" name="task_title" placeholder="Название задачи" required>
    <textarea class="input" name="task_description" placeholder="Описание"></textarea>
    <button  class="btn_create" type="submit">Создать задачу</button>
</form>
    </dialog>
    <header>
        <section class="header_container">
            <p>tesdsdsdasascascsacsdst</p>
            <img class="header_logo" src="{{ asset('welcome\logo_core_header.svg') }}" alt="">
                <nav class="header_navigation">
                        <a class="header_link" href="{{ url('/dashboard') }}">main</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="header_link" :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('log out') }}
                            </a>
                        </form>
                        <section class="header_user_data" id="header_user_data">
                            <p class="header_user_name">{{ (Auth::user()->name) }}</p>
                            <img class="header_img_user" src="{{ Storage::url(Auth::user()->avatar)}}" alt="avatar">
                        </section>
                    </nav>
        </section>
    </header>
<main>
<section class="tasks_To-do-list">
    @forelse ($projects->tasks as $task)
        <section class="task_container">
            <strong class="task_title">{{ $task->title }}</strong>
            <p class="task_description">{{ $task->description }}</p>
        </section>
    @empty
        <p>Задач пока нет</p>
    @endforelse
</section>
</main>
<section class="tool_bar_container">
    <nav class="nav_tool_bar">
        <button id="create_task"></button>
    </nav>
</section>
<script>
    document.getElementById('create_task').addEventListener('click', function() {
        let modal = false;
        if(modal == false) {
            document.getElementById("dialog").style.display = "flex";
            modal = true;
        }
        else{
            document.getElementById("dialog").style.display = "none";
            modal = true;
        }
    })

    document.getElementById('exit').addEventListener('click', function() {
        document.getElementById("dialog").style.display = "none";
        modal = true;
    });
</script>
</body>
</html>


           <!-- <article class="card">
                <strong>{1{$projects->title}}</strong>
                <article class="project_bar">
                    <p>Администратор:{1{$projects->user->name}}</p>
                    1@foreach ($projects->users as $user) 
                    <section class="users_tables">
                        <p>
                            {1{ $user->name }}
                        </p> 
                        </section>
                       1@endforeach
                </article>
            </article>