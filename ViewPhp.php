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
     * Default part template dir
     * @var string
     */
    protected $templateDir = 'part';

    /**
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
     * @param null $templateDir
     */
    public function __construct(\CBitrixComponentTemplate $component, $templateDir = null)
    {
        if($templateDir == null){
            $templateDir = $this->templateDir;
        }
        $componentTemplateDir = $_SERVER['DOCUMENT_ROOT'].$component->GetFolder();
        $loaderPath = $componentTemplateDir.DIRECTORY_SEPARATOR.$templateDir.DIRECTORY_SEPARATOR.'%name%'.$this->ext;
        $loader = new FilesystemLoader($loaderPath);
        $this->view = new PhpEngine(new TemplateNameParser(), $loader);
    }
}