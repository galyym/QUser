<?php

namespace App\Qamtu\User\Domain\Services;

use App\Domain\Payloads\GenericPayload;
use App\Domain\Services\Service;
use App\Qamtu\User\Domain\Repositories\UserRepository as Repository;
use App\Helpers\Pki;
use Firebase\JWT\JWT;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redis;


class SignInService extends Service
{
    protected $repository;

    /**
     * @var Pki
     */
    private $pki;

    /**
     * @var ClientInterface
     */
    private $redis;

    public function __construct(Repository $repository, Pki $pki)
    {
        $this->repository = $repository;
        $this->pki = $pki;
        $this->redis = Redis::connection();
    }

    public function handle($data = [])
    {
        //берем данные из ЭЦП
        $certInfo = $this->pki->getCertificateInfo($data["base64"], $data["password"], true);

        //проверяем, есть ли такой юзер у нас в БД в таблице applicant
        $checkUser = $this->repository->checkUser($certInfo['iin']);

        //если нет юзера с такими данными, то мы этого юзера добавляем в таблицу temp_users
        if (empty($checkUser)) {
            $checkUser = $this->repository->addTempUser($certInfo);
        }
        return $this->mapToUserRow($checkUser);


//        $email = $data["base64"];
//        $password = $data["password"];
//        $user = $this->repository->getByEmail($email);
        if(!$user || !password_verify($password, $user->password)) throw new MainException("Email or password is incorrect");
        if(!$user->is_active) throw new MainException("You account is blocked");
//
//        if (! $token = auth('branch_admin')->login($user)) {
//            throw new MainException("Email or password is incorrect");
//        }
//        $user->last_visit = date('Y-m-d H:i:s');
//        $user->update();


//        return new GenericPayload(
//            array(
//                "user" => [
//                    "name" => $certInfo,
//                    "email" => $certInfo
//                ],
//                "token" => $certInfo
//            )
//        );
    }

    /**
     * Map data to row.
     *
     * @param array<mixed> $data The data
     *
     * @return array<mixed> The row
     */
    private function mapToUserRow(array $data)
    {
        $payload = $this->mapToUserPayload($data);
        $token = JWT::encode($payload, (string)getenv('JWT_KEY'), 'HS256');
        $refreshToken = $this->generateRefreshToken();
        $refreshData = array("token" => $token,
            "id" => $data["id"],
            "type" => "user",
            "org_type" => "user"
        );
//        $this->redis->setex($refreshToken, getenv("REFRESH_TOKEN_LIVE_SEC"), json_encode($refreshData, JSON_UNESCAPED_UNICODE));
        Redis::setex($refreshToken, getenv("REFRESH_TOKEN_LIVE_SEC"), json_encode($refreshData, JSON_UNESCAPED_UNICODE));

//        return [
//            "full_name" => $data["full_name"],
////            "org_name" => $data["company_name"],
//            "token" => $token,
//            "refresh_token" => $refreshToken
//        ];

        return new GenericPayload(
            array(
                "user" => [
                    "full_name" => $data["full_name"],
//                    "org_name" => $data["company_name"],
                ],
                "token" => $token,
                "refresh_token" => $refreshToken
            )
        );
    }

    /**
     * Map to user payload to send JWT
     *
     * @param array<mixed> $data The data
     *
     * @return array<mixed> The row
     */
    private function mapToUserPayload(array $data): array
    {
        return [
            "iss" => env("API_URL"),
            "aud" => env("URL"),
            "jti" => $this->generateJti(32),
            "iat" => time(),
            "exp" => time() + intval(env("JWT_LIVE_SEC")),
            "id" => (int)$data["id"],
            "type" => "user",
            "org_type" => "user",
            "iin" => $data["iin"],
//            "org_bin" => $data["org_bin"]
        ];
    }

    /**
     *  Generating new jtu for user
     *
     * @return string The jti
     */
    private function generateJti($length = 32)
    {
        if (!isset($length) || intval($length) <= 8) {
            $length = 32;
        }
        if (function_exists("random_bytes")) {
            return bin2hex(random_bytes($length));
        }
        if (function_exists("mcrypt_create_iv")) {
            return bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM));
        }
        if (function_exists("openssl_random_pseudo_bytes")) {
            return bin2hex(openssl_random_pseudo_bytes($length));
        }
    }

    /**
     *  Generating new refresh token for user
     *
     * @return string The refresh token
     */
    private function generateRefreshToken(int $length = 36, int $attempt = 1): string
    {
        $randomStr = $this->base64url_encode(substr(hash("sha512", mt_rand()), 0, $length));
        if ($this->redis->exists($randomStr)) {
            if ($attempt > 10) {
                $attempt = 1;
                $length++;
            }
            return $this->generateRefreshToken($length, $attempt);
        }
        return $randomStr;
    }

    /**
     *
     * @param string $data The data
     *
     * @return string The cleaned string
     */
    public function base64url_encode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), "+/", "-_"), "=");
    }
}
