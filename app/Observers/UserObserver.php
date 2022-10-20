<?php

namespace App\Observers;

use App\Models\User;
use App\Services\EmailService;

class UserObserver
{
    /**
     * Handle the User "creating" event.
     *
     * @param User $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->onCreating($user);
    }

    /**
     * Handle the User "created" event.
     *
     * @param User $user
     * @return void
     */
    public function created(User $user)
    {
        if (!$user->isSuperAdmin())
        {
            $email_template = 'email_templates.signup';
            $user = $this->makePayload($user, '/verify-account/' . $user->email . '/' . $user->verification_code);

            EmailService::make()
                ->template($email_template)
                ->subject('Account Verification')
                ->to($user['email'])
                ->setPayload($user)
                ->send();
        }
    }

    public function updating(User $user)
    {
        $user->onUpdating($user);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param User $user
     * @return void
     */
    public function updated(User $user)
    {
        if (!$user->isSuperAdmin())
        {
            if ($user->wasChanged('email_verified_at') && $user->email_verified_at && request()->route()->getName() !== 'verify.account') {
                EmailService::make()
                    ->template('email_templates.welcome')
                    ->subject('Welcome')
                    ->to($user->email)
                    ->send();
            }
        }
    }

    private function makePayload($user, $url)
    {
        $url = env('APP_URL').$url;
        $user = $user->toArray();
        $user['url'] = $url;

        return $user;
    }
}
