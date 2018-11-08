<?php

namespace CEV\UserBundle\Controller;

use CEV\UserBundle\Entity\Intro;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Intro controller.
 *
 * @Route("intro")
 */
class IntroController extends Controller
{
    /**
     * Lists all intro entities.
     *
     * @Route("/", name="intro_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $intro = $em->getRepository('CEVUserBundle:Intro')->findOneBy(array('id'=>'1'));

        return $this->render('intro/index.html.twig', array(
            'intro' => $intro,
        ));
    }

    /**
     * Finds and displays a intro entity.
     *
     * @Route("/{id}", name="intro_show")
     * @Method("GET")
     */
    public function showAction(Intro $intro)
    {

        return $this->render('intro/show.html.twig', array(
            'intro' => $intro,
        ));
    }

    /**
     * Displays a form to edit an existing intro entity.
     *
     * @Route("/{id}/edit", name="intro_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Intro $intro)
    {
        $deleteForm = $this->createDeleteForm($intro);
        $editForm = $this->createForm('CEV\UserBundle\Form\IntroType', $intro);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('member_index');
        }

        return $this->render('intro/edit.html.twig', array(
            'intro' => $intro,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a intro entity.
     *
     * @Route("/{id}", name="intro_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Intro $intro)
    {
        $form = $this->createDeleteForm($intro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($intro);
            $em->flush();
        }

        return $this->redirectToRoute('member_index');
    }

    /**
     * Creates a form to delete a intro entity.
     *
     * @param Intro $intro The intro entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Intro $intro)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('intro_delete', array('id' => $intro->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
