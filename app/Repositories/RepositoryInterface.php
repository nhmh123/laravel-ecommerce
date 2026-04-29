<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function setModel();
    
    public function getModel();

    public function getAll();

    public function find($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function destroy($id);
}
