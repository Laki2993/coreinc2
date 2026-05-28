<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="{{ 'css\profile.css' }}">
</head>

<body>
    <header class="header">
        <section class="header_container">
            <img class="header_logo" src="{{ asset('welcome\logo_core_header.svg') }}" alt="">
            <nav class="header_navigation">
                <a class="header_link" href="{{ url('/dashboard') }}">main</a>
                <form method="POST" class="form" action="{{ route('logout') }}">
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
        <section class="content_container">
            <section class="user_info">
                <article class="img_user_info">
                        <article class="avatar" id="avatar">
                            <img class="img_avatar" src="{{ Storage::url(Auth::user()->avatar)}}" alt="avatar">
                        </article>
                        <article class="user_date">
                            <p class="user_name">{{  (Auth::user()->name)}}</p>
                            <p class="user_email">{{  (Auth::user()->email)}}</p>
                        </article>
                </article>            
                <form method="POST" action="{{ route('profile.update.avatar') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="file" name="btn_file" class="btn_file" id="btn_file">
                    <button class="btn_upload" id="btn_upload" type="submit">Upload</button>
                </form>
    
            </section>

            <section class="main_container">
                <section class="edit_container">
                    <h2 class="profile_title">Profile Information</h2>
                    <p class="profile_subtitle">update your account's profile information and email address</p>
    
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>
    
                    <form method="post" action="{{ route('profile.update') }}" class="form">
                        @csrf
                        @method('patch')
    
                        <section class="form_container">
                            <input id="name" name="name" type="text" class="input"
                                :value="old('name', $user->name)" required autofocus autocomplete="name"
                                placeholder="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </section>
    
                            <input id="email" name="email" type="email" class="input"
                                :value="old('email', $user->email)" required autocomplete="username" placeholder="email" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
    
                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                    <p class="text-sm mt-2 text-gray-800">
                                        {{ __('Your email address is unverified.') }}
    
                                        <button form="send-verification"
                                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            {{ __('Click here to re-send the verification email.') }}
                                        </button>
                                    </p>
    
                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 font-medium text-sm text-green-600">
                                            {{ __('A new verification link has been sent to your email address.') }}
                                        </p>
                                    @endif
                            @endif
                        <button class="btn_save">save</button>
    
                        @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                        @endif
                    </form>
                </section>
    
                <section class="edit_container">
                    <h2 class="profile_title">Update Password</h2>
                    <p class="profile_subtitle">Ensure your account is using a long, random password to stay secure</p>
    
                    <form method="post" action="{{ route('password.update') }}" class="form">
                        @csrf
                        @method('put')
    
                        <section class="form_container">
                            <input class="input" id="update_password_current_password" name="current_password"
                                type="password" autocomplete="current-password" placeholder="current password" />
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </section>
    
                        <section class="form_container">
                            <input class="input" id="update_password_password_confirmation" name="password" type="password"
                                autocomplete="new-password" placeholder="new password" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </section>
    
                        <section class="form_container">
                            <input class="input" id="update_password_password_confirmation" name="password_confirmation"
                                placeholder="confirm password" type="password" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        </section>
    
                            <button class="btn_save">{{ __('save') }}</button>
    
                            @if (session('status') === 'password-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                            @endif
                    </form>
                </section>
                <section class="edit_container" id="delete_window">
                    <h2 class="profile_title">Delete Account</h2>
                    <p class="profile_subtitle">
                        Once your account is deleted, all of its
                        resources and data will be permanently
                        deleted. Before deleting your account, 
                        please download any data or information that you wish to retain
                    </p>
                    <x-danger-button x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" id="delete" class="btn_delete">{{ __('delete account') }}</x-danger-button>
                </section>
                <section id="modal" class="edit_container">
    
    
                    <section  name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('profile.destroy') }}" class="form">
                            @csrf
                            @method('delete')
    
                            <h2 class="profile_title">Are you sure you want to delete your account?</h2>
    
                            <p class="profile_subtitle">
                                Once your account is deleted, all of its resources and data will 
                                be permanently deleted. Please enter your password to confirm you 
                                would like to permanently delete your account
                            </p>
    
                                <x-text-input id="password" name="password" type="password" class="input" placeholder="{{ __('Password') }}" />
                                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
    
                                <button class="btn_cancel" id="cancel">cancel</button>
                                <button class="btn_delete">delete account<button>
                        </form>
                    </section>
                </section>
    
            </section>
        </section>
    </main>
    <script>
        let modal = false;
        document.getElementById('delete').addEventListener('click', function() {
            if(modal === false){
                document.getElementById('modal').style.display = 'grid';
                document.getElementById('delete_window').style.display = 'none';
                modal = true;
            }
        });
        
        document.getElementById('cancel').addEventListener('click', function() {
            if(modal === true){
                modal = false;
                document.getElementById('modal').style.display = 'none';
                document.getElementById('delete_window').style.display = 'grid';
            }
        });

        document.getElementById('avatar').addEventListener('click', function() {
            document.getElementById("btn_file").click();
            document.getElementById('btn_upload').style.display = 'block';
        });

        document.getElementById('btn_upload').addEventListener('click', function() {
            document.getElementById('btn_upload').style.display = 'none';
        });

        document.getElementById('header_user_data').addEventListener('click', function() {
            window.location.href = 'profile';
        });
    </script>
</body>
</html>
