<?php

namespace App\Controller;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class UserController extends AbstractController
{
    private EntityManagerInterface $entitymanger;

    public function  __construct(EntityManagerInterface $entitymanger)
    {
        $this->entitymanger = $entitymanger;
    }

    /**
     * @Route("/user", name="user", methods={"GET"})
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        /** @var User $user */

        $user = $this->getUser();
        return $this->render('admin/admin.html.twig', [
            'user' => $user,
        ]);
    }


}
