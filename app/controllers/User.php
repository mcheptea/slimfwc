<?php
namespace Controllers;

use Swagger\Annotations as SWG;
use Swagger;
use Models\Rest\CustomResponse;

class User
{
    /**
     * @SWG\Post(
     *     tags={"user"},
     *     path="/user/{username}",
     *     summary="Create user",
     *     description="create user description",
     *     operationId="createUser",
     *      @SWG\Parameter(
     *          name="username", required=true, type="string", description="The user's username (email).", in="path"
     *      ),
     *     @SWG\Response(
     *          response="200", description="The user created!"
     *      ),
     *     @SWG\Response(
     *          response="500", description="There was an error!"
     *      )
     * )
     */
    public function create($username)
    {
        $response = array("message" => "Hello " . $username);

        return CustomResponse::json($response, 200);
    }
}