<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class GetMyOrdersAction
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    public function __construct(
        EntityManagerInterface $entityManager,
        TokenStorageInterface $tokenStorage,
    LoggerInterface $logger
    )
    {
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
        $this->logger=$logger;
    }

    public function __invoke(array $data)
    {
        $token = $this->tokenStorage->getToken();
            $orders=[];

            /** @var User $author */
            $author = $token->getUser();
            foreach($data as $item){
                /** @var Order $order */
                $order=$item;
                if($order->getShoppingCart()->getCustomer()->getUser()===$author){
                    $orders[] = $order;
                }

            }

        return new JsonResponse($data);

    }
}
