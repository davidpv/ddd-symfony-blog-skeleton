<?php declare(strict_types=1);

namespace App\Apps\Web\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegisterUserController extends AbstractController
{

    public function __invoke()
    {
        return $this->render('web/auth/login.html.twig');
    }

}