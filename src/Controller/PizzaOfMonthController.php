<?php

namespace App\Controller;

use App\Entity\PizzaOfMonth;
use App\Entity\Price;
use App\Form\PizzaOfMonthType;
use App\Repository\PizzaOfMonthRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/pizza/of/month")
 */
class PizzaOfMonthController extends AbstractController
{
    /**
     * @Route("/", name="pizza_of_month_index", methods={"GET"})
     */
    public function index(PizzaOfMonthRepository $pizzaOfMonthRepository): Response
    {
        return $this->render('admin/pizza_of_month/index.html.twig', [
            'pizza_of_months' => $pizzaOfMonthRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pizza_of_month_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pizzaOfMonth = new PizzaOfMonth();

        $price1 = (new Price())->setPizzaOfMonth($pizzaOfMonth);
        $price2 = (new Price())->setPizzaOfMonth($pizzaOfMonth);
        $price3 = (new Price())->setPizzaOfMonth($pizzaOfMonth);

        if(sizeof($pizzaOfMonth->getPrices()) <= 3)
        {
            for($i = 0; $i < 3; $i++)
            {
                if(is_null($pizzaOfMonth->getPrices()[$i]))
                {
                    if($i === 0)
                    {
                        $price1->setSize(26);
                        $pizzaOfMonth->addPrice($price1);
                    }
                    else if($i === 1)
                    {
                        $price2->setSize(33);
                        $pizzaOfMonth->addPrice($price2);
                    }
                    else if($i === 2)
                    {
                        $price3->setSize(40);
                        $pizzaOfMonth->addPrice($price3);
                    }
                }
                else
                {
                    if($i === 0)
                    {
                        $price1 = $pizzaOfMonth->getPrices()[$i];
                    }
                    else if($i === 1)
                    {
                        $price2 = $pizzaOfMonth->getPrices()[$i];
                    }
                    else if($i === 2)
                    {
                        $price3 = $pizzaOfMonth->getPrices()[$i];
                    }
                }
            }
        }
        
        $form = $this->createForm(PizzaOfMonthType::class, $pizzaOfMonth);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($price1);
            $entityManager->persist($price2);
            $entityManager->persist($price3);
            $entityManager->persist($pizzaOfMonth);
            $entityManager->flush();

            return $this->redirectToRoute('pizza_of_month_index');
        }

        return $this->render('admin/pizza_of_month/new.html.twig', [
            'pizza_of_month' => $pizzaOfMonth,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pizza_of_month_show", methods={"GET"})
     */
    public function show(PizzaOfMonth $pizzaOfMonth): Response
    {
        return $this->render('admin/pizza_of_month/show.html.twig', [
            'pizza_of_month' => $pizzaOfMonth,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pizza_of_month_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PizzaOfMonth $pizzaOfMonth): Response
    {
        $price1 = (new Price())->setPizzaOfMonth($pizzaOfMonth);
        $price2 = (new Price())->setPizzaOfMonth($pizzaOfMonth);
        $price3 = (new Price())->setPizzaOfMonth($pizzaOfMonth);

        if(sizeof($pizzaOfMonth->getPrices()) <= 3)
        {
            for($i = 0; $i < 3; $i++)
            {
                if(is_null($pizzaOfMonth->getPrices()[$i]))
                {
                    if($i === 0)
                    {
                        $price1->setSize(26);
                        $pizzaOfMonth->addPrice($price1);
                    }
                    else if($i === 1)
                    {
                        $price2->setSize(33);
                        $pizzaOfMonth->addPrice($price2);
                    }
                    else if($i === 2)
                    {
                        $price3->setSize(40);
                        $pizzaOfMonth->addPrice($price3);
                    }
                }
                else
                {
                    if($i === 0)
                    {
                        $price1 = $pizzaOfMonth->getPrices()[$i];
                    }
                    else if($i === 1)
                    {
                        $price2 = $pizzaOfMonth->getPrices()[$i];
                    }
                    else if($i === 2)
                    {
                        $price3 = $pizzaOfMonth->getPrices()[$i];
                    }
                }
            }
        }

        $form = $this->createForm(PizzaOfMonthType::class, $pizzaOfMonth);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($price1);
            $em->persist($price2);
            $em->persist($price3);

            $em->flush();

            return $this->redirectToRoute('pizza_of_month_index');
        }

        return $this->render('admin/pizza_of_month/edit.html.twig', [
            'pizza_of_month' => $pizzaOfMonth,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pizza_of_month_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PizzaOfMonth $pizzaOfMonth): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pizzaOfMonth->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pizzaOfMonth);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pizza_of_month_index');
    }
}
