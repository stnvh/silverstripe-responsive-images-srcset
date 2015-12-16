# Silverstripe Responsive Images - `srcset` extension
[![Latest Stable Version](https://poser.pugx.org/stnvh/silverstripe-responsive-images-srcset/v/stable.svg)](https://packagist.org/packages/stnvh/silverstripe-responsive-images-srcset) [![License](https://poser.pugx.org/stnvh/silverstripe-responsive-images-srcset/license.svg)](https://packagist.org/packages/stnvh/silverstripe-responsive-images-srcset)

Addon for the [responsive images module](https://github.com/heyday/silverstripe-responsive-images) to use the img/srcset standard

By Stan Hutcheon - [Bigfork Ltd](http://bigfork.co.uk)

## Installation:

### Composer:

```
composer require "stnvh/silverstripe-responsive-images-srcset" "0.x"
```

### Download:

Clone this repo into the root of your silverstripe installation folder.

### Usage:

See the [responsive images module usage](https://github.com/heyday/silverstripe-responsive-images#how-to-use) for basic config.

The option to automatically generate retina images has been added for ease. It can be enabled via yml:
```yml
ResponsiveImageExtension:
  sets:
    GallerySet:
      method: CroppedFocusedImage
      sizes:
        - {query: "(min-width: 640px)", size: 820x640}
        - {query: "(min-width: 940px)", size: 1128x768}
      default_size: 960x480
	  retina: true
```

### Notes:

- A polyfill is required for IE 11 & below.
- This has only been tested with min-width queries.

After installing via composer, you must */dev/build* and flush
