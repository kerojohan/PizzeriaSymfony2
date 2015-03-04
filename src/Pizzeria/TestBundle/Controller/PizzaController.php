<?php

namespace Pizzeria\TestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pizzeria\TestBundle\Entity\Pizza;
use Pizzeria\TestBundle\Form\PizzaType;

/**
 * Pizza controller.
 *
 */
class PizzaController extends Controller
{

    /**
     * Lists all Pizza entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PizzeriaTestBundle:Pizza')->findAll();

        return $this->render('PizzeriaTestBundle:Pizza:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Pizza entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Pizza();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $sellingPrice = 0;
            $ingredients = $entity->getIngredients();
            // Create an ArrayCollection of the current Tag objects in the database
            foreach ($ingredients as $ingredient) {             
                $sellingPrice = $sellingPrice + $ingredient->getcost();
            }

            $sellingPrice = $sellingPrice * 1.5;
            $entity->setSellingPrice($sellingPrice);

            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pizza_show', array('id' => $entity->getId())));
        }

        return $this->render('PizzeriaTestBundle:Pizza:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Pizza entity.
     *
     * @param Pizza $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Pizza $entity)
    {
        $form = $this->createForm(new PizzaType(), $entity, array(
            'action' => $this->generateUrl('pizza_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Pizza entity.
     *
     */
    public function newAction()
    {
        $entity = new Pizza();
        $form   = $this->createCreateForm($entity);

        return $this->render('PizzeriaTestBundle:Pizza:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Pizza entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PizzeriaTestBundle:Pizza')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pizza entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PizzeriaTestBundle:Pizza:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pizza entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PizzeriaTestBundle:Pizza')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pizza entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PizzeriaTestBundle:Pizza:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Pizza entity.
    *
    * @param Pizza $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pizza $entity)
    {
        $form = $this->createForm(new PizzaType(), $entity, array(
            'action' => $this->generateUrl('pizza_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Pizza entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PizzeriaTestBundle:Pizza')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pizza entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pizza_edit', array('id' => $id)));
        }

        return $this->render('PizzeriaTestBundle:Pizza:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Pizza entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PizzeriaTestBundle:Pizza')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pizza entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pizza'));
    }

    /**
     * Creates a form to delete a Pizza entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pizza_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
        public function ingredientsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PizzeriaTestBundle:Ingredient')->findAll();

        return $this->render('PizzeriaTestBundle:Pizza:ingredient.html.twig', array(
            'entities' => $entities,
        ));
    }
}
