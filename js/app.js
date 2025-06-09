/*
 * Siren application js
 * @author Louie
 * @url http://i94.me
 * @date 2016.11.19
 */
// DOM 查询缓存器
const getEl = (()=>{
    const cache = new Map();
    return (id)=>{
        if (!cache.has(id) || !document.body.contains(cache.get(id))) {
            cache.set(id, document.getElementById(id)); // 自动更新无效缓存
        }
        return cache.get(id);
    };
})();
const SafeStorage = {
    get(key) {
        try {
            return localStorage.getItem(key);
        } catch (e) {
            return null;
        }
    },
    set(key, value) {
        try {
            localStorage.setItem(key, value);
        } catch (e) {
            return null;
        }
    }
};
// 防抖函数
const debounce = (fn,delay)=>{
    let timer;
    return function(...args) {
        clearTimeout(timer);
        timer = setTimeout(()=>fn.apply(this, args), delay);
    };
};
// 表情
function grin(emoji) {
    const textarea = getEl("comment");
	// 元素校验
    if (!(textarea instanceof HTMLTextAreaElement)) return;
    try {
        const startPos = textarea.selectionStart;
        const endPos = textarea.selectionEnd;
        const wrappedEmoji = `${emoji}`;
		// 使用现代文本操作API
        textarea.setRangeText(wrappedEmoji, startPos, endPos, 'end');
		// 设置光标 焦点管理
        requestAnimationFrame(()=>{
            textarea.focus();
            const newCursor = startPos + wrappedEmoji.length;
            textarea.setSelectionRange(newCursor, newCursor);
        });
		// 触发输入事件
        textarea.dispatchEvent(new Event('input',{
            bubbles: true
        }));
    } catch (error) {}
}

