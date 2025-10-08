<?php

use App\Constants\UserTypeConstant;
use App\Models\Account\Student;
use App\Models\Account\User;
use App\Models\Attempt\SessionExam;
use App\Models\MasterType\RefMasterType;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert as LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
use App\Models\MasterType\RefEducation;

new
#[Layout('layouts.auth')]
class extends Component {
    // TODO: Real size NISN
    #[Validate('required|string|digits:10|unique:users,username')]
        public string $nisn;
    #[Validate('required|string|max:255')]
    public string $name;

    #[Validate('required|numeric|digits_between:10,15')]
    public string $phone;

    public $education_levels;
    #[Validate('required|integer')]
    public int $ref_education_id;

    #[Validate('required|confirmed|min:5')]
    public string $password;
    #[Validate('required|same:password')]
    public string $password_confirmation;

    public function mount() {
        $this->education_levels = RefEducation::all();
    }

    public function register() {
        $this->validate();

        try {
            $ref_user_type = RefMasterType::where('code', UserTypeConstant::STUDENT)->firstOrFail();
            $user = User::create([
                'username' => $this->nisn,
                'name' => $this->name,
                'password' => Hash::make($this->password),
                'user_type_code' => UserTypeConstant::STUDENT,
                'ref_user_type_id' => $ref_user_type->id
            ]);
            $user->assignRole('Student');

            Student::create([
                'user_id' => $user->id,
                'nisn' => $this->nisn,
                'phone' => $this->phone,
                'ref_education_id' => $this->ref_education_id,
            ]);

            session()->flash('success', 'Akun berhasil didaftarkan!');
            $this->clearVars();
            return redirect()->route('login')->with('success-register', 'Akun berhasil didaftarkan!');
        } catch (Exception $e) {
            LivewireAlert::title('Gagal!')
                ->text($e->getMessage())
                ->error()
                ->show();
            session()->flash('error', 'Pendaftaran akun gagal: ' . $e->getMessage());
        }
    }

    private function clearVars() {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    private function toApp() {
        $this->redirect('/');
    }
}; ?>

<div class="auth-main">
    <x-slot name="title">
        {{ __('title.register') }}
    </x-slot>
    <div class="auth-wrapper v1">
        <div class="auth-form">
            <div class="card my-5">
                <div class="card-body">

                    <div class="text-center mb-3">
                        <a href=""><img style="max-width: 50%" src="{{ asset('logo/'.config('app.logo_dark')) }}"
                                        alt="img"/></a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-info my-3" role="alert">
                            <h5 class="alert-heading">{{ __('auth.register_success') }}</h5>
                            <p class="mb-0">{{ session('success') }}</p>
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger my-3" role="alert">
                            <h5 class="alert-heading">{{ __('auth.failed_title') }}</h5>
                            <p class="mb-0">{{ session('error') }}</p>
                        </div>
                    @endif

                    <h4 class="text-center f-w-500 mb-3">{{ __('title.register') }}</h4>

                    <form wire:submit="register">
                        <div class="mb-3">
                            <x-form.input wire:model="nisn" placeholder="{{ __('auth.nisn_placeholder') }}"/>
                        </div>
                        <div class="mb-3">
                            <x-form.input wire:model="name" placeholder="{{ __('auth.name_placeholder') }}"/>
                        </div>
                        <div class="mb-3">
                            <x-form.select required placeholder="{{ __('auth.education_placeholder') }}" style_select="form-select"
                                           wire:model="ref_education_id">
                                @foreach($education_levels as $education)
                                    <option value="{{ $education->id }}">{{ $education->name }}</option>
                                @endforeach
                            </x-form.select>
                        </div>
                        <div class="mb-3">
                            <x-form.input wire:model="phone" placeholder="{{ __('auth.phone_placeholder') }}"/>
                        </div>
                        <div class="mb-3">
                            <x-form.input wire:model="password" type="password" placeholder="{{ __('auth.password_placeholder') }}"/>
                        </div>
                        <div class="mb-3">
                            <x-form.input wire:model="password_confirmation" type="password"
                                          placeholder="{{ __('auth.confirm_password_placeholder') }}"/>
                        </div>
                        {{-- TODO: phase 2
                        <div class="mb-3">
                            <x-form.pricing/>
                        </div>--}}
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">{{ __('auth.signup_button') }}</button>
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-4">
                            <h6 class="f-w-500 mb-0">{{ __('auth.have_account') }}</h6>
                            <a href="{{ route('login') }}" class="link-primary">{{ __('auth.login_here') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
