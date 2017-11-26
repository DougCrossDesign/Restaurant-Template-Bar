<?php
class CAuthClient {

    // SOAP client.
    private $client;

    // Location of CAuthServer service WSDL.
    private $wsdl = "https://intranet.aycmedia.com/api/CAuthServer_v1.php?WSDL";

    /**
     * @param string $username
     * @param string $password
     * @return mixed
     * @throws Exception
     */
    public function login($username, $password) {
        //die('start login process central authing');
        return $this->request('login', [
            'user' => $username,
            'pass' => $password
        ]);
    }

    /**
     * Creates a stream context that can be used to securely verify remote SSL hosts,
     * for instantiating SOAP clients which must communicate over secure connections.
     *
     * @return resource
     */
    private function getSSLContext() {
        // Setup path to CA PEM file and create stream context resource.
        $cert_file = CMS_SYSTEM_DIR . "/Storage/cacert.pem";

        // Verify that CA PEM file exists. If not, return an insecure context.
        if (!is_file($cert_file)) {
            return stream_context_create([]);
        }

        // Setup/configure SSL context.
        $context = stream_context_create(["ssl" => [
            "verify_peer" => true,
            "cafile" => $cert_file,
            "verify_depth" => 5,
        ]]);

        return $context;
    }

    /**
     * @param string $action
     * @param array $params
     * @return mixed
     * @throws Exception
     */
    private function request($action, $params = []) {
        // Make sure SoapClient exists.
        if (!class_exists("SoapClient")) {
            throw new Exception("Class SoapClient does not exist.");
        }

        // Setup SOAP client, if applicable.
        if ($this->client === null) {
            $this->client = new SoapClient($this->wsdl, [
                'trace'          => 1,
                'exceptions'     => 1,
                "stream_context" => $this->getSSLContext()
            ]);
        }

        // Gather some general information about the user and website this request is coming from.
        // Let the central authentication server decide what to do with this information.
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        $data = [
            "ipaddress" => $_SERVER['REMOTE_ADDR'],
            "useragent" => $_SERVER['HTTP_USER_AGENT'],
            "domain" => $_SERVER['HTTP_HOST'],
        ];

        // Pass request through to server and return full result.
        $result = $this->client->request($action, $params, $data);

        return $result;
    }
}