// baguetteBox Libs
var baguetteBox = function() {
    function t(t, n) {
        H.transforms = f();
        H.svg = g();
        e();
        j = document.querySelectorAll(t);
        for (let i = 0; i < j.length; i++) {
            const el = j[i];
            if (n && n.filter) {
                A = n.filter;
            }
            const links = el.getElementsByTagName("a");
            const filteredLinks = [];
            for (let k = 0; k < links.length; k++) {
                if (A.test(links[k].href)) {
                    filteredLinks.push(links[k]);
                }
            }
            const o = D.length;
            D.push(filteredLinks);
            D[o].options = n;
            for (let l = 0; l < D[o].length; l++) {
                const link = D[o][l];
                link.addEventListener("click", function(event) {
                    event.preventDefault();
                    i(o);
                    a(l);
                });
            }
        }
    }

    function e() {
        const b = document.getElementById("baguetteBox-overlay");
        if (b) {
            k = document.getElementById("baguetteBox-slider");
            w = document.getElementById("previous-button");
            C = document.getElementById("next-button");
            T = document.getElementById("close-button");
        } else {
            const b = document.createElement("div");
            b.id = "baguetteBox-overlay";
            document.body.appendChild(b);
            k = document.createElement("div");
            k.id = "baguetteBox-slider";
            b.appendChild(k);
            w = document.createElement("button");
            w.id = "previous-button";
            w.innerHTML = H.svg ? E : "<";
            b.appendChild(w);
            C = document.createElement("button");
            C.id = "next-button";
            C.innerHTML = H.svg ? x : ">";
            b.appendChild(C);
            T = document.createElement("button");
            T.id = "close-button";
            T.innerHTML = H.svg ? B : "X";
            b.appendChild(T);
            w.className = C.className = T.className = "baguetteBox-button";
            n();
        }
    }

    function n() {
        const b = document.getElementById("baguetteBox-overlay");
        b.addEventListener("click", function(event) {
            if (event.target && event.target.nodeName!== "IMG" && event.target.nodeName!== "FIGCAPTION") {
                r();
            }
        });
        w.addEventListener("click", function(event) {
            event.stopPropagation();
            c();
        });
        C.addEventListener("click", function(event) {
            event.stopPropagation();
            u();
        });
        T.addEventListener("click", function(event) {
            event.stopPropagation();
            r();
        });
        b.addEventListener("touchstart", function(event) {
            N = event.changedTouches[0].pageX;
        });
        b.addEventListener("touchmove", function(event) {
            if (!S) {
                event.preventDefault();
                const touch = event.touches[0] || event.changedTouches[0];
                if (touch.pageX - N > 40) {
                    S = true;
                    c();
                } else if (touch.pageX - N < -40) {
                    S = true;
                    u();
                }
            }
        });
        b.addEventListener("touchend", function() {
            S = false;
        });
        document.addEventListener("keydown", function(event) {
            switch (event.keyCode) {
                case 37:
                    c();
                    break;
                case 39:
                    u();
                    break;
                case 27:
                    r();
                    break;
            }
        });
    }

    function i(t) {
        if (M!== t) {
            M = t;
            o(D[t].options);
            while (k.firstChild) {
                k.removeChild(k.firstChild);
            }
            X.length = 0;
            for (let n = 0; n < D[t].length; n++) {
                const e = document.createElement("div");
                e.className = "full-image";
                e.id = "baguette-img-" + n;
                X.push(e);
                k.appendChild(X[n]);
            }
        }
    }

    function o(t) {
        t = t || {};
        for (const e in P) {
            I[e] = P[e];
            if (typeof t[e]!== "undefined") {
                I[e] = t[e];
            }
        }
        k.style.transition = k.style.webkitTransition = I.animation === "fadeIn"? "opacity .4s ease" : I.animation === "slideIn"? "" : "none";
        if (I.buttons === "auto") {
            if ("ontouchstart" in window || D[M].length === 1) {
                I.buttons = false;
            }
        }
        w.style.display = C.style.display = I.buttons? "" : "none";
    }

    function a(t) {
        const b = document.getElementById("baguetteBox-overlay");
        if (b.style.display!== "block") {
            L = t;
            s(L, function() {
                p(L);
                h(L);
            });
            d();
            b.style.display = "block";
            setTimeout(function() {
                b.className = "visible";
                if (I.afterShow) {
                    I.afterShow();
                }
            }, 50);
            if (I.onChange) {
                I.onChange(L, X.length);
            }
        }
    }

    function r() {
        const b = document.getElementById("baguetteBox-overlay");
        if (b.style.display!== "none") {
            b.className = "";
            setTimeout(function() {
                b.style.display = "none";
                if (I.afterHide) {
                    I.afterHide();
                }
            }, 500);
        }
    }

    function s(t, e) {
        const n = X[t];
        if (typeof n!== "undefined") {
            if (n.getElementsByTagName("img")[0]) {
                if (e) {
                    e();
                }
                return;
            }
            const imageElement = D[M][t];
            const imageCaption = typeof I.captions === "function"? I.captions.call(D[M], imageElement) : imageElement.getAttribute("data-caption") || imageElement.title;
            const imageSrc = l(imageElement);
            const i = document.createElement("figure");
            const o = document.createElement("img");
            const a = document.createElement("figcaption");
            n.appendChild(i);
            i.innerHTML = '<div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>';
            o.onload = function() {
                const n = document.querySelector("#baguette-img-" + t + " .spinner");
                i.removeChild(n);
                if (!I.async && e) {
                    e();
                }
            };
            o.setAttribute("src", imageSrc);
            i.appendChild(o);
            if (I.captions && imageCaption) {
                a.innerHTML = imageCaption;
                i.appendChild(a);
            }
            if (I.async && e) {
                e();
            }
        }
    }

    function l(t) {
        let e = t.href;
        if (t.dataset) {
            const n = {};
            for (const i in t.dataset) {
                if (i.substring(0, 3) === "at-" &&!isNaN(i.substring(3))) {
                    n[i.replace("at-", "")] = t.dataset[i];
                }
            }
            const keys = Object.keys(n).sort(function(t, e) {
                return parseInt(t) < parseInt(e)? -1 : 1;
            });
            const o = window.innerWidth * window.devicePixelRatio;
            let a = 0;
            for (; a < keys.length - 1 && keys[a] < o; a++);
            e = n[keys[a]] || e;
        }
        return e;
    }

    function u() {
        let t;
        if (L <= X.length - 2) {
            L++;
            d();
            p(L);
            t = true;
        } else if (I.animation) {
            k.className = "bounce-from-right";
            setTimeout(function() {
                k.className = "";
            }, 400);
            t = false;
        }
        if (I.onChange) {
            I.onChange(L, X.length);
        }
        return t;
    }

    function c() {
        let t;
        if (L >= 1) {
            L--;
            d();
            h(L);
            t = true;
        } else if (I.animation) {
            k.className = "bounce-from-left";
            setTimeout(function() {
                k.className = "";
            }, 400);
            t = false;
        }
        if (I.onChange) {
            I.onChange(L, X.length);
        }
        return t;
    }

    function d() {
        const t = 100 * -L + "%";
        if (I.animation === "fadeIn") {
            k.style.opacity = 0;
            setTimeout(function() {
                if (H.transforms) {
                    k.style.transform = k.style.webkitTransform = "translate3d(" + t + ",0,0)";
                } else {
                    k.style.left = t;
                }
                k.style.opacity = 1;
            }, 400);
        } else if (H.transforms) {
            k.style.transform = k.style.webkitTransform = "translate3d(" + t + ",0,0)";
        } else {
            k.style.left = t;
        }
    }

    function f() {
        const t = document.createElement("div");
        return typeof t.style.perspective!== "undefined" || typeof t.style.webkitPerspective!== "undefined";
    }

    function g() {
        const t = document.createElement("div");
        t.innerHTML = "<svg/>";
        return t.firstChild && t.firstChild.namespaceURI === "http://www.w3.org/2000/svg";
    }

    function p(t) {
        if (t - L >= I.preload) {
            s(t + 1, function() {
                p(t + 1);
            });
        }
    }

    function h(t) {
        if (L - t >= I.preload) {
            s(t - 1, function() {
                h(t - 1);
            });
        }
    }

    let b, k, w, C, T, N;
    const E = '<svg width="44" height="60"><polyline points="30 10 10 30 30 50" stroke="rgba(255,255,255,.8)" stroke-width="4"stroke-linecap="butt" fill="none" stroke-linejoin="round"/></svg>';
    const x = '<svg width="44" height="60"><polyline points="14 10 34 30 14 50" stroke="rgba(255,255,255,.8)" stroke-width="4"stroke-linecap="butt" fill="none" stroke-linejoin="round"/></svg>';
    const B = '<svg width="30" height="30"><g stroke="rgba(255,255,255,.8)" stroke-width="4"><line x1="5" y1="5" x2="25" y2="25"/><line x1="5" y1="25" x2="25" y2="5"/></g></svg>';
    const I = {};
    const P = {
        captions: true,
        buttons: "auto",
        async: false,
        preload: 2,
        animation: "slideIn",
        afterShow: null,
        afterHide: null,
        onChange: null
    };
    const H = {};
    let L = 0;
    let M = -1;
    let S = false;
    const A = /.+\.(gif|jpe?g|png|webp)/i;
    let j = [];
    let D = [];
    let X = [];

    return {
        run: t,
        showNext: u,
        showPrevious: c
    };
}();

