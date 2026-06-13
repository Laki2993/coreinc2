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
    <section class="exit_form_container">
        <button id="exit"></button>
    </section>
    <input class="input" type="text" name="task_title" placeholder="project title" required>
    <textarea class="input" name="task_description" placeholder="project description"></textarea>
    <button  class="btn_create" id="btn_create" type="submit">Create task</button>
</form>
    </dialog>
    <header>
        <section class="header_container">
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
    <aside class="project_setting">
        <section class="project_info">
        <p class="project_setting_name">{{ $projects->title }}</p>    
        <img class="project_setting_icon" src="{{ asset('projectboard/setting_white.svg') }}" alt="">
        </section>     
        <section class="project_setting_container">
            <img class="project_setting_img" src="{{ Storage::url($projects->user->avatar)}}" alt="">
            <article class="project_setting_info">
                <article class="project_admin_info">
                    <h2 class="project_info_title">Admin:</h2>
                    <p class="project_admin_name">{{$projects->user->name}}</p>
                </article>
                <p class="project_create">project created at: {{ $projects->created_at->format('d.m.Y') }}</p>
            </article>
        </section>
        <section class="project_setting_description">
            <h2 class="project_info_title">project description:</h2>
            <p class="project_info_description">{{ $projects->description }}</p>
        </section>
        <section class="project_setting_member">
            <h2 class="project_info_title">members:</h2>
            @foreach ( $projects->users as $member )
            <section class="project_member_info">
                <article class="prtoject_member_date">
                    <img class="project_member_img" src="{{ Storage::url($member->avatar) }}" alt="">
                    <p class="project_member_name">{{ $member->name }}</p>
                </article>
                <article class="project_member_date">
                    <p class="project_member_role">{{ $member->pivot->role }}</p>
                    <p class="project_member_time">{{ $member->pivot->created_at->format('d.m.Y') }}</p>
                </article>
            </section>
            
            @endforeach
        </section>
        <h3 class="project_setting_id">project id : {{ $projects->unique_id }}</h3>       
    </aside>
    <section class="workspace">

        <section class="section_answer">
            @if(session('error'))
            <div class="alert">
                {{ session('error') }}
            </div>
            @endif
            
            @if(session('success'))
            <div class="alert">
                {{ session('success') }}
                <img class="alert_icon" src="{{ asset('projectboard/pencil.svg') }}" alt="">
            </div>
            @endif

            @if(isset($enterMessage))
                <div class="alert">
                    {{ $enterMessage}} {{ $projects->title }}
                </div>
            @endif
        </section>
    <section class="tasks_To-do-list">
        @forelse ($projects->tasks as $task)
            <section class="task_container">
                <article class="task_info">
                    <strong class="task_title">{{ $task->title }}</strong>
                    <p class="task_description">{{ $task->description }}</p>
                </article>
                <section class="bar_info">
                    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="tool_bar" type="submit"></button>
                    </form>
                    </section>
            </section>
        @empty
            <p class="task_text_default">There are no tasks yet</p>
        @endforelse
    </section>
    </section>
</main>
<section class="tool_bar_container">
    <nav class="nav_tool_bar">
        <button id="settings" class="settings"></button>
        <button id="create_task" ></button>
        <button id="create_chat"></button>
        <button id="exit_project" class="exit_project" onclick="window.location.href = '{{ route('dashboard') }}'"></button>
    </nav>
</section>
<script>
    let setting_flag = false;
    document.getElementById('settings').addEventListener('click', function() {
        if(setting_flag == false) {
            document.getElementById('settings').classList = 'settings_invers';
            document.querySelector('.project_setting_icon').classList = 'project_setting_icon_anim';
            document.querySelector('.project_setting').style.width = '30%';
            setting_flag = true;
        }
        else {
            document.getElementById('settings').classList = 'settings';
            document.querySelector('.project_setting_icon_anim').classList = 'project_setting_icon';
            document.querySelector('.project_setting').style.width = '0%';
            setting_flag = false;
        }
    });
        document.getElementById('header_user_data').addEventListener('click', function() {
            window.location.href = '/profile';
        });
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

        setTimeout(function(){
            document.querySelector('.alert').remove();
        }, 3000);


    document.getElementById('exit').addEventListener('click', function() {
        document.getElementById("dialog").style.display = "none";
        modal = true;
    });

document.querySelectorAll('.tool_bar').forEach(button => {
    button.addEventListener('click', function(event) {
        let currentButton = this;
        
        let taskContainer = this.closest('.task_container');
        
        let title = taskContainer.querySelector('.task_title').innerText;
        let description = taskContainer.querySelector('.task_description').innerText;
        
        console.log('Нажата кнопка для задачи:', title);
        console.log('Описание:', description);
        
    });
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