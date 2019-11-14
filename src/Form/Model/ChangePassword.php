<?php
namespace App\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class ChangePassword
{

    protected $oldPassword;

    /**
     * @Assert\Length(
     *     min = 6,
     *     minMessage = "Votre mot de passe doit contenir au minimun 6 caractères"
     * )
     */
    public $newPassword;

}