# Шаблонизатор symfony для bitrix
Шаблонизация в symfony - простой, мощный и расширяемый инструмент управления шаблонами. Если Вы работаете с битриксом достаточно долго, скорее всего Вас уже достали портянки кода в шаблонах. Будем честны - шаблоны битрикса ужасны. Использование данного шаблонизатора поможет частично решить эту проблему и ступить на путь простоты и повторного использования кода.  

## Установка

       composer require msvdev/bitrix-extension-view

## Использование в компонентах
### Разбиваем шаблон на логические части
*template.php*
```php
<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$view = (new Msvdev\Bitrix\View\ViewPhp($this))->getView();
?>
<div>
    <h1><?=$arResult['NAME']?></h1>
    ...some code...
    <?php if(sizeof($arResult['IMAGES'])):?>
        <?=$view->render('gallery',['images' => $arResult['IMAGES']])?>
    <?php endif?>    
    ...some code...
</div>
```
*gallery.html.php*
```php
<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
* @var array $images
 */
?>
<?php foreach ($images as $image):?>
    <img src="<?=$image['src']?>" alt="<?=$image['alt']?>"/>
<?php endforeach;?>
```
### Повторное использование кода шаблона
Части шаблона можно переиспользовать в зависимости от входящих условий или в случае когда верстка различных элементов идентична.  
*template.php*
```php
<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$view = (new Msvdev\Bitrix\View\ViewPhp($this,'parts'))->getView();
?>
<div>
    ...some code..
    <?php foreach ($arResult['ITEMS'] as $arItem):?>
        <?=$view->render('item',['arItem' => $arItem])?>
    <?php endforeach;?>
    ...some code...
    <span>Show first item</span>
    <?=$view->render('item',['arItem' => $arResult['ITEMS'][0]])?>       
</div>
```
*part/item.html.php*
```php
<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * @var array $arItem
 * @var \Symfony\Component\Templating\PhpEngine $view
 */
?>
<div>
    <?= $arItem['NAME'] ?>
    <?php if(sizeof($arItem['IMAGES'])):?>
        <?php // Шаблоны можно вкладывать в друг-друга (part/images.html.php)
            echo $view->render('images',['images' => $arItem['IMAGES']])
        ?>
    <?php endif?>   
</div>
```
### Экранирование вывода
```php
    <?php echo $view->escape($firstname) ?>    
    
    <?php echo $view->escape($var, 'js') ?>
```
## Что еще?
Использование шаблонизации symfony в битрикс не ограничивается дополнением к стандартным шаблонам. Хотя даже в этом случае открыт невероятный простор для оптимизации вашего кода.  
Подробнее о возможностях шаблонизатора можно всегда почитать в [официальной документации](https://symfony.com/doc/current/components/templating.html).