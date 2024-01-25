<?php

namespace DAO;

use DAO\Connection;
use Exception;
use Model\ServerConfigModel;
use PDOException;

class ServerConfigDAO
{
    use Connection;
    protected $db;

    public function __construct()
    {
        try {
            $this->db = $this->getPdoConnection();
            if (!$this->db)
                throw new Exception("Erro ao realizar conexão com o Banco de Dados!");
        } catch (Exception $e) {
            print_r($e->getMessage());
            exit;
        }
    }

    public function insert(ServerConfigModel $ServerConfigModel)
    {
        try {
            $sql = 'INSERT INTO extract_oneprovider.server_config VALUES
                    (:id,
                     :dc,
                     :code,
                     :region,
                     :cpu_fabricante,
                     :cpu_familia,
                     :cpu_modelo,
                     :core,
                     :thred,
                     :frequency,
                     :ram,
                     :disk,
                     :disk_type,
                     :port,
                     :bandwidth,
                     :ddos,
                     :price_conventional,
                     :price_promotional,
                     :currency,
                     :qty,
                     :setup,
                     :status)';

            $stmt = $this->db->prepare($sql);

            $stmt->execute(array(
                ':id' => 'default',
                ':dc' => 'OneProvider',
                ':code' => $ServerConfigModel->getCode(),
                ':region' => $ServerConfigModel->getRegion(),
                ':cpu_fabricante' => $ServerConfigModel->getCpu_fabricante(),
                ':cpu_familia' => $ServerConfigModel->getCpu_familia(),
                ':cpu_modelo' => $ServerConfigModel->getCpu_modelo(),
                ':core' => $ServerConfigModel->getCore(),
                ':thred' => 'null',
                ':frequency' => $ServerConfigModel->getFrequency(),
                ':ram' => $ServerConfigModel->getRam(),
                ':disk' => $ServerConfigModel->getDisk(),
                ':disk_type' => $ServerConfigModel->getDisk_type(),
                ':port' => $ServerConfigModel->getPort(),
                ':bandwidth' => $ServerConfigModel->getBandwidth(),
                ':ddos' => $ServerConfigModel->getDdos(),
                ':price_conventional' => $ServerConfigModel->getPrice_conventional(),
                ':price_promotional' => $ServerConfigModel->getPrice_promotional(),
                ':currency' => $ServerConfigModel->getCurrency(),
                ':qty' => 0,
                ':setup' => $ServerConfigModel->getSetup(),
                ':status' => $ServerConfigModel->getStatus()
            ));

            return true;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function update(ServerConfigModel $ServerConfigModel)
    {
        try {
            $sql = 'UPDATE extract_oneprovider.server_config SET
                    price_conventional = :price_conventional,
                    price_promotional = :price_promotional
                    WHERE code = :code';

            $stmt = $this->db->prepare($sql);

            $stmt->execute(array(
                ':price_conventional' => $ServerConfigModel->getPrice_conventional(),
                ':price_promotional' => $ServerConfigModel->getPrice_promotional(),
                ':code' => $ServerConfigModel->getCode(),
            ));

            return true;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            exit;
            return false;
        }
    }

    public function read(ServerConfigModel $ServerConfigModel)
    {
        try {
            $sql = 'SELECT * FROM extract_oneprovider.server_config 
                    WHERE code = :code';

            $stmt = $this->db->prepare($sql);

            $stmt->execute(array(
                ':code' => $ServerConfigModel->getCode(),
            ));

            $obj = $stmt->fetch($this->db::FETCH_OBJ);
            $ServerConfigModel = $this->fillObject($obj);
            return $ServerConfigModel;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    function fillObject($obj)
    {
        $ServerConfigModel = new ServerConfigModel;
        if ($obj) {
            $ServerConfigModel->setId($obj->id);
            $ServerConfigModel->setDc($obj->dc);
            $ServerConfigModel->setCode($obj->code);
            $ServerConfigModel->setRegion($obj->region);
            $ServerConfigModel->setCpu_fabricante($obj->cpu_fabricante);
            $ServerConfigModel->setCpu_familia($obj->cpu_familia);
            $ServerConfigModel->setCpu_modelo($obj->cpu_modelo);
            $ServerConfigModel->setCore($obj->core);
            $ServerConfigModel->setThred($obj->thred);
            $ServerConfigModel->setFrequency($obj->frequency);
            $ServerConfigModel->setRam($obj->ram);
            $ServerConfigModel->setDisk($obj->disk);
            $ServerConfigModel->setDisk_type($obj->disk_type);
            $ServerConfigModel->setPort($obj->port);
            $ServerConfigModel->setBandwidth($obj->bandwidth);
            $ServerConfigModel->setDdos($obj->ddos);
            $ServerConfigModel->setPrice_conventional($obj->price_conventional);
            $ServerConfigModel->setPrice_promotional($obj->price_promotional);
            $ServerConfigModel->setCurrency($obj->currency);
            $ServerConfigModel->setQty($obj->qty);
            $ServerConfigModel->setSetup($obj->setup);
            $ServerConfigModel->setStatus($obj->status);
        }
        return $ServerConfigModel;
    }
}
