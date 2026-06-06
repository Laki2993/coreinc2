<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>main</title>
    <link rel="stylesheet" href="{{ "css\main.css" }}">
</head>
<body>
    <header>
        <section class="header_container">
            <img class="header_logo" src="{{ asset('welcome\logo_core_header.svg') }}" alt="">
                <nav class="header_navigation">
                        <a class="header_link" href="{{ url('/dashboard') }}">main</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="header_link" :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
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
    <nav class="project_bar_nav">
        <section class="nav_container">
            <button class="btn_join" id="btn_join">join</button>
            <button class="btn_create" id="btn_create">create</button>
        </section>
    </nav>
    <section>
        <form method="POST" action="{{ route('projectboard.create') }}" class="modal_form_create" id="modal_form_create">
            @csrf
            <input class="input" type="text" name="project_title" placeholder="project name">
            <input class="input" type="text" name="project_description" placeholder="project description">
            <button class="btn_form_create" type="submit">create</button>
        </form>
        <form method="POST" action="{{ route('projectboard.join') }}" class="modal_form_create" id="modal_form_join">
            @csrf
            <input class="input" type="text" name="project_id" placeholder="project id">
            <button class="btn_form_create" type="submit">join</button>
        </form>
    </section>

    <section class="cards_container">
@foreach ($projects as $project)

    <article class="card" data-unique="{{ $project->unique_id }}">
        <strong>{{ $project->title }}</strong>
        <section class="bg_project">
           <p class="Project_marker_img">{{ $project->img }}</p>
           <article class="Project_description_container">
                <p class="Project_description_text">{{ $project->description }}</p>
           </article>
        </section>
        <article class="project_bar">
            <article class="project_bar">
                <p class="project_admin">admin - {{ $project->user->name }}</p>
                <p class="project_Date">admin - {{ $project->created_at }}</p>
            </article>
            <button class="info">•••</button>
        </article>
    </article>
@endforeach
    </section>
    </main>
    <footer>
        <section class="footer_container">
            <img class="footer_logo" src="{{ asset('welcome/logo_core_footer.svg') }}" alt="core-logo">
            <nav class="footer_navigation">
                <a class="footer_link" href="#">blog</a>
                <a class="footer_link" href="#">support</a>
                <a class="footer_link" href="#">about</a>
            </nav>
            <nav class="footer_social_navigation">
                <button class="footer_social_btn" onclick='window.open("https://vk.com/yjininheart", "_blank")' ></button>
                <button class="footer_social_btn" onclick="copyText('@Yjinvoice')"></button>
                <button class="footer_social_btn" onclick="copyText('vladislove650@gmail.com')" ></button>
            </nav>
        </section>
    </footer>
    <script>
        let form_create = false;
        let form_join = false;
        document.getElementById('header_user_data').addEventListener('click', function() {
            window.location.href = 'profile';
        });

        document.getElementById("btn_create").addEventListener('click', function() {
            if(form_create == false){
                document.getElementById("modal_form_create").style.display = "grid";
                form_create = true;
            }
            else{
                document.getElementById("modal_form_create").style.display = "none";
                form_create = false;                
            }
        })

        document.getElementById("btn_join").addEventListener('click', function() {
            if(form_join == false){
                document.getElementById("modal_form_join").style.display = "grid";
                form_join = true;
            }
            else{
                document.getElementById("modal_form_join").style.display = "none";
                form_join = false;                
            }
        })



        let markers = document.querySelectorAll('.Project_marker_img');
        let bgElements = document.querySelectorAll('.bg_project');

        markers.forEach((marker, i) => {
            let bg = bgElements[i];
            if (!bg) return;
        
            let val = marker.textContent.trim();
        
            const images = {
                '1': "url('../backgroundProject/backgroundContentColor.svg')",
                '2': "url('../backgroundProject/BackgroundTextColor.svg')",
                '3': "url('../backgroundProject/BackgroundContentNoneGorizont.svg')",
                '4': "url('../backgroundProject/BackgroundContentNoneVertical.svg')"
            };
        
            if (images[val]) {
                bg.style.backgroundImage = images[val];
            }
        });

document.querySelectorAll('.info').forEach(item => {
    item.addEventListener('click', function() {
        let parent = this.closest('.card');
        let container = parent.querySelector('.Project_description_container');
        let projectDate = parent.querySelector('.project_Date');
        
        if (container.style.height === "100%") {
            container.style.height = "0%";
            container.style.padding = "0vw";
            if (projectDate) projectDate.style.display = "none";
        } else {
            container.style.height = "100%";
            container.style.padding = "0.5vw";
            if (projectDate) projectDate.style.display = "flex";
        }
    });
});

document.querySelectorAll('.card').forEach(item => {
    item.addEventListener('click', function(event) {
        if (event.target.closest('button, .btn_upload, .btn_form_create, .btn_join, .btn_create_project')) {
            return;
        }
        const uniqueId = this.dataset.unique;
        window.location.href = '/projectboard/' + uniqueId;
    });
});
    </script>
</body>
</html>