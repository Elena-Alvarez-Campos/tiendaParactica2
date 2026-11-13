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
botones.forEach(button => {
    button.addEventListener('click',()=>{
    n++
    button.childNodes[1].textContent++
    console.log(button.id)
    let pedido={
        nombre: button.id,
        stock: 8-button.childNodes[1] 
    }
    try {
        fetch('php/actualiza_producto.php',{
            method: 'POST',
            body: JSON.stringify(pedido)
        })
        console.log('conexión con php exitosa')
    } catch (error) {
        console.log(error)
    }
})


})