# Шаблонизатор из symfony для bitrix

Документация в процессе...


## Использование в шаблонах компонентов

```php
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$view = (new Msvdev\Bitrix\View\ViewPhp($this))->getView();
?>
<div>
    <h1>News</h1>
    <?=$view->render('items',['arItems' => $arResult['ITEMS']])?>
</div>
```