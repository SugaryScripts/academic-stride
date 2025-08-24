<?php

use App\Models\Account\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
use App\Models\MasterType\RefEducation;

new #[Layout('layouts.auth',[
    'page_title' => 'Register new account'
])] class extends Component {
    // TODO: Real size NISN
    #[Validate('required|string|digits:10')]
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

    public function mount()
    {
        $this->education_levels = RefEducation::all();
    }

    public function register() {
        $this->validate();
        //\Barryvdh\Debugbar\Facades\Debugbar::info('Register clicked');

        try {
            $ref_user_type = \App\Models\MasterType\RefMasterType::where('code', \App\Constants\UserTypeConstant::STUDENT)->firstOrFail();
            $user = User::create([
                'username' => $this->nisn,
                'name' => $this->name,
                'password' => Hash::make($this->password),
                'user_type_code' => \App\Constants\UserTypeConstant::STUDENT,
                'ref_user_type_id' => $ref_user_type->id
            ]);
            $user->assignRole('Student');

            \App\Models\Account\Student::create([
                'user_id' => $user->id,
                'nisn' => $this->nisn,
                'phone' => $this->phone,
                'ref_education_id' => $this->ref_education_id,
            ]);

            \App\Models\Attempt\SessionExam::create([

            ])

            //\Barryvdh\Debugbar\Facades\Debugbar::info('Register success');
            session()->flash('success', 'Akun berhasil didaftarkan!');
            $this->clearVars();
            return redirect()->route('login')->with('success-register', 'Akun berhasil didaftarkan!');
        } catch (\Exception $e) {
            \Jantinnerezo\LivewireAlert\Facades\LivewireAlert::title('Gagal!')
                ->text($e->getMessage())->error();
            //\Barryvdh\Debugbar\Facades\Debugbar::info('Register failed');
            session()->flash('error', 'Pendaftaran akun gagal: ' . $e->getMessage());
        }
        //\Barryvdh\Debugbar\Facades\Debugbar::info('Register anomaly detected');
    }

    private function clearVars(){
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    private function toApp() {
        $this->redirect('/');
    }
}; ?>

<div class="auth-main">
    <div class="auth-wrapper v1">
        <div class="auth-form">
            <div class="card my-5">
                <div class="card-body">

                    <div class="text-center mb-3">
                        <a href=""><img style="max-width: 50%" src="{{ asset('logo/'.config('app.logo_dark')) }}" alt="img" /></a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-info my-3" role="alert">
                            <h5 class="alert-heading">Berhasil Daftar!</h5>
                            <p class="mb-0">{{ session('success') }}</p>
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger my-3" role="alert">
                            <h5 class="alert-heading">Gagal!</h5>
                            <p class="mb-0">{{ session('error') }}</p>
                        </div>
                    @endif

                    <h4 class="text-center f-w-500 mb-3">Sign up new Account.</h4>

                    <form wire:submit="register">
                        <div class="mb-3">
                            <x-form.input wire:model="nisn" placeholder="NISN"/>
                        </div>
                        <div class="mb-3">
                            <x-form.input wire:model="name" placeholder="Full Name"/>
                        </div>
                        <div class="mb-3">
                            <x-form.select required placeholder="Choose Education Level" style_select="form-select"
                                           wire:model="ref_education_id">
                                @foreach($education_levels as $education)
                                    <option value="{{ $education->id }}">{{ $education->name }}</option>
                                @endforeach
                            </x-form.select>
                        </div>
                        <div class="mb-3">
                            <x-form.input wire:model="phone" placeholder="Phone Number" />
                        </div>
                        <div class="mb-3">
                            <x-form.input wire:model="password" type="password" placeholder="Password" />
                        </div>
                        <div class="mb-3">
                            <x-form.input wire:model="password_confirmation" type="password"
                                          placeholder="Confirm Password" />
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">Sign up</button>
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-4">
                            <h6 class="f-w-500 mb-0">Already have an Account?</h6>
                            <a href="{{ route('login') }}" class="link-primary">Login here</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
