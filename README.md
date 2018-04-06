# PartnerComm Hot Menus
Build Menu Links Based on Matched Taxonomies

# Requirments
- PHP 5.6
- Composer
- WordPress 4.*

# Usage
1) Add any targets to your pages based on their slug
```php
  $slug = get_post_field( 'post_name', get_post() );
  <a id="<?php echo $slug;?>"></a>
```
2) From within your post or body add the following shortcode
```text
  [hotmenu taxonomy="term" base-link='/other/page/to/link/to' ul-class="someclass for designer"]
```
_You can add multiple taxonomy/term combination, and they will be exclusionary_
```text
  [hotmenu taxonomy="term" taxonomy2="term2" taxonomy3="term3" base-link='/other/page/to/link/to']
```
3) You can choose to exclude the base-link option, and it will default to just `#target` on the current page