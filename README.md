# Ride: Template (Smarty)

This module adds template blocks, functions and modifiers for a Ride application to Smarty.

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
| transformation | String | Name of the transformation. |
| var | String | Variable name to assign this URL to. |
| thumbnail | --- | Deprecated |

:warning: Transformations may require additional parameters.

For more information about the transformations and their parameters, check out [ride-lib-image](https://github.com/all-ride/ride-lib-image#transformation).

```Smarty
{image src=$content->image var='image' transformation='crop'}
```

### parsley

Adds parsley data attributes to the attributes of a form widget.

| Parameter | Type | Description |
| --- | --- | --- |
| type | string | Type of the form row widget |
| validators | Array | Validators of a form row |
| var | String | Variable name to assign the updated attributes to. |

```Smarty
{$widget = $formRow->getWidget()}
{parsleyAttributes attributes=$widget->getAttributes() type=$widget->getType() var="attributes"}
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

## Related Modules 

- [ride/app](https://github.com/all-ride/ride-app)
- [ride/app-image](https://github.com/all-ride/ride-app-template)
- [ride/app-template](https://github.com/all-ride/ride-app-template)
- [ride/app-template-smarty](https://github.com/all-ride/ride-app-template-smarty)
- [ride/lib-api](https://github.com/all-ride/ride-lib-api)
- [ride/lib-image](https://github.com/all-ride/ride-lib-i18n)
- [ride/lib-i18n](https://github.com/all-ride/ride-lib-i18n)
- [ride/lib-router](https://github.com/all-ride/ride-lib-router)
- [ride/lib-security](https://github.com/all-ride/ride-lib-security)
- [ride/lib-template](https://github.com/all-ride/ride-lib-template)
- [ride/lib-template-smarty](https://github.com/all-ride/ride-lib-template-smarty)
- [ride/web](https://github.com/all-ride/ride-web)
- [ride/web-api](https://github.com/all-ride/ride-web-api)
- [ride/web-security](https://github.com/all-ride/ride-web-security)
- [ride/web-template](https://github.com/all-ride/ride-web-template)

## Installation

You can use [Composer](http://getcomposer.org) to install this application.

```
composer require ride/web-template-smarty
```
