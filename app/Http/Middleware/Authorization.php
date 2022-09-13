<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Authorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        JWT::$leeway = intval(getenv('JWT_LIVE_SEC'));
        $header = 'X-Auth';
        $contentTypeHeaders = $request->header($header);
        if (empty($contentTypeHeaders)) throw new UnauthorizedHttpException($request, "Unauthorized user");
        $jwt = $contentTypeHeaders;
        $result = (array)JWT::decode($jwt, new Key(env('JWT_KEY'), 'HS256'));
        $request->request->add(['jwt' => $result]);
        try{
            return $next($request);
        }catch(ExpiredException $e){
            throw new UnauthorizedHttpException($request, "Unauthorized user");
        }catch(SignatureInvalidException $e){
            throw new UnauthorizedHttpException($request, "Unauthorized user");
        }catch(\DomainException $e){
            throw new UnauthorizedHttpException($request, "Unauthorized user");
        }catch(\InvalidArgumentException $e){
            throw new UnauthorizedHttpException($request, "Unauthorized user");
        }catch(\UnexpectedValueException $e){
            throw new UnauthorizedHttpException($request, "Unauthorized user");
        }catch(\DateTime $e){
            throw new UnauthorizedHttpException($request, "Unauthorized user");
        }

        return $next($request);
    }
}
