<?php

namespace Interfaces;

interface CrudInterface
{

    public function create();

    public function read($id);

    public function update();

    public function delete();

}