const home = location.href;
const s = document.getElementById('bgvideo');

const Siren = {
    // 移动端菜单
    MN: function() {
        const iconflat = document.querySelector('.iconflat');
        if (iconflat) {
            iconflat.addEventListener('click', function() {
                document.body.classList.toggle('navOpen');
                const mainContainer = document.getElementById('main-container');
                const moNav = document.getElementById('mo-nav');
                const openNav = document.querySelector('.openNav');
                if (mainContainer) {
                    mainContainer.classList.toggle('open');
                }
                if (moNav) {
                    moNav.classList.toggle('open');
                }
                if (openNav) {
                    openNav.classList.toggle('open');
                }
            });
        }
    },

    // 移动端菜单自动隐藏
    MNH: function() {
        if (document.body.classList.contains('navOpen')) {
            document.body.classList.toggle('navOpen');
            const mainContainer = document.getElementById('main-container');
            const moNav = document.getElementById('mo-nav');
            const openNav = document.querySelector('.openNav');
            if (mainContainer) {
                mainContainer.classList.toggle('open');
            }
            if (moNav) {
                moNav.classList.toggle('open');
            }
            if (openNav) {
                openNav.classList.toggle('open');
            }
        }
    },

    // 背景视频
    splay: function() {
        const videoBtn = document.getElementById('video-btn');
        if (videoBtn) {
            videoBtn.classList.add('video-pause');
            videoBtn.classList.remove('video-play');
            videoBtn.style.display = 'block';
            const videoStu = document.querySelector('.video-stu');
            if (videoStu) {
                videoStu.style.bottom = '-100px';
            }
            if (s) {
                s.play();
            }
        }
    },
    spause: function() {
        const videoBtn = document.getElementById('video-btn');
        if (videoBtn) {
            videoBtn.classList.add('video-play');
            videoBtn.classList.remove('video-pause');
            if (s) {
                s.pause();
            }
        }
    },
    liveplay: function() {
        if (s && s.oncanplay!== undefined && document.querySelectorAll('.haslive').length > 0) {
            if (document.querySelectorAll('.videolive').length > 0) {
                Siren.splay();
            }
        }
    },
    livepause: function() {
        if (s && s.oncanplay!== undefined && document.querySelectorAll('.haslive').length > 0) {
            Siren.spause();
            const videoStu = document.querySelector('.video-stu');
            if (videoStu) {
                videoStu.style.bottom = '0px';
                videoStu.innerHTML = '已暂停 ...';
            }
        }
    },
    addsource: function() {
        const videoStu = document.querySelector('.video-stu');
        if (videoStu) {
            videoStu.innerHTML = '正在载入视频 ...';
            videoStu.style.bottom = '0px';
        }
        const t = Poi.movies.name.split(",");
        const _t = t[Math.floor(Math.random() * t.length)];
        const bgvideo = document.getElementById('bgvideo');
        if (bgvideo) {
            bgvideo.setAttribute('src', Poi.movies.url + '/' + _t + '.mp4');
            bgvideo.setAttribute('video-name', _t);
        }
    },
    LV: function() {
        const _btn = document.getElementById('video-btn');
        if (_btn) {
            _btn.addEventListener('click', function() {
                if (_btn.classList.contains('loadvideo')) {
                    _btn.classList.add('video-pause');
                    _btn.classList.remove('loadvideo');
                    _btn.style.display = 'none';
                    Siren.addsource();
                    if (s) {
                        s.oncanplay = function() {
                            Siren.splay();
                            const videoAdd = document.getElementById('video-add');
                            if (videoAdd) {
                                videoAdd.style.display = 'block';
                            }
                            _btn.classList.add('videolive');
                            _btn.classList.add('haslive');
                        };
                    }
                } else {
                    if (_btn.classList.contains('video-pause')) {
                        Siren.spause();
                        _btn.classList.remove('videolive');
                        const videoStu = document.querySelector('.video-stu');
                        if (videoStu) {
                            videoStu.style.bottom = '0px';
                            videoStu.innerHTML = '已暂停 ...';
                        }
                    } else {
                        Siren.splay();
                        _btn.classList.add('videolive');
                    }
                }
                if (s) {
                    s.onended = function() {
                        const bgvideo = document.getElementById('bgvideo');
                        if (bgvideo) {
                            bgvideo.setAttribute('src', '');
                        }
                        const videoAdd = document.getElementById('video-add');
                        if (videoAdd) {
                            videoAdd.style.display = 'none';
                        }
                        _btn.classList.add('loadvideo');
                        _btn.classList.remove('video-pause');
                        _btn.classList.remove('videolive');
                        _btn.classList.remove('haslive');
                    };
                }
            });
            const videoAdd = document.getElementById('video-add');
            if (videoAdd) {
                videoAdd.addEventListener('click', function() {
                    Siren.addsource();
                });
            }
        }
    },

    // 自适应窗口高度
    AH: function() {
        if (Poi.windowheight === 'auto') {
            const mainTitle = document.querySelector('h1.main-title');
            if (mainTitle) {
                const _height = window.innerHeight;
                const centerbg = document.getElementById('centerbg');
                if (centerbg) {
                    centerbg.style.height = _height + 'px';
                }
                const bgvideo = document.getElementById('bgvideo');
                if (bgvideo) {
                    bgvideo.style.minHeight = _height + 'px';
                }
                window.addEventListener('resize', function() {
                    Siren.AH();
                });
            }
        } else {
            const headertop = document.querySelector('.headertop');
            if (headertop) {
                headertop.classList.add('headertop-bar');
            }
        }
    },

    // 进程
    PE: function() {
        const headertop = document.querySelector('.headertop');
        if (headertop) {
            const mainTitle = document.querySelector('h1.main-title');
            const blank = document.querySelector('.blank');
            if (mainTitle) {
                if (blank) {
                    blank.style.paddingTop = '0px';
                }
                headertop.style.height = 'auto';
                headertop.style.display = 'block';
                if (Poi.movies.live === 'open') {
                    Siren.liveplay();
                }
            } else {
                if (blank) {
                    blank.style.paddingTop = '80px';
                }
                headertop.style.height = '0px';
                headertop.style.display = 'none';
                Siren.livepause();
            }
        }
    },

    // 点击事件
    CE: function() {
        // 显示&隐藏评论
        const commentsHidden = document.querySelector('.comments-hidden');
        const commentsMain = document.querySelector('.comments-main');
        if (commentsHidden) {
            commentsHidden.style.display = 'block';
        }
        if (commentsMain) {
            commentsMain.style.display = 'none';
        }
        if (commentsHidden) {
            commentsHidden.addEventListener('click', function() {
                if (commentsMain) {
                    commentsMain.style.display = 'block';
                    commentsHidden.style.display = 'none';
                }
            });
        }

        // 归档页
        const archives = document.querySelectorAll('.archives');
        const archivesTempH3 = document.querySelectorAll('#archives-temp h3');
        if (archives.length > 0) {
            for (let i = 1; i < archives.length; i++) {
                archives[i].style.display = 'none';
            }
            archives[0].style.display = 'block';
        }
        if (archivesTempH3.length > 0) {
            for (let i = 0; i < archivesTempH3.length; i++) {
                archivesTempH3[i].addEventListener('click', function(event) {
                    event.preventDefault();
                    const nextElement = this.nextElementSibling;
                    if (nextElement) {
                        if (nextElement.style.display === 'none') {
                            nextElement.style.display = 'block';
                        } else {
                            nextElement.style.display = 'none';
                        }
                    }
                });
            }
        }

        // 灯箱
        baguetteBox.run('.entry-content', {
            captions: function(element) {
                const img = element.getElementsByTagName('img')[0];
                return img? img.alt : '';
            }
        });

        // 搜索框
        const jsToggleSearch = document.querySelector('.js-toggle-search');
        const jsSearch = document.querySelector('.js-search');
        if (jsToggleSearch) {
            jsToggleSearch.addEventListener('click', function() {
                this.classList.toggle('is-active');
                if (jsSearch) {
                    jsSearch.classList.toggle('is-visible');
                }
            });
        }
        const searchClose = document.querySelector('.search_close');
        if (searchClose) {
            searchClose.addEventListener('click', function() {
                if (jsSearch && jsSearch.classList.contains('is-visible')) {
                    if (jsToggleSearch) {
                        jsToggleSearch.classList.toggle('is-active');
                    }
                    jsSearch.classList.toggle('is-visible');
                }
            });
        }

        // 导航菜单
        const showNav = document.getElementById('show-nav');
        if (showNav) {
            showNav.addEventListener('click', function() {
                if (showNav.classList.contains('showNav')) {
                    showNav.classList.remove('showNav');
                    showNav.classList.add('hideNav');
                    const nav = document.querySelector('.site-top .lower nav');
                    if (nav) {
                        nav.classList.add('navbar');
                    }
                } else {
                    showNav.classList.remove('hideNav');
                    showNav.classList.add('showNav');
                    const nav = document.querySelector('.site-top .lower nav');
                    if (nav) {
                        nav.classList.remove('navbar');
                    }
                }
            });
        }

        // 过渡动画
        const loading = document.getElementById("loading");
        if (loading) {
            loading.addEventListener('click', function() {
                loading.style.display = 'none';
            });
        }

        // 打开表情框
        const smliButton = document.querySelector(".smli-button");
        const smiliesBox = document.querySelector(".smilies-box");
        if (smliButton) {
            smliButton.addEventListener('click', function() {
                if (smiliesBox) {
                    if (smiliesBox.style.display === 'none') {
                        smiliesBox.style.display = 'block';
                    } else {
                        smiliesBox.style.display = 'none';
                    }
                }
            });
        }

        const weixin = document.getElementById('weixin');
        const qrcodeOpen = document.getElementById('qrcode-open');
        const blackMask = document.getElementById('black_mask');
        const qrcode = document.getElementById('qrcode');
        if (weixin) {
            weixin.addEventListener('click', function() {
                if (qrcodeOpen) {
                    qrcodeOpen.classList.add("demo-open");
                }
                if (blackMask) {
                    blackMask.classList.add("add_mask");
                }
                if (qrcode) {
                    qrcode.innerHTML = "";
                    new QRCode('qrcode', {
                        text: home,
                        colorDark: 'rgb(85, 85, 85)',
                        colorLight: '#ffffff',
                        width: '130',
                        height: '130',
                        correctLevel: QRCode.CorrectLevel.H
                    });
                }
            });
        }
        if (blackMask) {
            blackMask.addEventListener('click', function() {
                if (qrcodeOpen) {
                    qrcodeOpen.classList.remove("demo-open");
                }
                if (blackMask) {
                    blackMask.classList.remove("add_mask");
                }
            });
        }
    },

    // 合并返回顶部-导航栏显隐-滚动监听器
    GTNH: function() {
        // 返回顶部相关元素
        const rocket = document.querySelector('.rocket');
        const wrapper = document.querySelector('.rocket-wrapper');
    	// 导航栏相关元素
        const header = document.querySelector('.site-header');
        
        // 安全校验
        if (!rocket || !header) return;
    
        // 共享状态变量
        let ticking = false;
        let lastY = 0;
        const headerClassList = header.classList;
    
        // 合并的滚动监听器
        window.addEventListener('scroll', () => {
            if (ticking) return;
            ticking = true;
            
            requestAnimationFrame(() => {
                const y = window.scrollY;
                
                // 任务1: 控制火箭显隐
                wrapper.classList.toggle("rocket-visible", y > 100);
                
                // 任务2: 更新导航栏状态
                headerClassList.toggle('yya', y > 0);
                headerClassList.toggle('gizle', y > 30);
                headerClassList.toggle('sabit', y > 30 && y <= lastY);
                
                lastY = y;
                ticking = false;
            });
        }, { passive: true });
    
        // 火箭点击事件
        wrapper.addEventListener('click', () => {
            const startTime = performance.now();
            const startY = window.scrollY;
            const viewportHeight = window.innerHeight;
            const rocketRect = rocket.getBoundingClientRect();
            
            // 计算初始基准位置（考虑当前滚动偏移）
            const rocketStartY = rocketRect.top + startY;
            
            // 禁用 CSS 过渡干扰
            rocket.style.transition = 'none';
    
            // 动画循环
            const animate = (currentTime) => {
                const timeElapsed = currentTime - startTime;
                const progress = Math.min(timeElapsed / 1200, 1); // 总时长 1200ms
                
                // 同步任务1: 窗口滚动
                const scrollEase = 1 - Math.pow(1 - progress, 4);
                window.scrollTo(0, startY * (1 - scrollEase));
                
                // 同步任务2: 火箭位移（换算为视口高度的200%）
                const rocketOffset = viewportHeight * 2 * progress;
                rocket.style.transform = `translate(-50%, calc(-100% - ${rocketOffset}px))`;
                
                // 继续动画或清理
                if (progress < 1) {
                    requestAnimationFrame(animate);
                } else {
                    rocket.style.removeProperty('transform');
                    rocket.style.removeProperty('transition');
                }
            };
            
            requestAnimationFrame(animate);
        });
    },
    // Ajax评论
    XCS: function() {
        const cancel = getEl('cancel-comment-reply-link');
        if (!cancel) return;
        const cancelText = cancel.textContent;
		// 预缓存常用元素
        ['respond', 'comment_parent', 'comment'].forEach(getEl);
		// 创建提示条
        const butterbarHTML = message=>
		`<div class="butterBar butterBar--center"><p class="butterBar-message">${message}</p></div>`;
        const notify = message=>{
            // 如果已有提示存在，先移除
            const existing = document.querySelector('.butterBar');
            if (existing) existing.remove();
            // 创建新的提示条
            const wrapper = document.createElement('div');
            wrapper.innerHTML = butterbarHTML(message);
            const bar = wrapper.firstChild;
            document.body.appendChild(bar);
            // 3秒后自动移除
            setTimeout(()=>bar.remove(), 3000)
        };
        
		// 评论表单移动
        const moveForm = (commId,parentId,respondId)=>{
            const comm = getEl(commId);
            const respond = getEl(respondId);
            
            const parent = getEl('comment_parent');
            if (!respond || !parent) return false;
            cancel.textContent = cancelText;
			// 创建临时div
            let temp = getEl('wp-temp-form-div');
            if (!temp) {
                temp = document.createElement('div');
                temp.id = 'wp-temp-form-div';
                temp.style.display = 'none';
                respond.parentNode.insertBefore(temp, respond);
                elemCache.set('wp-temp-form-div', temp) // 更新缓存
            }
			// 移动表单
            if (!comm) {
                parent.value = '0';
                temp.parentNode.insertBefore(respond, temp);
                temp.parentNode.removeChild(temp)
            } else {
                comm.parentNode.insertBefore(respond, comm.nextSibling)
            }
			// 滚动到表单
            window.scrollTo({
                top: respond.offsetTop - 180,
                behavior: 'smooth'
            });
            parent.value = parentId;
            cancel.style.display = '';
			// 取消事件
            cancel.onclick = function() {
                parent.value = '0';
                const temp = getEl('wp-temp-form-div');
                const respond = getEl('respond');
                if (temp && respond && temp.parentNode) {
                    temp.parentNode.insertBefore(respond, temp);
                    temp.parentNode.removeChild(temp);
                }
                this.style.display = 'none';
                this.onclick = null;
                return false
            };
            try {
                getEl('comment')?.focus()
            } catch (e) {}
            return false
        };
		// 评论提交处理
        document.body.addEventListener('submit', debounce(async function(e) {
            if (e.target.id !== 'commentform') return;
            e.preventDefault();
			// 防止重复提交
            if (e.target.dataset.submitting === 'true') return;
            e.target.dataset.submitting = 'true';
            try {
                notify("让我看看你是不是在说我坏话！");
				// 获取表单数据
                const formData = new FormData(e.target);
                if (!formData.get('comment')?.trim()) {
                    throw new Error('评论内容不能为空');
                }
                formData.append('action', 'ajax_comment');
				// 请求处理
                const controller = new AbortController();
                const timeoutId = setTimeout(()=>controller.abort(), 5000);
                const response = await fetch(Poi.ajaxurl, {
                    method: 'POST',
                    body: formData,
                    credentials: 'same-origin',
                    signal: controller.signal
                });
                clearTimeout(timeoutId);
                if (!response.ok) {
                    throw new Error(await response.text() || '评论提交失败');
                }
				// 处理响应
                const responseText = await response.text();
                const parser = new DOMParser();
                const tempDoc = parser.parseFromString(responseText, 'text/html');
				// 清空评论框
                document.querySelectorAll('textarea').forEach(t=>t.value = '');
				// 插入评论
                const fragment = document.createDocumentFragment();
                // 解析获取回应 HTML
                const container = document.createElement('div');
                container.innerHTML = responseText;
                // 尝试找到最外层 <li> 标签
				let newComment = container.querySelector('li');
				if (!newComment) {
					throw new Error("评论解析失败。");
				}
				const parent = getEl('comment_parent')?.value || '0';
                if (parent !== '0') {
                    // 回复评论
					const parentComment = document.getElementById(`comment-${parent}`);
					if (!parentComment) return;
					let childrenContainer = parentComment.querySelector('.children');
					if (!childrenContainer) {
						childrenContainer = document.createElement('ul');
						childrenContainer.className = 'children';
						parentComment.appendChild(childrenContainer);
					}
					childrenContainer.insertAdjacentElement('afterbegin', newComment);
                } else {
					// 新评论
                    const list = document.querySelector('.comments-main .commentwrap');
                    if (list) {
                        const method = Poi.order === 'asc' ? 'beforeend' : 'afterbegin';
                        list.insertAdjacentElement(method, newComment);
                    } else {
                        // list 不存在，插在 respond 之前或之后
                        const pos = Poi.formpostion === 'bottom' ? 'beforebegin' : 'afterend';
                        getEl('respond').insertAdjacentElement(pos, newComment);
                    }
                }
                notify("算了，呈上去了！");
				// 重置状态
                cancel.style.display = 'none';
                cancel.onclick = null;
                getEl('comment_parent').value = '0';
				// 处理临时元素
                const temp = getEl('wp-temp-form-div');
                const respond = getEl('respond');
                if (temp && respond && temp.parentNode) {
                    temp.parentNode.insertBefore(respond, temp);
                    temp.parentNode.removeChild(temp)
                }
            } catch (error) {
                notify(error.message || '评论提交失败') ;
            } finally {
                e.target.dataset.submitting = 'false';
            }
        }, 200), {passive: false, capture: true});
		// 导出评论方法
		// 不要覆盖WordPress内置的addComment功能
        if (window.addComment) {
			// 扩展现有addComment对象，保留原有功能
            const originalMoveForm = window.addComment.moveForm;
            window.addComment.createButterbar = notify;
			// 有条件地覆盖moveForm，保持兼容性
            if (!originalMoveForm) {
                window.addComment.moveForm = moveForm
            }
        } else {
            window.addComment = {
                moveForm,
                createButterbar: notify
            }
        }
    },
    // Ajax加载文章
    XLS: function() {
        document.body.addEventListener('click', function(event) {
            if (event.target.matches('#pagination a')) {
                const link = event.target;
                link.classList.add("loading");
                link.textContent = "";
                fetch(link.href + "#main", {
                    method: "POST"
                })
               .then(response => response.text())
               .then(text => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(text, "text/html");
                    const result = doc.querySelectorAll("#main .post");
                    const nextHref = doc.querySelector("#pagination a")? doc.querySelector("#pagination a").href : undefined;
                    const main = document.getElementById("main");
                    if (main) {
                        for (let i = 0; i < result.length; i++) {
                            main.appendChild(result[i]);
                            result[i].style.display = 'none';
                            result[i].style.display = 'block';
                        }
                    }
                    const paginationLink = document.querySelector("#pagination a");
                    if (paginationLink) {
                        paginationLink.classList.remove("loading");
                        paginationLink.textContent = "下一页";
                        if (nextHref) {
                            paginationLink.href = nextHref;
                        } else {
                            const pagination = document.getElementById("pagination");
                            if (pagination) {
                                pagination.innerHTML = "<span>别翻了，真的没有了 ...</span>";
                            }
                        }
                    }
                });
                event.preventDefault();
            }
        });
    },
    IA: function() {
        if (typeof POWERMODE !== 'function') return;
        document.addEventListener('focusin', e=>{
            if (e.target.matches('input, textarea, [contenteditable]')) {
                e.target.addEventListener('input', POWERMODE);
                e.target.addEventListener('focusout', function cleanup() {
                    this.removeEventListener('input', POWERMODE);
                    this.removeEventListener('focusout', cleanup)
                })
            }
        })
    },
    // == 点赞功能模块 ==
    ZAN: function() {
        // 初始化点赞状态
        document.querySelectorAll('.specsZan').forEach(btn=>{
            const id = btn.dataset.id;
            if (!id) return;
            const key = `${location.pathname}_specs_zan_${id}`;
            if (SafeStorage.get(key)) {
                btn.querySelector('i')?.classList.replace('icon-heart_line', 'icon-heart');
                btn.classList.add('permanent-done');
            }
        });
        document.addEventListener('click', async e => {
            const btn = e.target.closest('.specsZan');
            if (!btn) return;
            const id = btn.dataset.id;
            const key = `${location.pathname}_specs_zan_${id}`;
            if (!id || btn.classList.contains('permanent-done')) return;
            // UI 更新
            const icon = btn.querySelector('i');
            const countEl = btn.querySelector('.count');
            btn.classList.add('permanent-done');
            if (icon)
                icon.classList.replace('icon-heart_line', 'icon-heart');
            if (countEl) {
                const count = parseInt(countEl.textContent || '0', 10);
                countEl.textContent = count + 1;
            }
            SafeStorage.set(key, 'true');
            btn.style.pointerEvents = 'none';
			// 发送请求
            try {
                await fetch(Poi.ajaxurl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `action=specs_zan&um_id=${encodeURIComponent(id)}&um_action=ding`
                });
            } catch (e) {}
        }, { passive: true });
    },
    SFS: function() {
        window.addEventListener('scroll', function() {
            const htmlHeight = document.body.scrollHeight || document.documentElement.scrollHeight;
            const clientHeight = window.innerHeight + 1;
            const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
            const pageNext = document.querySelector('#pagination a')? document.querySelector('#pagination a').href : undefined;
            const loadKey = document.getElementById("add_post_time");
            // 这里可以添加下拉自动刷新的逻辑
        });
    }
};

document.addEventListener('DOMContentLoaded', function() {
    Siren.MN();
    Siren.AH();
    Siren.PE();
    Siren.CE();
    Siren.GTNH();
    Siren.XLS();
    Siren.XCS();
    Siren.IA();
    Siren.ZAN();
    Siren.SFS();
    Siren.LV();
});


/*
 * File skip-link-focus-fix.js.
 * Helps with accessibility for keyboard only users.
 * Learn more: https://git.io/vWdr2
*/
var isWebkit = navigator.userAgent.toLowerCase().indexOf('webkit') > -1;
var isOpera = navigator.userAgent.toLowerCase().indexOf('opera') > -1;
var isIe = navigator.userAgent.toLowerCase().indexOf('msie') > -1;

if ((isWebkit || isOpera || isIe) && document.getElementById && window.addEventListener) {
    window.addEventListener('hashchange', function() {
        var id = location.hash.substring(1);
        var element;

        if (!(/^[A-z0-9_-]+$/.test(id))) {
            return;
        }

        element = document.getElementById(id);

        if (element) {
            if (!(/^(?:a|select|input|button|textarea)$/i.test(element.tagName))) {
                element.tabIndex = -1;
            }

            element.focus();
        }
    }, false);
}

