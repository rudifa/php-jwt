<?php



/**
 * Class AppleJWT
 */
class AppleJWT
{

    public static function decode(string $jwtJson)
    {

        // 1. extract the value of the signedPayload key
        $signedPayload = json_decode($jwtJson)->signedPayload;

        // 2. decode the triplet and extract the payload
        $payload = self::decodeTriplet($signedPayload);

        $data = json_encode(json_decode($payload)->data);

        $signedTransactionInfo = json_decode($data)->signedTransactionInfo;

        $result2 = self::decodeTriplet($signedTransactionInfo);

        $result3 = json_decode($result2, true);

        return $result3;
    }

    public static function decodeTriplet(string $jwtJson)
    {
        $tks = \explode('.', $jwtJson);

        $payload = base64_decode($tks[1]);

        return $payload;
    }
}
