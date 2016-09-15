<?php
abstract class Api {

	/**
	 * The HTTP method this request was made in, either GET, POST, PUT or DELETE
	 * @var string
	 */
    protected $method = '';

	/**
	 * The Model requested in the URI. eg: /files
	 * @var string
	 */
    protected $endpoint = '';

	/**
	 * An optional additional descriptor about the endpoint, used for things that can
     * not be handled by the basic methods. eg: /files/process
	 * @var string
	 */
    protected $verb = '';

	/**
	 * Any additional URI components after the endpoint and verb have been removed, in our
     * case, an integer ID for the resource. eg: /<endpoint>/<verb>/<arg0>/<arg1>
     * or /<endpoint>/<arg0>
	 * @var Array
	 */
    protected $args = Array();

	/**
	 * Stores the input of the PUT request
	 * @var [type]
	 */
    protected $file = Null;

	/**
	 * Trims extra whitespace, and strip tags from URI data.
	 * @param  Array  $data URI request data
	 * @return Array        cleaned URI request data
	 */
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

	/**
	 * Returns an error status based on an error code.
	 * @param  integer $code an HTTP status code (ie. 200)
	 * @return string        the associated message
	 */
	private function _requestStatus($code) {
	    $status = array(
	        200 => 'OK',
	        404 => 'Not Found',
	        405 => 'Method Not Allowed',
	        500 => 'Internal Server Error',
	    );

	    return ($status[$code]) ? $status[$code] : $status[500];
	}

	/**
	 * Sets the header to the current HTTP status.
	 * @param  Object  $data   data returned from the model
	 * @param  integer $status an HTTP status code (200 by default)
	 * @return JSON
	 */
    private function _response($data, $status = 200) {
        header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));

        return json_encode($data);
    }

	/**
	 * Sanitizes the URI request data.
	 * @param  string $method the type of request made (ie. HTTP GET)
	 */
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

	/**
	 * Sets the value of args to any extra request data that isn't the
	 *  endpoint or the verb. This data will then be passed into the endpoint
	 *  as a function parameter.
	 * @param [type] $request [description]
	 */
	private function _setArgs($request) {
		$this->args = $request;
	}

	/**
	 * Sets the value of the endpoint. This is the name of the model we will be
	 *  receiving data from.
	 * @param Array $request the URI request data
	 */
	private function _setEndpoint(&$request) {
		if (isset($request['endpoint'])) {
			$this->endpoint = $request['endpoint'];
			unset($request['endpoint']);
		} else {
			throw new Exception("Missing endpoint");
		}
	}

	/**
	 * Sets the method of the request (ie. HTTP GET).
	 * @param string $requestMethod the HTTP request method (ie. HTTP GET)
	 */
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

	/**
	 * Sets the extra description of how to process the request. For example,
	 *  /files/process.
	 * @param Array $request the URI request data
	 */
	private function _setVerb(&$request) {
		if (isset($request['verb'])) {
			$this->verb = $request['verb'];
			unset($request['verb']);
		}
	}

	/**
	 * Strips any request that begins with _ from the request URI array.
	 * @param  Array $request the URI request data
	 */
	private function _stripUnderscoreRequests(&$request) {
		foreach ($request as $key => $val) {
			if (substr($key, 0, 1) == '_') {
				unset($request[$key]);
			}
		}
	}

    /**
     * Constructor: __construct
     * Allow for CORS, assemble and pre-process the data
     */
    public function __construct($request) {
        // header("Access-Control-Allow-Orgin: *");
        // header("Access-Control-Allow-Methods: *");
        // header("Content-Type: application/json");

		$this->_stripUnderscoreRequests($request);
		$this->_setEndpoint($request);
		$this->_setVerb($request);
		$this->_setArgs($request);
		$this->_setMethod($_SERVER['REQUEST_METHOD']);
		$this->_sanitizeInputs($this->method);
    }

	/**
	 * Calls the endpoint with any arguments passed in. If the endpoint doesn't
	 *  exist, it returns a 404 (Not found) status.
	 * @return JSON || string either returns the JSON encoded data or an HTTP
	 *                 status message
	 */
   	public function processAPI() {
        if (method_exists($this, $this->endpoint)) {
            return $this->_response($this->{$this->endpoint}($this->args));
        }

        return $this->_response("No Endpoint: $this->endpoint", 404);
    }
}
?>
