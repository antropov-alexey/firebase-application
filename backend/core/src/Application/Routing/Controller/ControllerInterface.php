<?php declare(strict_types=1);

namespace App\Application\Routing\Controller;

use App\Application\Request\Request;
use App\Application\Response\Response;

interface ControllerInterface
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function getResponse(Request $request): Response;
}
