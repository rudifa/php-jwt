<?php

// namespace Firebase\JWT;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
// use UnexpectedValueException;

include 'Utils.php';

function typeof($var)
{
    if (is_object($var)) {
        return get_class($var);
    } else if (is_array($var)) {
        return 'array of ' . count($var) . ' elements';
    } else if (is_string($var)) {
        return 'string of ' . strlen($var) . ' chars';
    } else {
        return gettype($var);
    }
}


class AppleJWTTest extends TestCase
{

    public function test_2x2()
    {
        $this->assertEquals(4, 2 * 2);
    }

    public function x_test_signedPayload()
    {

        echo "\n\n";

        // pass 1
        $appleJWT = file_get_contents(__DIR__ . '/data/signedPayload2.json');
        // echo "---- appleJWT= ". $appleJWT ."\n\n";
        echo "---- appleJWT  appleJWT is " . typeof($appleJWT) . "\n\n";

        $key = "c025e2a7b5aa4f12a8b7ec51acdbbd08";
        // $key = "";
        $payload1 = JWT::decode($appleJWT, new Key($key, 'ES256'));
        echo "---- appleJWT  payload1 is " . typeof($payload1) . "\n\n"; // is stdClass : do json_encode to get string

        $payload1 = json_encode($payload1);
        #echo "---- appleJWT  payload1= ". $payload1 ."\n\n";
        echo "---- appleJWT  payload1 is " . typeof($payload1) . "\n\n";

        //{"notificationType":"EXPIRED","subtype":"VOLUNTARY","notificationUUID":"1a9c67f6-d351-46e5-a1c1-c660415f4b09",

        $notificationType = json_decode($payload1)->notificationType;
        echo "---- appleJWT  notificationType= " . $notificationType . "\n\n";

        $subtype = json_decode($payload1)->subtype ?? "NO_SUBTYPE";
        echo "---- appleJWT  subtype= " . $subtype . "\n\n";

        $notificationUUID = json_decode($payload1)->notificationUUID;
        echo "---- appleJWT  notificationUUID= " . $notificationUUID . "\n\n";

        //"data":{"bundleId":"com.share-telematics.StickQueue1","bundleVersion":"1","environment":"Sandbox","signedTransactionInfo":
        $data = json_encode(json_decode($payload1)->data);
        // echo "---- appleJWT  data= ". $data ."\n\n";
        echo "---- appleJWT  data is " . typeof($data) . "\n\n";

        //"version":"2.0","signedDate":1674061904484}

        $version = json_decode($payload1)->version;
        echo "---- appleJWT  version= " . $version . "\n\n";

        $signedDate = json_decode($payload1)->signedDate;
        echo "---- appleJWT  signedDate= " . $signedDate . "\n\n";

        // elements from data

        $bundleId = json_decode($data)->bundleId;
        echo "---- appleJWT  bundleId= " . $bundleId . "\n\n";

        $bundleVersion = json_decode($data)->bundleVersion;
        echo "---- appleJWT data bundleVersion= " . $bundleVersion . "\n\n";

        $environment = json_decode($data)->environment;
        echo "---- appleJWT data environment= " . $environment . "\n\n";

        $signedTransactionInfo = json_decode($data)->signedTransactionInfo;
        #echo "---- appleJWT data signedTransactionInfo= ". $signedTransactionInfo ."\n\n";

        $signedTransactionInfo1 = JWT::decode($signedTransactionInfo, new Key($key, 'ES256'));
        echo "---- appleJWT  signedTransactionInfo1 is " . typeof($signedTransactionInfo1) . "\n\n"; // is stdClass : do json_encode to get string

        $signedTransactionInfo1 = json_encode($signedTransactionInfo1);
        // echo "---- appleJWT data signedTransactionInfo1= ". $signedTransactionInfo1 ."\n\n";
        echo "---- appleJWT  signedTransactionInfo1 is " . typeof($signedTransactionInfo1) . "\n\n";

        // ---- appleJWT data signedTransactionInfo1= {"transactionId":"2000000253271855","originalTransactionId":"1000000636285238","webOrderLineItemId":"2000000019030938","bundleId":"com.share-telematics.StickPlan1","productId":"SPLPS_GADZARTS","subscriptionGroupIdentifier":"20605699","purchaseDate":1674061594000,"originalPurchaseDate":1583681241000,"expiresDate":1674061894000,"quantity":1,"type":"Auto-Renewable Subscription","inAppOwnershipType":"PURCHASED","signedDate":1674061904491,"environment":"Sandbox"}




        $this->assertEquals(TRUE, TRUE);
    }

