<?php

namespace App\Manager;

use Symfony\Component\Security\Core\Security;

class SalesReportManager
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function sendNewsletter()
    {
        $salesData = [];

        if($this->security->isGranted('ROLE_SALES_ADMIN')){
            $salesData['top_secret_numbers'] = rand();
        }

        // ..
    }

    // ..
}