<?php
/**
 * Process the form request and return the data. Create a session variable if it
 *  hasn't already been set.
 * @param  string $request the name of the request
 * @return string          the value of the request or empty string
 */
function get_form_request($request) {
    if (isset($_POST[$request])) {

        // set the session variable if it hasn't already been set.
        if (!isset($_SESSION[$request]) ||

            // set the session variable if the incoming request is different
            //  from the existing session variable.
            $_SESSION[$request] !== $_POST[$request]) {

            $_SESSION[$request] = $_POST[$request];
        }

        return $_POST[$request];
    } else if (isset($_SESSION[$request])) {
        return $_SESSION[$request];
    }

    return "";
}

function get_full_form_request() {
    if (isset($_POST) && count($_POST) > 0) {
        return $_POST;
    } else if (isset($_SESSION)) {
        return $_SESSION;
    }
    return false;
}
?>
