(function () {
    'use strict';

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeAboutVideoVisibility);
        return;
    }

    initializeAboutVideoVisibility();

    function initializeAboutVideoVisibility() {
        const observerUtils = window.MaribeIntersectionObserverUtils;
        const video = document.getElementById('logoHistoryVideo');
        const videoContainer = document.getElementById('logosContainer');

        if (!video || !videoContainer) {
            return;
        }

        let isSeeking = false;
        let isVisible = false;

        function releaseSeekingState() {
            window.setTimeout(function () {
                isSeeking = false;
            }, 50);
        }

        function playVideoIfVisible() {
            if (!isVisible || document.visibilityState !== 'visible') {
                return;
            }

            video.play().catch(function () {});
        }

        function pauseVideo() {
            if (!video.paused) {
                video.pause();
            }
        }

        video.addEventListener('timeupdate', function () {
            if (!isSeeking && video.duration && video.currentTime >= video.duration - 0.2) {
                isSeeking = true;
                video.currentTime = 0;
                releaseSeekingState();
            }
        });

        video.addEventListener('ended', function () {
            isSeeking = true;
            video.currentTime = 0;
            playVideoIfVisible();
            releaseSeekingState();
        });

        video.addEventListener('pause', function () {
            if (!isSeeking) {
                playVideoIfVisible();
            }
        });

        video.addEventListener('loadeddata', function () {
            playVideoIfVisible();
        });

        document.addEventListener('visibilitychange', function () {
            if (document.visibilityState !== 'visible') {
                pauseVideo();
                return;
            }

            playVideoIfVisible();
        });

        if (observerUtils && observerUtils.isSupported()) {
            observerUtils.observeVisibility(videoContainer, {
                threshold: 0.4,
                onEnter: function () {
                    isVisible = true;
                    playVideoIfVisible();
                },
                onExit: function () {
                    isVisible = false;
                    pauseVideo();
                }
            });

            return;
        }

        isVisible = true;
        playVideoIfVisible();
    }
})();
