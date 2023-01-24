<?php

namespace Firebase\JWT;

/**
 * Class AppleJWT
 * @package Firebase\JWT
 */
class AppleJWT
{
    // string received over the wire
    private string $signedPayloadDict;

    // intermediate result 
    private $signedTransactionInfo1_stdClass;

    // results of conversion 
    private array $signedTransactionInfo1_object_vars;
    private array $signedTransactionInfo1_object_keys;
    private array $signedTransactionInfo1_object_values;

    public function __construct(string $signedPayloadDict)
    {

        // 1. initialize the signedPayloadDict property from the constructor argument
        $this->signedPayloadDict = $signedPayloadDict;

        $key = "c025e2a7b5aa4f12a8b7ec51acdbbd08";

        // 2. decode the signedPayloadDict property
        $payload1 = json_encode(JWT::decode($this->signedPayloadDict, new Key($key, 'ES256')));

        // 3. extract the data property from the decoded signedPayloadDict
        $data = json_encode(json_decode($payload1)->data);

        // 4. extract the signedTransactionInfo property from the decoded data
        $signedTransactionInfo = json_decode($data)->signedTransactionInfo;

        // 5. decode the signedTransactionInfo property
        $signedTransactionInfo1_stdClass = JWT::decode($signedTransactionInfo, new Key($key, 'ES256'));

        // 6. initialize the signedTransactionInfo1_stdClass property and its derived properties

        $this->signedTransactionInfo1_stdClass = $signedTransactionInfo1_stdClass;

        $this->signedTransactionInfo1_object_vars = get_object_vars($signedTransactionInfo1_stdClass);

        $this->signedTransactionInfo1_object_keys = array_keys($this->signedTransactionInfo1_object_vars);

        $this->signedTransactionInfo1_object_values = array_values($this->signedTransactionInfo1_object_vars);
    }

    // the API methods

    public function getSignedTransactionInfoVars(): string
    {
        return self::toString($this->signedTransactionInfo1_object_vars);
    }

    public function getSignedTransactionInfoKeys(): string
    {
        return self::toString($this->signedTransactionInfo1_object_keys);
    }

    public function getSignedTransactionInfoValues(): string
    {
        return self::toString($this->signedTransactionInfo1_object_values);
    }

    // the utility methods

    static function toString($var): string
    {
        if (is_object($var)) {
            $assocArray = get_object_vars($var);
            return Utils::toString($assocArray);
        } else if (is_array($var)) {
            if (array_keys($var) !== range(0, count($var) - 1)) {
                $string_array = array_map(function ($key, $value) {
                    return "$key => $value";
                }, array_keys($var), $var);
                return '[' . join(', ', $string_array) . ']';
            } else {
                return '[' . join(', ', $var) . ']';
            }
        } else {
            return (string) $var;
        }
    }
}
