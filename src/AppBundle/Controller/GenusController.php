<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Genus;
use AppBundle\Entity\GenusNote;
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
        $genus->setSpeciesCount(rand(1,1000));

        $genusNote = new GenusNote();
        $genusNote->setUsername('AquaWeaver');
        $genusNote->setUserAvatarFilename('ryan.jpeg');
        $genusNote->setNote('Hi There!');
        $genusNote->setCreatedAt(new \DateTime());
        $genusNote->setGenus($genus);

        $em = $this->getDoctrine()->getManager();
        $em->persist($genus);
        $em->persist($genusNote);
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
     * @Route("/genus/{name}/notes", name="genus_show_notes")
     * @Method("GET")
     */
    public function getNotesAction(Genus $genus)
    {
        $notes = $genus->getNotes();

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