最近弄一个flarum论坛，图片储存需要用到阿里云oss上传的拓展，看了一下“flagrow/upload”好像暂时没有阿里云，不过作者说稍后会添加。
我暂时等不了那么久，所以自己在原插件基础上增加了阿里云oss的支持。
## 本插件在原插件基础上新增支持阿里云OSS
本插件没有composer安装，所以请自己composer需要的依赖。
使用前提你必须拥有以下拓展：
- 阿里云oss sdk （不高于2.2的版本,我用的2.2.4）
  composer require aliyuncs/oss-sdk-php:v2.2.4
- Flysystem的oss适配器 
  composer require aliyuncs/aliyun-oss-flysystem
  
然后下载本插件，覆盖去原插件那里(vendor/flagrow/upload)，本插件只增加了模块，没改动原来的东西，原理上是不会影响你原来的插件配置。
（如果你之前没有用过flagrow/upload插件，请先自行composer安装一下原插件，因为会有安装别的依赖，然后再下载本插件去覆盖原插件即可）
  
最后你可能还需要改下你的语言包才能在后台显示出对应的中文（不影响实际功能）。

可能还需要php flarum cache:clear一下

我在beta8上亲测过可以使用，如果不能使用的，留下issue。

# Upload by ![Flagrow logo](https://avatars0.githubusercontent.com/u/16413865?v=3&s=20) [Flagrow](https://discuss.flarum.org/d/1832-flagrow-extension-developer-group)

[![MIT license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/flagrow/upload/blob/master/LICENSE.md) [![Latest Stable Version](https://img.shields.io/packagist/v/flagrow/upload.svg)](https://packagist.org/packages/flagrow/upload) [![Total Downloads](https://img.shields.io/packagist/dt/flagrow/upload.svg)](https://packagist.org/packages/flagrow/upload) [![Donate](https://discordapp.com/api/guilds/240489109041315840/embed.png)](https://flagrow.io/join-discord)

An extension that handles file uploads intelligently for your forum.

## Features

- For images:
  - Auto watermarks.
  - Auto resizing.
- Mime type to upload adapter mapping.
- Whitelisting mime types.
- Uploading on different storage services (local, imgur, AWS S3 for instance).
- Drag and drop uploads.
- Uploading multiple files at once (button and drag and drop both support this).
- Easily extendable, the extension heavily relies on Events.

For a complete overview of our releases, please visit the [milestones tracker](https://github.com/flagrow/upload/milestones) on Github.

## Installation

Use [Bazaar](https://discuss.flarum.org/d/5151) or install manually:

```bash
composer require "flagrow/upload:*"
```

## Updating

```bash
composer update flagrow/upload
php flarum cache:clear
```

## Configuration

Enable the extension, a new tab will appear on the left hand side. This separate settings page allows you to further configure the extension.

Make sure you configure the upload permission on the permissions page as well.

### Mimetype regular expression

Regular expressions allow you a lot of freedom, but they are also very difficult to understand. Here are some pointers, but feel free to ask
for help on the official Flarum forums.

In case you want to allow all regular file types including video, music, compressed files and images, use this:

```text
(video\/(3gpp|mp4|mpeg|quicktime|webm))|(audio\/(aiff|midi|mpeg|mp4))|(image\/(gif|jpeg|png))|(application\/(x-(7z|rar)-compressed|zip|arj|x-(bzip2|gzip|lha|stuffit|tar)|pdf))
```

A mimetype consists of a primary and secondary type. The primary type can be `image`, `video` and `application` for instance. The secondary
is like a more detailed specification, eg `png`, `pdf` etc. These two are divided by a `/`, in regex you have to escape this character by using: `\/`.

## Changelog

Please visit the [thread](https://discuss.flarum.org/d/4154).

Check [future milestones](https://github.com/flagrow/upload/milestones).

## Security

If you discover a security vulnerability within Upload, please send an email to the Flagrow team at security@flagrow.io. All security vulnerabilities will be promptly addressed.

Please include as many details as possible. You can use `php flarum info` to get the PHP, Flarum and extension versions installed.

## FAQ

-  __AWS S3__: read the [AWS S3 configuration page](https://github.com/flagrow/upload/wiki/AWS-S3).

## Links

- [Flarum Discuss post](https://discuss.flarum.org/d/4154)
- [Source code on GitHub](https://github.com/flagrow/upload)
- [Changelog](https://github.com/flagrow/upload/blob/master/CHANGELOG.md)
- [Report an issue](https://github.com/flagrow/upload/issues)
- [Download via Packagist](https://packagist.org/packages/flagrow/upload)

An extension by [Flagrow](https://flagrow.io/).
