<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cms;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CmsController extends Controller
{
    /**
     * @Route("/", name="cms_list")
     */
    public function listAction(Request $request){
        $cms2 = $this->getDoctrine()
                ->getRepository('AppBundle:Cms')
                ->findAll();
                
        return $this->render('cms/index.html.twig', array('cms2' => $cms2
                
        ));
        
    }
    
    /**
     * @Route("cms/create", name="create_list")
     */
    public function createAction(Request $request){
        $cms = new Cms;
         
        $form = $this->createFormBuilder($cms)
                ->add('name', TextType::class, array('attr' => array('class' => 'form-control','style' => 'margin-bottom:15px')))
                ->add('category', TextType::class, array('attr' => array('class' => 'form-control','style' => 'margin-bottom:15px')))
                ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control','style' => 'margin-bottom:15px')))
                ->add('priority', ChoiceType::class, array('choices' => array('Low' => 'low', 'Normal' => 'Normal', 'High' => 'High'), 'attr' => array('class' => 'form-control','style' => 'margin-bottom:15px')))
                ->add('due_date', DateTimeType::class, array('attr' => array('class' => 'formcontrol','style' => 'margin-bottom:15px')))     
                ->add('save', SubmitType::class, array('label' => 'Create Cms', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
                ->getForm();
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
              //Get Date
              $name = $form['name']->getData();
              $category = $form['category']->getData();
              $description = $form['description']->getData();
              $priority = $form['priority']->getData();
              $due_date = $form['due_date']->getData();
              
              $now = new\DateTime('now');
              
              $cms->setName($name);
              $cms->setCategory($category);
              $cms->setDescription($description);
              $cms->setPriority($priority);
              $cms->setDueDate($due_date);
              $cms->setCreateDate($now);
              
              $em = $this->getDoctrine()->getManager();
              
              $em->persist($cms);
              $em->flush();
              
              $this->addFlash(
                    'notice',
                    'cms Added'
              );
              
              return $this->redirectToRoute('cms_list');
              
        }
        
        return $this->render('cms/create.html.twig', array(
            'form' => $form->createView()
        ));   
    }
    
    /**
     * @Route("cms/edit/{id}", name="edit_list")
     */
    public function editAction($id, Request $request){
        $cms = $this->getDoctrine()
                ->getRepository('AppBundle:Cms')
                ->find($id);
         
        $form = $this->createFormBuilder($cms)
                ->add('name', TextType::class, array('attr' => array('class' => 'form-control','style' => 'margin-bottom:15px')))
                ->add('category', TextType::class, array('attr' => array('class' => 'form-control','style' => 'margin-bottom:15px')))
                ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control','style' => 'margin-bottom:15px')))
                ->add('priority', ChoiceType::class, array('choices' => array('Low' => 'low', 'Normal' => 'Normal', 'High' => 'High'), 'attr' => array('class' => 'form-control','style' => 'margin-bottom:15px')))
                ->add('due_date', DateTimeType::class, array('attr' => array('class' => 'formcontrol','style' => 'margin-bottom:15px')))     
                ->add('save', SubmitType::class, array('label' => 'Create Cms', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
                ->getForm();
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
              //Get Date
              $name = $form['name']->getData();
              $category = $form['category']->getData();
              $description = $form['description']->getData();
              $priority = $form['priority']->getData();
              $due_date = $form['due_date']->getData();
              
              $now = new\DateTime('now');
              
              $cms->setName($name);
              $cms->setCategory($category);
              $cms->setDescription($description);
              $cms->setPriority($priority);
              $cms->setDueDate($due_date);
              $cms->setCreateDate($now);
              
              $em = $this->getDoctrine()->getManager();
              
              $em->persist($cms);
              $em->flush();
              
              $this->addFlash(
                    'notice',
                    'cms Added'
              );
              
              return $this->redirectToRoute('cms_list');
              
        }
                
        return $this->render('cms/edit.html.twig', array(
            'cms' => $cms
        ));    
    }
    
    /** 
     * @Route("cms/details/{id}", name="details_list")
     */
    public function detailsAction($id){
        $cms = $this->getDoctrine()
                ->getRepository('AppBundle:Cms')
                ->find($id);
                
        return $this->render('cms/details.html.twig', array(
            'cms' => $cms
        ));  
    }
    
    
}
