<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Entity\Price;
use App\Form\PizzaType;
use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/pizza")
 */
class PizzaController extends AbstractController
{
    /**
     * @Route("/", name="pizza_index", methods={"GET"})
     */
    public function index(PizzaRepository $pizzaRepository): Response
    {
        return $this->render('admin/pizza/index.html.twig', [
            'pizzas' => $pizzaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pizza_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pizza = new Pizza();

        $price1 = (new Price())->setPizza($pizza);
        $price2 = (new Price())->setPizza($pizza);
        $price3 = (new Price())->setPizza($pizza);

        if(sizeof($pizza->getPrices()) <= 3)
        {
            for($i = 0; $i < 3; $i++)
            {
                if(is_null($pizza->getPrices()[$i]))
                {
                    if($i === 0)
                    {
                        $price1->setSize(26);
                        $pizza->addPrice($price1);
                    }
                    else if($i === 1)
                    {
                        $price2->setSize(33);
                        $pizza->addPrice($price2);
                    }
                    else if($i === 2)
                    {
                        $price3->setSize(40);
                        $pizza->addPrice($price3);
                    }
                }
                else
                {
                    if($i === 0)
                    {
                        $price1 = $pizza->getPrices()[$i];
                    }
                    else if($i === 1)
                    {
                        $price2 = $pizza->getPrices()[$i];
                    }
                    else if($i === 2)
                    {
                        $price3 = $pizza->getPrices()[$i];
                    }
                }
            }
        }

        $form = $this->createForm(PizzaType::class, $pizza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($price1);
            $entityManager->persist($price2);
            $entityManager->persist($price3);
            $entityManager->persist($pizza);
            $entityManager->flush();

            return $this->redirectToRoute('pizza_index');
        }

        return $this->render('admin/pizza/new.html.twig', [
            'pizza' => $pizza,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pizza_show", methods={"GET"})
     */
    public function show(Pizza $pizza): Response
    {
        return $this->render('admin/pizza/show.html.twig', [
            'pizza' => $pizza,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pizza_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pizza $pizza): Response
    {
        $price1 = (new Price())->setPizza($pizza);
        $price2 = (new Price())->setPizza($pizza);
        $price3 = (new Price())->setPizza($pizza);

        if(sizeof($pizza->getPrices()) <= 3)
        {
            for($i = 0; $i < 3; $i++)
            {
                if(is_null($pizza->getPrices()[$i]))
                {
                    if($i === 0)
                    {
                        $price1->setSize(26);
                        $pizza->addPrice($price1);
                    }
                    else if($i === 1)
                    {
                        $price2->setSize(33);
                        $pizza->addPrice($price2);
                    }
                    else if($i === 2)
                    {
                        $price3->setSize(40);
                        $pizza->addPrice($price3);
                    }
                }
                else
                {
                    if($i === 0)
                    {
                        $price1 = $pizza->getPrices()[$i];
                    }
                    else if($i === 1)
                    {
                        $price2 = $pizza->getPrices()[$i];
                    }
                    else if($i === 2)
                    {
                        $price3 = $pizza->getPrices()[$i];
                    }
                }
            }
        }

        $form = $this->createForm(PizzaType::class, $pizza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($price1);
            $em->persist($price2);
            $em->persist($price3);

            $em->flush();

            return $this->redirectToRoute('pizza_index');
        }

        return $this->render('admin/pizza/edit.html.twig', [
            'pizza' => $pizza,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pizza_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pizza $pizza): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pizza->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pizza);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pizza_index');
    }

    /**
     * @Route("/{id}/price/{priceId}", name="pizza_price_delete", methods={"GET"})
     */
    public function deletePrice(Request $request, Pizza $pizza, int $priceId): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $price = $entityManager->getRepository(Price::class)->find($priceId);

        if(!is_null($price))
        {
            $entityManager->remove($price);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pizza_show', ['id' => $pizza->getId()]);
    }
}
