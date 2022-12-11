<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;



class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }




    /**
     * @Route("/formation", name="formation")
     */
    public function for(): Response
    {

        return $this->render('home/formation.html.twig', [

        ]);
    }

    /**
     * @Route("/domaines-d'expertise", name="expertise")
     */
    public function expertise(): Response
    {

        return $this->render('home/expertise.html.twig', [

        ]);
    }


    /**
     * @Route("/contactf", name="contactf")
     */
    public function contactf(Request $request): Response
    {

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        return $this->render('home/contact-form.html.twig', [
            'Contact' => $form->createView(),
        ]);
    }


    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);


        return $this->render('home/text.html.twig', [
            'Contact' => $form->createView(),
        ]);
    }





/**
 * @Route("/list", name="list")
 */
public function  list(): Response{

        return $this->render('home/list.html.twig', [

        ]);
    }



    /**
     * @Route("/contact", name="contact")
     */
    public function  contactus(Request $request): Response{
        $form = $this->createForm(ContactType::class);

        return $this->render('home/contact_us.html.twig', [
            'Contact' => $form->createView(),
        ]);
    }



/**
 * @Route("/contactpages", name="contactpages")
 */
public function  contactpages(Request $request, MailerInterface $mailer): Response{
    $form = $this->createForm(ContactType::class);
    $contact = $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){

         $data = $form->getData();

        $email    = $data['email'];
        $message    = $data['message'];
        $email = (new Email())
            ->from($email)
            ->to('you@example.com')
            ->subject('demande')
        ->subject($message);

        $mailer->send($email);
    }

    return $this->render('home/contactpages.html.twig', [

        'Contact' => $form->createView(),

    ]);
}



    /**
     * @Route("/apropos", name="apropos")
     */
    public function celabout(): Response{

        return $this->render('home/celabout.html.twig', [

        ]);
    }
}
