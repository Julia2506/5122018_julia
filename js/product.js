let btn = document.querySelector('.add-to-basket');

btn.addEventListener('click', function(){
    let productId = this.getAttribute('data-product-id');

    //console.log(productId);

    let xhr = new XMLHttpRequest();
    xhr.open('GET', `/handlers/basket_handler.php?product_id=${productId}`);
    xhr.send();

    xhr.addEventListener('load', ()=>{
        basket.load();
    });
});