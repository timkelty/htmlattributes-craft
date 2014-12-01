# htmlAttributes

A Craft plugin (Twig filter) to help with the output of HTML attributes.

## Usage

### Twig template
```
{% set attrs = {
  class: ['myClass', 'myClass2'],
  style: {
    'background-image': "url('img.png')",
    'color': 'red',
  },
  'data-foo': {
    someKey: 'foo',
    otherKey: 'bar',
    myArray: ['foo', 'bar', 'baz'],
  },
  'data-bar': true,
  'data-baz': null,
  'data-qux': false,
} %}

<div {{ attrs|htmlAttrs }}></div>
```

### Output
```
<div
 class="myClass myClass2"
 style="background-image: url('img.png'); color: red"
 data-foo='{"someKey":"foo","otherKey":"bar","myArray":["foo","bar","baz"]}' data-bar
 data-baz
 ></div>
```
