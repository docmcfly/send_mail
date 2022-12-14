<?php

namespace Cylancer\SendMessage\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use Cylancer\SendMessage\Domain\Model\FrontendUserGroup;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;

/**
 *
 * This file is part of the "send message" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 C. Gogolin <service@cylancer.net>
 *
 * @package Cylancer\SendMessage\Domain\Repository
 */ 
class FrontendUserRepository extends Repository{
    
    
    
    // protected $defaultOrderings = ['sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING];
    /**
     *
     * @var array
     * @param string $table
     *            table name
     * @return QueryBuilder
     */
    protected function getQueryBuilder(string $table)
    {
        return GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
    }
    
    
    
    /**
     *
     * @param array<Integer> $frontendUserGroupUid
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface|array
     */
    public function findByUserGroups(array $frontendUserGroupUid ) 
    {
        if (empty($frontendUserGroupUid)) {
            return [];
        }
        
        $qb = $this->getQueryBuilder('fe_users');
        $qb->select('uid')->from('fe_users');
        
        $usergroupTerm = array();
        /** @var int $uid */
        foreach ($frontendUserGroupUid as $uid) {
            $qb->orWhere($qb->expr()
                ->inSet('usergroup', $uid));
        }
        
        $s = $qb->execute();
        $return = array();
        while ($row = $s->fetch()) {
            $return[] = $row['uid'];
        }
        return $return;
    }
    
    
}