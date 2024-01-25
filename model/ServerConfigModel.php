<?php

namespace Model;

class ServerConfigModel
{
    private $id;
    private $dc;
    private $code;
    private $region;
    private $cpu_fabricante;
    private $cpu_familia;
    private $cpu_modelo;
    private $core;
    private $thred;
    private $frequency;
    private $ram;
    private $disk;
    private $disk_type;
    private $port;
    private $bandwidth;
    private $ddos;
    private $price_conventional;
    private $price_promotional;
    private $currency;
    private $qty;
    private $setup;
    private $status;

    function __construct()
    {
        $this->id = '';
        $this->dc = '';
        $this->code = '';
        $this->region = '';
        $this->cpu_fabricante = '';
        $this->cpu_familia = '';
        $this->cpu_modelo = '';
        $this->core = '';
        $this->thred = '';
        $this->frequency = '';
        $this->ram = '';
        $this->disk = '';
        $this->disk_type = '';
        $this->port = '';
        $this->bandwidth = '';
        $this->ddos = '';
        $this->price_conventional = '';
        $this->price_promotional = '';
        $this->currency = '';
        $this->qty = '';
        $this->setup = '';
        $this->status = '';
    }

    function getId()
    {
        return $this->id;
    }

    function getDc()
    {
        return $this->dc;
    }

    function getCode()
    {
        return $this->code;
    }

    function getRegion()
    {
        return $this->region;
    }

    function getCpu_fabricante()
    {
        return $this->cpu_fabricante;
    }

    function getCpu_familia()
    {
        return $this->cpu_familia;
    }

    function getCpu_modelo()
    {
        return $this->cpu_modelo;
    }

    function getCore()
    {
        return $this->core;
    }

    function getThred()
    {
        return $this->thred;
    }

    function getFrequency()
    {
        return $this->frequency;
    }

    function getRam()
    {
        return $this->ram;
    }

    function getDisk()
    {
        return $this->disk;
    }

    function getDisk_type()
    {
        return $this->disk_type;
    }

    function getPort()
    {
        return $this->port;
    }

    function getBandwidth()
    {
        return $this->bandwidth;
    }

    function getDdos()
    {
        return $this->ddos;
    }

    function getPrice_conventional()
    {
        return $this->price_conventional;
    }

    function getPrice_promotional()
    {
        return $this->price_promotional;
    }

    function getCurrency()
    {
        return $this->currency;
    }

    function getQty()
    {
        return $this->qty;
    }

    function getSetup()
    {
        return $this->setup;
    }

    function getStatus()
    {
        return $this->status;
    }

    function setId($id): void
    {
        $this->id = $id;
    }

    function setDc($dc): void
    {
        $this->dc = $dc;
    }

    function setCode($code): void
    {
        $this->code = $code;
    }

    function setRegion($region): void
    {
        $this->region = $region;
    }

    function setCpu_fabricante($cpu_fabricante): void
    {
        $this->cpu_fabricante = $cpu_fabricante;
    }

    function setCpu_familia($cpu_familia): void
    {
        $this->cpu_familia = $cpu_familia;
    }

    function setCpu_modelo($cpu_modelo): void
    {
        $this->cpu_modelo = $cpu_modelo;
    }

    function setCore($core): void
    {
        $this->core = $core;
    }

    function setThred($thred): void
    {
        $this->thred = $thred;
    }

    function setFrequency($frequency): void
    {
        $this->frequency = $frequency;
    }

    function setRam($ram): void
    {
        $this->ram = $ram;
    }

    function setDisk($disk): void
    {
        $this->disk = $disk;
    }

    function setDisk_type($disk_type): void
    {
        $this->disk_type = $disk_type;
    }

    function setPort($port): void
    {
        $this->port = $port;
    }

    function setBandwidth($bandwidth): void
    {
        $this->bandwidth = $bandwidth;
    }

    function setDdos($ddos): void
    {
        $this->ddos = $ddos;
    }

    function setPrice_conventional($price_conventional): void
    {
        $this->price_conventional = $price_conventional;
    }

    function setPrice_promotional($price_promotional): void
    {
        $this->price_promotional = $price_promotional;
    }

    function setCurrency($currency): void
    {
        $this->currency = $currency;
    }

    function setQty($qty): void
    {
        $this->qty = $qty;
    }

    function setSetup($setup): void
    {
        $this->setup = $setup;
    }

    function setStatus($status): void
    {
        $this->status = $status;
    }
}
