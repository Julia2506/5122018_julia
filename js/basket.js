let del = document.querySelectorAll('.del');
let basketBox = document.querySelector('.basket-box');

del.forEach((delItem)=>{
    delItem.addEventListener('click', function(){
        console.log('I was clicked');
        let newDel = document.querySelectorAll('.del');
        if(newDel.length == 1) {
            basketBox.remove();    
        } else {
            this.parentElement.remove();
        }
        
        let delEl = this.getAttribute('data-del-id'); 
    
        let xhr = new XMLHttpRequest();
        xhr.open('GET', `/handlers/basket_handler.php?product_del_id=${delEl}`);
        xhr.send();
    
        xhr.addEventListener('load', ()=>{
            basket.load();
            // window.location.replace('/basket.php');
        });
    });
});