<?php

namespace App\Controller;

/**
 * @Route("/pizza")
 */

use App\Entity\Pizza;
use App\Form\PizzaType;
use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class PizzaController extends AbstractController
{
    /**
     * @Route("/", name="pizza_index")
     */
    public function index(): Response
    {
        $pizzas = $this->getDoctrine()->getRepository(Pizza::class)->getPizzasWhereUserNameDiffFlen();
        return $this->render('pizza/index.html.twig',[
            'pizzas'=>$pizzas
        ]);
    }

    /**
     * @Route("/new", name="pizza_create")
     */
    public function newPizza(Request $request): Response
    {
        $pizza = new Pizza();
        $form = $this->createForm(PizzaType::class,$pizza);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pizza);
            $entityManager->flush();
            return $this->redirectToRoute('pizza_index');
        }
        return $this->render('pizza/new.html.twig',array(
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("/search_pizza", name="pizza_search")
     */
    public function searchPizza(Request $request){

            $data = $this->getDoctrine()->getRepository(Pizza::class)->getPizzaByOwnerUsername($request->get('name'));
            $serializer = new Serializer([new ObjectNormalizer()]);
            $result = $serializer->normalize($data,'json',['attributes' => ['id','slices','eatenBy'=>['id','username']]]);
            return new JsonResponse($result);
    }
}
