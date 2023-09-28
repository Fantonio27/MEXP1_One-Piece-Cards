import dataset from "./dataset.characters.js";
const { characters } = dataset;

let pageno = [0, 10];

const container = document.querySelector('.container');
const cardContainer = document.getElementById('card-container');
const category = document.getElementById('cat').textContent;
const id = document.getElementById('char').textContent;
const pagenum = document.getElementById('page').textContent;
const tabs = document.querySelectorAll('#tab');
const paginationtab = document.querySelector('.pagination');
const next = document.getElementById('next');
const prev = document.getElementById('prevous');
const modalContainer = document.querySelector('.modal-container')
const modal = document.querySelector('#modal')
const modalBox = document.querySelector('.modal-box')
const modalsChild = document.querySelectorAll('.mode')

activetab() //Function

//Buttons
next.addEventListener("click", () => { pagination(1) });
prev.addEventListener("click", () => { pagination(2) });

function activetab(no) {
    if (id != 0) {
        opentab(id)
    }
    
    let title;
    for (let i = 0; i < 4; i++) {
        if (tabs[i].textContent[0] === category) {
            tabs[i].className = "active";
            title = tabs[i].textContent;
        }
    }
    document.title += " - " + title;
    fillCards(title);
}

function fillCards(category) { //page
    
    const cat = category == "All";
    const data = cat ? 
        characters
        .slice(pageno[0] + (pagenum * 10 - 10), pageno[1] * pagenum) 
        .map(value => ({ value, sort: Math.random() }))
        .sort((a, b) => a.sort - b.sort)
        .map(({ value }) => value)
        : 
        characters
        .filter(cat => cat.type === category)
        .map(value => ({ value, sort: Math.random() }))
        .sort((a, b) => a.sort - b.sort)
        .map(({ value }) => value)
        
    cardContainer.innerHTML = ''
    data.map((char, index) => {
        setTimeout(() => {

            paginationtab.style.display = !cat && "none";
            const { id, name, short } = char
            const card = document.createElement('div')

            card.innerHTML =
                `   <a href="index.php?category=${category[0]}&id=${id}&pageno=${pagenum}">
                <div class="card">
                    <div class="card-inner">
                            <div class="front-card"></div>
                            <div class="back-card">
                                <div></div>
                                <p>${short}</p>
                            </div>
                        </div>
                    </div>
                    <div class="title">
                        <p>${name}</p>
                    </div>
                    </a>
                `;
            cardContainer.appendChild(card);
            const frontCard = document.querySelectorAll('.front-card');
            frontCard[index].style.backgroundImage = `url('./images/Characters/${id}.jpg')`;
        }, 1000 * index) 
        

    })
}

function pagination(action) {
    if(action == 1 && pagenum != 3){
        location.replace(`index.php?category=${category[0]}&pageno=${Number(pagenum) + 1}`)
    }else if(action == 2 && pagenum != 1){
        location.replace(`index.php?category=${category[0]}&pageno=${Number(pagenum) - 1}`)
    }
}

function opentab(charid) {
    modal.className = "modal";
    modalContainer.style.zIndex = 1;
    modalBox.style.opacity = "1";
    container.style.overflow = "hidden";

    const datachar = characters.filter(e => e.id === charid)
    const { id, name, type, description} = datachar[0]
    modalsChild[0].src = `./images/Characters/${id}.jpg`;
    modalsChild[1].textContent = name;
    modalsChild[2].textContent = type;
    modalsChild[3].textContent = description;
}
