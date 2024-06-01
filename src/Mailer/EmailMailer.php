<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;

/**
 * Email mailer.
 */
class EmailMailer extends Mailer
{
    /**
     * Mailer's name.
     *
     * @var string
     */
    public static $name = 'Email';

    public function sendLinkPassword($user)
    {
        $this
            ->setTo($user->email)
            ->setProfile('sender')
            ->setEmailFormat('html')
            ->setTemplate('rescue_password')
            ->setLayout('email')
            ->setViewVars([
                'name' => $user->name,
                'host' => $user->host_name,
                'token' => $user->password_reset_token
            ])
            ->setSubject(sprintf('Recuperar senha'));
    }
}
