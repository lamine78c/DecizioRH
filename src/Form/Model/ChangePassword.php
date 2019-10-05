<?php
namespace App\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class ChangePassword
{

    protected $oldPassword;

    /**
     * @Assert\Length(
     *     min = 6,
     *     minMessage = "Password should by at least 6 chars long"
     * )
     */
    public $newPassword;

}