## moell/laravel-rss
在[moell/rss](https://github.com/moell-peng/rss)基础上开发的laravel包

### RSS规范
[http://www.rssboard.org/rss-specification](http://www.rssboard.org/rss-specification)


### 要求
Laravel 5+

### 安装
```shell
composer require moell/laravel-rss:1.*
```

### 修改config/app.php
```shell
#在providers中追加
Moell\LaravelRss\RssServiceProvider::class,

#在aliases中追加
'Rss'   => Moell\LaravelRss\RssFacade::class,
```
### 提供接口
```php
//设置字符集
public function setEncode($encode); //默认UTF-8

public function channel(array $channel);

public function item(array $item);

public function items(array $items);

//构造xml
public function build();

//快速构造
public function fastBuild(array $channel, array $item);

public function __toString();
```

### 用法
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

        //其他获取方式
        //return response($rss->build()->asXML(), 200, ['Content-Type' => 'text/xml']);

        //return response($rss->fastBuild($channel, $items)->asXML(), 200, ['Content-Type' => 'text/xml']);

        //return response($rss->channel($channel)->items($items)->build()->asXML(), 200, ['Content-Type' => 'text/xml']);

    }
}

```
### 生成结果
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
