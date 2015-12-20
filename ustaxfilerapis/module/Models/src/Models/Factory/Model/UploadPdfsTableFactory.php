<?php 
namespace Models\Factory\Model;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ObjectProperty;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\Feature;
use Models\Model\UploadPdfs;
use Models\Model\UploadPdfsTable;
class UploadPdfsTableFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $db = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $resultSetPrototype = new HydratingResultSet();
        $resultSetPrototype->setHydrator(new ObjectProperty());
        $resultSetPrototype->setObjectPrototype(new UploadPdfs());
        $tableGateway       = new TableGateway('upload_pdfs', $db,array(),$resultSetPrototype);
        $table              = new UploadPdfsTable($tableGateway);
        return $table;
    }
}