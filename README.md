# Шаблонизатор из symfony для bitrix


## Использование в шаблонах компонентов

```php
use \Msvdev\Bitrix\View\ViewPhp;

echo $form->field($model, 'coordinatesAttribute')->widget(
    MapInput::className(), 
    [        
        'language' => 'en-Us', // map language, default is the same as in the app        
        'service' => 'google', // map service provider, "google" or "yandex", default "google"       
        'apiKey' => '', // required google maps
        'coordinatesDelimiter' => '@', // attribute coordinate string delimiter, default "@" (lat@lng)       
        'mapWidth' => '800px', // width map container, default "500px"
        'mapHeight' => '500px', // height map container, default "500px"
        'mapZoom' => '14', // map zoom value, default "10"
        'mapCenter' => [55.753338, 37.622861], // coordinates center map with an empty attribute, default Moscow        
    ]
);
```