<?php
namespace WebApp\Platform\OpenApi;

use OpenApi\Annotations as OA;

/** 
 * 
 * @OA\Info(
 *     version="1.0",
 *     title="OpenAPI",
 *     description="OpenAPI",
 *     @OA\Contact(name="OpenAPI")
 * )
 * @OA\Server(
 *     url="http://localhost:8888/",
 *     description="API server"
 * )
 * @OA\Tag(
 *     name="Example",
 *     description="Example"
 * )
 */
final class OpenAPI {}