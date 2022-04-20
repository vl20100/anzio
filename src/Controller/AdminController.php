<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController{

    /**
     * @param Request $request
     * @return Response
     * 
     * @Route("/admin", name="adminPanel")
     */
    public function indexAdmin(Request $request) : Response
    {
        return $this->render("admin/index.html.twig");
    }
}