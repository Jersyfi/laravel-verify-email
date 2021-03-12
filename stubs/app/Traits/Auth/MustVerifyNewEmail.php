<?php

namespace App\Traits\Auth;

use App\Models\PendingUserEmails;
use Illuminate\Support\Facades\Mail;
use App\Mail\Auth\VerifyEmail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

trait MustVerifyNewEmail
{
    /**
     * Syncronise email changes and send a new mail when email is different
     *
     * @param string $email
     */
    public function syncEmail(string $email)
    {
        if ($this->email !== $email || ($this->getPendingEmail() !== $email && $this->getPendingEmail() !== null)) {
            $this->newEmail($email);
        }
    }

    /**
     * Creates a new registration attempt and deleting all old ones
     *
     * @param string $email
     */
    protected function newEmail(string $email)
    {
        if ($this->hasVerifiedEmail() && $this->email === $email) {
            return null;
        }

        $this->clearPendingEmail();

        if (config('verify-new-email.reset_verification', true)) {
            $this->email_verified_at = null;
            $this->save();
        }

        $pendingUserEmail = new PendingUserEmails;
        $pendingUserEmail->user_id = $this->getKey();
        $pendingUserEmail->email = $email;
        $pendingUserEmail->save();

        $this->sendEmailVerificationMail();
    }

    /**
     * Returns the users pending email address
     *
     * @return string|null
     */
    public function getPendingEmail(): ?string
    {
        $pendingEmail = PendingUserEmails::where('user_id', $this->getKey())
            ->first();

        return $pendingEmail ?
            $pendingEmail->email :
            null;
    }

    /**
     * Deletes the users pending email address
     *
     * @return void
     */
    public function clearPendingEmail()
    {
        return PendingUserEmails::where('user_id', $this->id)
            ->delete();
    }

    /**
     * Send new email verification mail
     *
     * @return void
     */
    protected function sendEmailVerificationMail()
    {
        return Mail::to($this->getPendingEmail())
            ->send(new VerifyEmail(
                $this->verificationUrl()
            ));
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl()
    {
        return URL::temporarySignedRoute(
            config('verify-email.route.for', 'verification.verify'),
            Carbon::now()->addMinutes(config('verify-email.expire', 60)),
            [
                'id' => $this->getKey(),
                'hash' => sha1($this->getEmailForVerification()),
            ]
        );
    }
}
