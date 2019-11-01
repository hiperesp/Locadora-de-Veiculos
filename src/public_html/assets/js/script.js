/**
 * HyperGaming - Gaming CSS Framework
 * NOTE: Chromium 73.0.3683.86 for Arch Linux 64 bits
 * @author Gabriel Lopes Ferreira Ramos <gabrielramos149@gmail.com>
 * @link https://hiperesp.github.io/
 * @license UNDEFINED
 */

(function () {
    /*SECURITY MESSAGE*/
    (function () {
        var silentConsole = function (text, format) {
            setTimeout(console.log.bind(console, "%c" + text, format));
        }
        silentConsole("ATENÇÃO!!!", "color:#FF8F1C; font-size:40px;");
        silentConsole("Essa ferramenta do navegador é somente para desenvolvedores. Por favor, não copie e cole ou execute quaisquer códigos aqui. Isso pode prejudicar sua conta.", "color:#003087; font-size:12px;");
        silentConsole("Para mais informações, veja: http://en.wikipedia.org/wiki/Self-XSS", "color:#003087; font-size:12px;");
    })();
    /*header scroll sticky animation*/
    (function () {
        var HEADER = document.querySelector("header");
        addEventListener("scroll", function (e) {
            (function (offset) {
                if (offset > HEADER.clientHeight) {
                    HEADER.classList.add("sticky");
                } else {
                    HEADER.classList.remove("sticky");
                }
            })(pageYOffset);
        });
    })();
    /*hamburger menu*/
    (function () {
        document.querySelector(".hamburger-controller-label").addEventListener("click", function () {
            if (!(this.dataset.mobile == "true" || false)) {
                this.dataset.mobile = true;
                var HEADER = document.querySelector("header nav");
                var MENUS = HEADER.querySelectorAll("ul.menu");
                for (var i = 0; i < MENUS.length; i++) {
                    var MENU_ITEMS = MENUS[i].querySelectorAll("li.menu-item");
                    for (var j = 0; j < MENU_ITEMS.length; j++) {
                        var dropdownContent = MENU_ITEMS[j].querySelectorAll(".dropdown-content")
                        if (dropdownContent.length == 1) {
                            dropdownContent[0].style.opacity = "0";
                        }
                        MENU_ITEMS[j].addEventListener("click", function () {
                            if (this.classList.contains("open")) {
                                this.classList.remove("open");
                                this.querySelector(".dropdown-content").style.opacity = "0";
                                this.querySelector(".dropdown-content").style.visibility = "visible";
                                setTimeout(function (elem) {
                                    elem.querySelector(".dropdown-content").style.display = "none";
                                }, 250, this);
                            } else {
                                this.classList.add("open");
                                this.querySelector(".dropdown-content").style.display = "block";
                                this.querySelector(".dropdown-content").style.visibility = "visible";
                                setTimeout(function (elem) {
                                    elem.querySelector(".dropdown-content").style.opacity = "1";
                                }, 1, this)
                            }
                        });
                    }
                }
            }
        });
    })();
    /*sliders*/
    (function () {
        var SLIDERS = document.querySelectorAll(".slider");
        var all_slides = [];
        var timeout = 0;

        for (var i = 0; i < SLIDERS.length; i++) {
            SLIDERS[i].dataset.sliderIndex = i;
            SLIDERS[i].dataset.paused = "false";
            SLIDERS[i].dataset.nextSlide = "no";
            all_slides[i] = SLIDERS[i].querySelector(".section-content").querySelectorAll(".slide");
            fillSlideSelector(i);
            nextSlide(i, true);
        }
        function fillSlideSelector(sliderIndex, currentSlide) {
            var CHANGE_SLIDE_CONTAINER = SLIDERS[sliderIndex].querySelectorAll(".section-pos .change-slide");
            if (CHANGE_SLIDE_CONTAINER.length > 0) {
                CHANGE_SLIDE_CONTAINER = CHANGE_SLIDE_CONTAINER[0];

                while (CHANGE_SLIDE_CONTAINER.firstChild) {
                    CHANGE_SLIDE_CONTAINER.removeChild(CHANGE_SLIDE_CONTAINER.firstChild);
                }

                var back = document.createElement("a");
                back.href = "javascript:void(0)";
                back.classList.add("button-3");
                back.dataset.slider = sliderIndex;
                back.addEventListener("click", function () {
                    backSlide(this.dataset.slider);
                });
                var icon_back = document.createElement("i");
                icon_back.classList.add("material-icons");
                icon_back.textContent = "navigate_before";
                back.appendChild(icon_back);
                CHANGE_SLIDE_CONTAINER.appendChild(back);

                for (var i = 0; i < all_slides[sliderIndex].length; i++) {
                    var button = document.createElement("a");
                    button.href = "javascript:void(0)";
                    button.classList.add("button-3");
                    button.dataset.slider = sliderIndex;
                    button.dataset.slide = i;
                    var icon = document.createElement("i");
                    icon.classList.add("material-icons");
                    if (currentSlide == all_slides[sliderIndex][i]) {
                        icon.textContent = "radio_button_checked";
                    } else {
                        icon.textContent = "radio_button_unchecked";
                        button.addEventListener("click", function () {
                            changeSlide(this.dataset.slider, this.dataset.slide);
                        });
                    }
                    button.appendChild(icon);
                    CHANGE_SLIDE_CONTAINER.appendChild(button);
                }

                var pos = document.createElement("a");
                pos.href = "javascript:void(0)";
                pos.classList.add("button-3");
                pos.dataset.slider = sliderIndex;
                pos.addEventListener("click", function () {
                    posSlide(this.dataset.slider);
                });
                var icon_pos = document.createElement("i");
                icon_pos.classList.add("material-icons");
                icon_pos.textContent = "navigate_next";
                pos.appendChild(icon_pos);
                CHANGE_SLIDE_CONTAINER.appendChild(pos);
            }
        }
        function changeSlide(sliderIndex, slide) {
            slide = all_slides[sliderIndex][slide];
            var slideContainer = SLIDERS[sliderIndex].querySelector(".section-content");
            var currentSlide = null;
            while (currentSlide != slide) {
                if (currentSlide != null) {
                    slideContainer.appendChild(currentSlide);
                }
                currentSlide = slideContainer.querySelector(".slide");
            }
            SLIDERS[sliderIndex].dataset.nextSlide = "no";
            clearTimeout(timeout);
            nextSlide(sliderIndex, true);
        }
        function backSlide(sliderIndex) {
            for (var i = 0; i < all_slides[sliderIndex].length; i++) {
                if (all_slides[sliderIndex][i].style.display != "none") {
                    if (i == 0) {
                        i = all_slides[sliderIndex].length;
                    }
                    changeSlide(sliderIndex, i - 1);
                    break;
                }
            }
        }
        function posSlide(sliderIndex) {
            for (var i = 0; i < all_slides[sliderIndex].length; i++) {
                if (all_slides[sliderIndex][i].style.display != "none") {
                    if (i == all_slides[sliderIndex].length - 1) {
                        i = -1;
                    }
                    changeSlide(sliderIndex, i + 1);
                    break;
                }
            }
        }
        function nextSlide(sliderIndex, reset = false) {
            var resetTimerPreview = function (sliderIndex) {
                var timeoutPreview = SLIDERS[sliderIndex].querySelectorAll(".section-pos .slide-timer");
                if (timeoutPreview.length > 0) {
                    timeoutPreview[0].style.transition = "width 0ms, height 0.5s";
                    timeoutPreview[0].style.width = "0%";
                }
            }
            var resetSlider = function (sliderIndex, callback) {
                resetTimerPreview(sliderIndex);
                SLIDERS[sliderIndex].addEventListener("mouseenter", function (e) {
                    SLIDERS[sliderIndex].dataset.paused = "true";
                });
                SLIDERS[sliderIndex].addEventListener("mouseleave", function (e) {
                    SLIDERS[sliderIndex].dataset.paused = "false";
                    if (SLIDERS[sliderIndex].dataset.nextSlide == "yes") {
                        nextSlide(this.dataset.sliderIndex);
                        SLIDERS[sliderIndex].dataset.nextSlide = "no";
                    }
                });
                var ALL_SLIDES = SLIDERS[sliderIndex].querySelectorAll(".section-content .slide");
                for (var i = 0; i < ALL_SLIDES.length; i++) {
                    ALL_SLIDES[i].style.display = "none";
                }
                callback(sliderIndex);
            };
            var showNewSlide = function (sliderIndex, callback) {
                var slideContainer = SLIDERS[sliderIndex].querySelector(".section-content");
                var newSlide = slideContainer.querySelector(".slide");
                newSlide.style.display = "table";
                //newSlide.style.display = "block";
                fillSlideSelector(sliderIndex, newSlide);
                timeout = setTimeout(function (newSlide, sliderIndex, callback) {
                    newSlide.classList.add("fade");
                    callback(sliderIndex, newSlide);
                }, 1, newSlide, sliderIndex, callback);
            };
            var hideOldSlide = function (sliderIndex, callback) {
                if (SLIDERS[sliderIndex].dataset.paused == "false") {
                    var slideContainer = SLIDERS[sliderIndex].querySelector(".section-content");
                    var oldSlide = slideContainer.querySelector(".slide");
                    oldSlide.classList.remove("fade");
                    resetTimerPreview(sliderIndex);
                    timeout = setTimeout(function (oldSlide, slideContainer, callback) {
                        oldSlide.style.display = "none";
                        slideContainer.appendChild(oldSlide);
                        callback(sliderIndex);
                    }, 500, oldSlide, slideContainer, callback);
                } else {
                    SLIDERS[sliderIndex].dataset.nextSlide = "yes";
                }
            };
            var showNextSlide = function (sliderIndex, newSlide) {
                var slideTimeout = newSlide.dataset.timeout || 0;
                if (slideTimeout > 0) {
                    var timeoutPreview = SLIDERS[sliderIndex].querySelectorAll(".section-pos .slide-timer");
                    if (timeoutPreview.length > 0) {
                        timeoutPreview[0].style.transition = "width " + slideTimeout + "ms, height 0.5s";
                        timeoutPreview[0].style.width = "100%";
                    }
                    timeout = setTimeout(function (sliderIndex) {
                        nextSlide(sliderIndex);
                    }, slideTimeout, sliderIndex);
                }
            };
            (reset ? resetSlider : hideOldSlide)(sliderIndex, function (sliderIndex) {
                showNewSlide(sliderIndex, showNextSlide);
            });
        }
    })();
    /*countdown*/
    (function () {
        var ALL_COUNTDOWNS = document.querySelectorAll(".countdown");
        for (var i = 0; i < ALL_COUNTDOWNS.length; i++) {
            if (typeof ALL_COUNTDOWNS[i].dataset.countdown == "undefined") {
                ALL_COUNTDOWNS[i].dataset.countdown = new Date().toString();
            }
            var dateString = ALL_COUNTDOWNS[i].dataset.countdown;
            dateNumber = parseInt(dateString);
            dateString = isNaN(dateNumber) ? dateString : dateNumber;
            var rate = (ALL_COUNTDOWNS[i].dataset.rate || 1000);
            startCountdown(dateString, rate, function (date, objCallback) {
                var countdownString = dateParse(date, Object.assign({}, objCallback.dataset));
                objCallback.innerHTML = countdownString;
            }, function (string, objCallback) {
                var expiredMessage = string;
                if (expiredMessage == null) {
                    expiredMessage = (objCallback.dataset.expireMessage || new String(new Date(objCallback.dataset.countdown)) || new String(new Date()));
                    var now = new Date();
                    var format = Object.assign({}, objCallback.dataset);
                    format.format = expiredMessage;
                    expiredMessage = dateParse({ years: now.getFullYear(), months: now.getMonth(), days: now.getDay(), hours: now.getHours(), minutes: now.getMinutes(), seconds: now.getSeconds(), milliseconds: now.getMilliseconds() }, format);
                }
                objCallback.innerHTML = expiredMessage;
            }, ALL_COUNTDOWNS[i]);
        }
        function startCountdown(dateString, rate, callback, callbackEnd, objCallback) {
            var countDownDateVar = new Date(dateString)
            var countDownDate = countDownDateVar.getTime();
            var calculateCountdown = function (countDownDate, callback, callbackEnd, objCallback) {
                if (isNaN(countDownDate)) {
                    callbackEnd(countDownDateVar, objCallback);
                } else {
                    var MILLISECOND = 1, SECOND = 1000 * MILLISECOND, MINUTE = 60 * SECOND, HOUR = 60 * MINUTE, DAY = 24 * HOUR, MONTH = 30 * DAY, YEAR = 12 * MONTH;
                    var now = new Date().getTime();
                    var offset = countDownDate - now;
                    if (offset < 1) {
                        callbackEnd(null, objCallback);
                        clearInterval(x);
                    } else {
                        var years = Math.floor(offset / YEAR); offset -= years * YEAR;
                        var months = Math.floor(offset / MONTH); offset -= months * MONTH;
                        var days = Math.floor(offset / DAY); offset -= days * DAY;
                        var hours = Math.floor(offset / HOUR); offset -= hours * HOUR;
                        var minutes = Math.floor(offset / MINUTE); offset -= minutes * MINUTE;
                        var seconds = Math.floor(offset / SECOND); offset -= seconds * SECOND;
                        var milliseconds = Math.floor(offset / MILLISECOND); offset -= milliseconds * MILLISECOND;
                        callback({ years, months, days, hours, minutes, seconds, milliseconds }, objCallback);
                    }
                }
            };
            var x = setInterval(calculateCountdown, rate, countDownDate, callback, callbackEnd, objCallback);
            calculateCountdown(countDownDate, callback, callbackEnd, objCallback);
        }
        function dateParse(hiperespDate, format) {
            var parsedDate = (format.format || "%if-year-string%%if-month-string%%if-day-string%%hour-string%%minute-string%%second-string%%millisecond-string%");
            var yearString = (format.yearString || "%year% years, ").replace(/%year%/g, zeroPad(hiperespDate.years, (format.yearPad || 0)));
            var monthString = (format.monthString || "%month% months, ").replace(/%month%/g, zeroPad(hiperespDate.months, (format.monthPad || 0)));
            var dayString = (format.dayString || "%day% days, ").replace(/%day%/g, zeroPad(hiperespDate.days, (format.dayPad || 0)));
            var hourString = (format.hourString || "%hour% hours, ").replace(/%hour%/g, zeroPad(hiperespDate.hours, (format.hourPad || 0)));
            var minuteString = (format.minuteString || "%minute% minutes, ").replace(/%minute%/g, zeroPad(hiperespDate.minutes, (format.minutePad || 0)));
            var secondString = (format.secondString || "%second% seconds, ").replace(/%second%/g, zeroPad(hiperespDate.seconds, (format.secondPad || 0)));
            var millisecondString = (format.millisecondString || "%millisecond% ms").replace(/%millisecond%/g, zeroPad(hiperespDate.milliseconds, (format.millisecondPad || 0)));
            var removeFirstZero = ((format.removeFirstZero || "") == "true");
            parsedDate = parsedDate.replace(/%if-year-string%/g, hiperespDate.years > 0 ? yearString : "");
            parsedDate = parsedDate.replace(/%year-string%/g, yearString);
            parsedDate = parsedDate.replace(/%if-month-string%/g, hiperespDate.months > 0 ? monthString : "");
            parsedDate = parsedDate.replace(/%month-string%/g, monthString);
            parsedDate = parsedDate.replace(/%if-day-string%/g, hiperespDate.days > 0 ? dayString : "");
            parsedDate = parsedDate.replace(/%day-string%/g, dayString);
            parsedDate = parsedDate.replace(/%if-hour-string%/g, hiperespDate.hours > 0 ? hourString : "");
            parsedDate = parsedDate.replace(/%hour-string%/g, hourString);
            parsedDate = parsedDate.replace(/%if-minute-string%/g, hiperespDate.minutes > 0 ? minuteString : "");
            parsedDate = parsedDate.replace(/%minute-string%/g, minuteString);
            parsedDate = parsedDate.replace(/%if-second-string%/g, hiperespDate.seconds > 0 ? secondString : "");
            parsedDate = parsedDate.replace(/%second-string%/g, secondString);
            parsedDate = parsedDate.replace(/%if-millisecond-string%/g, hiperespDate.milliseconds > 0 ? millisecondString : "");
            parsedDate = parsedDate.replace(/%millisecond-string%/g, millisecondString);
            parsedDate = (removeFirstZero && parsedDate[0] == "0") ? parsedDate.substring(1) : parsedDate;
            return parsedDate;
        }
        function zeroPad(number, pad) {
            pad = parseInt(pad);
            pad = (("" + number).length > pad) ? ("" + number).length : pad;
            var zeros;
            for (var i = 0; i < pad; i++ , zeros += "0");
            return (zeros + number).slice(-pad);
        }
    })();
    /*resize warning*/
    (function () {
        var isDisabled = $cookie("hiperesp-disable-resize-warning-screen") || false;
        var oldWidth = innerWidth;
        var RESIZE_WARNING_SCREEN = document.querySelector(".screen[data-screen=resize-warning]");
        var ACTIONS_BUTTONS = RESIZE_WARNING_SCREEN.querySelectorAll("a[data-resize-action]");
        RESIZE_WARNING_SCREEN.style.display = "none";
        addEventListener("resize", function (e) {
            if (!isDisabled) {
                if (oldWidth > 960 && innerWidth < 961 || oldWidth < 961 && innerWidth > 960) {
                    showWarning();
                } else {
                    closeWarning();
                }
            }
        });
        for (var i = 0; i < ACTIONS_BUTTONS.length; i++) {
            var BUTTON = ACTIONS_BUTTONS[i];
            var func = function () { };
            switch (BUTTON.dataset.resizeAction) {
                case "reload":
                    func = refresh;
                    break;
                case "no-reload":
                    func = closeWarning;
                    break;
                case "disable-warning":
                    func = disableWarningThenClose;
                    break;
            }
            BUTTON.addEventListener("click", func);
        }
        function showWarning() {
            RESIZE_WARNING_SCREEN.style.display = "table";
        }
        function refresh() {
            location.reload();
        }
        function closeWarning() {
            RESIZE_WARNING_SCREEN.style.display = "none";
            oldWidth = innerWidth;
        }
        function disableWarningThenClose() {
            disableWarning();
            closeWarning();
        }
        function disableWarning() {
            isDisabled = $cookie("hiperesp-disable-resize-warning-screen", true);
        }
    })();
    /*loading screen, always be last*/
    (function () {
        addEventListener("load", function () {
            setTimeout(function () {
                var LOADING_SCREEN = document.querySelector(".screen[data-screen=loading]");
                LOADING_SCREEN.style.opacity = "0";
                setTimeout(function (LOADING_SCREEN) {
                    document.querySelector("body").removeChild(LOADING_SCREEN);
                }, 1000, LOADING_SCREEN);
            }, 1);
        });
    })();
    function $cookie(name, value, seconds) {
        if (value) {
            var expires = "";
            if (seconds) {
                var date = new Date();
                date.setTime(date.getTime() + (seconds * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
            return $cookie(name);
        }
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
    function $rm_cookie(name) {
        document.cookie = name + '=; Max-Age=-99999999;';
    }
})();