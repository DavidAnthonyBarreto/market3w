<?php

namespace Market3w\SiteBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class Market3wSiteBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
