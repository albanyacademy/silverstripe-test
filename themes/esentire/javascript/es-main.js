/// array.from polyfill

// Production steps of ECMA-262, Edition 6, 22.1.2.1
if (!Array.from) {
    Array.from = (function () {
        var toStr = Object.prototype.toString;
        var isCallable = function (fn) {
            return typeof fn === 'function' || toStr.call(fn) === '[object Function]';
        };
        var toInteger = function (value) {
            var number = Number(value);
            if (isNaN(number)) { return 0; }
            if (number === 0 || !isFinite(number)) { return number; }
            return (number > 0 ? 1 : -1) * Math.floor(Math.abs(number));
        };
        var maxSafeInteger = Math.pow(2, 53) - 1;
        var toLength = function (value) {
            var len = toInteger(value);
            return Math.min(Math.max(len, 0), maxSafeInteger);
        };

        // The length property of the from method is 1.
        return function from(arrayLike/*, mapFn, thisArg */) {
            // 1. Let C be the this value.
            var C = this;

            // 2. Let items be ToObject(arrayLike).
            var items = Object(arrayLike);

            // 3. ReturnIfAbrupt(items).
            if (arrayLike == null) {
                throw new TypeError('Array.from requires an array-like object - not null or undefined');
            }

            // 4. If mapfn is undefined, then let mapping be false.
            var mapFn = arguments.length > 1 ? arguments[1] : void undefined;
            var T;
            if (typeof mapFn !== 'undefined') {
                // 5. else
                // 5. a If IsCallable(mapfn) is false, throw a TypeError exception.
                if (!isCallable(mapFn)) {
                    throw new TypeError('Array.from: when provided, the second argument must be a function');
                }

                // 5. b. If thisArg was supplied, let T be thisArg; else let T be undefined.
                if (arguments.length > 2) {
                    T = arguments[2];
                }
            }

            // 10. Let lenValue be Get(items, "length").
            // 11. Let len be ToLength(lenValue).
            var len = toLength(items.length);

            // 13. If IsConstructor(C) is true, then
            // 13. a. Let A be the result of calling the [[Construct]] internal method
            // of C with an argument list containing the single item len.
            // 14. a. Else, Let A be ArrayCreate(len).
            var A = isCallable(C) ? Object(new C(len)) : new Array(len);

            // 16. Let k be 0.
            var k = 0;
            // 17. Repeat, while k < len… (also steps a - h)
            var kValue;
            while (k < len) {
                kValue = items[k];
                if (mapFn) {
                    A[k] = typeof T === 'undefined' ? mapFn(kValue, k) : mapFn.call(T, kValue, k);
                } else {
                    A[k] = kValue;
                }
                k += 1;
            }
            // 18. Let putStatus be Put(A, "length", len, true).
            A.length = len;
            // 20. Return A.
            return A;
        };
    }());
}


