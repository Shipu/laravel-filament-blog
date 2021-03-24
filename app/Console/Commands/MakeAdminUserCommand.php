<?php

namespace App\Console\Commands;

use Filament\Commands\Concerns\CanValidateInput;
use Filament\Filament;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MakeAdminUserCommand extends Command
{
    use CanValidateInput;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a Admin user.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userModel = Filament::auth()->getProvider()->getModel();

        $details = [];

        $details['first_name'] = $this->validateInput(fn () => $this->ask('First Name'), 'first_name', ['required']);

        $details['last_name'] = $this->validateInput(fn () => $this->ask('Last Name'), 'last_name', ['required']);

        $details['email'] = $this->validateInput(fn () => $this->ask('Email'), 'email', ['required', 'email', 'unique:' . $userModel]);

        $details['phone'] = $this->validateInput(fn () => $this->ask('Phone'), 'phone', ['required', 'regex:#^(?:\+?88|0088)?01[15-9]\d{8}$#', 'unique:' . $userModel]);

        $details['password'] = Hash::make($this->validateInput(fn () => $this->secret('Password'), 'password', ['required', 'min:8']));

        $adminColumn = $userModel::getFilamentAdminColumn();
        if ($adminColumn !== null) {
            $details[$adminColumn] = $this->confirm('Would you like this user to be an administrator?', true);
        }

        $userColumn = $userModel::getFilamentUserColumn();
        if ($userColumn !== null) {
            $details[$userColumn] = true;
        }

        $user = $userModel::create($details);

        $loginUrl = route('filament.auth.login');
        $this->info("Success! {$user->phone} or {$user->email} may now log in at {$loginUrl}.");

        if (Filament::auth()->getProvider()->getModel()::count() === 1 && $this->confirm('Would you like to show some love by starring the repo?', true)) {
            if (PHP_OS_FAMILY === 'Darwin') {
                exec('open https://github.com/shipu/laravel-filament-blog');
            }
            if (PHP_OS_FAMILY === 'Linux') {
                exec('xdg-open https://github.com/shipu/laravel-filament-blog');
            }
            if (PHP_OS_FAMILY === 'Windows') {
                exec('start https://github.com/shipu/laravel-filament-blog');
            }

            $this->line('Thank you!');
        }
    }
}
