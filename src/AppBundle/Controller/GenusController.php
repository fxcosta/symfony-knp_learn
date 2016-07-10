<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Genus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GenusController extends Controller
{

    /**
     * @Route("/genus/new")
     */
    public function newAction()
    {

        $genus = new Genus();
        $genus->setName("Octopus".rand(1, 100));
        $genus->setSubFamily("Octo");
        $genus->setSpeciesCount(1);
        $em = $this->getDoctrine()->getManager();
        $em->persist($genus);
        $em->flush();

        return new Response("OK");
    }

    /**
     * @Route("/genus/{genusName}", name="genus_show" )
     */
    public function showAction($genusName)
    {
        $em = $this->getDoctrine()->getManager();
        $genus = $em->getRepository("AppBundle:Genus")
            ->findOneBy(["name" => $genusName]);

        if (!$genus)
        {
            throw $this->createNotFoundException("No genus found!");
        }

        return $this->render('genus/show.html.twig', [
            'genus' => $genus
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

    /**
     * @Route("/genus")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $genuses = $em->getRepository('AppBundle:Genus')
            ->findAllPublishedOrderedBySize();

        return $this->render("genus/list.html.twig", [
            'genuses' => $genuses
        ]);

    }

}