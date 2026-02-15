<?php

use Illuminate\Http\Request;

if (!function_exists('device_fingerprint')) {
    function device_fingerprint(Request $request): string
    {
        return hash(
            'sha256',
            $request->userAgent() .
            '|' . $request->ip() .
            '|' . $request->header('accept-language')
        );
    }
}
