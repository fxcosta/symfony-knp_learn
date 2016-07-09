<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class GenusController extends Controller
{

    /**
     * @Route("/genus/{genusName}")
     */
    public function showAction($genusName)
    {

        $notes = [
            'Octopus asked me a riddles, outsmarted me',
            'I counted 8 legs...',
            'Inked',
            'I\'ve got a game on Wii U'
        ];

        return $this->render('genus/show.html.twig', ['name' => $genusName, 'notes' => $notes]);
    }

}