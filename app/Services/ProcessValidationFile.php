<?php

namespace App\Services;

use App\Document;

/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 30/11/2016
 * Time: 14:06
 */
class ProcessValidationFile
{

    private $file = null;

    private $vault = null;

    public function initialize($file, $vault)
    {
        $this->file = $file;

        $this->vault = $vault->id . str_slug($vault->name);

        return $this;
    }

    public function processValidationFile()
    {

        $name = $this->file->getClientOriginalName();

        $path = $this->file->storeAs($this->vault . DIRECTORY_SEPARATOR . 'validation', $name, 'uploads');

        return Document::create([
            'name' => $name,
            'path' => $path,
            'uuid' => strtoupper(md5(uniqid(rand(), true)))
        ]);

    }

}