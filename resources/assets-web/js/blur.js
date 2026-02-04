function blur() {

    const numeros = document.querySelectorAll('.blur')

    numeros.forEach((numero)=>{
        numero.addEventListener('click',() => {
            numero.classList.toggle('active')
        })
    });

}

blur()