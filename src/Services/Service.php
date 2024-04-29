<?php

namespace Ruslan_sgs\SmartgasLibAuth\Services;

abstract class Service
{
    protected $model;

    public function update($model, $data)
    {
        foreach ($data as $key => $value) {
            $model->{$key} = $value;
        }
        $model->update();
        return $model;
    }
}