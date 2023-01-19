<?php

namespace drmonkeyninja;

class AppleJWT
{

    // string received over the wire
    public $signedPayloadDict;

    // the value of the signedPayload key
    public $signedPayload;

    // the 3 parts of the signedPayload
    public $signedPayloadParts;

    public $signedPayload_header;
    public $signedPayload_payload;
    public $signedPayload_signature_provided;

    // the header of the signedPayload
    public $signedPayload_header_alg;
    public $signedPayload_header_x5c;

    // the x5c array of the header: 3 parts
    public $signedPayload_header_x5c_header;
    public $signedPayload_header_x5c_payload;
    public $signedPayload_header_x5c_signature_provided;

    // the 3 parts of header xc5 decoded
    public $signedPayload_header_x5c_header_0;
    public $signedPayload_header_x5c_header_1;
    public $signedPayload_header_x5c_header_2;

    // the first 3 values in signedPayload_payload
    public $signedPayload_payload_notificationType;
    public $signedPayload_payload_subtype;
    public $signedPayload_payload_notificationUUID;
    public $signedPayload_payload_data;
    public $signedPayload_payload_version;
    public $signedPayload_payload_signedDate;

    // items from $signedPayload_payload_data;
    public $signedPayload_payload_data_bundleId;
    public $signedPayload_payload_data_bundleVersion;
    public $signedPayload_payload_data_environment;
    public $signedPayload_payload_data_signedTransactionInfo; // is a signed string 

    public $signedPayload_payload_data_signedTransactionInfo_parts; // is an array of 3 parts

    public $signedPayload_payload_data_signedTransactionInfo_part_1; // part  of interest

    // 14 extracted items
    public $signedPayload_payload_data_signedTransactionInfo_part_1_transactionId;
    public $signedPayload_payload_data_signedTransactionInfo_part_1_originalTransactionId;
    public $signedPayload_payload_data_signedTransactionInfo_part_1_webOrderLineItemId;

    public $signedPayload_payload_data_signedTransactionInfo_part_1_bundleId;
    public $signedPayload_payload_data_signedTransactionInfo_part_1_productId;
    public $signedPayload_payload_data_signedTransactionInfo_part_1_subscriptionGroupIdentifier;

    public $signedPayload_payload_data_signedTransactionInfo_part_1_purchaseDate;
    public $signedPayload_payload_data_signedTransactionInfo_part_1_originalPurchaseDate;
    public $signedPayload_payload_data_signedTransactionInfo_part_1_expiresDate;

    public $signedPayload_payload_data_signedTransactionInfo_part_1_quantity;
    public $signedPayload_payload_data_signedTransactionInfo_part_1_type;
    public $signedPayload_payload_data_signedTransactionInfo_part_1_inAppOwnershipType;

    public $signedPayload_payload_data_signedTransactionInfo_part_1_signedDate;
    public $signedPayload_payload_data_signedTransactionInfo_part_1_environment;




    public function __construct(string $signedPayloadDict)
    {

        // 1. initialize the signedPayloadDict property from the constructor argument
        $this->signedPayloadDict = $signedPayloadDict;


        $key = "c025e2a7b5aa4f12a8b7ec51acdbbd08";
        // $key = "";
        $payload1 = JWT::decode($appleJWT, new Key($key, 'ES256'));

        $payload1 = json_encode($payload1);

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
    }
}
