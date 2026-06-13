<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>main</title>
    <link rel="stylesheet" href="<?php echo e("css\main.css"); ?>">
</head>
<body>
    <dialog id="dialog">
        <form method="POST" action="<?php echo e(route('projectboard.create')); ?>" class="modal_form_create" id="modal_form_create">
            <?php echo csrf_field(); ?>
            <article class="btn_exit_form">
                <button  class="exit" id="btn_create_exit"></button>
            </article>
            <input class="input" type="text" name="project_title" placeholder="project name">
            <input class="input" type="text" name="project_description" placeholder="project description">
            <button class="btn_form_create" id="btn_form_create" type="submit">create</button>
        </form>
        <form method="POST" action="<?php echo e(route('projectboard.join')); ?>" class="modal_form_create" id="modal_form_join">
            <?php echo csrf_field(); ?>
            <article class="btn_exit_form">
                <button class="exit" id="btn_join_exit"></button>
            </article>
            <input class="input" type="text" name="project_id" placeholder="project id">
            <button class="btn_form_create" id="btn_join_form" type="submit">join</button>
        </form>
    </dialog>
    <header>
        <section class="header_container">
            <img class="header_logo" src="<?php echo e(asset('welcome\logo_core_header.svg')); ?>" alt="">
                <nav class="header_navigation">
                        <a class="header_link" href="<?php echo e(url('/dashboard')); ?>">main</a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <a class="header_link" :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                <?php echo e(__('log out')); ?>

                            </a>
                        </form>
                        <section class="header_user_data" id="header_user_data">
                            <p class="header_user_name"><?php echo e((Auth::user()->name)); ?></p>
                            <img class="header_img_user" src="<?php echo e(Storage::url(Auth::user()->avatar)); ?>" alt="avatar">
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

    <section class="cards_container">
<?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <article class="card" data-unique="<?php echo e($project->unique_id); ?>">
        <article class="header_card">
            <strong><?php echo e($project->title); ?></strong>
            <form method="POST" action="<?php echo e(route('project.destroy', $project->id)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button class="btn_delete_project" type="submit"></button>
            </form>
        </article>
        <section class="bg_project">
           <p class="Project_marker_img"><?php echo e($project->img); ?></p>
           <article class="Project_description_container">
                <p class="Project_description_text"><?php echo e($project->description); ?></p>
           </article>
        </section>
        <article class="project_bar">
            <article class="project_bar">
                <p class="project_admin">admin - <?php echo e($project->user->name); ?></p>

                <p class="project_Date">date - <?php echo e($project->created_at); ?></p>
            </article>
        </article>
    </article>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </section>
    </main>
    <footer>
        <section class="footer_container">
            <img class="footer_logo" src="<?php echo e(asset('welcome/logo_core_footer.svg')); ?>" alt="core-logo">
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
                document.getElementById("dialog").style.display = "flex";
                document.getElementById("modal_form_create").style.display = "grid";
                form_create = true;
            }
            else{
                document.getElementById("dialog").style.display = "none";
                document.getElementById("modal_form_create").style.display = "none";
                form_create = false;                
            }
        })

        document.getElementById("btn_join").addEventListener('click', function() {
            if(form_join == false){
                document.getElementById("dialog").style.display = "flex";
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

//document.querySelectorAll('.info').forEach(item => {
//    item.addEventListener('click', function() {
//        let parent = this.closest('.card');
//        let container = parent.querySelector('.Project_description_container');
//        let projectDate = parent.querySelector('.project_Date');
//        
//        if (container.style.height === "100%") {
//            container.style.height = "0%";
//            container.style.padding = "0vw";
//            if (projectDate) projectDate.style.display = "none";
//        } else {
//            container.style.height = "100%";
//            container.style.padding = "0.5vw";
//            if (projectDate) projectDate.style.display = "flex";
//        }
//    });
//});

document.querySelectorAll('.card').forEach(item => {
    item.addEventListener('click', function(event) {
        if (event.target.closest('button, .btn_upload, .btn_form_create, .btn_join, .btn_create_project')) {
            return;
        }
        const uniqueId = this.dataset.unique;
        window.location.href = '/projectboard/' + uniqueId;
    });
});

document.getElementById("btn_join_form").addEventListener("click", function() {
    document.getElementById("dialog").style.display = "none";
});

document.getElementById("btn_form_create").addEventListener("click", function() {
    document.getElementById("dialog").style.display = "none";
});

document.getElementById("btn_join_exit").addEventListener("click", function() {
    document.getElementById("dialog").style.display = "none";
})
document.getElementById("btn_create_exit").addEventListener("click", function() {
    document.getElementById("dialog").style.display = "none";
})

document.querySelectorAll('.card').forEach(item => {
    item.addEventListener('mouseleave', function(event) {
        let parent = this.closest('.card');
        let trash = parent.querySelector('.btn_delete_project');
        let container = parent.querySelector('.Project_description_container');
        let projectDate = parent.querySelector('.project_Date');
            container.style.height = "0%";
            container.style.padding = "0vw";
            trash.style.display = "none";
            if (projectDate) projectDate.style.display = "none";
    });
});
document.querySelectorAll('.card').forEach(item => {
    item.addEventListener('mouseenter', function(event) {
        let parent = this.closest('.card');
        let trash = parent.querySelector('.btn_delete_project');
        let container = parent.querySelector('.Project_description_container');
        let projectDate = parent.querySelector('.project_Date');
        
        if (container.style.height === "100%") {
            trash.style.display = "none";
            container.style.height = "0%";
            container.style.padding = "0vw";
            if (projectDate) projectDate.style.display = "none";
        } else {
            container.style.height = "100%";
            trash.style.display = "block";
            container.style.padding = "0.5vw";
            if (projectDate) projectDate.style.display = "flex";
        }
    });
});
    </script>
</body>
</html><?php /**PATH C:\Users\Admin\Desktop\CoreProject\coreinc2\resources\views/dashboard.blade.php ENDPATH**/ ?>