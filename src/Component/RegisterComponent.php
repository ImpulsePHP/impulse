<?php

declare(strict_types=1);

namespace App\Component;

use App\Entity\User;
use Impulse\Auth\Contracts\UserRepositoryInterface;
use Impulse\Core\App;
use Impulse\Core\Attributes\Action;
use Impulse\Core\Component\AbstractComponent;
use Impulse\Core\Http\Response;
use Impulse\Validator\Contract\ValidatorInterface;

/**
 * @property string $email
 * @property string $password
 * @property string $error
 */
final class RegisterComponent extends AbstractComponent
{
    public function setup(): void
    {
        $request = $this->getRequest();

        $this->states([
            'email' => $request->request()->get('email'),
            'password' => $request->request()->get('password'),
            'error' => null,
        ]);
    }

    #[Action]
    public function save(): ?Response
    {
        $validator = App::get(ValidatorInterface::class);

        $emailError = $validator->validateField('email', $this->email, 'required|email');
        $passwordError = $validator->validateField('password', $this->password, 'required|min_length:8');

        if ($emailError || $passwordError) {
            $this->error = $emailError ?? $passwordError;
            $this->password = null;

            return null;
        }

        $userRepository = App::get(UserRepositoryInterface::class);

        // Vérifie si l'utilisateur existe déjà
        if ($userRepository->findByIdentifier($this->email) !== null) {
            http_response_code(409);

            $this->error = 'Un utilisateur avec cet e-mail existe déjà.';
            $this->password = null;

            return null;
        }

        // Hash du mot de passe puis création et sauvegarde de l'utilisateur
        $hashed = password_hash($this->password, PASSWORD_DEFAULT);
        $newUser = (new User())
            ->setEmail($this->email)
            ->setPassword($hashed)
        ;

        $userRepository->save($newUser);

        return Response::redirect('/?registered=1');
    }

    private function getError(): ?string
    {
        if ($this->error !== null) {
            return <<<HTML
            <uialert
                title="Erreur"
                description="$this->error"
                with-icon="true"
                icon-name="x-circle"
                color="red"
                variant="filled"
                class="pb-4"
            />
            HTML;
        }

        return null;
    }

    public function template(): string
    {
        $error = $this->getError();

        return <<<HTML
            <div class="mb-3">
                <span data-update="error">$error</span>
                <uiinput
                    label="Adresse email"
                    placeholder="exemple@email.com"
                    type="email"
                    size="normal"
                    name="email"
                    block="true"
                    color="teal"
                    required="true"
                    rules="required|email"
                />
            </div>
            <div class="mb-6">
                <uiinput
                    label="Mot de passe"
                    placeholder="••••••••"
                    type="password"
                    size="normal"
                    name="password"
                    block="true"
                    color="teal"
                    required="true"
                    rules="required|min_length:8"
                    help-text="Au moins 8 caractères requis"
                />
            </div>
            <uibutton
                type="button"
                color="teal"
                variant="solid"
                label="Enregistrer"
                size="normal"
                block="true"
                data-action-click="save"
                data-action-update="error"
            />
        HTML;
    }
}
