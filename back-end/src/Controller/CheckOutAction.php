<?php


namespace App\Controller;

use App\Email\Mailer;
use App\Entity\Orders;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class CheckOutAction
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var Mailer
     */
    private $mailer;


    public function __construct(
        Mailer $mailer,
        EntityManagerInterface $entityManager,
        LoggerInterface $logger
    )
    {
        $this->entityManager = $entityManager;
        $this->mailer=$mailer;
        $this->logger=$logger;
    }

    public function __invoke(Orders $data){

        $data->getShoppingCart()->setActive(false);
        $data->setTotal($data->getShoppingCart()->getTotal());
        $this->entityManager->flush();
        // Send e-mail here...
        $this->mailer->sendOrderConfirmation($data);

        return new JsonResponse($data);

    }
}