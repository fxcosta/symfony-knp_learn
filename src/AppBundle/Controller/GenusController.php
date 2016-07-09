<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GenusController extends Controller
{

    /**
     * @Route("/genus/{genusName}")
     */
    public function showAction($genusName)
    {

        $funFact = "Octopus change color in *3 seconds*";

        $cache = $this->get('doctrine_cache.providers.my_markdown_cache');
        $key = md5($funFact);
        if ($cache->contains($key)) {
            $funFact = $cache->fetch($key);
        } else {
            $funFact = $this->get('markdown.parser')->transformMarkdown($funFact);
            $cache->save($key, $funFact);
        }


        return $this->render('genus/show.html.twig', [
            'name' => $genusName,
            'funFact' => $funFact
        ]);
    }

    /**
     * @Route("/genus/{genusName}/notes", name="genus_show_notes")
     * @Method("GET")
     */
    public function getNotesAction()
    {
        $notes = [
            ['id' => 1, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Where you come from?', 'date' => 'Dec. 20 2015'],
            ['id' => 2, 'username' => 'AquaWeaver', 'avatarUri' => '/images/ryan.jpeg', 'note' => 'Hi, im Ryan', 'date' => 'Dec. 21 2015'],
            ['id' => 3, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Hi, anyone there?', 'date' => 'Dec. 22 2015']
        ];

        $data = [
            'notes' => $notes
        ];

        return new JsonResponse($data);

    }

}