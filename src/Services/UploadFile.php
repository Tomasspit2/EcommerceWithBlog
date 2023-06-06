<?php

namespace App\Services;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class UploadFile extends AbstractController
{
    public function generate_name($length = 20)
    {
        $code = "a5ze3rtyu6ioAZp7hzebfjznngnsvoiinqsdfg78h";
        $result = "";

        while (strlen($result) < $length) {
            $result .= $code[rand(0, strlen($code)-1)];
        }
        return $result;
    }

    public function saveFile($file)
    {
        $extension = $file->getClientOriginalName();
        $filename = $this->generate_name(30).".".$extension;
        $file->move($this->getParameter('image_dir'), $filename);

        return '/assets/images/articles/'.$filename;
    }
}