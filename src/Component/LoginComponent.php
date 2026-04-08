<?php

declare(strict_types=1);

namespace App\Component;

use Impulse\Auth\Contracts\AuthInterface;
use Impulse\Core\App;
use Impulse\Core\Attributes\Action;
use Impulse\Core\Component\AbstractComponent;
use Impulse\Core\Http\Response;

/**
 * @property string $email
 * @property string $password
 * @property string $error
 * @property string $success
 */
final class LoginComponent extends AbstractComponent
{
    public function setup(): void
    {
        $request = $this->getRequest();

        $this->states([
            'email' => $request->request()->get('email'),
            'password' => $request->request()->get('password'),
            'error' => null,
            'success' => $request->query()->get('registered') ? 'Compte créé avec succès. Vous pouvez maintenant vous connecter.' : null,
        ]);
    }

    #[Action]
    public function login(): ?Response
    {
        $auth = App::get(AuthInterface::class);

        if ($auth->login($this->email, $this->password)) {
            return Response::redirect('/account');
        }

        http_response_code(401);
        $this->error = 'Identifiants invalides.';

        // Efface le mot de passe stocké dans l'état pour des raisons de sécurité
        $this->password = null;

        return null;
    }

    private function getError(): ?string
    {
        if ($this->error) {
            return <<<HTML
                <uialert
                    title="Erreur"
                    description="$this->error"
                    with-icon="true"
                    icon-name="x-circle"
                    color="rose"
                    variant="filled"
                    class="pb-4"
                />
            HTML;
        }

        return null;
    }

    private function getSuccess(): ?string
    {
        if ($this->success) {
            return <<<HTML
                <uialert
                    title="Succès"
                    description="$this->success"
                    with-icon="true"
                    icon-name="check-circle"
                    color="emerald"
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
        $success = $this->getSuccess();

        return <<<HTML
            <span data-update="success">
                $success
            </span>
            <span data-update="error">
                $error
            </span>
            <div class="mb-3">
                <uiinput
                    label="Adresse email"
                    placeholder="exemple@email.com"
                    type="email"
                    size="normal"
                    name="email"
                    block="true"
                    color="teal"
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
                />
            </div>
            <uibutton
                type="button"
                color="teal"
                variant="solid"
                label="Connexion"
                size="normal"
                block="true"
                data-action-click="login"
                data-action-update="error"
            />
        HTML;
    }
}
