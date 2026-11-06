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
})