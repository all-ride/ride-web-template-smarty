# ride-web-template-smarty

## Block functions

[[Smarty docs](http://www.smarty.net/docs/en/plugins.block.functions.tpl)]

### isGranted

```Smarty
{isGranted route= url= permission= var=}
{/isGranted}
```

### isNotGranted

```Smarty
{isNotGranted route= url= permission= var=}
{/isNotGranted}
```

## Template functions

[[Smarty docs](http://www.smarty.net/docs/en/plugins.functions.tpl)]

### apiMethodParameters

```Smarty
{apiMethodParameters method= url= namespace= classes=}
```

### apiType

```Smarty
{apiType type= url= method= html= link= namespace= classes=}
```

### image

Return the URL of a transformed image.

| Parameter | Type | Description |
| --- | --- | --- |
| src | String | Source url or file for this image. |
| default | String | Fallback for src parameter. |
| var | String | Variable name to assign this URL to. |
| thumbnail | --- | --- |
| transformation | String | Name of the transformation. |

:warning: Transformations may require additional parameters.

To see more transformations and their parameters, check out [ride-lib-image](https://github.com/all-ride/ride-lib-image/tree/master/src/ride/library/image/transformation).

```Smarty
{image src=$content->image var='image' transformation='crop'}
```

### pagination

Render pagination links.

| Parameter | Type | Description |
| label |  |  |
| label |  |  |
| label |  |  |
| label |  |  |
| label |  |  |

```Smarty
{pagination label= page= pages= href= onclick= class=}
```

### tableVars

Add these FormTable variables to the template:

- `$tableNameField`
- `$tableActionField`
- `$tableIdField`
- `$tableOrderField`
- `$tableSearchQueryField`
- `$tablePageRowsField`

```Smarty
{tableVars}
```

### translate

Translate a key using the i18n translator.

| Parameter | Type | Description |
| --- | --- | --- |
| key | String | Translation key. |
| locale | String | Translation locale. |
| n | Integer | Number of items for a translation that describes multiple items. |
| var | String | Variable name to assign the translated key to. |

```Smarty
{translate key='label.submit' locale='nl'}
```

:warning: When simply translating a key, using the `{$key|translate}` modifier syntax is preferred.

### url

```Smarty
{url id= parameters= query= separator= var= object=}
```

## Modifiers

[[Smarty docs](http://www.smarty.net/docs/en/plugins.modifiers.tpl)]

### decorate

| Parameter | Type | Description |
| --- | --- | --- |
|  | String | ID of the decorator. |

Common decorator IDs: `storage.size` / `time` / `date.format` / `file` / `file.extension` / `file.size`

```Smarty
{$content->data->getDatePublished()|decorate:'time'}
```

### safe
Modify a string value to safely use as file name, URL, id etc.

```Smarty
{'Unsafe string!'|safe} {* result: unsafe-string *}
```

### translate

| Parameter | Type | Description |
| --- | --- | --- |
|  | Array | Variables to be replaced in the translation. |

```Smarty
{'label.fields.required'|translate}
```
