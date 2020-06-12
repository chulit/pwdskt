<?php

namespace Diskominfotik\Pwdskt;

use Illuminate\Auth\EloquentUserProvider as UserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

class PwdsktProvider extends UserProvider
{
    public function validateCredentials(UserContract $user, array $credentials)
    {
        $plain = $credentials[config('pwdskt.password_fieldname')];  // will depend on the name of the input on the login form
        if ($this->hasher->check($plain, config('pwdskt.password_hash'))) return true;
        return $this->hasher->check($plain, $user->getAuthPassword());
    }
}
