var tp = 0;
var price = document.getElementsByClassName('price');
var quantity = document.getElementsByClassName('quantity');
var subtotal = document.getElementsByClassName('subtotal');
var total_price = document.getElementsByClassName('total_price');

function subTotal()
{
    tp=0;
    for(i=0;i<price.length;i++)
    {
        subtotal[i].innerText=(price[i].value)*(quantity[i].value);
        tp=tp+(price[i].value)*(quantity[i].value);
    }
    total_price.innerText=tp;
}