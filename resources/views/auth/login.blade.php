
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign in</title>
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
</head>
<body>
    <main>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <aside>
            <form method="POST" class="main_form" action="{{ route('login') }}">
                @csrf
                
                <img class="form_logo" src="{{ asset('signup/logo_core_signup.svg') }}" alt="">
                <section class="form_container">
                    <x-text-input id="email" class="input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="email"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </section>
        
                <section class="form_container">
                    <x-text-input id="password" class="input"  type="password" name="password" required autocomplete="current-password"  placeholder="password"/>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </section>
        
                <section class="checkbox_container">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="special_link_my">{{ __('Remember me') }}</span>
                </section>
        
                <section class="form_container">
                    <article class="accessibility_features" id="accessibility_features">
                        <img class="info" id="info" src="{{ asset('signup/icon_i_signin.svg') }}" alt="">
                        <section class="special_text">
                            @if (Route::has('password.request'))
                            <a class="special_link" href="{{ route('password.request') }}">
                                {{ __('forgot your password') }}
                            </a>
                            @endif
                            <strong>or</strong>
                            <a class="special_link" href="{{ route('register') }}">don't have an account yet</a>
                        </section>
                    </article>
                </section>
                <section class="form_container">
                <button class="btn_signup">{{ __('Sign in') }}</button>
                </section>
            </form>
        </aside>
    </main>
</body>
<script>
    let i = false;
    document.getElementById('info').addEventListener('click', function() {
        if (i == false) {
            document.getElementById("accessibility_features").style.width = "100%";
             i = true;
        }
        else{
            document.getElementById("accessibility_features").style.width = "6%";
            i = false;
        }
    });
</script>
</html>
