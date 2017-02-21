<?php

namespace AppBundle\Controller;

use AppBundle\Entity\LoginAccounts;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Loginaccount controller.
 *
 */
class LoginAccountsController extends Controller
{
    /**
     * Lists all loginAccount entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $loginAccounts = $em->getRepository('AppBundle:LoginAccounts')->findAll();

        return $this->render('loginaccounts/index.html.twig', array(
            'loginAccounts' => $loginAccounts,
        ));
    }

    /**
     * Creates a new loginAccount entity.
     *
     */
    public function newAction(Request $request)
    {
        $loginAccount = new Loginaccount();
        $form = $this->createForm('AppBundle\Form\LoginAccountsType', $loginAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($loginAccount);
            $em->flush($loginAccount);

            return $this->redirectToRoute('cms2_user_show', array('id' => $loginAccount->getId()));
        }

        return $this->render('loginaccounts/new.html.twig', array(
            'loginAccount' => $loginAccount,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a loginAccount entity.
     *
     */
    public function showAction(LoginAccounts $loginAccount)
    {
        $deleteForm = $this->createDeleteForm($loginAccount);

        return $this->render('loginaccounts/show.html.twig', array(
            'loginAccount' => $loginAccount,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing loginAccount entity.
     *
     */
    public function editAction(Request $request, LoginAccounts $loginAccount)
    {
        $deleteForm = $this->createDeleteForm($loginAccount);
        $editForm = $this->createForm('AppBundle\Form\LoginAccountsType', $loginAccount);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cms2_user_edit', array('id' => $loginAccount->getId()));
        }

        return $this->render('loginaccounts/edit.html.twig', array(
            'loginAccount' => $loginAccount,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a loginAccount entity.
     *
     */
    public function deleteAction(Request $request, LoginAccounts $loginAccount)
    {
        $form = $this->createDeleteForm($loginAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($loginAccount);
            $em->flush($loginAccount);
        }

        return $this->redirectToRoute('cms2_user_index');
    }

    /**
     * Creates a form to delete a loginAccount entity.
     *
     * @param LoginAccounts $loginAccount The loginAccount entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(LoginAccounts $loginAccount)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cms2_user_delete', array('id' => $loginAccount->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
