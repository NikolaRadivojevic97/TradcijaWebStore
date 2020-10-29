<?php


namespace App\Controller;

use App\Entity\ShoppingCart;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class RemoveFromChartAction
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(ShoppingCart $data)
    {
        $data->removeProduct($data->getRemoveProduct());
        $this->entityManager->flush();

        return new JsonResponse($data);

    }
}
