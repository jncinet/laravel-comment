<h1 align="center">会员评论</h1>

## 安装
```shell
$ composer require jncinet/laravel-comment
```

## 配置
```shell
$ php artisan vendor:publish --provider="Jncinet\\LaravelComment\\CommentServiceProvider"
```

## 使用
### 会员模型添加
```php
// ...
use Jncinet\LaravelComment\Traits\Commenter;

class User extends Authenticatable
{
    use Commenter;
    
    // ...
}
```

### 用户API
```php
$user = User::find(1);
// 用户所有评论
$user->comments;
// 用户指定模型评论
$user->getCommentItems(Article::class)->get();
```

### 内容模型添加
```php
// ...
use Jncinet\LaravelComment\Traits\Commentable;

class Article extends Model
{
    use Commentable;
    
    // ...
}
```

### 内容API
```php
$article = Article::find(1);
// 文章所有评论
$article->comments;
```