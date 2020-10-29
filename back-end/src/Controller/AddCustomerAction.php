<?php


namespace App\Controller;

use App\Entity\ShoppingCart;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AddCustomerAction
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
        TokenStorageInterface $tokenStorage
    )
    {
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
    }

    public function __invoke(ShoppingCart $data)
    {
        $token = $this->tokenStorage->getToken();

        if ($token->getUser()!=="anon.") {
            /** @var User $author */
            $author = $token->getUser();
            $shoppingCarts=$author->getInfo()->getShoppingCarts();
            foreach ($shoppingCarts as $sc){
                if($sc->getActive()){
                    foreach ($sc->getProducts() as $product){
                        $data->addProduct($product);
                    }
                    $sc->setActive(false);
                    $data->setActive(true);
                }
            }
            $data->setCustomer($author->getInfo());
        }

        $this->entityManager->flush();

        return new JsonResponse($data);

    }
}