# ride-web-template-smarty

## Block functions

[[Smarty docs](http://www.smarty.net/docs/en/plugins.block.functions.tpl)]

### isGranted

Parse block content if the specified route/url/permission is allowed.

| Parameter | Type | Description |
| --- | --- | --- |
| route | String | Path to check for allowance. |
| url | String | URL to check for allowance.
| permission | String | Permission code to check for allowance. |
| strategy | String | AND or OR when checking more then one of the above checks. |
| var | String | Variable to assign the result to. (`true` if this block content will be printed, `false` otherwise) |

```Smarty
{isGranted permission="cms.node.varnish.manage"}
  ...
{/isGranted}
```

_Note: The content of this block is always rendered. If the content is used for logic, assign the grant to a var and use an if statement._

### isNotGranted

Parse block content if the specified route/url/permission is *not* allowed.

| Parameter | Type | Description |
| --- | --- | --- |
| route | String | Path to check for allowance. |
| url | String | URL to check for allowance. |
| permission | String | Permission code to check for allowance. |
| strategy | String | AND or OR when checking more then one of the above checks. |
| var | String | Variable to assign the result to. (`true` if this block content will be printed, `false` otherwise) |

```Smarty
{isNotGranted permission="cms.node.varnish.manage"}
  ...
{/isNotGranted}
```

_Note: The content of this block is always rendered. If the content is used for logic, assign the grant to a var and use an if statement._

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

Create an URL.

| Parameter | Type | Description |
| --- | --- | --- |
| id | String | Route ID. |
| parameters | Array | Path arguments for the URL. |
| query | Array | Query parameters. |
| separator | String | Seperator for query parameters. (defaults to `&`) |
| var | String | Variable name to assign the URL to. |
| object | Boolean | Return URL Object instead of String. (defaults to `false`) |

```Smarty
{url id='api.search' var='searchUrl'}
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

### parsley
Add the parsley data attributes to the attributes of a form widget.

| Parameter | Type | Description |
| --- | --- | --- |
|  | Array | Validators of a form row |


```Smarty
{$attributes = $formRow->getWidget()->getAttributes()|parsley:$row->getValidators()}
```

### safe
Modify a string value to safely use it as a file name, URL, id etc.

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
