<?php

namespace Controller;

use Goutte\Client;
use DAO\ServerConfigDAO;
use Model\ServerConfigModel;

class ExtractProvider
{
    private $url;
    public $count_insert;
    public $count_update;
    public $erro;

    function __construct()
    {
        $this->url = 'https://oneprovider.com/dedicated-servers/unmetered-bandwidth';
        $this->count_insert = 0;
        $this->count_update = 0;
        $this->erros = '';
    }

    public function runExtract()
    {
        $client = new Client();

        $crawler = $client->request('GET', $this->url);

        $crawler->filter('.results-tr')->each(function ($node) {

            $dados = json_decode($node->filter('.conf-data')->attr('data-analytics'));
            $ServerConfigModel = new ServerConfigModel();
            $ServerConfigModel->setCode($dados->id);
            $ServerConfigModel = (new ServerConfigDAO())->read($ServerConfigModel);

            //verifica se o registro já existe
            if (!$ServerConfigModel->getId()) {
                //tratamento dos dados
                $modelo = explode(' ', $dados->cpu->model);
                $modelo = $modelo[count($modelo) - 1];
                $familia = str_replace($modelo, '', $dados->cpu->model);
                $core = intval($node->filter('.field-cpu-core')->text());
                $frequency = floatval($node->filter('.field-cpu-freq')->text());
                $disk = $node->filter('.res-storage')->text();
                preg_match_all("#\([\w\s']+\)#i", $disk, $disk_type);
                $disk = str_replace($disk_type[0], '', $disk);
                $disk_type = implode(',', $disk_type[0]);
                $disk_type = str_replace(['(', ')'], '', $disk_type);
                $port = $node->filter('.res-bandwidth .number')->text();
                $bandwidth = $node->filter('.res-bandwidth .bw-fair-usage')->text();
                $price = $node->filter('.res-price .currency-code-usd')->text();
                $price = explode('$', $price);
                $price_conventional = trim($price[1]);
                $price_promotional = count($price) == 3 ? trim($price[2]) : '0.00';
                $setup = $node->filter('.res-buybutton')->text();
                if (strpos($setup, 'Setup Fee'))
                    $setup = substr($node->filter('.setup_fee_buy .currency-code-usd .price-normal')->text(), 1);
                else
                    $setup = 'null';

                if (strpos($setup, 'SOLD OUT'))
                    $status = 'inactive';
                else
                    $status = 'active';

                $ServerConfigModel->setCode($dados->id);
                $ServerConfigModel->setRegion($dados->location->name);
                $ServerConfigModel->setCpu_fabricante($dados->cpu->maker);
                $ServerConfigModel->setCpu_familia($familia);
                $ServerConfigModel->setCpu_modelo($modelo);
                $ServerConfigModel->setCore($core);
                $ServerConfigModel->setFrequency($frequency);
                $ServerConfigModel->setRam(substr($dados->ram, 0, 1));
                $ServerConfigModel->setDisk($disk);
                $ServerConfigModel->setDisk_type($disk_type);
                $ServerConfigModel->setPort($port);
                $ServerConfigModel->setBandwidth($bandwidth);
                $ServerConfigModel->setDdos(true);
                $ServerConfigModel->setPrice_conventional($price_conventional);
                $ServerConfigModel->setPrice_promotional($price_promotional);
                $ServerConfigModel->setCurrency('Dólar');
                $ServerConfigModel->setSetup($setup);
                $ServerConfigModel->setStatus($status);

                if ((new ServerConfigDAO())->insert($ServerConfigModel)) {
                    $this->count_insert += 1;
                } else {
                    $this->erros .= "Erro ao inserir registro da região: {$dados->location->name} (code: ' . $dados->id . ')\n";
                }
            } else {
                $price = $node->filter('.res-price .currency-code-usd')->text();
                $price = explode('$', $price);
                $price_conventional = trim($price[1]);
                $price_promotional = count($price) == 3 ? trim($price[2]) : '0.00';

                //verifica se houve alteração nos valores do registro
                if (($ServerConfigModel->getPrice_conventional() != $price_conventional) || ($ServerConfigModel->getPrice_promotional() != $price_promotional)) {
                    $percentual_conventional = $this->calculaPercentual($price_conventional, $ServerConfigModel->getPrice_conventional());
                    $percentual_promotional = $this->calculaPercentual($price_promotional, $ServerConfigModel->getPrice_promotional());

                    //verifica se o valor alterado é superior/inferior a 5%
                    if ($percentual_conventional >= 5 || $percentual_promotional >= 5) {
                        $ServerConfigModel->setPrice_conventional($price_conventional);
                        $ServerConfigModel->setPrice_promotional($price_promotional);
                        if ((new ServerConfigDAO())->update($ServerConfigModel)) {
                            $this->count_update += 1;
                        } else {
                            $this->erros .= "Erro ao alterar registro da região: ' . $dados->location->name . ' (code: ' . $dados->id . ')\n";
                        }
                    }
                }
            }
        });

        echo "---------------------------RESUMO----------------------------\n";
        echo "Total de novos registros inseridos: " . $this->count_insert . "\n";
        echo "Total de registros alterados: " . $this->count_update . "\n";
        echo "Erros: " . ($this->erros ? $this->erros : "Nenhum erro encontrado.") . "\n";
    }

    /**
     * Função para calcular o percentual de variação do valor novo em relação ao antigo.
     */
    public function calculaPercentual(float $valor_novo, float $valor_antigo): float
    {
        $valor = abs($valor_novo - $valor_antigo);
        $percentual = ($valor * 100) / $valor_antigo;

        return $percentual;
    }
}
