const CACHE_NAME = 'book-data-v2';
const urlsToCache = [
    'index.html',
    'aboutme.php',
    'addbooks.php',
    'css/bootstrap.min.css',
    'js/bootstrap.bundle.min.js',
    'style.css',
    'images/shelfwise-bookstack (1).png',
    'images/Image Remove Background.png',
    'images/readingbook.png'
];
// Install the service worker and cache the app's assets
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => {
            return cache.addAll(urlsToCache);
        })
    );
});
// Fetch and serve cached assets when offline
self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request).then(response => {
            return response || fetch(event.request);
        })
    );
});
// Activate the service worker and remove old caches
self.addEventListener('activate', event => {
    const cacheWhitelist = [CACHE_NAME];
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (!cacheWhitelist.includes(cacheName)) {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});