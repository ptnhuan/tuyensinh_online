<?php namespace Foostart\Phpexcel\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Closure;

use Foostart\Phpexcel\Models\Api;

class ValidRequest extends BaseVerifier {

    protected $except = [
        'stripe/*',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        $obj_api = new Api();

        $token = $request->get('key');

        if ($obj_api->isValidToken($token)) {
            return $next($request);
        } else {
            $data = ['error'=>[
                'message' => 'Invalid token',
                'code'  => 111,
                'type' => 'vailidRequest'
            ]];
            return response()->json($data);
        }

    }

}