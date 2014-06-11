zfs-grid
================

Модель и представление данных в табличном виде.

Подключение
---
Модель может быть использована сразу после подклчения библиотеки через композер.
Для использования помощников вида (ViewHelper) нужно в ваш ```application.config.php``` в ветки ```service_manager``` и ```listeners``` добавить следующее:
```php
'service_manager' => array(
    'invokables' => array(
        'ZFS\Grid\View\Helper\Configurator' => 'ZFS\Grid\View\Helper\Configurator'
    )
),
'listeners' => array(
    'ZFS\Grid\View\Helper\Configurator'
)
```
Ключ можно выбрать любой другой, если есть необходимость.
Для использования произвольных помощников вида, их можно подключить к ViewHelperManager:
```php
$serviceLocator
    ->get('ViewHelperManager')
    ->setInvokableClass('gridRowValue', 'ZFS\Grid\View\Helper\GridRowValue');
```

Использование
---

Для отображения данных в табличном виде нужны:
1. Сами данные:
```php
$users = array(
    array(
        'id'     => 1,
        'login'  => 'Vasia',
        'email'  => 'vasia@pupkin.com',
        'status' => '0',
    ),
    array(
        'id'     => 2,
        'login'  => 'Fedia',
        'email'  => 'Fedia@nepupkin.com',
        'status' => '1',
    )
);
```
2. Модель "сетки":
```php
$grid = new GridModel();
```

3. Установить гриду данные:
```php
$grid->setRows($users);
```
4. Установить гриду набор колонок. Параметр name - системное имя колонки, fieldName - имя/ключ параметра в строке для выборки и подстановки в ячейку, title - заглавие колонки:
```php
$grid->setColumns(
    array(
        new ColumnModel(array(
            'name'      => 'id',
            'fieldName' => 'id',
            'title'     => 'ID',
        )),
        new ColumnModel(array(
            'name'      => 'login',
            'fieldName' => 'login',
            'title'     => 'Login',
        )),
        new ColumnModel(array(
            'name'      => 'email',
            'fieldName' => 'email',
            'title'     => 'E-mail',
        ))
    )
);
```
5. Передать грид в представление:
```php
// представим, что находимся в контроллере
return new ViewModel(array('grid' => $grid));
```
6. Отобразить таблицу в шаблоне с помощью ViewHelper'а Grid:
```php
<?php echo $this->grid($grid); ?>
```
или отобразить таблицу вручную, если вы намеренно не подключили ViewHelper'ы.

Параметры GridModel и ColumnModel
---
Все параметры ColumnModel можно устанавливать через get\* и set\* методы:
```php
$column = new ColumnModel();
$column->setName('name');
$column->setFieldName('name');
$column->setTitle('User name');
```

Полный набор параметров у ColumnModel:
- name - системное имя колонки;
- fieldName - имя/ключ параметра в строке для выборки и подстановки в ячейку;
- title - заглавие колонки;
- formatter - callback, результат которого идет как значение в ячейку. Вызывается помощником вида GridRowValue после получения значения из строки и только при наличии этого параметра у ColumnModel. Сигнатура функции: ``` function ($valueFromRowCell, $wholeRow, $currentColumn) {} ```;

- id - строка, подставляется в атрибут ```id``` тэгу ```<th>``` в ```<thead>``` и ```<tfoot>```;
- css - строка, подставляется в атрибут ```class``` тэгу ```<th>``` в ```<thead>``` и ```<tfoot>```;
- style - строка, подставляется в атрибут ```style``` тэгу ```<th>``` в ```<thead>``` и ```<tfoot>```;


У GridModel тоже есть подобные параметры:
- id - строка, подставляется в атрибут ```id``` тэгу ```<table>```;
- css - строка, подставляется в атрибут ```class``` тэгу ```<table>```
- style - строка, подставляется в атрибут ```style``` тэгу ```<table>```

И у ColumnModel и у GridModel есть возможность установки произвольных параметров через магические ```__get``` и ```__set``` для ручной их обработки в шаблонах представления.

Помощники вида
---
В библиотеке реализованы следующие помощники вида:
- grid - отображение стандартной таблицы с использованием параметров id, css, style;
- gridHeader - отображение блока ```<thead>```;
- gridHeaderRow - отображение строки заголовка: ```<tr><th>...</th></tr>```;
- gridHeaderCell - отображение ячейки строки заголовка: ```<th>..</th>```;
- gridBody - отображение блока ```<tbody>``;
- gridBodyRow - отображение строки тела: ```<tr><td>...<td></tr>```;
- gridBodyCell - отображение ячейки строки тела: ```<td>...</td>```;
- gridFooter - отображение блока ```<tfoot>```;
- gridFooterRow - отображение строки футера: ```<tr><th>...</th></tr>```;
- gridFooterCell - отображение ячейки строки футера: ```<th>..</th>```;
- gridRowValue - отображение значения ячейки строки данных.

Для отображения стандартной таблицы достаточно использовать лишь ```grid```:
```php
<?php echo $this->grid($grid); ?>
```

Если вам не нужен футер, к примеру, можно воспользоваться помощниками вида ниже уровня: ```gridHeader```, ```gridBody```:
```php
<?php echo $this->grid()->openTag($grid); ?>
<?php echo $this->gridHeader($grid); ?>
<?php echo $this->gridBody($grid); ?>
<?php echo $this->grid()->closeTag(); ?>
```

Полная аналогия с помощниками вида Zend\Form.

Лицензия
----

MIT