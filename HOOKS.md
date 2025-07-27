
## Actions

### Addons
    do_action('before_addon_upload');
    do_action('after_addon_upload');
    do_action('before_addon_deactivation', $alias);
    do_action("before_{$alias}_addon_deactivation");
    do_action('after_addon_deactivation', $alias);
    do_action("after_{$alias}_addon_deactivation");
    do_action('before_addon_activation', $alias);
    do_action("before_{$alias}_addon_activation");
    do_action('after_addon_activation', $alias);
    do_action("after_{$alias}_addon_activation");
    do_action('before_addon_remove', $alias);
    do_action("before_{$alias}_addon_remove");
    do_action('after_addon_remove', $alias);
    do_action("after_{$alias}_addon_remove");

## Filters

