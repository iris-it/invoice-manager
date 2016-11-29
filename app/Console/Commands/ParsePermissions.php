<?php

namespace App\Console\Commands;

use App\Permission;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use League\CLImate\CLImate;

class ParsePermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse all files (app / views) for finding permissions and extract them to database';


    /**
     * Paths for scan
     *
     * @var array
     */
    protected $directories = [
        'app' . DIRECTORY_SEPARATOR,
        'resources' . DIRECTORY_SEPARATOR,
    ];

    /**
     * Instance of command line utilities tool
     *
     * @var CLImate
     */
    private $climate;

    /**
     * Create a new command instance.
     *
     * @param CLImate $climate
     */
    public function __construct(CLImate $climate)
    {
        parent::__construct();

        $this->climate = $climate;

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $this->climate->lightGreen('Initialization ...');

        $files = $this->buildFileList();
        
        $strings = $this->parseFilesAndExtractString($files);
        
        $this->populateDatabase($strings);

    }

    public function populateDatabase($strings)
    {
        $this->climate->lightRed('Populate Database');
        
        $progress = $this->climate->progress()->total(count($strings));

        $permissions_db = Permission::select('name')->get()->toArray();

        $to_delete = array_diff(array_values(array_unique(array_flatten($permissions_db))), $strings);

        foreach ($to_delete as $item) {
            Permission::where('name', $item)->delete();
        }

        foreach ($strings as $key => $string) {
            $progress->current($key + 1);
            $permission = Permission::firstOrNew(array('name' => $string));
            $permission->save();
        }

        $this->climate->br();

        $this->climate->draw('passed');
    }

    public function parseFilesAndExtractString($files)
    {
        $this->climate->lightRed('Parse And Extract');
        
        $progress = $this->climate->progress()->total(count($files));

        $strings = [];

        foreach ($files as $key => $file) {
            $progress->current($key + 1);

            $content = Storage::disk('base')->get($file);

            preg_match_all('/(\'permission\:\:[a-zA-Z0-9\-\_]*\'|"permission\:\:[a-zA-Z0-9\-\_]*")/', $content, $results);

            foreach ($results as $result) {
                if ($result != null && $result != "") {
                    $result = preg_replace('/\'+/', '', preg_replace('/\"+/', '', $result));
                    array_push($strings, $result);
                }
            }

        }

        $strings = array_values(array_unique(array_flatten($strings)));

        $this->climate->br();
        
        $this->climate->lightRed('Strings Finder Result');
        
        $this->climate->br();
        
        $this->climate->columns($strings, 2);
        
        $this->climate->br();

        return $strings;
    }

    public function buildFileList()
    {
        
        $this->climate->br();
        
        $this->climate->lightRed('Scan Directory');
        
        $progress = $this->climate->progress()->total(count($this->directories));

        $file_list = [];

        foreach ($this->directories as $key => $directory) {
            $progress->current($key + 1);
            $files = Storage::disk('base')->allFiles($directory);
            $file_list[] = $files;
        }

        $this->climate->br();

        return array_flatten($file_list);

    }
}