(function () {
    "use strict";
    var esentire = {
        initialized:false,
        mobile: false,
        init: function () {
            if(!this.initialised) {
                this.initialised = true;
            } else {
                return;
            }
            var self = this;
            this.checkMobile();
            this.mobileNav();
            this.allyNav();
            this.cookiesConsent();
        },
        checkMobile: function () {
            return this.mobile = /Android|webOS|iPhone|iPod|iPad|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || window.screen.width < 991;
        },
        mobileNav: function() {
            // todo - stolen from Algolia. I guess keyboard-navigable menus is a pipedream without JS. Theirs is pretty cool though.
            var e = document.querySelector("body")
                , t = document.querySelector(".js-mobile-menu")
                , n = document.querySelector(".js-mobile-nav")
                , r = document.querySelector(".js-mobile-nav-close");
            t.addEventListener("click", function() {
                n.classList.add("is-open"),
                    e.classList.add("ov-hidden")
            }),
                r.addEventListener("click", function() {
                    n.classList.remove("is-open"),
                        e.classList.remove("ov-hidden")
                })
        },
        allyNav: function() {
            function e(e) {
                return e.parentNode.querySelector(".js-subnav")
            }
            function t(e) {
                return e.querySelectorAll(".js-subnav-link")[e.querySelectorAll(".js-subnav-link").length - 1]
            }
            function n(e) {
                e.parentNode.querySelector(".js-subnav").classList.add("hover")
            }
            function r(e) {
                e.parentNode.querySelector(".js-subnav").classList.remove("hover")
            }
            function o() {
                [].concat(_toConsumableArray(document.querySelectorAll(".js-subnav"))).map(function(e) {
                    e.classList.remove("hover")
                })
            }
            var i = document.querySelectorAll(".js-subnav-trigger");
            [].concat(_toConsumableArray(i)).map(function(o) {
                o.addEventListener("mousemove", function() {
                    n(o)
                }),
                    o.addEventListener("touchstart", function() {
                        n(o)
                    }),
                    o.addEventListener("focus", function() {
                        n(o)
                    }),
                    o.addEventListener("mouseout", function() {
                        window.setTimeout(function() {
                            e(o).matches(":hover") || r(o)
                        }, 50)
                    }),
                    e(o).addEventListener("mouseleave", function() {
                        window.setTimeout(function() {
                            o.matches(":hover") || r(o)
                        }, 50)
                    }),
                    t(e(o)).addEventListener("blur", function() {
                        window.setTimeout(function() {
                            r(o)
                        }, 50)
                    })
            }),
                document.addEventListener("click", function(e) {
                    e.target.classList.contains("js-subnav-trigger") || e.target.classList.contains("js-subnav") || o()
                }),
                document.addEventListener("keydown", function(e) {
                    27 === e.keyCode && o()
                })
        },
        cookiesConsent:function () {
            var
                cookieName = 'cookies-accepted',
                id = '#cookies',
                link = id + ' .' + cookieName,
                CN = 'className',
                CLICK = 'click',
                HIDDEN = 'hidden',
                MOUSEWHEEL = 'mousewheel',
                SCROLL = 'scroll',
                document = window.document,
                location = window.location,
                st = window.setTimeout,
                ct = window.clearTimeout,
                delay = 1350,
                $ = function (css) {
                    return document.querySelector(css);
                },
                add = function (where, which, what) {
                    where.addEventListener(which, what, !where);
                },
                remove = function (where, which, what) {
                    where.removeEventListener(which, what, !where);
                },
                drop = function (el) {
                    el.parentNode.removeChild(el);
                    document.body.style.paddingTop = null;
                },
                hide = function (evt) {
                    var el = $(id);
                    ct(t);
                    if (el) {
                        remove(window, MOUSEWHEEL, hide);
                        remove(window, SCROLL, hide);
                        remove(document, CLICK, imply);
                        el[CN] += ' ' + HIDDEN;
                        st(drop, delay, el);
                        el = document.querySelectorAll(link);
                        if (el) {
                            if (evt.type === CLICK) {
                                set(evt.preventDefault());
                            }
                            remove(el, CLICK, hide);
                        }
                        evt.preventDefault();
                    }
                },
                set = function () {
                    var d = new Date();
                    d.setFullYear(d.getFullYear() + 1);
                    document.cookie = ''.concat(
                        cookieName, '=1',
                        ';expires=', d.toGMTString(),
                        ';path=/',
                        ';domain=.', location.hostname,
                        location.protocol === 'https' ? ';secure' : ''
                    );
                },
                imply = function(e) {
                    if (e.target.tagName === "A" && e.target.getAttribute("href") !== "#cookies")  {
                        document.getElementById("cookies").querySelector(".cookies-accepted").click();
                    }
                },
                show = function () {
                    var el = $(id);
                    if (el) {
                        if (document.cookie.indexOf(cookieName) < 0) {
                            t = st(function () {
                                t = 0;
                                add(window, MOUSEWHEEL, hide);
                                add(window, SCROLL, hide);
                            }, delay * 10);
                            el[CN] = el[CN].replace(HIDDEN, '');
                            document.body.style.paddingTop = window.getComputedStyle($(id), null).height;
                            el = $(link);
                            if (el) {
                                add(el, CLICK, hide);
                            }
                            add(document, CLICK, imply);
                        } else {
                            set(drop(el));
                        }
                    } else {
                        t = st(show, delay);
                    }
                },
                t = st(show, delay)
            ;
        }
    };
    esentire.init();
})(window);

