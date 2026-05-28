<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Core</title>
    <link rel="stylesheet" href="{{ "css\welcome.css" }}">
</head>
<body>
    <header>
        <section class="header_container">
            <img class="header_logo" src="{{ asset('welcome\logo_core_header.svg') }}" alt="">
            @if (Route::has('login'))
                <nav class="header_navigation">
                    @auth
                        <a class="header_link" href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a class="header_link" href="{{ route('login') }}">sign in</a>
                        @if (Route::has('register'))
                            <a class="header_link" href="{{ route('register') }}">sign up</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </section>
    </header>
    <main>
        <section class="main_container">
            <article class="main_text">
                <h1 class="title">Start project right now</h1>
                <p class="description">from idea to completion</p>
            </article>
            <div class="btn_container" id="btn_container">
                <div class="blic" id="blic"></div>
                <button class="btn_started" id="Btn">Start project</button>
            </div>
        </section>
    </main>
    
    <footer>
        <section class="footer_container">
            <img class="footer_logo" src="{{ asset('welcome/logo_core_footer.svg') }}" alt="core-logo">
            <nav class="footer_navigation">
                <a class="footer_link" href="">blog</a>
                <a class="footer_link" href="">support</a>
                <a class="footer_link" href="">about</a>
            </nav>
            <nav class="footer_social_navigation">
                <button class="footer_social_btn" onclick='window.open("https://vk.com/yjininheart", "_blank")' ></button>
                <button class="footer_social_btn" onclick="copyText('@Yjinvoice')"></button>
                <button class="footer_social_btn" onclick="copyText('vladislove650@gmail.com')" ></button>
            </nav>
        </section>
    </footer>

                   @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
        <script>

            document.getElementById("btn_container").addEventListener("mouseenter", function() {
                document.getElementById("blic").style.display = "none";
            });
            document.getElementById("btn_container").addEventListener("mouseleave", function() {
                document.getElementById("blic").style.display = "flex";
            });
            const btn = document.getElementById('Btn');
    
            btn.addEventListener('click', function() {
                @auth
                    window.location.href = "{{ route('dashboard') }}";
                @else
                    window.location.href = "{{ route('register') }}";
                @endauth
            });

            function copyText(text) {
                navigator.clipboard.writeText(text);
            }
        </script>
</body>
</html>