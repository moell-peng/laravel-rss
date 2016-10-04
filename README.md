## moell/rss
Laravel package developed on the basis of [moell/rss](https://github.com/moell-peng/rss)

### RSS specification
[http://www.rssboard.org/rss-specification](http://www.rssboard.org/rss-specification)

### 中文README
[README](README_zh.md)

### Requirement
Laravel 5+

### Installation
```shell
composer require moell/laravel-rss:1.*
```
### Modify config/app.php
```shell
#Append in providers
Moell\LaravelRss\RssServiceProvider::class,

#Append in aliases
'Rss'   => Moell\LaravelRss\RssFacade::class,
```

### Provides an interface
```php

public function setEncode($encode); //默认UTF-8

public function channel(array $channel);

public function item(array $item);

public function items(array $items);

public function build();

public function fastBuild(array $channel, array $item);

public function __toString();
```

### Usage
```php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Rss;

class RssController extends Controller
{
    public function index()
    {
        $channel = [
            'title' => 'title',
            'link'  => 'http://moell.cn',
            'description' => 'description',
            'category' => [
                'value' => 'html',
                'attr' => [
                    'domain' => 'http://www.moell.cn'
                ]
            ]
        ];

        $rss = Rss::channel($channel);

        $items = [];
        for($i = 0; $i < 2; $i++) {
            $item = [
                'title' => "title".$i,
                'description' => 'description',
                'source' => [
                    'value' => 'moell.cn',
                    'attr' => [
                        'url' => 'http://www.moell.cn'
                    ]
                ]
            ];
            $items[] = $item;
            $rss->item($item);
        }

        return response($rss, 200, ['Content-Type' => 'text/xml']);

        //Other acquisition methods
        //return response($rss->build()->asXML(), 200, ['Content-Type' => 'text/xml']);

        //return response($rss->fastBuild($channel, $items)->asXML(), 200, ['Content-Type' => 'text/xml']);

        //return response($rss->channel($channel)->items($items)->build()->asXML(), 200, ['Content-Type' => 'text/xml']);

    }
}
```
### Generate results
```xml
<?xml version="1.0" encoding="UTF-8"?>
<rss
    xmlns:content="http://purl.org/rss/1.0/modules/content/"
    xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">
    <title>title</title>
    <link>http://moell.cn</link>
    <description>description</description>
    <category domain="http://www.moell.cn">html</category>
    <item>
        <title>title0</title>
        <description>description</description>
        <source url="http://www.moell.cn">moell.cn</source>
    </item>
    <item>
        <title>title1</title>
        <description>description</description>
        <source url="http://www.moell.cn">moell.cn</source>
    </item>
</rss>
```

### License
MIT
