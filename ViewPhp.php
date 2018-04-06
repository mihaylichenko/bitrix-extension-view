<?php
namespace Msvdev\Bitrix\View;

use \Symfony\Component\Templating\Loader\FilesystemLoader;
use \Symfony\Component\Templating\PhpEngine;
use \Symfony\Component\Templating\TemplateNameParser;

/**
 * Class ViewPhp
 * @package msvdev\bitrix\view
 */
class ViewPhp
{
    /**
     * @var PhpEngine
     */
    protected $view;

    /**
     * Template file extension
     * @var string
     */
    protected $ext = '.html.php';

    /**
     * @return PhpEngine
     */
    public function getView(){
        return $this->view;
    }

    /**
     * ViewPhp constructor.
     * @param \CBitrixComponentTemplate $component
     * @param string $templateSubDir directory with templates relative to the component template
     */
    public function __construct(\CBitrixComponentTemplate $component, $templateSubDir = null)
    {
        $componentTemplateDir = $_SERVER['DOCUMENT_ROOT'].$component->GetFolder();
        if($templateSubDir == null){
            $loaderPath = $componentTemplateDir.DIRECTORY_SEPARATOR.'%name%'.$this->ext;
        } else {
            $loaderPath = $componentTemplateDir.DIRECTORY_SEPARATOR.$templateSubDir.DIRECTORY_SEPARATOR.'%name%'.$this->ext;
        }
        $loader = new FilesystemLoader($loaderPath);
        $this->view = new PhpEngine(new TemplateNameParser(), $loader);
    }
}