<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class HomepageController extends Controller
{
    /**
     * @Route("", name="homepage")
     */
    public function homepageAction()
    {
        if ($this->getUser()) {
            return $this->render('homepage/index.html.twig');
        }
        return $this->redirectToRoute('fos_user_security_login');
    }
}
