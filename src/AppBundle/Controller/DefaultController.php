<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
	/**
	 * @Template
	 * @Route("/", name="homepage")
	 */
	public function indexAction(Request $request)
	{
		$form = $this->getContactForm();
		$form->handleRequest($request);

		/** @var \AppBundle\Business\Contact $contactManager */
		$contactManager = $this->get('busines.contact');

		if (!$form->isSubmitted() || !$form->isValid()) {
			return [
				'all' => $contactManager->findAll(),
				'form' => $form->createView()
			];
		}

		$contact = $form->getData();
		$contactManager->save($contact);

		return $this->redirectToRoute('homepage'); //save
	}

	public function getContactForm()
	{
		$contact = new \AppBundle\Entity\Contact;
		return $this->createFormBuilder($contact)
			->setAction($this->generateUrl('homepage'))
			->add('name', TextType::class, [
//				'required' => FALSE
			])->add('email', TextType::class)
			->add('save', SubmitType::class)
			->getForm();
	}

	/**
	 * @Route("/save", name="save")
	 */
	public function saveAction(Request $request)
	{
// Bez @Template anotace pak:
//			return $this->render('AppBundle:default:index.html.twig', [
//				'form' => $form->createView()
//			]);
		return new Response('OK');
	}
}
