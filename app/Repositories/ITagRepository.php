<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ITagRepository extends IRepository
{
    public function allByProject(array $attributes) : Collection;
    public function verifyTag($projectId, $tagName) : Model;
    public function search($projectId, $text) : Collection;
    public function getByNameCI($projectId, $name): Model;

}