    public function test_signedPayload_2()
    {

        echo "\n\n";

        $utils = new Utils();

        // pass 1
        $appleJWT = file_get_contents(__DIR__ . '/data/signedPayload2.json');
        // echo "---- appleJWT= ". $appleJWT ."\n\n";

        $key = "c025e2a7b5aa4f12a8b7ec51acdbbd08";
        // $key = "";
        $payload1_stdClass = JWT::decode($appleJWT, new Key($key, 'ES256'));

        $payload1 = json_encode($payload1_stdClass);

        $payload1_object_vars = get_object_vars($payload1_stdClass);


        //{"notificationType":"EXPIRED","subtype":"VOLUNTARY","notificationUUID":"1a9c67f6-d351-46e5-a1c1-c660415f4b09",

        $notificationType = json_decode($payload1)->notificationType;

        $subtype = json_decode($payload1)->subtype ?? "NO_SUBTYPE";

        $notificationUUID = json_decode($payload1)->notificationUUID;


        //"data":{"bundleId":"com.share-telematics.StickQueue1","bundleVersion":"1","environment":"Sandbox","signedTransactionInfo":
        $data = json_encode(json_decode($payload1)->data);

        //"version":"2.0","signedDate":1674061904484}

        $version = json_decode($payload1)->version;

        $signedDate = json_decode($payload1)->signedDate;

        // elements from data

        $bundleId = json_decode($data)->bundleId;

        $bundleVersion = json_decode($data)->bundleVersion;

        $environment = json_decode($data)->environment;

        $signedTransactionInfo = json_decode($data)->signedTransactionInfo;

        $signedTransactionInfo1_stdClass = JWT::decode($signedTransactionInfo, new Key($key, 'ES256'));

        $signedTransactionInfo1_string = json_encode($signedTransactionInfo1_stdClass);

        // ---- appleJWT data signedTransactionInfo1= {"transactionId":"2000000253271855","originalTransactionId":"1000000636285238","webOrderLineItemId":"2000000019030938","bundleId":"com.share-telematics.StickPlan1","productId":"SPLPS_GADZARTS","subscriptionGroupIdentifier":"20605699","purchaseDate":1674061594000,"originalPurchaseDate":1583681241000,"expiresDate":1674061894000,"quantity":1,"type":"Auto-Renewable Subscription","inAppOwnershipType":"PURCHASED","signedDate":1674061904491,"environment":"Sandbox"}

        // NOTE:
        // $json_object = json_decode($json_string); // stdClass
        // $object_vars = get_object_vars($json_object); // associative array of <n> kv pairs

        $signedTransactionInfo1_object_vars = get_object_vars($signedTransactionInfo1_stdClass);



        echo "---- appleJWT  appleJWT is " . typeof($appleJWT) . "\n\n";
        echo "---- appleJWT  appleJWT is " . $utils->typeof($appleJWT) . "\n\n";

        echo "---- appleJWT  payload1 is " . typeof($payload1) . "\n\n"; // is stdClass : do json_encode to get string

        echo "---- appleJWT  payload1_object_vars is " . typeof($payload1_object_vars) . "\n\n";

        echo "==== appleJWT  payload1_object_vars keys= " . $utils->arrayToString(array_keys($payload1_object_vars)) . "\n\n";

        #echo "---- appleJWT  payload1= ". $payload1 ."\n\n";
        echo "---- appleJWT  payload1 is " . typeof($payload1) . "\n\n";

        echo "---- appleJWT  payload1 subtype= " . $subtype . "\n\n";

        echo "---- appleJWT  payload1 notificationUUID= " . $notificationUUID . "\n\n";

        // echo "---- appleJWT  data= ". $data ."\n\n";
        echo "---- appleJWT  payload1 data is " . typeof($data) . "\n\n";

        echo "---- appleJWT  payload1 version= " . $version . "\n\n";

        echo "---- appleJWT  payload1 signedDate= " . $signedDate . "\n\n";

        echo "---- appleJWT  payload1 data bundleId= " . $bundleId . "\n\n";

        echo "---- appleJWT  payload1 data bundleVersion= " . $bundleVersion . "\n\n";

        echo "---- appleJWT  payload1 data environment= " . $environment . "\n\n";

        #echo "---- appleJWT data signedTransactionInfo= ". $signedTransactionInfo ."\n\n";
        echo "---- appleJWT  payload1 data signedTransactionInfo1_stdClass is " . typeof($signedTransactionInfo1_stdClass) . "\n\n"; // is stdClass : do json_encode to get string

        // echo "---- appleJWT data signedTransactionInfo1= ". $signedTransactionInfo1 ."\n\n";
        echo "---- appleJWT  payload1 data signedTransactionInfo1_string is " . typeof($signedTransactionInfo1_string) . "\n\n";

        echo "---- appleJWT  payload1 data signedTransactionInfo1_object_vars is " . typeof($signedTransactionInfo1_object_vars) . "\n\n";
        echo "---- appleJWT  payload1 data signedTransactionInfo1_object_vars= " .  $utils->assocArrayToString($signedTransactionInfo1_object_vars) . "\n\n";

        echo "==== appleJWT  payload1 data signedTransactionInfo1_object_vars keys= " . $utils->arrayToString(array_keys($signedTransactionInfo1_object_vars)) . "\n\n";
        echo "==== appleJWT  payload1 data signedTransactionInfo1_object_vars values= " . $utils->arrayToString(array_values($signedTransactionInfo1_object_vars)) . "\n\n";


        $this->assertEquals(TRUE, TRUE);
    }
}
