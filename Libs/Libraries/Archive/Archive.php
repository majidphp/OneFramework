<?php
class Archive
{
    private $archive;
    public $files = [];
    public $archiveName;
    public $archivePath;

    public function __construct()
    {
        $this->archive = new ZipArchive;
        if (!isset($this->archive)) return false;
    }

    public function compress()
    {
        if ($this->archive->open($this->archivePath.$this->archiveName) === true) {
            foreach ($this->files as $file) {
                $this->archive->addFile($file->path, $this->name);
            }
            return true;
        }
        return false;
    }

    public function extract()
    {
        if (!is_dir($this->archivePath)) return false;
        if ($this->archive->extractTo($this->archivePath)) return true;
        return false;
    }

    public function __destruct()
    {
        $this->archive->close();
    }
}
