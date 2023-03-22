

class newVideo {
    // video = this.video;

    constructor() {
        this.svg = {
            setting: new svg("0 0 24 24", [
                "M22.2,14.4L21,13.7c-1.3-0.8-1.3-2.7,0-3.5l1.2-0.7c1-0.6,1.3-1.8,0.7-2.7l-1-1.7c-0.6-1-1.8-1.3-2.7-0.7   L18,5.1c-1.3,0.8-3-0.2-3-1.7V2c0-1.1-0.9-2-2-2h-2C9.9,0,9,0.9,9,2v1.3c0,1.5-1.7,2.5-3,1.7L4.8,4.4c-1-0.6-2.2-0.2-2.7,0.7   l-1,1.7C0.6,7.8,0.9,9,1.8,9.6L3,10.3C4.3,11,4.3,13,3,13.7l-1.2,0.7c-1,0.6-1.3,1.8-0.7,2.7l1,1.7c0.6,1,1.8,1.3,2.7,0.7L6,18.9   c1.3-0.8,3,0.2,3,1.7V22c0,1.1,0.9,2,2,2h2c1.1,0,2-0.9,2-2v-1.3c0-1.5,1.7-2.5,3-1.7l1.2,0.7c1,0.6,2.2,0.2,2.7-0.7l1-1.7   C23.4,16.2,23.1,15,22.2,14.4z M12,16c-2.2,0-4-1.8-4-4c0-2.2,1.8-4,4-4s4,1.8,4,4C16,14.2,14.2,16,12,16z"
            ]),
            pause: new svg("0 0 512 512", [
                "M224,435.8V76.1c0-6.7-5.4-12.1-12.2-12.1h-71.6c-6.8,0-12.2,5.4-12.2,12.1v359.7c0,6.7,5.4,12.2,12.2,12.2h71.6   C218.6,448,224,442.6,224,435.8z",
                "M371.8,64h-71.6c-6.7,0-12.2,5.4-12.2,12.1v359.7c0,6.7,5.4,12.2,12.2,12.2h71.6c6.7,0,12.2-5.4,12.2-12.2V76.1   C384,69.4,378.6,64,371.8,64z"
            ]),
            mute: new svg("0 0 24 24", [
                "M5.889 16H2a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h3.889l5.294-4.332a.5.5 0 0 1 .817.387v15.89a.5.5 0 0 1-.817.387L5.89 16zm14.525-4l3.536 3.536-1.414 1.414L19 13.414l-3.536 3.536-1.414-1.414L17.586 12 14.05 8.464l1.414-1.414L19 10.586l3.536-3.536 1.414 1.414L20.414 12z"
            ]),
            halfMute: new svg("0 0 512 512", [
                "M296,416.19a23.92,23.92,0,0,1-14.21-4.69l-.66-.51-91.46-75H120a24,24,0,0,1-24-24V200a24,24,0,0,1,24-24h69.65l91.46-75,.66-.51A24,24,0,0,1,320,119.83V392.17a24,24,0,0,1-24,24Z",
                "M384,336a16,16,0,0,1-14.29-23.18c9.49-18.9,14.3-38,14.3-56.82,0-19.36-4.66-37.92-14.25-56.73a16,16,0,0,1,28.5-14.54C410.2,208.16,416,231.47,416,256c0,23.83-6,47.78-17.7,71.18A16,16,0,0,1,384,336Z"
            ]),
            play: new svg("0 0 512 512", [
                "M405.2,232.9L126.8,67.2c-3.4-2-6.9-3.2-10.9-3.2c-10.9,0-19.8,9-19.8,20H96v344h0.1c0,11,8.9,20,19.8,20  c4.1,0,7.5-1.4,11.2-3.4l278.1-165.5c6.6-5.5,10.8-13.8,10.8-23.1C416,246.7,411.8,238.5,405.2,232.9z"
            ]),
            openFullScreen: new svg("0 0 14 14", [
                "M2,9 L0,9 L0,14 L5,14 L5,12 L2,12 L2,9 L2,9 Z M0,5 L2,5 L2,2 L5,2 L5,0 L0,0 L0,5 L0,5 Z M12,12 L9,12 L9,14 L14,14 L14,9 L12,9 L12,12 L12,12 Z M9,0 L9,2 L12,2 L12,5 L14,5 L14,0 L9,0 L9,0 Z"
            ]),
            exitFullScreen: new svg("0 0 14 14", [
                "M0,11 L3,11 L3,14 L5,14 L5,9 L0,9 L0,11 L0,11 Z M3,3 L0,3 L0,5 L5,5 L5,0 L3,0 L3,3 L3,3 Z M9,14 L11,14 L11,11 L14,11 L14,9 L9,9 L9,14 L9,14 Z M11,3 L11,0 L9,0 L9,5 L14,5 L14,3 L11,3 L11,3 Z"
            ]),
            fullVolume: new svg("0 0 512 512", [
                "M232,416a23.88,23.88,0,0,1-14.2-4.68,8.27,8.27,0,0,1-.66-.51L125.76,336H56a24,24,0,0,1-24-24V200a24,24,0,0,1,24-24h69.75l91.37-74.81a8.27,8.27,0,0,1,.66-.51A24,24,0,0,1,256,120V392a24,24,0,0,1-24,24ZM125.82,336Zm-.27-159.86Z",
                "M320,336a16,16,0,0,1-14.29-23.19c9.49-18.87,14.3-38,14.3-56.81,0-19.38-4.66-37.94-14.25-56.73a16,16,0,0,1,28.5-14.54C346.19,208.12,352,231.44,352,256c0,23.86-6,47.81-17.7,71.19A16,16,0,0,1,320,336Z",
                "M368,384a16,16,0,0,1-13.86-24C373.05,327.09,384,299.51,384,256c0-44.17-10.93-71.56-29.82-103.94a16,16,0,0,1,27.64-16.12C402.92,172.11,416,204.81,416,256c0,50.43-13.06,83.29-34.13,120A16,16,0,0,1,368,384Z",
                "M416,432a16,16,0,0,1-13.39-24.74C429.85,365.47,448,323.76,448,256c0-66.5-18.18-108.62-45.49-151.39a16,16,0,1,1,27-17.22C459.81,134.89,480,181.74,480,256c0,64.75-14.66,113.63-50.6,168.74A16,16,0,0,1,416,432Z"
            ])
        }

        let checkFullScreenMode = false;
        let videoIsFocus = false;
        let isHidden = false;

        // CONTAINER 
        this.container = document.getElementById("video-container");
        this.isSerial = ((Boolean)(this.container.dataset.isSerial))

        //creating video
        this.video = document.createElement("video");
        this.video.setAttribute("id", "video")
        this.video.setAttribute("src", this.container.dataset.src);
        this.container.append(this.video);

        if (getMobileOperatingSystem() == 'iOS') {
            this.controlsContainer.classList.add("visually-hiiden");
            return;
        }

        //creating controls container
        this.controlsContainer = document.createElement("div");
        this.controlsContainer.setAttribute("id", "controls-container")
        this.container.append(this.controlsContainer)

        // if content is serial
        if (this.isSerial) {
            this.episode = JSON.parse(this.container.dataset.thisEpisode)

            //skip opening
            if (this.episode.start_opening) {
                this.isSkiped = true;
                this.openingBtns = document.createElement("div");
                this.openingBtns.classList.add("opening-btns");
                this.openingBtns.classList.add("hidden");
                this.controlsContainer.append(this.openingBtns);


                let btnHide = document.createElement("button");
                btnHide.classList.add("btn");
                btnHide.classList.add("btn-dark");
                btnHide.classList.add("btn-sm");
                btnHide.textContent = "Смотреть заставку";
                btnHide.addEventListener("click", function () {
                    this.openingBtns.classList.add("hidden")
                    this.isSkiped = false;
                    document.cookie = "isSkiped=false";
                }.bind(this))
                this.openingBtns.append(btnHide)

                this.btnSkipContainer = document.createElement("div");
                this.btnSkipContainer.classList.add("animation-container");
                this.btnSkipContainer.classList.add("ms-3");

                this.openingBtns.append(this.btnSkipContainer);


                this.btnSkip = document.createElement("button");
                this.btnSkip.classList.add("btn");
                this.btnSkip.classList.add("btn-dark");
                this.btnSkip.classList.add("btn-sm");
                this.btnSkip.classList.add("btn-ani");
                this.btnSkip.textContent = "Пропустить заставку";
                this.btnSkip.addEventListener("click", function () {
                    this.openingBtns.classList.add("hidden")
                    this.video.currentTime = this.episode.end_opening;
                    document.cookie = "isSkiped=true";
                }.bind(this))
                this.btnSkipContainer.append(this.btnSkip)


                this.btnSkipFill = document.createElement("div");
                this.btnSkipFill.classList.add("animation-fill");
                this.btnSkipContainer.append(this.btnSkipFill);
            }

            if (this.episode.start_finish && this.container.dataset.nextEpisode) {
                // alert(123)
                this.nextEpisodeBtn = document.createElement("button");
                this.nextEpisodeBtn.classList.add("btn")
                this.nextEpisodeBtn.classList.add("next-episode")
                this.nextEpisodeBtn.classList.add("btn-dark")
                this.nextEpisodeBtn.classList.add("btn-sm")
                this.nextEpisodeBtn.classList.add("hidden")
                this.nextEpisodeBtn.textContent = "Следующая серия";
                this.nextEpisodeBtn.addEventListener("click", function () {
                    window.location.search = `?season=${JSON.parse(this.container.dataset.nextEpisode).seasonNumber}&episode=${JSON.parse(this.container.dataset.nextEpisode).number}`
                }.bind(this))
                this.controlsContainer.append(this.nextEpisodeBtn)
            }

            // json list seasons
            this.jsonSeasons = JSON.parse(this.container.dataset.seasons)
            //modal
            this.serialModal = document.createElement("div");
            this.serialModal.classList.add("serial-modal");
            this.controlsContainer.append(this.serialModal);

            //current season and episode
            let thisEpisode = document.createElement("div");
            thisEpisode.classList.add("this-episode");
            thisEpisode.classList.add("video-modal-btn");
            thisEpisode.textContent = `${JSON.parse(this.container.dataset.thisSeason).number} Сезон ${this.episode.number} Серия`;
            this.serialModal.append(thisEpisode)

            // seasons list
            let seasonsList = document.createElement("div");
            seasonsList.classList.add("video-modal-list");
            seasonsList.classList.add("seasons-list");
            this.serialModal.append(seasonsList);

            this.jsonSeasons.forEach(season => {
                //season item
                let seasonsItem = document.createElement("div");
                seasonsItem.classList.add("seasons-item");
                seasonsList.append(seasonsItem)

                let videoModalItem = document.createElement("div");
                videoModalItem.classList.add("video-modal-item");
                videoModalItem.classList.add("video-modal-btn");
                videoModalItem.textContent = `${season.number} Сезон`
                seasonsItem.append(videoModalItem)

                let episodesList = document.createElement("div");
                episodesList.classList.add("video-modal-list")
                episodesList.classList.add("episodes-list")
                seasonsItem.append(episodesList);

                season.episodes.forEach(episode => {
                    // let link = document.createElement("a");
                    // link.addEventListener("click")
                    // episodesList.append(link)

                    let videoModalItem = document.createElement("div");
                    videoModalItem.classList.add("video-modal-item");
                    videoModalItem.classList.add("video-modal-btn");
                    videoModalItem.textContent = `${episode.number} Серия`
                    videoModalItem.addEventListener("click", function () {
                        window.location.search = `?episode=${episode.number}&season=${season.number}`
                    })
                    // link.append(videoModalItem)
                    episodesList.append(videoModalItem)
                })
            });
        }

        //creating controls shadows 
        this.controlsShadow = document.createElement("div")
        this.controlsShadow.setAttribute("id", "controls-shadow")
        this.controlsContainer.append(this.controlsShadow)

        //MODAL SETTINGS
        this.modalSettings = document.createElement("div");
        this.modalSettings.setAttribute("id", "modal-settings");
        this.controlsContainer.append(this.modalSettings);

        //CONTROLS
        this.controls = document.createElement("div");
        this.controls.setAttribute("id", "controls");
        this.controlsContainer.append(this.controls);

        // CONTROLS TOP ELEMENTS 
        this.controlsTop = document.createElement("div");
        this.controlsTop.classList.add("controls-top");
        this.controls.append(this.controlsTop);

        // PROGRESS BAR
        this.progressBar = document.createElement("div");
        this.progressBar.setAttribute("id", "progress-bar");
        this.controlsTop.append(this.progressBar);

        // CURRENT PROGRESS
        this.currentProgress = document.createElement("div");
        this.currentProgress.setAttribute("id", "current-progress");
        this.progressBar.append(this.currentProgress);

        // CASH PROGRESS
        this.cashProgress = document.createElement("div");
        this.cashProgress.setAttribute("id", "cash-progress");
        this.progressBar.append(this.cashProgress)

        // COTNROLS BOTTOM 
        this.controlBottom = document.createElement("div");
        this.controlBottom.classList.add("controls-bottom");
        this.controls.append(this.controlBottom);

        // LEFT CONTROLS BUTTONS 
        this.leftControlsBnts = document.createElement("div");
        this.leftControlsBnts.classList.add("left-controls-btns");
        this.leftControlsBnts.classList.add("control-btns-section");
        this.controlBottom.append(this.leftControlsBnts);

        // RIGHT CONTROLS BUTTONS 
        this.rightControlsBtns = document.createElement("div");
        this.rightControlsBtns.classList.add("right-contols-btns");
        this.rightControlsBtns.classList.add("control-btns-section");
        this.controlBottom.append(this.rightControlsBtns);

        this.playingBtn = new button('playing', this.leftControlsBnts, this.svg.play);
        this.volumeBtn = new button("volume-btn", this.leftControlsBnts, this.svg.fullVolume)

        this.volumeRange = document.createElement("input");
        this.volumeRange.setAttribute("type", "range");
        this.volumeRange.setAttribute("id", "volume-range");
        this.volumeRange.setAttribute("min", "0");
        this.volumeRange.setAttribute("max", "1");
        this.volumeRange.setAttribute("step", ".01");
        this.volumeBtn.append(this.volumeRange);

        this.timer = document.createElement("div");
        this.timer.style.marginLeft = "20px";
        this.currentTime = document.createElement("span");
        this.currentTime.setAttribute("id", "current-time");
        this.duration = document.createElement("span");
        this.duration.setAttribute("id", "duration");
        this.timer.append(this.currentTime);
        this.timer.append(' / ');
        this.timer.append(this.duration);
        this.duration.innerHTML = "23:45"
        this.currentTime.innerHTML = "00:45"

        this.leftControlsBnts.append(this.timer)
        this.settingsBtn = new button("setting-btn", this.rightControlsBtns, this.svg.setting);
        this.openFullScreen = new button("screen-mode", this.rightControlsBtns, this.svg.openFullScreen);


        this.video.addEventListener("play", toggleSvg.bind(null, this.svg.pause, this.playingBtn.btn))
        this.video.addEventListener("pause", toggleSvg.bind(null, this.svg.play, this.playingBtn.btn))

        this.playingBtn.btn.addEventListener("click", togglePlayback.bind(null, this.video))
        this.volumeBtn.btn.addEventListener("click", toggleVolume.bind(null, this))

        this.video.addEventListener("canplay", function () {
            this.duration.innerHTML = formatTime(this.video.duration, (this.video.duration > 3600) ? true : false);
            this.currentTime.innerHTML = formatTime(0);
        }.bind(this))

        // this.video.addEventListener("progress", function () {
        //     var buffered = Math.floor(this.video.buffered.end(0)) / Math.floor(this.video.duration);
        //     this.cashProgress.style.width = Math.floor(buffered * this.progressBar.width()) + "px";
        // }.bind(this), false);

        this.video.addEventListener("timeupdate", function () {
            let progress = Math.floor(this.video.currentTime) / Math.floor(this.video.duration);
            this.currentProgress.style.width = Math.floor(progress * this.progressBar.offsetWidth) + "px";
            this.currentTime.innerHTML = formatTime(this.video.currentTime, (this.video.currentTime > 3600) ? true : false);
            if (this.isSerial && this.episode.start_opening) {
                if (this.isSkiped
                    && this.video.currentTime > this.episode.start_opening
                    && this.video.currentTime < this.episode.end_opening) {
                    this.openingBtns.classList.remove("hidden")
                    this.isSkiped = false;
                    // console.log(123)

                    let userIsSkiped = getCookie('isSkiped');
                    if (userIsSkiped == 'true') {
                        this.btnSkipFill.animate({
                            width: '100%'
                        }, {
                            duration: 3000,
                            iterations: 1,
                        }).finished.then(() => {
                            if (getCookie('isSkiped') == 'true') {
                                this.isSkiped = true;
                                this.openingBtns.classList.add("hidden");
                                this.video.currentTime = this.episode.end_opening;
                            }
                        })
                        console.log(this.btnSkip)
                    }

                } else if (!this.isSkiped && (this.video.currentTime < this.episode.start_opening || this.video.currentTime > this.episode.end_opening)) {
                    this.openingBtns.classList.add("hidden");
                    this.isSkiped = true;
                }
                if (this.container.dataset.nextEpisode
                    && this.episode.start_finish
                    && this.video.currentTime > this.episode.start_finish) {
                    this.nextEpisodeBtn.classList.remove("hidden");
                } else {
                    this.nextEpisodeBtn.classList.add("hidden");
                }
            }
        }.bind(this), false)

        this.progressBar.addEventListener("click", function (e) {
            var x = (e.pageX - ((this.controls.offsetLeft - this.controls.offsetWidth / 2) + this.container.offsetLeft)) / this.progressBar.offsetWidth;
            this.video.currentTime = x * this.video.duration;
        }.bind(this))

        // this.progressBar.addEventListener("mousedown", function (e) {
        //     var x = (e.pageX - ((this.controls.offsetLeft - this.controls.offsetWidth / 2) + this.container.offsetLeft)) / this.progressBar.offsetWidth;
        //     this.video.currentTime = x * this.video.duration;
        // }.bind(this))

        this.volumeRange.addEventListener("change", function () {
            this.video.volume = this.volumeRange.value

            if (this.video.muted) this.video.muted = !this.video.muted

            if (this.volumeRange.value > .6) {
                toggleSvg(this.svg.fullVolume, this.volumeBtn.btn)
            } else if (this.volumeRange.value < .6 && this.volumeRange.value > .01) {
                toggleSvg(this.svg.halfMute, this.volumeBtn.btn)
            } else {
                toggleSvg(this.svg.mute, this.volumeBtn.btn)
            }
        }.bind(this))

        this.openFullScreen.btn.addEventListener("click", function () {
            toggleScreenmode(this);
        }.bind(this));

        document.addEventListener('fullscreenchange', function () {
            if (checkFullScreenMode) {
                toggleSvg(this.svg.openFullScreen, this.openFullScreen.btn);
            } else {
                toggleSvg(this.svg.exitFullScreen, this.openFullScreen.btn);
            }
            checkFullScreenMode = !checkFullScreenMode;
        }.bind(this));

        this.controlsContainer.addEventListener("click", function (e) {
            this.btnHide
            showControls(this);
            if (e.composedPath().includes(this.controls)
                || e.composedPath().includes(this.serialModal)
                || e.composedPath().includes(this.openingBtns)) return;
            togglePlayback(this.video);
        }.bind(this))

        this.controlsContainer.addEventListener("dblclick", function (e) {
            if (e.composedPath().includes(this.controls)
                || e.composedPath().includes(this.serialModal)) return;
            toggleScreenmode(this);
        }.bind(this))


        // затухание управления при наведение!
        var no_active_delay = 3;
        var now_no_active = 0;

        setInterval(() => {
            now_no_active++;
        }, 1000);
        setInterval(updateTick.bind(null, this), 1000);

        this.container.addEventListener("mousemove", (e) => {
            if (isHidden) showControls(this);
        })

        function updateTick(all) {
            if (!isHidden && now_no_active >= no_active_delay) {
                hideControls(all);
            }
        }



        document.addEventListener("click", function (e) {
            e.composedPath().includes(this.container) ? videoIsFocus = true : videoIsFocus = false;
            // console.log()
        }.bind(this))

        document.addEventListener("keydown", function (e) {
            if (!videoIsFocus) return;

            e.preventDefault();
            if (e.keyCode == 32) togglePlayback(this.video)
            if (e.keyCode == 70) toggleScreenmode(this)
            if (e.keyCode == 39) this.video.currentTime += 5;
            if (e.keyCode == 37) this.video.currentTime -= 5;
            if (e.keyCode == 77) toggleVolume(this);
            if (e.keyCode == 40) {
                if (this.video.volume - 0.2 <= 0) {
                    this.volumeRange.value = 0
                    this.video.volume = 0
                } else {
                    this.volumeRange.value -= 0.2
                    this.video.volume -= 0.2
                }
            };
            if (e.keyCode == 38) {
                if (this.video.volume + 0.1 >= 1) {
                    this.volumeRange.value = 1
                    this.video.volume = 1
                } else {
                    this.volumeRange.value += 0.1
                    this.video.volume += 0.1
                }
            };
        }.bind(this))

        function showControls(all) {
            if (all.isSerial) all.serialModal.classList.remove("hidden");
            all.controls.classList.remove("hidden");
            now_no_active = 0;
            all.container.style.cursor = "default";
            all.controlsShadow.classList.remove("hidden")
            isHidden = false;
        }

        function hideControls(all) {
            if (all.isSerial) all.serialModal.classList.add("hidden");
            all.controls.classList.add("hidden");
            all.container.style.cursor = "none";
            all.controlsShadow.classList.add("hidden")
            isHidden = true;
        }

        function toggleSvg(newSvg, element) {
            element.innerHTML = '';
            element.append(newSvg.svg);
        }

        function togglePlayback(video) {
            video.paused ? video.play() : video.pause();
        }

        function toggleScreenmode(all) {
            if (checkFullScreenMode) {
                if (document.fullscreenElement) {
                    document.exitFullscreen()
                        .then(() => {
                            // window.scrollTo(0, all.container.offsetTop - all.container.offsetHeight / 3)
                            // console.log("Document Exited from Full screen mode")
                        })
                        .catch((err) => console.error(err))
                } else {
                    document.documentElement.requestFullscreen();
                }
            } else {
                if (all.container.requestFullscreen) {
                    all.container.requestFullscreen();
                } else if (elem.webkitRequestFullscreen) { /* Safari */
                    all.container.webkitRequestFullscreen();
                } else if (elem.msRequestFullscreen) { /* IE11 */
                    all.container.msRequestFullscreen();
                }
            }
        }

        function changeVolume(all) {
            all.video.volume = all.volumeRange.value

            if (all.video.muted) all.video.muted = !all.video.muted

            if (all.volumeRange.value > .6) {
                toggleSvg(all.svg.fullVolume, all.volumeBtn.btn)
            } else if (all.volumeRange.value < .6 && all.volumeRange.value > .01) {
                toggleSvg(all.svg.halfMute, all.volumeBtn.btn)
            } else {
                toggleSvg(all.svg.mute, all.volumeBtn.btn)
            }
        }

        function toggleVolume(all) {
            if (all.video.muted) {
                toggleSvg(all.svg.fullVolume, all.volumeBtn.btn);
                all.volumeRange.value = all.video.volume;
            } else {
                toggleSvg(all.svg.mute, all.volumeBtn.btn);
                all.volumeRange.value = 0;
            }
            all.video.muted = !all.video.muted;
        }
        this.video.setAttribute("muted", "true");
        // togglePlayback(this.video);
    }
}



