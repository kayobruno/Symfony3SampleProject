<?php

namespace AppBundle\Controller\Api;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("")
 */
class HomepageController extends BaseController
{
    /**
     * @Route("", name="api_homepage")
     */
    public function homepageAction()
    {
        return $this->createApiResponse(null, Response::HTTP_NO_CONTENT);
    }
}
