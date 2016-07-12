<?php
/**
 * Created by PhpStorm.
 * User: webdown
 * Date: 12/07/2016
 * Time: 15:02
 */

namespace AppBundle\Controller;


use AppBundle\Form\UserRegistrationForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{

    /**
     * @Route("/register",name="user_register")
     */
    public function registerAction(Request $request)
    {

        $form = $this->createForm(UserRegistrationForm::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $em = $this->getDoctrine()->getManager();

            $em->persist($user);
            $em->flush();
            $this->addFlash("success", "User successfully registered!");

            //return $this->redirectToRoute('homepage');

            return $this->get('security.authentication.guard_handler')
                ->authenticateUserAndHandleSuccess(
                    $user,
                    $request,
                    $this->get('app.security.login_form_authenticator'),
                    'main');
        }

        return $this->render('user/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}