class button {
    constructor(id, parent, svg) {
        this.controlItem = document.createElement("div");
        this.controlItem.classList.add("control-item");
        this.controlItem.setAttribute("id", id);
        parent.append(this.controlItem);

        this.btn = document.createElement("button");
        this.btn.classList.add("control-btn");
        this.controlItem.append(this.btn);

        this.btn.append(svg.svg);
    }

    append(element) {
        this.controlItem.append(element);
    }

}

class svg {
    constructor(viewBox, paths = []) {
        this.svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
        this.svg.setAttribute("height", "100%");
        this.svg.setAttribute("width", "100%");
        this.svg.setAttribute("viewBox", viewBox);
        this.svg.setAttribute("fill", "#fff");

        paths.forEach(element => {
            let svgPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
            svgPath.setAttribute("d", element);
            this.svg.append(svgPath);
        });

    }
}


function formatTime(time, hours) {
    if (hours) {
        var h = Math.floor(time / 3600);
        time = time - h * 3600;

        var m = Math.floor(time / 60);
        var s = Math.floor(time % 60);

        return h.lead0(2) + ":" + m.lead0(2) + ":" + s.lead0(2);
    } else {
        var m = Math.floor(time / 60);
        var s = Math.floor(time % 60);

        return m.lead0(2) + ":" + s.lead0(2);
    }
}

Number.prototype.lead0 = function (n) {
    var nz = "" + this;
    while (nz.length < n) {
        nz = "0" + nz;
    }
    return nz;
};

function getParameter(name) {
    if (name = (new RegExp('[?&]' + encodeURIComponent(name) + '=([^&]*)')).exec(location.search))
        return decodeURIComponent(name[1]);
}

function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function getMobileOperatingSystem() {
    var userAgent = navigator.userAgent || navigator.vendor || window.opera;

    // Windows Phone must come first because its UA also contains "Android"
    if (/windows phone/i.test(userAgent)) {
        return "Windows Phone";
    }

    if (/android/i.test(userAgent)) {
        return "Android";
    }

    // iOS detection from: http://stackoverflow.com/a/9039885/177710
    if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
        return "iOS";
    }

    return "unknown";
}