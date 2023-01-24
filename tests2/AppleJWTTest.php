<?php

// namespace Firebase\JWT;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\AppleJWT;
use Firebase\JWT\AppleJWT2;

// use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
// use UnexpectedValueException;

include 'Utils.php';



class AppleJWTTest extends TestCase
{

    public function x_test_2x2()
    {
        $this->assertEquals(4, 2 * 2);
    }

    public function x_test_signedPayload()
    {

        echo "\n\n";

        // pass 1
        $appleJWT = file_get_contents(__DIR__ . '/data/signedPayload2.json');
        // echo "---- appleJWT= ". $appleJWT ."\n\n";
        echo "---- appleJWT  appleJWT is " . Utils::typeof($appleJWT) . "\n\n"; // string

        $key = "c025e2a7b5aa4f12a8b7ec51acdbbd08";
        // $key = "";
        $payload1 = JWT::decode($appleJWT, new Key($key, 'ES256'));
        echo "---- appleJWT  payload1 is " . Utils::typeof($payload1) . "\n\n"; // is stdClass : do json_encode to get string

        $payload1 = json_encode($payload1);
        #echo "---- appleJWT  payload1= ". $payload1 ."\n\n";
        echo "---- appleJWT  payload1 is " . Utils::typeof($payload1) . "\n\n";

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
        echo "---- appleJWT  data is " . Utils::typeof($data) . "\n\n";

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
        echo "---- appleJWT  signedTransactionInfo1 is " . Utils::typeof($signedTransactionInfo1) . "\n\n"; // is stdClass : do json_encode to get string

        $signedTransactionInfo1 = json_encode($signedTransactionInfo1);
        // echo "---- appleJWT data signedTransactionInfo1= ". $signedTransactionInfo1 ."\n\n";
        echo "---- appleJWT  signedTransactionInfo1 is " . Utils::typeof($signedTransactionInfo1) . "\n\n";

        // ---- appleJWT data signedTransactionInfo1= {"transactionId":"2000000253271855","originalTransactionId":"1000000636285238","webOrderLineItemId":"2000000019030938","bundleId":"com.share-telematics.StickPlan1","productId":"SPLPS_GADZARTS","subscriptionGroupIdentifier":"20605699","purchaseDate":1674061594000,"originalPurchaseDate":1583681241000,"expiresDate":1674061894000,"quantity":1,"type":"Auto-Renewable Subscription","inAppOwnershipType":"PURCHASED","signedDate":1674061904491,"environment":"Sandbox"}


        $this->assertEquals(TRUE, TRUE);
    }

