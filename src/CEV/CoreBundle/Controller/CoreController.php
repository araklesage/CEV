<?php

namespace CEV\CoreBundle\Controller;

use CEV\CoreBundle\Entity\Contact;
use CEV\CoreBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class CoreController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="home")
     */
    public function indexAction()
    {


        return $this->render('Core/homepage.html.twig', array(
            'articles' => $this ->get('app.limit')->getLastArticles()
        ));
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {

        $contact = new Contact();

        $form = $this->get('form.factory')->create(ContactType::class, $contact);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush;

            $request->getSession()->getFlashBag()->add('notice', 'Votre message à bien été envoyé.');
            return $this->redirectToRoute('home');

        }
        return $this->render('Core/contact.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/bénévole", name="membership")
     */
    public function membershipAction ()
    {
        return $this->render('Core/membership.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/don", name="don")
     */
    public function donAction ()
    {
        return $this->render('Core/don.html.twig');
    }

}
