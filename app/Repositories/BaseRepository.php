<?php

namespace App\Repositories;

abstract class BaseRepository implements RepositoryInterface
{
    private $_model;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->setModel();
    }

    public function setModel()
    {
        $this->_model = app()->make($this->getModel());
    }

    public function getModel()
    {
        return $this->_model;
    }

    public function getAll()
    {
        return $this->_model->all();
    }

    public function find($id)
    {
        return $this->_model->find($id);
    }

    public function create(array $data)
    {
        return $this->_model->create($data);
    }

    public function update($id, array $data)
    {
        return $this->_model->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->_model->find($id)->delete();
    }

    public function destroy($id)
    {
        return $this->_model->destroy($id);
    }
}
