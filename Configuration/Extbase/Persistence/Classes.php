<?php
declare(strict_types = 1);

use Cylancer\SendMessage\Domain\Model\FrontendUserGroup;
use Cylancer\SendMessage\Domain\Model\FrontendUser;
 
return [
    FrontendUser::class => [
        'tableName' => 'fe_users',
    ],
    FrontendUserGroup::class => [
        'tableName' => 'fe_groups',
    ],
    
];  
