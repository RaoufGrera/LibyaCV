importScripts('https://storage.googleapis.com/workbox-cdn/releases/4.3.1/workbox-sw.js');
if (workbox) {

    // top-level routes we want to precache
    workbox.precaching.precacheAndRoute(['/policy','/terms']);

    // injected assets by Workbox CLI
    workbox.precaching.precacheAndRoute([]);

    // match routes for homepage, blog and any sub-pages of blog
    workbox.routing.registerRoute(
      'https://www.libyacv.com',
      'https://www.libyacv.com/job/search',
        new workbox.strategies.NetworkFirst({
            cacheName: 'static-resources',
        })
    );


    // js/css files
    workbox.routing.registerRoute(
      'https://www.libyacv.com/css/bootstrap_v1.css',
      'https://www.libyacv.com/js/facebox/jquery.js',
      'https://www.libyacv.com/js/index.js',
        new workbox.strategies.StaleWhileRevalidate({
            cacheName: 'static-resources',
        })
    );


}