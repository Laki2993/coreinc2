<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>fogot password</title>
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
</head>
<body>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <main>
        <aside>
            <p class="form_description">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>
            <form method="POST" class="main_form"  action="{{ route('password.email') }}">
                @csrf
                <section class="form_container">
                    <x-text-input id="email" class="input" type="email" name="email" :value="old('email')" required autofocus placeholder="email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </section>
            
                <section class="form_container">
                    <button class="btn_reset">
                        {{ __('send an email to reset your password') }}
                    </button>
                </section>
            </form>
        </aside>
    </main>
</body>
</html>   
    
