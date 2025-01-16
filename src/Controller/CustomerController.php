<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Customer;
use App\Form\Type\CustomerFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

readonly class CustomerController
{
    public function __construct(
        private Environment $environment,
        private RouterInterface $router,
        private FormFactoryInterface $formFactory,
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function index(Request $request): Response
    {
        return new Response($this->environment->render('Customer/index.html.twig', [
            'customers' => $this->entityManager->getRepository(Customer::class)->findAll(),
        ]));
    }

    public function show(Request $request): Response
    {
        /** @var ?Customer $customer */
        $customer = $this->entityManager->getRepository(Customer::class)->find($request->get('id'));

        if ($customer === null) {
            throw new NotFoundHttpException();
        }

        return new Response($this->environment->render('Customer/show.html.twig', [
            'customer' => $customer,
        ]));
    }

    public function new(Request $request): Response
    {
        $customer = new Customer();
        $form = $this->formFactory->create(CustomerFormType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($customer);
            $this->entityManager->flush();

            return new RedirectResponse($this->router->generate('customers_index'));
        }

        return new Response($this->environment->render('Customer/new.html.twig', [
            'form' => $form->createView(),
            'customer' => $customer,
        ]));
    }
}
