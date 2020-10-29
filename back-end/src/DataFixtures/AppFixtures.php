<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Car;
use App\Entity\Combination;
use App\Entity\Covers;
use App\Entity\Model;
use App\Entity\Order;
use App\Entity\ShippingInfo;
use App\Entity\ShoppingCart;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $this->loadBrands($manager);
        $this->loadModels($manager);
        $this->loadCars($manager);
        $this->loadCombinations($manager);
        $this->loadCovers($manager);
        $this->loadShippingInfo($manager);
        $this->loadUsers($manager);
        $this->loadShoppingCarts($manager);
        $this->loadOrders($manager);
    }
    public function loadBrands(ObjectManager $manager){
        $brand=new Brand();
        $brand->setName("mercedes");
        $this->setReference("mercedes", $brand);
        $manager->persist($brand);
        $manager->flush();
        $brand=new Brand();
        $brand->setName("audi");
        $this->setReference("audi", $brand);
        $manager->persist($brand);
        $manager->flush();

    }
    public function loadModels(ObjectManager $manager){
        $brand=$this->getReference("mercedes");
        $model=new Model();
        $model->setName("e class");
        $model->setBrand($brand);
        $this->setReference("e", $model);
        $manager->persist($model);
        $manager->flush();
        $brand=$this->getReference("audi");
        $model=new Model();
        $model->setName("a4");
        $model->setBrand($brand);
        $this->setReference("a4", $model);
        $manager->persist($model);
        $manager->flush();
    }
    public function loadCars(ObjectManager $manager){
        $model=$this->getReference("e");
        $car=new Car();
        $car->setBodyType("limuzine");
        $car->setEquipmentLevel("classic");
        $car->setGeneration("2003-2010");
        $car->setModel($model);
        $this->setReference("mercedes e",$car);
        $manager->persist($car);
        $manager->flush();

        $model=$this->getReference("a4");
        $car=new Car();
        $car->setBodyType("limuzine");
        $car->setEquipmentLevel("s line");
        $car->setGeneration("2005-2008");
        $car->setModel($model);
        $this->setReference("audi a4", $car);
        $manager->persist($car);
        $manager->flush();
    }
    public function loadCombinations(ObjectManager $manager){
        $combination=new Combination();
        $combination->setColor1("black");
        $combination->setColor2("red");
        $combination->setUrl("colors picture");
        $combination->setDescription("eko koza");
        $this->setReference("crveno-crne",$combination);
        $manager->persist($combination);
        $manager->flush();
        $combination=new Combination();
        $combination->setColor1("black");
        $combination->setColor2("black");
        $combination->setUrl("colors picture");
        $combination->setDescription("kombinacija");
        $this->setReference("crne",$combination);
        $manager->persist($combination);
        $manager->flush();
        $combination=new Combination();
        $combination->setColor1("grey");
        $combination->setColor2("black");
        $combination->setUrl("colors picture");
        $combination->setDescription("stof");
        $this->setReference("sivo-crne",$combination);
        $manager->persist($combination);
        $manager->flush();

    }
    public function loadCovers(ObjectManager $manager){
        $combination=$this->getReference("sivo-crne");
        $car=$this->getReference("mercedes e");
        $cover=new Covers();
        $cover->setUrl("seat color");
        $cover->setCar($car);
        $cover->setCombination($combination);
        $cover->setPrice(120.0);
        $this->setReference("mercedes e sivo-crno",$cover);
        $manager->persist($cover);
        $manager->flush();
        $combination=$this->getReference("crveno-crne");
        $car2=$this->getReference("audi a4");
        $cover=new Covers();
        $cover->setUrl("seat color");
        $cover->setCar($car2);
        $cover->setCombination($combination);
        $cover->setPrice(120.0);
        $this->setReference("audi a4 crveno-crno",$cover);
        $manager->persist($cover);
        $manager->flush();
        $combination=$this->getReference("crne");
        $cover=new Covers();
        $cover->setUrl("seat color");
        $cover->setCar($car);
        $cover->setCombination($combination);
        $cover->setPrice(120.0);
        $this->setReference("mercedes e crno",$cover);
        $manager->persist($cover);
        $manager->flush();
    }
    public function loadShippingInfo(ObjectManager $manager){
        $shippingInfo=new ShippingInfo();
        $shippingInfo->setFirstName("pera");
        $shippingInfo->setLastName("peric");
        $shippingInfo->setAddress("adresa1");
        $shippingInfo->setEmail("peraperic@gmail.com");
        $shippingInfo->setCity("beograd");
        $shippingInfo->setZipCode("11000");
        $shippingInfo->setPhoneNumber("0654279267");
        $this->setReference("pera peric",$shippingInfo);
        $manager->persist($shippingInfo);
        $manager->flush();

        $shippingInfo=new ShippingInfo();
        $shippingInfo->setFirstName("zika");
        $shippingInfo->setLastName("zikic");
        $shippingInfo->setAddress("adresa1");
        $shippingInfo->setEmail("zikazikic@gmail.com");
        $shippingInfo->setCity("beograd");
        $shippingInfo->setZipCode("11000");
        $shippingInfo->setPhoneNumber("0654279267");
        $this->setReference("zika zikic",$shippingInfo);
        $manager->persist($shippingInfo);
        $manager->flush();

        $shippingInfo=new ShippingInfo();
        $shippingInfo->setFirstName("laza");
        $shippingInfo->setLastName("lazic");
        $shippingInfo->setAddress("adresa1");
        $shippingInfo->setEmail("lazalazic@gmail.com");
        $shippingInfo->setCity("beograd");
        $shippingInfo->setZipCode("11000");
        $shippingInfo->setPhoneNumber("0654279267");
        $this->setReference("laza lazic",$shippingInfo);
        $manager->persist($shippingInfo);
        $manager->flush();

    }
    public function loadUsers(ObjectManager $manager){
        $user=new User();
        $user->setUsername("pera peric");
        $user->setPassword($this->passwordEncoder->encodePassword($user,"sifra"));
        $user->setInfo($this->getReference("pera peric"));
//        $user->addProduct($this->getReference("mercedes e crno"));
        $manager->persist($user);
        $manager->flush();
    }
    public function loadShoppingCarts(ObjectManager $manager){
        $sc=new ShoppingCart();
        $sc->setCustomer($this->getReference("pera peric"));
        $sc->setActive(false);
        $sc->addProduct($this->getReference("mercedes e sivo-crno"));
        $this->setReference("perina korpa",$sc);
        $manager->persist($sc);
        $manager->flush();

        $sc=new ShoppingCart();
        $sc->setCustomer($this->getReference("laza lazic"));
        $sc->setActive(true);
        $sc->addProduct($this->getReference("mercedes e sivo-crno"));
        $this->setReference("lazina korpa",$sc);
        $manager->persist($sc);
        $manager->flush();
    }
    public function loadOrders(ObjectManager $manager){
        $order=new Order();
        $order->setDate(new \DateTime());
        $order->setStatus("naruceno");
        $order->setShoppingCart($this->getReference("perina korpa"));
        $manager->persist($order);
        $manager->flush();
    }


}
