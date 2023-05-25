const music = "http://127.0.0.1:8000/api/song";

function start() {
    getApi((data) => {
        const arrayData = data;
        searchPlaylist.start(arrayData);
    });
}
start();

function getApi(data) {
    fetch(music)
        .then((response) => response.json())
        .then(data)
        .catch((error) => console.error(error));
}

const searchPlaylist = {
    defineProperties: function(arraySong) {
        Object.defineProperty(this, "currentSong", {
            get: function() {
                return arraySong['categorySongnew'][this.currentIndex];
            },
        });
    },

    search: function(arraySong) {

        const search = document.querySelector(".searchPlaylist");
        search.oninput = function() {
            const searchInput = search.value;
            let searchPlaylist = arraySong['categorySongnew'].filter((values) => {
                return values.name_song.toUpperCase().includes(searchInput.toUpperCase());
            });
            const listSearchSong = searchPlaylist.map((data, index) => {
                return `
                <div class="like_song" data-index=${index} style="width:100%;height:60px;background: ;display: flex;margin:0 40px 0 0x;">
                <label style="margin:15px 0 0 10px">${index+1}</label> 
                <div style="height: 50px;width: 60px;object-fit:cover;padding-top:10px">
                    <img src="${data.image_song}" style="height: 100%;width: 100%;padding-left:20px" alt="">
                </div>
                <div style="padding: 8px 0 0 15px;display:flex">
                <div style="display:block;" >
                    <p style="color: #fff;text-transform:uppercase">${data.name_song}</p>
                    <p style="color: #fff;">${data.name_singer}</p>
                </div>
                <div>
                <p style="color: #fff;padding-left:100px;display: block;text-transform:uppercase">${data.name_category}</p>
                </div>
                </div>
               
                <h1 class="play"></h1>
                <audio class="song">
                <source src="${data.pathSong}" />
                </audio>
                <p class="add-song">add</p>
           </div>`;
            })
            const song = document.querySelector(".playlist-song");
            song.onclick = function(e) {
                const playing = e.target.closest(".like_song");
                const currentIndex = Number(playing.dataset.index);
                console.log(this.loadCurrentSong());
                // this.loadCurrentSong();
            };
            const songNew = document.querySelector(".playlist-song");
            songNew.innerHTML = listSearchSong.join('')
            const addSong = document.querySelector(".add-song");
            var click = 0
            addSong.onclick = function(e) {
                var formData = {
                    nameSong: this.currentSong.name_song,
                    nameSinger: this.currentSong.name_singer,
                    pathSong: this.currentSong.path,
                    imageSong: data.image_song,
                    imageSinger: this.currentSong.image_singer,
                    category: this.currentSong.name_category,
                }
                click += 1
                this.likeSong(formData, click)
            }
        }
    },
    loadCurrentSong: function() {
        const imageSong = document.querySelector(".imageSong");
        const musicName = document.querySelector(".music-name");
        const nameSinger = document.querySelector(".singer-name");
        musicName.textContent = this.currentSong.name_song;
        nameSinger.textContent = this.currentSong.name_singer;
        imageSong.src = this.currentSong.image_song;
    },
    likeSongs: function(data, key) {
        try {
            localStorage.setItem('playlist' + key, JSON.stringify(data));
            console.log("Success:", data);
        } catch (error) {
            console.error("Error:", error);
        }

    },
    start: function(array) {
        this.search(array);
        this.search(array);
    },
};