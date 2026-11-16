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
let vaciar = document.getElementById('vaciar')
vaciar.addEventListener('click',()=>{
    console.log("Vaciar cestas");
    let confirmación = confirm("¿Quieres vaciar la cesta?\nToods los artículos regresarán a su origen.")
    if(confirmación==true){
        try {
        fetch('php/vacia_cesta.php',{
            method: 'POST'
        })
        console.log('conexión con php exitosa')
        } catch (error) {
            console.log(error)
        }
    }
})
let comprar = document.getElementById('comprar')
comprar.addEventListener('click',()=>{
    console.log("comprar contenido");
    let confirmación = confirm("¿Quieres tramitar el pedido?")
    if(confirmación==true){
        try {
        fetch('php/tramite_pedido.php',{
            method: 'POST'
        })
        console.log('conexión con php exitosa')
        } catch (error) {
            console.log(error)
        }
    }
})