<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign up</title>
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
</head>
<body>
    <main>
        <aside>
            <form class="main_form" method="POST" action="{{ route('register') }}">
                @csrf

                <img class="form_logo" src="{{ asset('signup/logo_core_signup.svg') }}" alt="">
        
                <section class="form_container">
                    <x-text-input id="name" class="input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"  placeholder="name"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2"  placeholder="name"/>
                </section>
        
                <section class="form_container">
                    <x-text-input id="email" class="input" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </section>
        
                <section class="form_container">
                    <x-text-input id="password" class="input" type="password" name="password" required autocomplete="new-password"  placeholder="password"/>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </section>
        
                <section class="form_container">
                    <x-text-input id="password_confirmation" class="input" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="password confirmation" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </section>
        
                <section class="form_container">
                    <a class="special_link" href="{{ route('login') }}">
                        {{ __('already have an account') }}
                    </a>
                    <button class="btn_signup">{{ __('Sign up') }}</button>
                </section>
            </form>
        </aside>
    </main>
</body>
</html>