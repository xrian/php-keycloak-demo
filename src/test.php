<?php
require_once('./index.php');

use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{
    private $public_key_str = <<<EOD
-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAkGLvSO2g1iuq9jREFpRgAOqxxFa+tdtawA3GUOvAcOhYdlRavaTI8Gck4QXBryxoCynw+wlALgJC4XnZzwFVEW0j8+Xn7smDAVw6bh9RS+TiG/RfKsQck/CuqF8YWOxXECs6+vIWTnDfNnJrJoLx3+TyuWdpRd4UGaijfhU+DDVpLnKZDFwPTbLW7SFEvmTaSc0JiIVtvyJGbV8Nd0Dw1utkyjhk23NVW3V5j3yGm7KSet9vY8v56oZPd72waWqd0BRsISB3WEf4jRyxR2j/tFXrR6W/NAyz2AAnq4qJHjiBPGMYGrJS/rfkIciunDxM6KtQpQcXDsaS6QiKlRy3WQIDAQAB
-----END PUBLIC KEY-----
EOD;
    private $config_json = <<<KEYCLOAK
{
  "realm": "dev",
  "auth-server-url": "http://localhost:8080/auth",
  "ssl-required": "external",
  "resource": "test",
  "public-client": true,
  "confidential-port": 0
}
KEYCLOAK;

    public function testPushAndPop()
    {
        $token = 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJVSmZsaHdyQ2plOE5TMHh3MU1VWDlBNzVUUUxZNEdfM3JmY3NKb3V5NkVjIn0.eyJqdGkiOiIzNjFiNWVhNS1hN2MxLTQ1NmEtYTY3MC1mODY2MGJiM2ZjMmMiLCJleHAiOjE1OTg1OTczNzMsIm5iZiI6MCwiaWF0IjoxNTk4NTk3MDczLCJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvYXV0aC9yZWFsbXMvZGV2IiwiYXVkIjoiYWNjb3VudCIsInN1YiI6ImM4NDJmNjRiLTEwM2QtNGMyZC1hYTRhLTM4MzUyNDcxNTBmZCIsInR5cCI6IkJlYXJlciIsImF6cCI6InRlc3QiLCJhdXRoX3RpbWUiOjAsInNlc3Npb25fc3RhdGUiOiIyNzZjNzRlYS00MDUxLTQwY2YtODdjNS1jNjQ1OGRjYTc5ZmEiLCJhY3IiOiIxIiwicmVhbG1fYWNjZXNzIjp7InJvbGVzIjpbIm9mZmxpbmVfYWNjZXNzIiwidW1hX2F1dGhvcml6YXRpb24iXX0sInJlc291cmNlX2FjY2VzcyI6eyJhY2NvdW50Ijp7InJvbGVzIjpbIm1hbmFnZS1hY2NvdW50IiwibWFuYWdlLWFjY291bnQtbGlua3MiLCJ2aWV3LXByb2ZpbGUiXX19LCJzY29wZSI6InByb2ZpbGUgZW1haWwiLCJlbWFpbF92ZXJpZmllZCI6ZmFsc2UsInByZWZlcnJlZF91c2VybmFtZSI6InRlc3RuYW1lIn0.MNeGKAi0hCzaWJg9bO-aseYcq-4iuz65HUlZz-WwZDc0z_2BN0vzR7YZPdE7TtASDsiHh_-ATUNLE-fMnYrfNhFKqhbupm3129eI8td-PIdpB3cOdiN2uIo-z7lh1kf8RwcRALQOk7OZd_uM2Apku0ZA5RyiLfmLfHMQSlvTUOkZPIBKSjJWKC_O_7DFliOG70XYMMXONIsgnYCSKP13F-5Qh083Pb7nyVQc-f5I2bcelexp5cBmSeo0_vQ0QRUf_dBweN_3qIIa5vE02G6kzLzA91N8o03sZH6wcV1iaUpHO1un9_DrNfJ-ZEgewkJBGfhOe8LCWQ6ngvCHeFJ7Hg';
        $config_json = $this->config_json;
        $publicKeyStr = $this->public_key_str;


        $config = json_decode($config_json, true);

        try {
            $decoded = validate($token, $publicKeyStr, $config);

            print_r(json_encode($decoded));
        } catch (Exception $e) {
            print_r($e);
        }
    }
}




