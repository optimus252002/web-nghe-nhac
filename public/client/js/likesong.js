const content = document.querySelector(".footer-content");

Object.keys(localStorage).forEach((element, index) => {
    const object = JSON.parse(localStorage.getItem(element));
    start(object, index);

});

function start(data, index) {


    content.innerHTML += `
    <div class="like_song" data-index=${index} style="width:100%;height:60px;background: ;display: flex;margin:0 40px 0 0x;">
        <label style="margin:15px 0 0 10px">${index+1}</label> 
        <div style="height: 50px;width: 60px;object-fit:cover;padding-top:10px">
            <img src="${data.imageSong}" style="height: 100%;width: 100%;padding-left:20px" alt="">
        </div>
        <div style="padding: 8px 0 0 15px;display:flex">
        <div style="display:block;" >
            <p style="color: #fff;text-transform:uppercase">${data.nameSong}</p>
            <p style="color: #fff;">${data.nameSinger}</p>
        </div>
        <div>
        <p style="color: #fff;padding-left:100px;display: block;text-transform:uppercase">${data.category}</p>
        </div>
        </div>
       
        <h1 class="play"></h1>
        <audio class="song">
        <source src="${data.pathSong}" />
        </audio>
        <p class="remove">clear</p>
   </div>
     `;
    document.querySelector(".remove").addEventListener("click", function(e) {
            localStorage.clear()
        })
        // document.querySelector(".remove").addEventListener("click", function(e) {
        //     const playing = e.target.closest(".like_song");
        //     const s = playing.dataset.index;
        //     console.log(s);
        // });
}

// function handleEvents() {
//     document.querySelector('.play').addEventListener('click', function() {
//         const play = document.querySelector('.song')
//         console.log(play)
//         play.play();
//     });
// }