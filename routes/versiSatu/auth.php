<?php

return [
    /**
     * @SWG\Get(
     *   path="/v1/me",
     *   summary="Get current user",
     *   tags={"Auth"},
     *   @SWG\Response(
     *     response=200,
     *     description="Data user",
     *     @SWG\Schema(ref="#/definitions/CurrentUser")
     *   ),
     *   @SWG\Response(
     *     response=401,
     *     description="Unauthorized",
     *     @SWG\Schema(ref="#/definitions/Unauthorized")
     *   )
     * )
     */
    'GET me' => 'auth/me',

    'POST auth/change' => 'auth/change',
    /**
     * @SWG\Get(
     *     path="/v1/auth/change",
     *     summary="Get data batch",
     *     tags={"Auth"},
     *     @SWG\Parameter(
     *         ref="#/parameters/id"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Data batch",
     *         @SWG\Schema(ref="#/definitions/Auth")
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Resource not found",
     *         @SWG\Schema(ref="#/definitions/Not Found")
     *     )
     * )
     */
];