    public function x_test_signedPayload_2()
    {
        echo "\n\n";;

        // pass 1
        $appleJWT_string = file_get_contents(__DIR__ . '/data/signedPayload2.json');
        // echo "---- appleJWT_string= ". $appleJWT_string ."\n\n";

        $key = "c025e2a7b5aa4f12a8b7ec51acdbbd08";
        // $key = "";
        $payload1_stdClass = JWT::decode($appleJWT_string, new Key($key, 'ES256')); // stdClass

        $payload1 = json_encode($payload1_stdClass); // string

        $payload1_object_vars = get_object_vars($payload1_stdClass);


        //{"notificationType":"EXPIRED","subtype":"VOLUNTARY","notificationUUID":"1a9c67f6-d351-46e5-a1c1-c660415f4b09",

        $notificationType = json_decode($payload1)->notificationType;

        $subtype = json_decode($payload1)->subtype ?? "NO_SUBTYPE";

        $notificationUUID = json_decode($payload1)->notificationUUID;


        //"data":{"bundleId":"com.share-telematics.StickQueue1","bundleVersion":"1","environment":"Sandbox","signedTransactionInfo":
        $data = json_encode(json_decode($payload1)->data);

        $data_stdClass = json_decode($payload1)->data;

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

        // ---- appleJWT_string data signedTransactionInfo1= {"transactionId":"2000000253271855","originalTransactionId":"1000000636285238","webOrderLineItemId":"2000000019030938","bundleId":"com.share-telematics.StickPlan1","productId":"SPLPS_GADZARTS","subscriptionGroupIdentifier":"20605699","purchaseDate":1674061594000,"originalPurchaseDate":1583681241000,"expiresDate":1674061894000,"quantity":1,"type":"Auto-Renewable Subscription","inAppOwnershipType":"PURCHASED","signedDate":1674061904491,"environment":"Sandbox"}

        // NOTE:
        // $json_object = json_decode($json_string); // stdClass
        // $object_vars = get_object_vars($json_object); // associative array of <n> kv pairs

        $signedTransactionInfo1_object_vars = get_object_vars($signedTransactionInfo1_stdClass);



        echo "---- appleJWT  appleJWT is " . Utils::typeof($appleJWT_string) . "\n\n";

        echo "---- appleJWT  payload1_stdClass is " . Utils::typeof($payload1_stdClass) . "\n\n"; // stdClass

        echo "---- appleJWT  payload1 is " . Utils::typeof($payload1) . "\n\n"; // string

        echo "---- appleJWT  payload1_object_vars is " . Utils::typeof($payload1_object_vars) . "\n\n";

        echo "==== appleJWT  payload1_object_vars keys= " . Utils::toString(array_keys($payload1_object_vars)) . "\n\n";
        // echo "==== appleJWT  payload1_object_vars values= " . Utils::toString(array_values($payload1_object_vars)) . "\n\n";

        #echo "---- appleJWT  payload1= ". $payload1 ."\n\n";
        echo "---- appleJWT  payload1 is " . Utils::typeof($payload1) . "\n\n";

        echo "---- appleJWT  payload1 notificationType= " . $notificationType . "\n\n";

        echo "---- appleJWT  payload1 subtype= " . $subtype . "\n\n";

        echo "---- appleJWT  payload1 notificationUUID= " . $notificationUUID . "\n\n";

        // echo "---- appleJWT  data= ". $data ."\n\n";
        echo "---- appleJWT  payload1 data is " . Utils::typeof($data) . "\n\n";

        echo "==== appleJWT  payload1 data_stdClass is " . Utils::typeof($data_stdClass) . "\n\n";


        echo "---- appleJWT  payload1 version= " . $version . "\n\n";

        echo "---- appleJWT  payload1 signedDate= " . $signedDate . "\n\n";

        echo "---- appleJWT  payload1 data bundleId= " . $bundleId . "\n\n";

        echo "---- appleJWT  payload1 data bundleVersion= " . $bundleVersion . "\n\n";

        echo "---- appleJWT  payload1 data environment= " . $environment . "\n\n";

        #echo "---- appleJWT data signedTransactionInfo= ". $signedTransactionInfo ."\n\n";
        echo "---- appleJWT  payload1 data signedTransactionInfo1_stdClass is " . Utils::typeof($signedTransactionInfo1_stdClass) . "\n\n"; // is stdClass : do json_encode to get string

        // echo "---- appleJWT data signedTransactionInfo1= ". $signedTransactionInfo1 ."\n\n";
        echo "---- appleJWT  payload1 data signedTransactionInfo1_string is " . Utils::typeof($signedTransactionInfo1_string) . "\n\n";

        echo "---- appleJWT  payload1 data signedTransactionInfo1_object_vars is " . Utils::typeof($signedTransactionInfo1_object_vars) . "\n\n";
        echo "==== appleJWT  payload1 data signedTransactionInfo1_object_vars= " .  Utils::toString($signedTransactionInfo1_object_vars) . "\n\n";

        echo "==== appleJWT  payload1 data signedTransactionInfo1_object_vars keys= " . Utils::toString(array_keys($signedTransactionInfo1_object_vars)) . "\n\n";
        echo "==== appleJWT  payload1 data signedTransactionInfo1_object_vars values= " . Utils::toString(array_values($signedTransactionInfo1_object_vars)) . "\n\n";


        $this->assertEquals(TRUE, TRUE);
    }


    public function x_test_signedPayload_final_1()
    {
        echo "\ntest_signedPayload_final_1\n";

        // get text from the file
        $appleJWT_text = file_get_contents(__DIR__ . '/data/signedPayload1.json');

        // create and initialize the converter
        $converter = new AppleJWT($appleJWT_text);

        // get the signedTransactionInfo properties as string
        $vars_string = $converter->getSignedTransactionInfoVars();        //$this->assertEquals($vars_string, '[transactionId => 2000000252146699, originalTransactionId => 1000000636285238, webOrderLineItemId => 2000000018941206, bundleId => com.share-telematics.StickPlan1, productId => SPLMS, subscriptionGroupIdentifier => 20605699, purchaseDate => 1673965876000, originalPurchaseDate => 1583681241000, expiresDate => 1673966176000, quantity => 1, type => Auto-Renewable Subscription, inAppOwnershipType => PURCHASED, signedDate => 1673965850117, environment => Sandbox]');
        $this->assertEquals($vars_string, '[transactionId => 2000000251171798, originalTransactionId => 1000000636285238, webOrderLineItemId => 2000000018867885, bundleId => com.share-telematics.StickPlan1, productId => SPLPS, subscriptionGroupIdentifier => 20605699, purchaseDate => 1673880327000, originalPurchaseDate => 1583681241000, expiresDate => 1673880627000, quantity => 1, type => Auto-Renewable Subscription, inAppOwnershipType => PURCHASED, signedDate => 1673880631072, environment => Sandbox]');

        // get the signedTransactionInfo keys as string
        $vars_string = $converter->getSignedTransactionInfoKeys();
        $this->assertEquals($vars_string, '[transactionId, originalTransactionId, webOrderLineItemId, bundleId, productId, subscriptionGroupIdentifier, purchaseDate, originalPurchaseDate, expiresDate, quantity, type, inAppOwnershipType, signedDate, environment]');

        $this->assertEquals(TRUE, TRUE);
    }

