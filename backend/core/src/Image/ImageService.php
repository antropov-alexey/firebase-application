<?php declare(strict_types=1);

namespace App\Image;

use App\Api\Storage;
use App\Auth\AuthService;

class ImageService
{
    private ImageRepository $imageRepository;
    private Storage         $storage;
    private AuthService     $authService;

    public function __construct(ImageRepository $imageRepository, Storage $storage, AuthService $authService)
    {
        $this->imageRepository = $imageRepository;
        $this->storage         = $storage;
        $this->authService     = $authService;
    }

    public function saveImage(string $authorId, string $imageType, string $tmpFileName)
    {
        $image = new Image($imageType, $authorId, null);

        $response = $this->imageRepository->save($image);

        $image->setUid($response->getRecordUid());

        $this->storage->uploadObject(
            $this->authService->getAccessToken(),
            fopen($tmpFileName, 'r'),
            $image->getType(),
            $image->getUid()
        );
    }

    public function getFiles()
    {
        $images = [];

        $response = $this->imageRepository->getByParams([]);

        if ($response->getResponse()) {
            $imagesPath = getenv('IMAGES_PATH');

            foreach (get_object_vars($response->getResponse()) as $uid => $object) {
                $fileName = "{$imagesPath}/{$uid}.png";

                if ( ! file_exists($fileName)) {
                    $this->storage->download(
                        $this->authService->getAccessToken(),
                        $uid,
                        $fileName
                    );
                }

                $images[] = new Image(
                    $object->type,
                    $object->authorId,
                    $uid
                );
            }
        }

        return $images;
    }

    public function makeImageGray(string $uid, string $imageType)
    {
        $imagesPath = getenv('IMAGES_PATH');
        $fileName   = "{$imagesPath}/{$uid}.png";

        // получаем размеры исходного изображения
        $imgSize = \getimagesize($fileName);
        $width   = $imgSize[0];
        $height  = $imgSize[1];

        // создаем новое изображение
        $img = \imageCreate($width, $height);

        // задаем серую палитру для нового изображения
        for ($color = 0; $color <= 255; $color++) {
            \imageColorAllocate($img, $color, $color, $color);
        }

        if ($imageType === 'jpeg') {
            // создаем изображение из исходного
            $img2 = \imagecreatefromjpeg($fileName);
        }
        else {
            // создаем изображение из исходного
            $img2 = \imagecreatefrompng($fileName);
        }

        // объединяем исходное изображение и серое
        \imageCopyMerge($img, $img2, 0, 0, 0, 0, $width, $height, 100);

        // сохраняем изображение
        \imagejpeg($img, $fileName);

        // очищаем память
        \imagedestroy($img);
    }
}
