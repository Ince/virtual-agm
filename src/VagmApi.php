<?php

namespace Ince\VAGM;

class VagmApi extends VagmClient
{
    use VagmAuth, VagmEvents, VagmSession, VagmVote;

    /**
     * Current user's auth guard.
     *
     * @var string|null
     */
    protected $guard;

    /**
     * VagmApi constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->guard = self::getGuard();
    }
}
