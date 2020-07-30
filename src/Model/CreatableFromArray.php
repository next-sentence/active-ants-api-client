<?php

namespace LWC\ActiveAnts\Model;

interface CreatableFromArray
{
    /**
     * Create an API response object from the HTTP response from the API server.
     *
     * @return self
     */
    public static function createFromArray(array $data);
}
