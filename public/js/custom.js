$(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
    
    
});

//add leading zeros
String.prototype.padFunction = function(padStr, len) {
    var str = this;
    while (str.length < len)
       str = padStr + str;
    return str;
 }

//fill stock select after toner selected
function fillStockSelector(tonerModelID, stockSelect){
    axios.get(`/toners/${tonerModelID}/stocks`)
    .then(response => {
        const stocks = response.data;

        //clear all option element
        while(stockSelect.options.length > 1) {
            stockSelect.remove(1);
        }
        
        //create option element with value
        stocks.forEach(function (stock, index) {
            const option = document.createElement('option');
            option.innerHTML = 'CIAU' + stock["check_in_id"].toString().padStart(7, '0') + '-' + stock['remaining_stock'] + 'PCS';
            option.value = stock['stock_id'];
            stockSelect.appendChild(option);
        });

    })
    .catch(error => {
        console.log(error);
    });
}

//add eventlistener on toner selector
const tonerSelector = document.querySelectorAll('.tonerSelector');
if(tonerSelector){
    for(const toner of tonerSelector) {
        toner.addEventListener('change', function(e){
            const stockSelect = e.target.parentElement.nextElementSibling.children[1];

            //remove max attribute of quantity input
            const inputQuantity = stockSelect.parentElement.nextElementSibling.children[1];
            inputQuantity.removeAttribute('max');

            fillStockSelector(e.target.value, stockSelect);
        })
    }
}

function setMiximumQuantityOfRelease(stockID, inputQuantity) {
    axios.get(`/stocks/${stockID}/remaining`)
    .then(response => {
        //remove max attribute
        inputQuantity.removeAttribute('max');

        const stock = response.data;
        if(stock.length) {
            inputQuantity.setAttribute('max', stock[0].remaining_stock);
        }
        
    })
    .catch(error => {
        console.log(error);
    });
}

//add eventlistener on stock selector
const stockSelector = document.querySelectorAll('.stockSelector');
if(stockSelector) {
    for(const stock of stockSelector){
        stock.addEventListener('change', function(e) {
            
            const inputQuantity = e.target.parentElement.nextElementSibling.children[1];
            setMiximumQuantityOfRelease(e.target.value, inputQuantity);
        });
    }
}

//search validation
const searchTypeSelectors = document.querySelectorAll('.searchType');
if(searchTypeSelectors) {
    const searchInput = document.querySelector('#searchInput');
    const startDate = document.querySelector('#startDate');
    const endDate = document.querySelector('#endDate');
    const locationSelector = document.querySelector('#locationSelect');
    const supplierSelector = document.querySelector('#supplierSelect');

    const forms = [searchInput, startDate, endDate, locationSelector, supplierSelector];

    for(const searchTypeSelector of searchTypeSelectors){
        searchTypeSelector.addEventListener('change', function(e) {
            let searchType = e.target.value;
    
            //reset display class of input in serach form
            function resetForm() {
                forms.forEach(form => {
                    if (form != null) {
                        form.classList.remove('d-none');
                    form.classList.add('d-none');
    
                    //remove attribute
                    form.children[0].setAttribute('required','');
                    form.children[0].removeAttribute('required');
    
                    forms[1].children[0].children[1].setAttribute('required','');
                    forms[2].children[0].children[1].setAttribute('required','');
                    forms[1].children[0].children[1].removeAttribute('required');
                    forms[2].children[0].children[1].removeAttribute('required');
                    }
                });
            }
    
            switch (searchType) {
                case 'reference_id':
                case 'dr_no':
                case 'invoice_no':
                case 'toner_code':
                case 'req_slip':
                    resetForm();
                    forms[0].classList.remove('d-none');
                    forms[0].children[0].setAttribute('required','');
                    break;
    
                case 'date':
                case 'purchased_date':
                case 'delivery_date':
                case 'date_received':
                    resetForm();
                    forms[1].classList.remove('d-none');
                    forms[2].classList.remove('d-none');
    
                    forms[1].children[0].children[1].setAttribute('required','');
                    forms[2].children[0].children[1].setAttribute('required','');
                    break;
    
                case 'location':
                    resetForm();
                    forms[3].classList.remove('d-none');
                    
                    forms[3].children[0].setAttribute('required','');
                    break;
    
                case 'location_with_date':
                    resetForm();
                    forms[3].classList.remove('d-none');
                    forms[1].classList.remove('d-none');
                    forms[2].classList.remove('d-none');
    
                    forms[3].children[0].setAttribute('required','');
                    forms[1].children[0].children[1].setAttribute('required','');
                    forms[2].children[0].children[1].setAttribute('required','');
                    break;
                
                case 'supplier':
                    resetForm();
                    forms[4].classList.remove('d-none');
                    forms[1].classList.remove('d-none');
                    forms[2].classList.remove('d-none');
    
                    forms[4].children[0].setAttribute('required','');
                    forms[1].children[0].children[1].setAttribute('required','');
                    forms[2].children[0].children[1].setAttribute('required','');
                    break;
                
                // case 'purchased_date':
                // case 'delivery_date':
                // case 'date_received':
                //     resetForm();
                //     forms[1].classList.remove('d-none');
                //     forms[2].classList.remove('d-none');
    
                //     forms[1].children[0].children[1].setAttribute('required','');
                //     forms[2].children[0].children[1].setAttribute('required','');
                //     break;
            
                default:
                    resetForm();
                    break;
            }
        });
    }
    
}
