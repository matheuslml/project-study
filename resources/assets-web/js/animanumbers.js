function initAnimaNumeros(){

    const numeros = document.querySelectorAll('[data-numero]')
    

    numeros.forEach((numero) => {
        const total = +numero.innerText;
        inc = Math.floor(100 / total)
        let start = 0;
        const time = setInterval(() => {
            start = start + inc;
            numero.innerText = start
            if(start > total){
                numero.innerText = total;
                clearInterval(time);
            }
        },10)
    })
}

initAnimaNumeros()