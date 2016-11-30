<?php

namespace App\Services;

use App\Document;

/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 30/11/2016
 * Time: 14:06
 */
class ProcessFiles
{

    private $files = [];

    private $vault = null;

    public function initialize(array $files, $vault)
    {
        $this->files = $files;

        $this->vault = $vault->id . str_slug($vault->name);

        return $this;
    }

    public function processFiles()
    {
        $file_list = [];

        foreach ($this->files as $file) {

            $name = $file->getClientOriginalName();

            $path = $file->storeAs($this->vault, $name, 'uploads');

            $file_list[] = Document::create([
                'name' => $name,
                'path' => $path,
                'uuid' => strtoupper(md5(uniqid(rand(), true)))
            ]);
        }

        return collect($file_list);

    }

}