<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected function model(): ?string
    {
        return null;
    }
    protected function query(): Builder
    {
        return app($this->model())->newQuery();
    }

    public function all(?array $columns = ['*']): Collection|array
    {
        return $this->query()->get($columns);
    }

    public function create(array $attributes): Model|Builder
    {
        return $this->query()->create($attributes);
    }

    public function update(array $attributes, int $id): Model|Builder
    {
        $this->query()->where(['id' => $id])->update($attributes);
        return $this->find($id);
    }

    public function find(int $id): ?Model
    {
        return $this->query()->find($id);
    }

    public function delete(int $id): Model|bool
    {
        return $this->query()->find($id)->delete();
    }
}
