<?php

namespace App\Services\Camunda;

use App\Services\MSB\IApplicationRequest;
use App\Services\MSB\IProgramByBinIinResponse;
use Ramsey\Uuid\Guid\Guid;

interface ICamundaService
{
    public function getClientSettings();
    public function setClientSettings(array $params);
    public function getBpmnDiagramXml();
    public function getBpmnHistory(string $appealId);
    public function startProcess(string $appealId);
    public function getAvailableTask(array $params);
    public function completedByDistributor(string $appealId, int $userId, string $distributorName);
    public function completeTask(string $taskDefinitionKey, string $appealId, int $userId, string $userName);
}
