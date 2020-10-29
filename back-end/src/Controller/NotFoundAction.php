<?php


namespace App\Controller;

use App\Entity\Model;
use Symfony\Component\HttpFoundation\JsonResponse;

class NotFoundAction
{

    public function __invoke(Model $data)
    {
        return new JsonResponse($data);
    }
}