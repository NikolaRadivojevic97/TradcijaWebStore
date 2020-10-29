<?php

namespace App\Email;

use App\Entity\Orders;
use App\Entity\User;
use Psr\Log\LoggerInterface;
use Swift_Mailer;
use Swift_Message;
use Twig\Environment;

class Mailer
{
    /**
     * @var Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(
        Swift_Mailer $mailer,
        Environment $twig,
        LoggerInterface $logger
    )
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->logger=$logger;
    }

    public function sendConfirmationEmail(User $user)
    {
        $body = $this->twig->render(
            'email/confirmation.html.twig',
            [
                'user' => $user
            ]
        );

        $message = (new Swift_Message('Please confirm your account!'))
            ->setFrom('tradicijaautopresvlake@gmail.com')
            ->setTo($user->getInfo()->getEmail())
            ->setBody($body, 'text/html');

        $this->mailer->send($message);
        $this->logger->debug("dosado do kraja mejlera");

    }
    public function sendOrderConfirmation(Orders $order)
    {
        $body = $this->twig->render(
            'email/orderconfirmation.html.twig',
            [
                'order' => $order
            ]
        );

        $message = (new Swift_Message('Order confirmation'))
            ->setFrom('tradicijaautopresvlake@gmail.com')
            ->setTo($order->getShoppingCart()->getCustomer()->getEmail())
            ->setBody($body, 'text/html');

        $this->mailer->send($message);
        $this->logger->debug("dosado do kraja mejlera");

    }
}