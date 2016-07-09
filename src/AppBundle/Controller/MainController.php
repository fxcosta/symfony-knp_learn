<?php
/**
 * Created by PhpStorm.
 * User: webdown
 * Date: 09/07/2016
 * Time: 18:14
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function homepageAction()
    {
        return $this->render('main/homepage.html.twig');
    }
}