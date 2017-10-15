<?php namespace DepotServer;
/**
 * File Manager
 *
 * Sistema administrador de archivos
 *
 * @access       public
 * @author       Mauricio Vera <m.vera@depotserver.com>
 * @copyright    DepotServer 2017
 * @name         File Manager
 * @since		3.5
 * @version		3.5
 */
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
use League\Flysystem\MountManager;

class FileManager 
{

  public $adapter, $filesystem, $manager;

  // constructor receives adapter instance
  public function __construct($pathInicial = 'tmp/', Adapter $adapter = null) {
    if( $adapter == null){
      $this->adapter = new Local(__DIR__.'/'.$pathInicial);
    }else{
      $this->adapter = $adapter;
    }
    $this->filesystem = new Filesystem($this->adapter);
    $this->manager = new MountManager([ 'fs' => $this->filesystem ]);
  }

  public function escribirArchivo($name, $stream, $path = "", $overwrite = false){
    if($overwrite){
      $this->manager->put('fs://'.$path.$name, $stream);
    }else{
      $this->manager->write('fs://'.$path.$name, $stream);
    }
  }

  public function leerArchivo($path, $delete = false){
    if($this->manager->has('fs://'.$path)){
      if($delete){
        return $this->manager->readAndDelete('fs://'.$path);
      }else{
        return $this->manager->read('fs://'.$path);
      }
    }else{
      return false;
    }
  }

  public function existeArchivo($path){
    return $this->manager->has('fs://'.$path);
  }

  private function validarPath($path){
    if(substr($path, -1) == "/"){
      return $path;
    }else{
      return $path."/";
    }
  }

}