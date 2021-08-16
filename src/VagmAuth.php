<?php

namespace Ince\VAGM;

use Illuminate\Http\Request;

trait VagmAuth
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $uuid
     * @param  array  $credentials
     * @return bool
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function login(Request $request, string $uuid, array $credentials)
    {
        $request_details = [
            'referrer'   => $request->server('HTTP_REFERER') ?? 'api',
            'ip_address' => $request->header('X-Forwarded-For') ?? $request->ip() ?? '127.0.0.1',
            'device'     => $request->header('User-Agent') ?? 'api',
        ];

        $response = $this->post(sprintf('/api/user/login/%s', $uuid), ($credentials + $request_details));

        if ($response['token'] ?? null) {
            return VagmApi::setUser($response);
        }

        return false;
    }

    /**
     * End session and delete API tokens.
     *
     * @return array
     */
    public function logout()
    {
        $response = $this->post('/api/user/logout');

        \Session::forget('_vagm_user');

        return $response;
    }

    /**
     * Set current time on last_active_at.
     *
     * @return void
     */
    public function lastActive()
    {
        $this->put('/api/user/last-active');
    }

    /**
     * Submit login OTP.
     *
     * @param  string  $otp
     * @return bool
     */
    public function otp(string $otp)
    {
        if ($this->post('/api/user/otp', compact('otp'))) {
            return VagmApi::clearOTP();
        }

        return false;
    }

    /**
     * Resend login OTP.
     *
     * @return int|null
     */
    public function resendOtp()
    {
        $otp = $this->post('/api/user/otp/resend')['otp'] ?? null;

        VagmApi::setOTP($otp);

        return $otp;
    }
}