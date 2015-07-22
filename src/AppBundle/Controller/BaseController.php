<?php
/**
 * Created by PhpStorm.
 * User: abdou
 * Date: 7/22/15
 * Time: 11:10 AM
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{

    /**
     * check user is login
     * @return bool
     */
    public function isUser()
    {
        $userInformation = $this->getUser();

        if ($userInformation) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * get user id
     * @return int
     */
    public function getUserId()
    {
        return $this->getUser()->getId();
    }

    /**
     * check if user is admin
     * @return bool
     */
    public function isAdmin()
    {
        $userRoles = $this->getUser()->getRoles();
        if (in_array("ROLE_ADMIN", $userRoles)) {
            return true;
        } else {
            return false;
        }
    }

}