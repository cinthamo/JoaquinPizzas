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
        pizza_name.innerHTML = pizza_name.children[0].value;
        edit_pizza_name_btn.innerHTML = `<img src="images/edit.png" alt="buttonpng" width="30" height="30"/>`;
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

function addIngredient(pizzaID) {
    const name = document.getElementById("new_ing_name"); 
    const price = document.getElementById("new_ing_price"); 
    
    if(name.value == "") {
        name.style.border = "2px solid rgb(184, 36, 36, 0.8)";
    } else {
        name.style.border = "2px solid white";
    }

    const is_price_valid = new RegExp('^[0-9]+(\.[0-9]+)?$').test(price.value);

    if(!is_price_valid) {
        price.style.border = "2px solid rgb(184, 36, 36, 0.8)";
    } else {
        price.style.border = "2px solid white";
    }

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