<?php
abstract class Api {

	/**
     * Property: method
     * The HTTP method this request was made in, either GET, POST, PUT or DELETE
     */
    protected $method = '';

	/**
     * Property: endpoint
     * The Model requested in the URI. eg: /files
     */
    protected $endpoint = '';

	/**
     * Property: verb
     * An optional additional descriptor about the endpoint, used for things that can
     * not be handled by the basic methods. eg: /files/process
     */
    protected $verb = '';

	/**
     * Property: args
     * Any additional URI components after the endpoint and verb have been removed, in our
     * case, an integer ID for the resource. eg: /<endpoint>/<verb>/<arg0>/<arg1>
     * or /<endpoint>/<arg0>
     */
    protected $args = Array();

	/**
     * Property: file
     * Stores the input of the PUT request
     */
    protected $file = Null;

	private function _cleanInputs($data) {
        $clean_input = Array();

        if (is_array($data)) {

            foreach ($data as $k => $v) {
                $clean_input[$k] = $this->_cleanInputs($v);
            }
        } else {
            $clean_input = trim(strip_tags($data));
        }

        return $clean_input;
    }

	private function _requestStatus($code) {
	    $status = array(
	        200 => 'OK',
	        404 => 'Not Found',
	        405 => 'Method Not Allowed',
	        500 => 'Internal Server Error',
	    );

	    return ($status[$code]) ? $status[$code] : $status[500];
	}

    private function _response($data, $status = 200) {
        header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));

        return json_encode($data);
    }

	private function _sanitizeInputs($method) {
		switch($method) {
			case 'DELETE':
			case 'POST':
				$this->request = $this->_cleanInputs($_POST);
				break;
			case 'GET':
				$this->request = $this->_cleanInputs($_GET);
				break;
			case 'PUT':
				$this->request = $this->_cleanInputs($_GET);
				$this->file = file_get_contents("php://input");
				break;
			default:
				$this->_response('Invalid Method', 405);
				break;
		}
	}

	private function _setArgs($request) {
		// TODO: set $this->args here
	}

	private function _setEndpoint(&$request) {
		if (isset($request['endpoint'])) {
			$this->endpoint = $request['endpoint'];
			unset($request['endpoint']);
		} else {
			throw new Exception("Missing endpoint");
		}
	}

	private function _setMethod($requestMethod) {
		$this->method = $requestMethod;

		if ($this->method == 'POST' &&
			array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {

			if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
				$this->method = 'DELETE';
			} else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
				$this->method = 'PUT';
			} else {
				throw new Exception("Unexpected Header");
			}
		}
	}

	private function _setVerb(&$request) {
		if (isset($request['verb'])) {
			$this->verb = $request['verb'];
			unset($request['verb']);
		}
	}

    /**
     * Constructor: __construct
     * Allow for CORS, assemble and pre-process the data
     */
    public function __construct($request) {
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");

		$this->_setEndpoint($request);
		$this->_setVerb($request);
		$this->_setArgs($request);
		$this->_setMethod($_SERVER['REQUEST_METHOD']);
		$this->_sanitizeInputs($this->method);
    }

   	public function processAPI() {
        if (method_exists($this, $this->endpoint)) {
            return $this->_response($this->{$this->endpoint}($this->args));
        }

        return $this->_response("No Endpoint: $this->endpoint", 404);
    }
}
?>
