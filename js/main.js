function callPHP() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        // do something with the response from the PHP function
        }
    };
    xhttp.open("GET", "myFunction.php", true);
    xhttp.send();
}

function removePizza(pizzaID) {
    document.getElementById("p-"+pizzaID).remove();
}

function editPizzaName() {
    const pizza_name = document.getElementById("pizza_name");
    const edit_pizza_name_btn = document.getElementById("edit_pizza_name");

    if(pizza_name.childElementCount == 0) {   
        pizza_name.innerHTML = `<input class='pizza_input w' type='text' value='${pizza_name.textContent}'/>`;
        edit_pizza_name_btn.innerHTML = `<img src="images/done.png" alt="buttonpng" width="30" height="30">`;
    } else {
        const name = pizza_name.children[0].value
        const is_valid = name != ""
        changeBorder(pizza_name.children[0], is_valid)
        if (is_valid) {
            pizza_name.innerHTML = name;
            edit_pizza_name_btn.innerHTML = `<img src="images/edit.png" alt="buttonpng" width="30" height="30"/>`;
        }
    }
}

function upIngredient(ingredientID, pizzaID) {
    const element = document.getElementById("row-"+ingredientID);
    const parent = element.parentElement;

    const index = Array.from(parent.children).indexOf(element);
    
    if(index != 0) {
        parent.removeChild(element);
        parent.insertBefore(element, parent.children[index-1]);
    }
}

function downIngredient(ingredientID, pizzaID) {
    const element = document.getElementById("row-"+ingredientID);
    const newRowElement = document.getElementById("new-row")
    const parent = element.parentElement;

    const index = Array.from(parent.children).indexOf(element);
    const newRowIndex = Array.from(parent.children).indexOf(newRowElement);

    if(index != newRowIndex - 1) {
        parent.removeChild(element);
        parent.insertBefore(element, parent.children[index+1]);
        
    }
}

function deleteIngredient(ingredientID, pizzaID, costPriceIngredient) {
    document.getElementById("row-"+ingredientID).remove();
    let total = document.getElementById("total").textContent;
    total = total - costPriceIngredient * 1.5;
    document.getElementById("total").textContent = total;
}

function changeBorder(element, isValid) {
    if (isValid)
        element.style.border = "2px solid white";
    else
        element.style.border = "2px solid rgb(184, 36, 36, 0.8)";
}

function addIngredient(pizzaID) {
    const name = document.getElementById("new_ing_name"); 
    const price = document.getElementById("new_ing_price"); 

    changeBorder(name, name.value != "");

    const is_price_valid = new RegExp('^[0-9]+(\.[0-9]+)?$').test(price.value);
    changeBorder(price, is_price_valid);

    if(name.value != "" && is_price_valid) {
        const ingredientID = 100;

        const new_tr = document.createElement("tr");
        new_tr.id = `row-${ingredientID}`;
        new_tr.className = "pizza_info";

        const new_ing_add = name.parentElement.parentElement;
        new_ing_add.parentElement.insertBefore(new_tr, new_ing_add);

        new_tr.innerHTML = `
            <td>
                <button class="small-arrow-btn" type="submit" onclick="upIngredient(${ingredientID}, ${pizzaID});">
                    <img src="images/up.png" alt="buttonpng" width="30" height="30"/>
                </button>
                <button class="small-arrow-btn" type="submit" onclick="downIngredient(${ingredientID}, ${pizzaID});">
                    <img src="images/down.png" alt="buttonpng" width="30" height="30"/>
                </button>
            </td>
            <td>${name.value}</td>
            <td>${price.value}</td>
            <td class="center">
                <button class="small-c-btn" type="submit" onclick="deleteIngredient(${ingredientID}, ${pizzaID}, ${price.value});">
                    <img src="images/trash.png" alt="buttonpng" width="30" height="30"/>
                </button>
            </td>
        `;

        name.value = "";
        price.value = "";
    }
}