    public function x_test_signedPayload_final_2()
    {
        echo "\ntest_signedPayload_final_2\n";

        // get text from the file
        $appleJWT_text = file_get_contents(__DIR__ . '/data/signedPayload2.json');

        // create and initialize the converter
        $converter = new AppleJWT($appleJWT_text);

        // get the signedTransactionInfo properties as string
        $vars_string = $converter->getSignedTransactionInfoVars();
        $this->assertEquals($vars_string, '[transactionId => 2000000252146699, originalTransactionId => 1000000636285238, webOrderLineItemId => 2000000018941206, bundleId => com.share-telematics.StickPlan1, productId => SPLMS, subscriptionGroupIdentifier => 20605699, purchaseDate => 1673965876000, originalPurchaseDate => 1583681241000, expiresDate => 1673966176000, quantity => 1, type => Auto-Renewable Subscription, inAppOwnershipType => PURCHASED, signedDate => 1673965850117, environment => Sandbox]');

        // get the signedTransactionInfo keys as string
        $vars_string = $converter->getSignedTransactionInfoKeys();
        $this->assertEquals($vars_string, '[transactionId, originalTransactionId, webOrderLineItemId, bundleId, productId, subscriptionGroupIdentifier, purchaseDate, originalPurchaseDate, expiresDate, quantity, type, inAppOwnershipType, signedDate, environment]');

        $this->assertEquals(TRUE, TRUE);
    }


    public function x_test_signedPayload_final_3()
    {
        echo "\ntest_signedPayload_final_3\n";

        // get text from the file
        $appleJWT_text = file_get_contents(__DIR__ . '/data/signedPayload3.json');

        // create and initialize the converter
        $converter = new AppleJWT($appleJWT_text);

        // get the signedTransactionInfo properties as string
        $vars_string = $converter->getSignedTransactionInfoVars();
        $this->assertEquals($vars_string, '[transactionId => 2000000253271855, originalTransactionId => 1000000636285238, webOrderLineItemId => 2000000019030938, bundleId => com.share-telematics.StickPlan1, productId => SPLPS_GADZARTS, subscriptionGroupIdentifier => 20605699, purchaseDate => 1674061594000, originalPurchaseDate => 1583681241000, expiresDate => 1674061894000, quantity => 1, type => Auto-Renewable Subscription, inAppOwnershipType => PURCHASED, signedDate => 1674061904491, environment => Sandbox]');

        // get the signedTransactionInfo keys as string
        $vars_string = $converter->getSignedTransactionInfoKeys();
        $this->assertEquals($vars_string, '[transactionId, originalTransactionId, webOrderLineItemId, bundleId, productId, subscriptionGroupIdentifier, purchaseDate, originalPurchaseDate, expiresDate, quantity, type, inAppOwnershipType, signedDate, environment]');

        $this->assertEquals(TRUE, TRUE);
    }


    public function test_decode_signedPayload_final_1()
    {
        echo "\nest_decode_signedPayload_final_1\n";

        // get text from the file
        $appleJWT_text = file_get_contents(__DIR__ . '/data/signedPayload1.json');

        $result = AppleJWT2::decode($appleJWT_text);


        print_r($result);

        $keys = array_keys($result);

        print_r($keys);

        $values = array_values($result);

        print_r($values);

        $this->assertEquals(TRUE, TRUE);
    }


    public function test_decode_signedPayload_final_2()
    {
        echo "\nest_decode_signedPayload_final_2\n";

        // get text from the file
        $appleJWT_text = file_get_contents(__DIR__ . '/data/signedPayload2.json');

        $result = AppleJWT2::decode($appleJWT_text);


        print_r($result);

        $keys = array_keys($result);

        print_r($keys);

        $values = array_values($result);

        print_r($values);

        $this->assertEquals(TRUE, TRUE);
    }

    public function test_decode_signedPayload_final_3()
    {
        echo "\nest_decode_signedPayload_final_3\n";

        // get text from the file
        $appleJWT_text = file_get_contents(__DIR__ . '/data/signedPayload3.json');

        // receive the result: associative array
        $result = AppleJWT2::decode($appleJWT_text);


        print_r($result);

        $keys = array_keys($result);

        print_r($keys);

        $values = array_values($result);

        print_r($values);

        $this->assertEquals(TRUE, TRUE);
    }
}
