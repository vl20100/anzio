<?php

namespace App\Controller;

use App\Repository\InformationRepository;
use App\Repository\IngredientRepository;
use App\Repository\PizzaOfMonthRepository;
use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function homeAction(Request $request, PizzaRepository $pizzaRepository, IngredientRepository $ingredientRepository, PizzaOfMonthRepository $pizzaOfMonthRepository, InformationRepository $informationRepository) : Response
    {
        $list = $pizzaRepository->findBy(["active" => true]);
        $pizzasOfMonth = $pizzaOfMonthRepository->getForCurrentMonth();
        $ingredients = $ingredientRepository->findBy([], ["name" => "ASC"]);
        $infos = $informationRepository->getInfos();

        return $this->render('home.html.twig', [
            "pizzas" => $list,
            "pizzasOfMonth" => $pizzasOfMonth,
            "ingredients" => $ingredients,
            "infos" => $infos
        ]);
    }
}