<?php


namespace App\Controller;

use App\Entity\ShoppingCart;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class AddToCartAction
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(ShoppingCart $data)
    {
        $data->addProduct($data->getAddProduct());
        $this->entityManager->flush();

        return new JsonResponse($data);

    }
}