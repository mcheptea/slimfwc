<?php
namespace Models\Rest;

use Slim\Http\Response;
use Slim\Slim;

/**
 * Rest Response utility class.
 *
 * User: Mark Cheptea
 * Date: 10/23/2015
 * Time: 1:20 PM
 */
class CustomResponse extends Response
{
    //200
    const HTTP_OK = 200;

    //400
    const HTTP_BAD_REQUEST = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_NOT_FOUND = 404;
    const HTTP_METHOD_NOT_ALLOWED = 405;
    const HTTP_PRECONDITION_FAILED = 412;

    //400 custom
    const HTTP_BAD_PARAMETER_COHERENCE = 451;
    const HTTP_REDUNDANT_REQUEST = 452;
    const HTTP_DATA_NONEXISTENT = 453;

    //500
    const HTTP_INTERNAL_SERVER_ERROR = 500;

    const CONTENT_TYPE_JSON = "application/json";
    const CONTENT_TYPE_PLAIN = "text/plain";

    /**
     * Prepares a json response and gives it to the app.
     *
     * @param array $body
     * @param int $status, the http status code
     */
    public static function json(array $body = array(), $status = self::HTTP_OK){
        //set status code
        self::setCustomStatus($status);

        //set content type
        self::setContentType(self::CONTENT_TYPE_JSON);

        echo json_encode($body);
        die;
    }

    /**
     * Outputs a plain response.
     *
     * Note: This method expect the first parameter to be a string.
     *
     * @param string $body
     * @param int $status
     * @param string $content_type
     */
    public static function plain($body, $status = self::HTTP_OK, $content_type = self::CONTENT_TYPE_JSON){
        //set status code
        self::setCustomStatus($status);

        //set content type
        self::setContentType($content_type);

        echo $body;
        die;
    }

    /**
     * Sets the HTTP status code in the headers.
     *
     * @param int $status
     * @return void
     */
    private static function setCustomStatus($status){
        $app = Slim::getInstance();

        //cast the status code
        $status  = (int)$status == 0 ? 500 : (int) $status;

        $http_code_message = \Slim\Http\Response::getMessageForCode($status);
        $http_code_message = is_null($http_code_message) ? "$status Custom Response Code" : $http_code_message;

        if (strpos(PHP_SAPI, 'cgi') === 0) {
            header(sprintf('Status: %s', $http_code_message));
        } else {
            header(sprintf('HTTP/%s %s', $app->config('http.version'), $http_code_message));
        }
    }

    /**
     * Sets the content type to the headers.
     *
     * @param string $contentType
     */
    private static function setContentType($contentType){
        header('Content-Type: '.$contentType);
    }
}