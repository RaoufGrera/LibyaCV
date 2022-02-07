importScripts('https://storage.googleapis.com/workbox-cdn/releases/4.3.1/workbox-sw.js');
if (workbox) {

    // top-level routes we want to precache
   // workbox.precaching.precacheAndRoute(['/policy','/terms']);

    // injected assets by Workbox CLI
    workbox.precaching.precacheAndRoute([
  {
    "url": "73618c7f3786a6076584ffc98d92eaf8.html",
    "revision": "837501974c28a8e3c8e15352acbcbd27"
  },
  {
    "url": "app.js",
    "revision": "39d03e43ab84df3dbdfe3349102df07b"
  },
  {
    "url": "css/app.css",
    "revision": "ac8245c5ce38cbe5f6f5359ae94481f3"
  },
  {
    "url": "css/bootstrap_v1.css",
    "revision": "98bead8da36cc4c3275dd8a25177db1e"
  }

]);

    // match routes for homepage, blog and any sub-pages of blog
    workbox.routing.registerRoute(
      'https://www.libyacv.com',

        new workbox.strategies.NetworkFirst({
            cacheName: 'static-resources',
        })
    );
    workbox.routing.registerRoute(
        'https://www.libyacv.com/job/search',

        new workbox.strategies.NetworkFirst({
            cacheName: 'static-resources',
        })
    );
    workbox.routing.registerRoute(
        'https://www.libyacv.com/company/search',

        new workbox.strategies.NetworkFirst({
            cacheName: 'static-resources',
        })
    );

    workbox.routing.registerRoute(
        'https://www.libyacv.com/cv/search',

        new workbox.strategies.NetworkFirst({
            cacheName: 'static-resources',
        })
    );
    workbox.routing.registerRoute(
        'https://www.libyacv.com/login',

        new workbox.strategies.NetworkFirst({
            cacheName: 'static-resources',
        })
    );

    workbox.routing.registerRoute(
        'https://www.libyacv.com/register',

        new workbox.strategies.NetworkFirst({
            cacheName: 'static-resources',
        })
    );
    // js/css files
    workbox.routing.registerRoute(
      'https://www.libyacv.com/css/bootstrap_v1.css',

        new workbox.strategies.StaleWhileRevalidate({
            cacheName: 'static-resources',
        })
    );

    if (!(self.Notification && self.Notification.permission === 'granted')) {
        //notifications arent supported or permission not granted!
     
    
    }
    self.addEventListener('push', function (e) {
    if (!(self.Notification && self.Notification.permission === 'granted')) {
        //notifications aren't supported or permission not granted!
        return;
    }

    if (e.data) {
        var msg = e.data.json();
        console.log(msg)
        e.waitUntil(self.registration.showNotification(msg.title, {
            body: msg.body,
            icon: msg.icon,
            actions: msg.actions
        }));
    }
});
self.addEventListener('notificationclick', function(e) {
    var notification = e.notification;
    
    var real = notification.actions[0].action;
    var action = e.action;
  
    if (action === 'close') {
      notification.close();
    } else {
      clients.openWindow(real);
      notification.close();
    }
  });

}
