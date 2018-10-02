<?php

namespace App\Extensions;

use Illuminate\Session\FileSessionHandler;
use Symfony\Component\Finder\Finder;
use Carbon\Carbon;

class MyFileSessionHandler extends FileSessionHandler
{

    /**
     * {@inheritdoc}
     */
    public function read($sessionId)
    {
        // dd($sessionId , $this->files->exists($path = $this->path.'/'.$sessionId));
        if ($this->files->exists($path = $this->path.'/'.$sessionId)) {
            if (filemtime($path) >= Carbon::now()->subMinutes($this->minutes)->getTimestamp()) {
                return $this->files->get($path, true);
            }
        }

        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function destroy($sessionId)
    {
        $this->files->delete($this->path.'/'.$sessionId);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function gc($lifetime)
    {
        $files = Finder::create()
                    ->in($this->path)
                    ->files()
                    ->ignoreDotFiles(true)
                    ->date('<= now - '.$lifetime.' seconds');

        foreach ($files as $file) {
            $this->files->delete($file->getRealPath());
        }
    }
}
