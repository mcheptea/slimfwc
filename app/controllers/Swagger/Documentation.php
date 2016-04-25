<?php
namespace Controllers\Swagger;

use Swagger\Annotations as SWG;
use Swagger;
use Models\Rest\CustomResponse;

/**
 * @SWG\Swagger(
 *      basePath="/index.php/",
 *      produces={"application/json"},
 *      consumes={"application/json", "multipart/form-data"},
 *      swagger="2.0",
 *      @SWG\Info(
 *          version="1.0.0",
 *          title="App API",
 *          description="Description goes here",
 *          @SWG\Contact(name="Mark Cheptea", email="marc.cheptea@spamina.com")
 *      ),
 *      @SWG\Parameter(
 *          name="X-Internal-Auth-Key",
 *          required=true,
 *          type="string",
 *          in="header",
 *          description="The API Authentication Key, used for internal API request validation."
 *      ),
 *      @SWG\Response(
 *          response="401",
 *          description="Authentication failed, X-Internal-Auth-Key is missing or is not valid."
 *      ),
 *      @SWG\Response(
 *          response="500",
 *          description="Internal error occurred."
 *      )
 * )
 *
 * User: Mark Cheptea
 * Date: 6/11/2015
 * Time: 1:25 PM
 */
class Documentation {

    const API_PATH = "../app/controllers";

    /**
     * @SWG\Get(
     *     tags={"api"},
     *     path="/api/documentation",
     *     description="Generates and returns this API's documentation.",
     *     summary="Get API Documentation",
     *     operationId="getAPIDocumentation",
     *
     *     @SWG\Response(response="200", description="The generated swagger documentation."),
     *     @SWG\Response(response="500", description="Internal server error.")
     * )
     */
    public function show(){
        $swagger = Swagger\scan(self::API_PATH);

        return CustomResponse::plain($swagger, CustomResponse::HTTP_OK, CustomResponse::CONTENT_TYPE_JSON);
    }
}