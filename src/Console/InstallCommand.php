<?php

namespace Jersyfi\VerifyEmail\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verify-email:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Verify email files';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Controllers...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers/Auth'));
        copy(__DIR__.'/../../stubs/app/Http/Controllers/Auth/VerifyNewEmailController.php', app_path('Http/Controllers/Auth/VerifyNewEmailController.php'));

        // Mail
        (new Filesystem)->ensureDirectoryExists(app_path('Mail/Auth'));
        copy(__DIR__.'/../../stubs/app/Mail/Auth/VerifyEmail.php', app_path('Mail/Auth/VerifyEmail.php'));

        // Models
        copy(__DIR__.'/../../stubs/app/Models/PendingUserEmails.php', app_path('Models/PendingUserEmails.php'));

        // Traits
        (new Filesystem)->ensureDirectoryExists(app_path('Traits/Auth'));
        copy(__DIR__.'/../../stubs/app/Traits/Auth/MustVerifyNewEmail.php', app_path('Traits/Auth/MustVerifyNewEmail.php'));

        // Config
        copy(__DIR__.'/../../stubs/config/verify-email.php', config_path('verify-email.php'));

        // Migrations
        (new Filesystem)->ensureDirectoryExists(database_path('migrations'));
        copy(__DIR__.'/../../stubs/database/migrations/2021_03_11_134208_create_pending_user_emails.php', database_path('migrations/2021_03_11_134208_create_pending_user_emails.php'));

        // Views...
        (new Filesystem)->ensureDirectoryExists(resource_path('views/emails/auth'));
        copy(__DIR__.'/../../stubs/resources/views/emails/auth/verifyEmail.blade.php', resource_path('views/emails/auth/verifyEmail.blade.php'));

        $this->info('Verify Email scaffolding installed successfully.');
        $this->comment('Please read the documentation to complete thpackage installation.');
    }
}