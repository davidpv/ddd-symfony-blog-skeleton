<?php declare(strict_types=1);

namespace App\Modules\Users\Domain;


use Shared\Domain\Bus\Command\Command;
use Symfony\Component\HttpFoundation\Request;

class CreateUserCommand implements Command
{

    public string $username;
    public string $password;
    public string $firstName;
    public string $lastName;
    public string $email;

    public function __construct(string $username,
                                string $password,
                                string $firstName,
                                string $lastName,
                                string $email)
    {
        $this->username = $username;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->request->get('username'),
            $request->request->get('password'),
            $request->request->get('firstName'),
            $request->request->get('lastName'),
            $request->request->get('email')
        );
    }

}
