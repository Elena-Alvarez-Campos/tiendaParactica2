
let rechazar = document.getElementsByName('rechazar')
rechazar.forEach(rechazado=>{
    
    rechazado.addEventListener('click',()=>{

        console.log("comprar contenido");
        console.log(rechazado.parentElement.querySelector('p').textContent)
    let confirmación = confirm("¿Quieres eliminar el pedido?")
    if(confirmación==true){
        try {
        fetch('php/rechazar.php',{
            method: 'POST',
            body: rechazado.parentElement.querySelector('p').textContent
        })
        console.log('conexión con php exitosa')
        } catch (error) {
            console.log(error)
        }
    }
})
})



////////
let aceptar = document.getElementsByName('aceptar')
console.log(aceptar)
aceptar.forEach(aceptado=>{
    
    aceptado.addEventListener('click',()=>{

        console.log("comprar contenido");
        console.log(aceptado.parentElement.querySelector('p').textContent)
    let confirmación = confirm("¿Quieres confirmar el pedido?")
    if(confirmación==true){
        try {
        fetch('php/aceptar.php',{
            method: 'POST',
            body: aceptado.parentElement.querySelector('p').textContent
        })
        console.log('conexión con php exitosa')
        } catch (error) {
            console.log(error)
        }
    }
})
})