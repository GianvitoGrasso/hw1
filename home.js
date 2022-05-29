function onJson(json) {
    console.log(json)
    for (i = 0; i < 10; i++) {
        console.log(json.player[i].strPlayer);
        if (json.player[i].strThumb == null) {

        } else {
                const sect = document.querySelector('section div');
                const par = document.querySelector('section p ');
                par.innerHTML="Ecco la tua Ricerca: ";
                sect.classList.remove('flex-containersection');
                sect.classList.add('flex');
                const div = document.createElement('div');
                div.classList.add('first');
                const immagine = document.createElement('img');
                const paragrafo = document.createElement('p');
                const button = document.createElement('button');
                immagine.src = json.player[i].strThumb;
                var img = immagine;
                paragrafo.textContent = json.player[i].strPlayer;
                button.innerHTML="Mi piace";
                button.addEventListener('click',mipiace);
                sect.appendChild(div);
                div.appendChild(immagine);
                div.appendChild(paragrafo);
                div.appendChild(button);
                }                
    }
}

function onJsonLike(json) {
    console.log(json)
}
function onResponseLike(response) {
    console.log(response);
    return response.json();
}
function mipiace(event) {
    event.preventDefault();
    const butt = event.currentTarget;
    if(butt.classList.contains('like'))
    {
        butt.classList.remove('like');
        blocco = event.currentTarget.parentNode;
        const image = blocco.querySelector('img').src;
        const par = blocco.querySelector('p').textContent;
        const form_data = new FormData;
        form_data.append("image", image);
        form_data.append("par", par);
        fetch("unlike.php", { method: "post", body: form_data}).then(onResponseLike).then(onJsonLike);
    } else {
        butt.classList.add('like');
        blocco = event.currentTarget.parentNode;
        const image = blocco.querySelector('img').src;
        const imageok = encodeURIComponent(image);
        const par = blocco.querySelector('p').textContent;
        const parok = encodeURIComponent(par);
        const form_data = new FormData;
        form_data.append("image", imageok);
        form_data.append("par", parok);
        fetch("like.php", { method: "post", body: form_data}).then(onResponseLike).then(onJsonLike);
    }
}
function onResponseCerca(response) {
    console.log(response);
    return response.json();
}
function cerca (event) {
    event.preventDefault();
    const form_data = {method: 'post', body: new FormData(form)};
    fetch("http://localhost:8080/dashboard/hw1/curl_thesportsdb.php", form_data).then(onResponseCerca).then(onJson);
    const sect = document.querySelectorAll('section div div');
    for (const ck of sect)
    {
        ck.innerHTML="";
    }
}

function onJsonPref(json) {
    console.log(json);
        for (i = 0; i < 10; i++) 
        {
                const sect = document.querySelector('section div');
                sect.classList.remove('flex-containersection');
                sect.classList.add('flex')
                const div = document.createElement('div');
                div.classList.add('first');
                const immagine = document.createElement('img'); 
                const paragrafo = document.createElement('p');
                immagine.src = decodeURIComponent(json[i].img);
                paragrafo.textContent = decodeURIComponent(json[i].title);
                sect.appendChild(div);
                div.appendChild(immagine);
                div.appendChild(paragrafo);
        }
}
function onResponsePref(response) {
    return response.json();
}

function preferiti () {
    fetch("http://localhost:8080/dashboard/hw1/preferiti.php").then(onResponsePref).then(onJsonPref);
}

preferiti();

function elimina(event) {
    event.preventDefault();
    fetch('elimina.php')
    const sect = document.querySelectorAll('section div div');
    for (const ck of sect)
    {
        ck.innerHTML="";
    }
}

const form = document.querySelector('form');
form.addEventListener('submit', cerca);

const butt = document.querySelector('.flex-button');
butt.addEventListener('click', elimina);
