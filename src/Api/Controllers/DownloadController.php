<?php

namespace Flagrow\Upload\Api\Controllers;

use Flagrow\Upload\Api\Serializers\FileSerializer;
use Flagrow\Upload\Commands\Download;
use Flagrow\Upload\Helpers\Settings;
use Flarum\Post\PostRepository;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DownloadController implements RequestHandlerInterface
{
    public $serializer = FileSerializer::class;

    /**
     * @var Dispatcher
     */
    protected $bus;
    /**
     * @var PostRepository
     */
    private $posts;
    /**
     * @var Settings
     */
    private $settings;

    public function __construct(Dispatcher $bus, PostRepository $posts, Settings $settings)
    {
        $this->bus = $bus;
        $this->posts = $posts;
        $this->settings = $settings;
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $actor = $request->getAttribute('actor');
        $uuid = Arr::get($request->getQueryParams(), 'uuid');
        $postId = Arr::get($request->getQueryParams(), 'post');
        $csrf = Arr::get($request->getQueryParams(), 'csrf');

        $post = $this->posts->findOrFail($postId, $actor);
        $discussion = $post->discussion_id;

        $session = $request->getAttribute('session');

        if ($this->settings->get('disableHotlinkProtection') != 1 && $csrf !== $session->get('csrf_token')) {
            throw new ModelNotFoundException();
        }

        return $this->bus->dispatch(
            new Download($uuid, $actor, $discussion, $postId)
        );
    }
}
