<?php

namespace Rocktoondevelop\LaravelExpansion\Repositories;

abstract class AbstractRepository
{
    const PAGE_LIMIT = 20;

    protected $model;

    abstract public function getModelClass(): string;

    public function __construct($target_object = null)
    {
        if (is_null($target_object)) {
            $this->model = app($this->getModelClass());
        } else {
            $this->model = $target_object;
        }
    }

    public function getTable()
    {
        return $this->model->getTable();
    }

    public function first()
    {
        return $this->model->first();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function count()
    {
        return $this->model->count();
    }

    public function getOneByField($value, $key)
    {
        $query = $this->model->query();

        $query->where($key, '=', $value);

        return $query->first();
    }

    public function getAllByField($value, $key)
    {
        $query = $this->model->query();

        $query->where($key, '=', $value);

        return $query->get();
    }

    public function getAllInByField(array $list, $key)
    {
        $query = $this->model->query();

        $query->whereIn($key, $list);

        return $query->get();
    }

    public function getAllKeyByField($key)
    {
        $instances = $this->all();

        return $instances->keyBy($key);
    }

    public function getPaginateBySearch()
    {
        $query = $this->model->query();

        //$query->sortable();

        $query->where($this->createSearchRequestToWhere());

        return $query->paginate(self::PAGE_LIMIT);
    }

    public function register($data)
    {
        return $this->model->create($data);
    }

    public function registers($data_list)
    {
        foreach ($data_list as $data) {
            $this->register($data);
        }
    }

    public function update($id, $data)
    {
        $model = $this->find($id);
        $model->update($data);

        return $model;
    }

    public function deleteById($id)
    {
        $query = $this->model->query();

        $query->where('id', $id);

        $query->delete();
    }

    public function truncate()
    {
        $this->model->truncate();
    }

    public function bulkInsert($data)
    {
        $bulk_list = array_chunk($data, 1000);
        foreach ($bulk_list as $row) {
            $this->model->insert($row);
        }
    }

    protected function createSearchRequestToWhere()
    {
        $request = request();

        $columns = $request->input('column', []);
        $operators = $request->input('operator', []);
        $values = $request->input('value', []);

        $wheres = [];

        foreach ($columns as $index => $column) {
            if (! isset($operators[$index])) {
                continue;
            }

            $value = isset($values[$index]) ? $values[$index] : '';

            if ($operators[$index] == 'like') {
                $value = '%'.$value.'%';
            }

            $wheres[] = [$column, $operators[$index], $value];
        }

        return $wheres;
    }
}
