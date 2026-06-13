<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Core</title>
    <link rel="stylesheet" href="<?php echo e("css\welcome.css"); ?>">
</head>
<body>
    <header>
        <section class="header_container">
            <img class="header_logo" src="<?php echo e(asset('welcome\logo_core_header.svg')); ?>" alt="">
            <?php if(Route::has('login')): ?>
                <nav class="header_navigation">
                    <?php if(auth()->guard()->check()): ?>
                        <a class="header_link" href="<?php echo e(url('/dashboard')); ?>">Dashboard</a>
                    <?php else: ?>
                        <a class="header_link" href="<?php echo e(route('login')); ?>">sign in</a>
                        <?php if(Route::has('register')): ?>
                            <a class="header_link" href="<?php echo e(route('register')); ?>">sign up</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </nav>
            <?php endif; ?>
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
            <img class="footer_logo" src="<?php echo e(asset('welcome/logo_core_footer.svg')); ?>" alt="core-logo">
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

                   <?php if(Route::has('login')): ?>
            <div class="h-14.5 hidden lg:block"></div>
        <?php endif; ?>
        <script>

            document.getElementById("btn_container").addEventListener("mouseenter", function() {
                document.getElementById("blic").style.display = "none";
            });
            document.getElementById("btn_container").addEventListener("mouseleave", function() {
                document.getElementById("blic").style.display = "flex";
            });
            const btn = document.getElementById('Btn');
    
            btn.addEventListener('click', function() {
                <?php if(auth()->guard()->check()): ?>
                    window.location.href = "<?php echo e(route('dashboard')); ?>";
                <?php else: ?>
                    window.location.href = "<?php echo e(route('register')); ?>";
                <?php endif; ?>
            });

            function copyText(text) {
                navigator.clipboard.writeText(text);
            }
        </script>
</body>
</html><?php /**PATH C:\Users\Admin\Desktop\CoreProject\coreinc2\resources\views/welcome.blade.php ENDPATH**/ ?>