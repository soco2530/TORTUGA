var imagenes =['img/img1.jpg', 'img/img2.jpg', 'img/img3.jpg', 'img/img4.jpg'],
cont=0;
function carrousel(contenedor){

    contenedor.addEventListener('click', e => {
        let atras =contenedor.querySelector('.atras'),
        adelante =contenedor.querySelector('.adelante'),
        img =contenedor.querySelector('img'),
        tgt =e.target;


        if(tgt == atras){
            if(cont > 0){
                img.src=imagenes[cont - 1];
                cont--;

            }else {
                img.src=imagenes[imagenes.length - 1];
                cont =imagenes.length- 1;
            }


        }else if(tgt == adelante){
            if(cont < imagenes.length -1){
                img.src=imagenes[cont +1];
                cont++;

            }else {
                img.src=imagenes[0];
                cont =0;
            }


        }

    });

}
document.addEventListener("DomContentLoaded", () => {
    let contenedor = document.querySelector('.contendor');
    carrousel(contendor);
} );