let loaders=document.getElementById("carga");
let random1=Math.floor( Math.random() * 14 )+1
let random2=Math.floor( Math.random() * 14)+1
let random3=Math.floor( Math.random() * 14 )+1
console.log(random1,random2,random3)
document.body.style.setProperty('--img1',`url(./img/loaders/img${random1}.jpeg)`)
document.body.style.setProperty('--img2',`url(./img/loaders/img${random2}.jpeg)`)
document.body.style.setProperty('--img3',`url(./img/loaders/img${random3}.jpeg)`)

document.body.style.setProperty('--imgarra1',`url(./img/loaders/arrancadores/img${random1}.jpeg)`)
document.body.style.setProperty('--imgarra2',`url(./img/loaders/arrancadores/img${random2}.jpeg)`)
document.body.style.setProperty('--imgarra3',`url(./img/loaders/arrancadores/img${random3}.jpeg)`)

document.body.style.setProperty('--imgbout1',`url(./img/loaders/boutique/img${random1}.jpeg)`)
document.body.style.setProperty('--imgbout2',`url(./img/loaders/boutique/img${random2}.jpeg)`)
document.body.style.setProperty('--imgbout3',`url(./img/loaders/boutique/img${random3}.jpeg)`)

document.body.style.setProperty('--imgcerra1',`url(./img/loaders/cerrajeria/img${random1}.jpeg)`)
document.body.style.setProperty('--imgcerra2',`url(./img/loaders/cerrajeria/img${random2}.jpeg)`)
document.body.style.setProperty('--imgcerra3',`url(./img/loaders/cerrajeria/img${random3}.jpeg)`)

document.body.style.setProperty('--imggps1',`url(./img/loaders/gps/img${random1}.jpeg)`)
document.body.style.setProperty('--imggps2',`url(./img/loaders/gps/img${random2}.jpeg)`)
document.body.style.setProperty('--imggps3',`url(./img/loaders/gps/img${random3}.jpeg)`)