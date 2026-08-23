# 🔧 Customization

Feel free to extend or publish views if needed:

### Publish All Views
Publish all views at once:

```bash
php artisan vendor:publish --tag=hwkui-views

```

### Publish Single Components or Groups

Instead of publishing all views, you can publish specific individual component views or component folders:

* **Single Form Component:**
```bash
php artisan vendor:publish --tag=hwkui-view-tom-select
php artisan vendor:publish --tag=hwkui-view-flat-picker

```


* **Single Widget Component:**
```bash
php artisan vendor:publish --tag=hwkui-view-typewriter
php artisan vendor:publish --tag=hwkui-view-info-box

```


* **Component Groups (Folder-based):**
```bash
php artisan vendor:publish --tag=hwkui-view-tabs
php artisan vendor:publish --tag=hwkui-view-accordion
php artisan vendor:publish --tag=hwkui-view-timeline
php artisan vendor:publish --tag=hwkui-view-carousel

```



### Overwriting Published Views

If you updated the package and want to overwrite your previously published views with the latest version, use the `--force` flag:

```bash
php artisan vendor:publish --tag=hwkui-view-select --force
# or for all views:
php artisan vendor:publish --tag=hwkui-views --force

```


