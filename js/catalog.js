class Product{
    constructor(name, price, photo, id){
        this.name = name; 
        this.price = price;
        this.photo = photo; 
        this.id  = id; 
    }
    show(){
        alert(`${this.name} ${this.price} ${this.photo}`);
    }
    render(parentEl){
        let productItem = document.createElement('a');
        productItem.href = `/product.php?id=${this.id}`;
        productItem.classList.add('catalog-products-item');
        productItem.innerHTML = `
            <img src='${this.photo}'>
            <h2>${this.name}</h2>
            <p>${this.price} руб.</p>
        `;

        parentEl.appendChild(productItem);
    }
}

class Catalog {
    constructor(){
        this.el = document.querySelector('.catalog');
        this.section = this.el.getAttribute('data-section');
        this.products = [];
        this.filters = {
            price:[
                [0, 1000],
                [1000,2000],
                [2000, 3500],
                [3500, 5000],
                [5000, 20000]
            ],
            activePrice: null,
            category:[
                ['outerwear' ,'Верхняя одежда'],
                ['jeans', 'Джинсы'],
                ['shoes', 'Обувь'],
                ['accessories', 'Аксессурары'] 
            ],
            activeCategory: null
        }

        this.renderFilterPrice();
        this.renderFilterCategory();

    }
    renderFilterPrice(){
        let select = document.createElement('select');
        select.name = 'filter-price';
        this.filters.price.forEach((priseArr) => {
            let option = document.createElement('option');
            option.innerHTML = `${priseArr[0]}-${priseArr[1]} руб.`;
            option.value = `${priseArr[0]}-${priseArr[1]}`;
            select.appendChild(option);
        });
        this.el.querySelector('.catalog-filters').appendChild(select);


        let that = this;
        select.addEventListener('change', function(){
            that.filters.activePrice = this.value;
            that.load();
        });
    }

    renderFilterCategory(){
        let selectt = document.createElement('select');
        selectt.name = 'filter-category';
        this.filters.category.forEach((categoryArr, index) => {
            let option = document.createElement('option');
            option.innerHTML = `${categoryArr[1]}`;
            option.value = `${categoryArr[0]}`;
            selectt.appendChild(option);
        });
        this.el.querySelector('.catalog-filters').appendChild(selectt);


        let that = this;
        selectt.addEventListener('change', function(){
            that.filters.activeCategory = this.value;
            // console.log(that.filters.activeCategory);
            that.load();
        });
    }

    render(){
        let catalogProductsBox = this.el.querySelector('.catalog-products');
        catalogProductsBox.innerHTML = '';
        this.products.forEach((product)=>{
            product.render(catalogProductsBox);
        });
    }
    preloadOn(){
        this.el.classList.add('preload');
    }
    preloadOff(){
        this.el.classList.remove('preload');
    }
    paginationRender(paginationConfig){
        let paginationEl = this.el.querySelector('.catalog-pagination');
        paginationEl.innerHTML = '';

        for(let i = 1; i<= paginationConfig.countPage; i++) {
            let paginationItem = document.createElement('div');
            paginationItem.classList.add('catalog-pagination-item');
            paginationItem.innerHTML = i;

            if(i==paginationConfig.nowPage) {
                paginationItem.classList.add('active');
            }

            paginationItem.setAttribute('data-page-id', i);
            let that = this;

            paginationItem.addEventListener('click', function(){
                let pageNum = this.getAttribute('data-page-id');
                that.load(pageNum);
            });
            paginationEl.appendChild(paginationItem);  
        }
    }
    load(page = 1){
        this.preloadOn();
        let xhr = new XMLHttpRequest();
        let path = `/handlers/catalog_handler.php?page=${page}&section=${this.section}`;

        if( this.filters.activePrice != null) {
            path += `&filters_price=${this.filters.activePrice}`
        }
        if( this.filters.activeCategory != null) {
            path += `&filter_category=${this.filters.activeCategory}`
        }
        console.log(path);

        xhr.open('GET', path);
        xhr.send();

        xhr.addEventListener('load', ()=>{
            //console.log(xhr.responseText);
            let data = JSON.parse(xhr.responseText);
            this.paginationRender(data.pagination);
            console.log(data);

            //Тут пойдет код заполнения массива this.products
            this.products = [];
            data.products.forEach((productsItem)=>{
                this.products.push(new Product(productsItem.name, productsItem.price, productsItem.img_src, productsItem.id));
            });

            console.log(this.products);
            this.render();
            this.preloadOff();
        });
    }
}

let catalog = new Catalog();
catalog.load();