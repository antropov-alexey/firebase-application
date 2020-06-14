<?php declare(strict_types=1);

namespace App\Http\Routes\Image;

use App\App;
use App\Application\Enum\RequestMethods;
use App\Application\Routing\Controller\ControllerInterface;
use App\Application\Routing\RouterInterface;
use App\Http\Controller\Images\GrayImagesController;
use App\Http\Controller\Images\ImagesController;

class GrayImageRoute implements RouterInterface
{
    /**
     * @return string
     */
    public function getPath(): string
    {
        return '/makeGrayImage';
    }

    /**
     * @return string[]
     * @see RequestMethods
     */
    public function allowedRequestMethods(): array
    {
        return [RequestMethods::GET];
    }

    /**
     * @return ControllerInterface
     */
    public function getController(): ControllerInterface
    {
        return new GrayImagesController(App::ImageService());
    }

    /**
     * @return RouterInterface
     */
    public static function make(): RouterInterface
    {
        return new self();
    }
}
