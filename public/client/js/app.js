const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const alterCss = document.querySelector(".footer");
const setVolume = document.querySelector("#set-volume");
const playBtn = document.querySelector(".player-inner");
const randomSong = document.querySelector(".play-infinite");
const nextBtn = document.querySelector(".play-forward");
const prevBtn = document.querySelector(".play-back");
const durationTime = document.querySelector(".duration");
const remainingTime = document.querySelector(".remaining");
const rangeBar = document.querySelector(".range");
const musicName = document.querySelector(".music-name");
const musicThumbnail = document.querySelector(".music-thumb");
const musicImage = document.querySelector(".music-thumb img");
const playRepeat = document.querySelector(".play-repeat");
const songs = document.querySelector(".songs");
const songNew = document.querySelector(".songNew");
const songHot = document.querySelector(".songHot");
const audio = document.querySelector("#audio");
const mainContent = document.querySelector(".main-content");
const playings = document.querySelector(".playing");
const rangeVolume = document.querySelector("#set-volume");
const topicSongs = document.querySelector(".topic-song");
const likeSong = document.querySelector(".my-favorite");

const musicNew = "http://127.0.0.1:8000/api/song";

function start() {
    getApi((data) => {
        const arrayData = data;
        mainApp.start(arrayData);
    });
}
start();

function getApi(data) {
    fetch(musicNew)
        .then((response) => response.json())
        .then(data)
        .catch((error) => console.error(error));
}


