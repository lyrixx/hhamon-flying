<?php

use Symfony\Component\HttpFoundation\Response;

$app->get('/', function() use ($app) {
    $params['is_flying'] = false;
    $tweet = $app['tweet.inspector']->getRecentTweetAboutFlying();

    if ($tweet) {
        $params['oembed_html'] = $app['tweet.inspector']->getOembedForTweet($tweet, 500, 'center')->html;
        $params['is_flying'] = true;
    }

    $response = new Response($app['twig']->render('index.html.twig', $params));
    $response->setTtl($app['tweet.inspector.ttl']);

    return $response;
});
