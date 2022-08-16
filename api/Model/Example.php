<?php
    namespace WebApp\Platform\OpenApi\Model;

    use OpenApi\Annotations as OA;
    use JsonSerializable;

    /**
     * @OA\Schema(
     *     schema="Example",
     *     title="Examples",
     * )
     */
    #[\Code\Simplify\AllArgsConstructor]
    final class Example extends \Code\Simplify implements JsonSerializable {
        /**
         * @OA\Property
         * @var int
         */
        public int $id = 0;
        /**
         * @OA\Property
         * @var string
         */
        public string $name = 'foo';
        public function jsonSerialize() : mixed {
            return [
                'id' => $this->id,
                'name' => $this->name,
            ];
        }
    }