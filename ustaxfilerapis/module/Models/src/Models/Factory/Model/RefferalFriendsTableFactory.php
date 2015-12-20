<?php 
namespace Models\Factory\Model;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ObjectProperty;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\Feature;
use Models\Model\RefferalFriends;
use Models\Model\RefferalFriendsTable;
class RefferalFriendsTableFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $db = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $resultSetPrototype = new HydratingResultSet();
        $resultSetPrototype->setHydrator(new ObjectProperty());
        $resultSetPrototype->setObjectPrototype(new RefferalFriends());
        $tableGateway       = new TableGateway('referral_friends', $db,array(),$resultSetPrototype);
        $table              = new RefferalFriendsTable($tableGateway);
        return $table;
    }
}