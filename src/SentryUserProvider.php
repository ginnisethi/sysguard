<?php namespace Ifaniqbal\Sysguard;

use Illuminate\Auth\EloquentUserProvider;
use Ifaniqbal\Sysguard\User;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class SentryUserProvider extends EloquentUserProvider {

    public function __construct(HasherContract $hasher, User $model)
    {
        parent::__construct($hasher, $model);
    }
}
