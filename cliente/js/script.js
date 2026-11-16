/*
import * as bootstrap from 'bootstrap'
let boton= document.getElementById('b')
boton.addEventListener('click',() =>{
    const guardaPedido={
            producto:'zapato',
            cantidad:4,
            estado:false
        }
    
    console.log('pulsado')
    try {
        
    fetch('conector.php',{
        method: 'POST',
        body: JSON.stringify(guardaPedido)
    })
    console.log('conexión con php exitosa')
    } catch (error) {
        console.log(error)
    }
})*/
let n=0
let botones = document.querySelectorAll('button');
let compra={}
console.log(compra)
botones.forEach(button => {
    button.addEventListener('click',()=>{
        if (button.id=='carrito') {
            window.location.href='cesta.php'
        }else{
            //se refiere a la notificación roja
            let total=button.nextSibling.nextSibling.childNodes[1].textContent.trim()
        button.childNodes[1].textContent++
        let producto=button.id;
        if (compra[producto]==undefined) {
                //nombre producto y su cantidad
                compra[producto]=0
            }
            compra[producto]++
        let pedido={
            nombre: button.id,//nombre del artículo
            carrito: compra
        }
    
        if(parseInt(button.childNodes[1].textContent)==parseInt(total)){
        
            button.setAttribute('disabled','disabled')

        }
        
        try {
            fetch('/cliente/php/actualiza_producto.php',{
                method: 'POST',
                body: JSON.stringify(pedido)
            })
            console.log('conexión con php exitosa')
            
        } catch (error) {
            console.log(error)
        }
        }
        

    })


})
