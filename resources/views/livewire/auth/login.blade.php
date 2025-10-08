<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new
#[Layout('layouts.auth')]
class extends Component {

    #[Validate('required', as: 'nisn pengguna')]
    public string $username;
    #[Validate('required')]
    public string $password;
    #[Validate('nullable|boolean')]
    public ?bool $remember = false;

    public function mount(): void
    {
        if (session()->has('success-register')) {
            \Jantinnerezo\LivewireAlert\Facades\LivewireAlert::title(session('success'))->success()->show();
        }
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void {
        $this->validate();

        if (!Auth::attempt(['username' => $this->username, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            session()->flash('error', 'Username atau Password Salah!');

            throw ValidationException::withMessages([
                'username' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        if (Auth::user()->hasRole('Student'))
            $this->redirectIntended(default: route('active-exam', absolute: false), navigate: false);
        else
            $this->redirectIntended(default: route('homes', absolute: false), navigate: false);
    }


    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string {
        return Str::transliterate(Str::lower($this->username) . '|' . request()->ip());
    }
}

?>
<div class="auth-main">
    <x-slot name="title">
        {{ __('title.login') }}
    </x-slot>
    <div class="auth-wrapper v1">
        <div class="auth-form">
            <div class="card my-5">
                <div class="card-body">

                    <div class="text-center mb-3">
                        <a href=""><img src="{{ asset('logo/'.config('app.logo_dark')) }}" alt="img" /></a>
                    </div>

                    @if(session('info'))
                        <div class="alert alert-info my-3" role="alert">
                            <h5 class="alert-heading">{{ __('auth.info') }}</h5>
                            <p class="mb-0">{{ session('info') }}</p>
                        </div>
                    @elseif(session('success-register'))
                        <div class="alert alert-info my-3" role="alert">
                            <h5 class="alert-heading">{{ __('auth.register_success') }}</h5>
                            <p class="mb-0">{{ session('success-register') }}</p>
                        </div>
                    @endif

                    <h4 class="text-center f-w-500 mb-3">{{ __('auth.login_title') }}</h4>

                    <form wire:submit="login">
                        <div class="mb-3">
                            <x-form.input wire:model="username" placeholder="{{ __('auth.username_placeholder') }}" />
                        </div>
                        <div class="mb-3">
                            <x-form.input wire:model="password" type="password" placeholder="{{ __('auth.password_placeholder') }}" />
                        </div>
                        <div class="d-flex mt-1 justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input input-primary" type="checkbox" id="remember" checked="" wire:model="remember" />
                                <label class="form-check-label text-muted" for="remember">{{ __('auth.remember_me') }}</label>
                            </div>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">{{ __('auth.login_button') }}</button>
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-4">
                            <h6 class="f-w-500 mb-0">{{ __('auth.no_account') }}</h6>
                            <a href="{{ route('register') }}" class="link-primary">{{ __('auth.create_account') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
