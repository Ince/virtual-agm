<?php

namespace Ince\VAGM;

trait VagmSession
{
    /**
     * Get user in current session.
     *
     * @return  object|null  $token
     */
    public static function getUser() : ?object
    {
        return \Session::get('_vagm_user');
    }

    /**
     * Set user in current session.
     *
     * @param  array|object  $user
     * @return bool
     */
    public static function setUser($user) : bool
    {
        $user = (array) $user;

        $user['name'] = $user['last_name'] ? sprintf('%s %s', $user['first_name'], $user['last_name']) : $user['first_name'];

        \Session::put('_vagm_user', (object) $user);

        return true;
    }

    /**
     * Update user in current session.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return  bool
     */
    public static function updateUser(string $key, $value = null) : bool
    {
        $user = self::getUser();
        $user->{$key} = $value;

        self::setUser($user);

        return true;
    }

    /**
     * Get guard in current session.
     *
     * @return  string|null
     */
    public static function getGuard() : ?string
    {
        return self::getUser()->guard ?? null;
    }

    /**
     * Get token in current session.
     *
     * @return  string|null
     */
    public static function getToken() : ?string
    {
        return self::getUser()->token ?? null;
    }

    /**
     * Get token in current session.
     *
     * @return  bool
     */
    public static function setToken(string $token) : bool
    {
        return self::updateUser('token', $token);
    }

    /**
     * Get OTP in current session.
     *
     * @return  string|null
     */
    public static function getOTP() : ?string
    {
        return self::getUser()->otp ?? null;
    }

    /**
     * Set OTP in current session.
     *
     * @param  int|string|null  $otp
     * @return  bool
     */
    public static function setOTP($otp = null) : bool
    {
        return self::updateUser('otp', $otp);
    }

    /**
     * Clear OTP in current session.
     *
     * @return bool
     */
    public static function clearOTP() : bool
    {
        return self::setOTP();
    }
}