const mainApp = {

    indexSong: 0,
    currentIndex: 0,
    isPlaying: true,
    isRepeat: false,

    defineProperties: function(arraySong) {
        Object.defineProperty(this, "currentSong", {
            get: function() {
                return arraySong['categorySongnew'][this.currentIndex];
            },
        });
    },

    renderPlaylist: function(arraySong) {
        const listSongNew = arraySong['categorySongnew'].map((song, index) => {
            return `
                     <div class="col-2 playing" data-index="${index}">
                     <div style="padding:14px;">
                     <img src="${song.image_song}" alt="" style="height:200px;with:250px;object-fit:cover" >
                     <div style="color: #fff;">
                         <h5>${song.name_song}</h5>
                         <p>${song.name_singer}</p>
                     </div>
                     </div>
                     </div>`;
        });
        songNew.innerHTML = listSongNew.join("");
    },

    handleEvents: function(arraySong) {
        const _this = this;

        playBtn.onclick = function() {
            if (_this.isPlaying) {
                audio.pause();
            } else {
                audio.play();
            }
        };
        audio.onplay = function() {
            _this.isPlaying = true;
            playBtn.innerHTML = `<i class="play-icon fa-sharp fa-solid fa-circle-pause  style="font-size: 30px"></i>`;
        };

        // Khi song bị pause
        // When the song is pause
        audio.onpause = function() {
            _this.isPlaying = false;
            playBtn.innerHTML = `<i class="play-icon fa-sharp fa-solid fa-circle-play  style="font-size: 30px"></i>`;
        };
        songNew.onclick = function(e) {
            const playing = e.target.closest(".playing");
            _this.currentIndex = Number(playing.dataset.index);
            _this.loadCurrentSong();
        };
        songHot.onclick = function(e) {
            const playing = e.target.closest(".playing");
            _this.currentIndex = Number(playing.dataset.index);
            _this.loadCurrentSong();
        };
        setVolume.onchange = function(e) {
            // audio.volume = 0
            valueVolume = e.target.value;
            audio.volume = valueVolume;
        };
        rangeBar.onchange = function(e) {
            const seekTime = (audio.duration / 100) * e.target.value;
            audio.currentTime = seekTime;
            console.log(audio);
        };

        nextBtn.onclick = function() {
            _this.nextSong(arraySong);
        };
        prevBtn.onclick = function() {
            _this.prevSong(arraySong);
        };
        var clicks = 0;

        randomSong.onclick = function() {
            clicks += 1;
            if (clicks % 2 !== 0) {
                randomSong.style.color = "red";
                audio.addEventListener("ended", function() {
                    _this.randomSong(arraySong);
                });
            };
            if (clicks % 2 == 0) {
                randomSong.style.color = "white";
                audio.addEventListener("ended", function() {
                    _this.currentIndex = 0;
                });
            }
        }

        var click3 = 0
        likeSong.onclick = function(e) {
            var formData = {
                nameSong: _this.currentSong.name_song,
                nameSinger: _this.currentSong.name_singer,
                pathSong: _this.currentSong.path,
                imageSong: _this.currentSong.image_song,
                imageSinger: _this.currentSong.image_singer,
                category: _this.currentSong.name_category,
            }
            click3 += 1
            _this.likeSong(formData, click3)
        }

        var click1 = 0;
        playRepeat.onclick = function(e) {
            click1 += 1;
            if (click1 % 2 !== 0) {
                playRepeat.style.color = "red";
                audio.addEventListener("ended", function() {
                    _this.currentIndex++;
                    if ((_this.currentIndex = arraySong.length)) {
                        _this.currentIndex = 0;
                    }
                    _this.loadCurrentSong();
                });
            }
            if (click1 % 2 == 0) {
                playRepeat.style.color = "white";
                audio.addEventListener("ended", function() {
                    _this.currentIndex = 0;
                    _this.loadCurrentSong();
                });
            }
        };
    },

    loadCurrentSong: function() {
        const imageSong = document.querySelector(".imageSong");
        const musicName = document.querySelector(".music-name");
        const nameSinger = document.querySelector(".singer-name");
        musicName.textContent = this.currentSong.name_song;
        nameSinger.textContent = this.currentSong.name_singer;
        imageSong.src = this.currentSong.image_song;
        alterCss.style.display = "block";
        audio.src = this.currentSong.path;
        audio.ontimeupdate = function(e) {
            rangeBar.value = (audio.currentTime / audio.duration) * 100;
            const currentMinutes = Math.floor(audio.currentTime / 60);
            const currentSeconds = Math.floor(
                audio.currentTime - currentMinutes * 60
            );
            remainingTime.textContent = `${
                currentMinutes < 10 ? "0" + currentMinutes : currentMinutes
            }:${currentSeconds < 10 ? "0" + currentSeconds : currentSeconds}`;
            if (audio.duration) {
                const durationMinutes = Math.floor(audio.duration / 60);
                const durationSeconds = Math.floor(
                    audio.duration - durationMinutes * 60
                );
                durationTime.textContent = `${
                    durationMinutes < 10
                        ? "0" + durationMinutes
                        : durationMinutes
                }:${
                    durationSeconds < 10
                        ? "0" + durationSeconds
                        : durationSeconds
                }`;
            }
        };
    },

    likeSong: function(data, key) {
        try {
            localStorage.setItem(key, JSON.stringify(data));
            console.log("Success:", data);
        } catch (error) {
            console.error("Error:", error);
        }

    },

    nextSong: function(arraySong) {
        this.currentIndex++;
        if (this.currentIndex >= arraySong.length) {
            this.currentIndex = 0;
        }
        this.loadCurrentSong();
    },
    prevSong: function(arraySong) {
        this.currentIndex--;

        if (this.currentIndex < 0) {
            this.currentIndex = arraySong.length - 1;
        }
        this.loadCurrentSong();
    },
    randomSong: function(arraySong) {
        let newIndex;
        do {
            newIndex = Math.floor(Math.random() * arraySong.length);
        } while (newIndex === this.currentIndex);

        this.currentIndex = newIndex;
        this.loadCurrentSong();
    },

    start: function(array) {
        this.defineProperties(array);
        this.renderPlaylist(array);
        this.handleEvents(array);
    },
};


var click2 = 0;

function moveVolumes() {
    click2 += 1;
    if (click2 % 2 !== 0) {
        rangeVolume.style.display = 'block'
    }
    if (click2 % 2 == 0) {
        rangeVolume.style.display = 'none'
    }
}