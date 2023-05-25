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
    search: function(arraySong) {
        const search = document.querySelector(".search_bar");
        search.oninput = function() {
            const searchInput = search.value;
            let searchPlaylist = arraySong['categorySongnew'].filter((values) => {
                return values.name_song.toUpperCase().includes(searchInput.toUpperCase());
            });
            const listSearchSong = searchPlaylist.map((song, index) => {
                return `
                     <div class="col-2 playing" style="background-color: #131313;" data-index="${index}">
                     <div style="padding:14px;">
                     <img src="${song.image_song}" alt="" style="height:200px;with:250px;object-fit:cover" >
                     <div style="color: #fff;">
                         <h5>${song.name_song}</h5>
                         <p>${song.name_singer}</p>
                     </div>
                     </div>
                     </div>`;
            })
            const songNew = document.querySelector(".songNew");
            songNew.innerHTML = listSearchSong.join('')
        }
    },
    start: function(array) {
        this.search(array);

    },
};