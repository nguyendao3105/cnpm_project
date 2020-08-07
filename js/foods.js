var script = document.createElement("script");
script.src = "jquery-3.5.1.min.js";

if (document.readyState == "loading") {
  document.addEventListener("DOMContentLoaded", ready);
} else {
  ready();
}
/*
var menu_vender;
var menu_foodname;
var menu_description;
var menu_price;
var menu_source;*/

function ready() {
  //extractAllMenu();

  var removeCartItemButtons = document.getElementsByClassName("btn-remove");
  for (var i = 0; i < removeCartItemButtons.length; i++) {
    var button = removeCartItemButtons[i];
    button.addEventListener("click", removeCartItem);
  }

  var quantityInputs = document.getElementsByClassName("cart-quantity-input");
  for (var i = 0; i < quantityInputs.length; i++) {
    var input = quantityInputs[i];
    input.addEventListener("change", quantityChanged);
  }

  var addToCartButtons = document.getElementsByClassName("food-item-button");
  for (var i = 0; i < addToCartButtons.length; i++) {
    var button = addToCartButtons[i];
    button.addEventListener("click", addToCartClicked);
  }
  document
    .getElementsByClassName("btn-purchase")[0]
    .addEventListener("click", purchaseClicked);
  updateCartTotal();
}

function purchaseClicked() {
  // When clicked to the purchase button
  thanhtoan();
  var cartItems = document.getElementsByClassName("cart-items")[0];
  // Remove cartRow
  while (cartItems.hasChildNodes()) {
    cartItems.removeChild(cartItems.firstChild);
  }
  updateCartTotal();
}

function removeCartItem(event) {
  // When clicked the remove item button
  var buttonClicked = event.target;
  buttonClicked.parentElement.parentElement.remove();
  updateCartTotal();
}

function quantityChanged(event) {
  // When manipulate the quantity box
  var input = event.target;
  if (isNaN(input.value) || input.value <= 0) {
    input.parentElement.parentElement.remove();
  }
  updateCartTotal();
}

function addToCartClicked(event) {
  // When clicked to the add item button
  var button = event.target;
  var foodItem = button.parentElement.parentElement.parentElement;
  var title = foodItem.getElementsByClassName("food-item-title")[0].innerText;
  var price = foodItem.getElementsByClassName("food-item-price")[0].innerText;
  var imageSrc = foodItem.getElementsByClassName("food-item-image")[0].src;
  var id_ven = foodItem.parentElement.parentElement;
  var id_vendor = id_ven.getElementsByClassName("vendor_id")[0].innerHTML;
  // Add item to cart and update the shopping cart
  addItemToCart(title, price, imageSrc, id_vendor);
  updateCartTotal();
}

function addItemToCart(title, price, imageSrc, id_vendor) {
  // Title: item's name
  // Price: the cost of item
  // imageSrc: item's image
  var cartItems = document.getElementsByClassName("cart-items")[0];
  var cartItemNames = cartItems.getElementsByClassName("cart-item-title");
  // If the item was already in the cart, just increase the item's quantity
  for (var i = 0; i < cartItemNames.length; i++) {
    if (cartItemNames[i].innerText == title) {
      var cartRow = cartItemNames[i].parentElement.parentElement;
      var quantity = cartRow.getElementsByClassName("cart-quantity-input")[0];
      quantity.value = parseInt(quantity.value) + 1;
      return;
    }
  }
  // Add to cart / append the <cartItems> one more <cartRow>
  var cartRow = document.createElement("div");
  cartRow.classList.add("cart-row");
  var cartRowContents = `
        <div class="cart-item cart-column">
            <img class="cart-item-image" src="${imageSrc}" width="100" height="100" alt="${title}">
            <span class="cart-item-title">${title}</span>
            
        </div>
        <span class="cart-price cart-column">${price}</span>
        <div class="cart-quantity cart-column">
            <input class="cart-quantity-input" type="number" value="1">
            <button class="btn-remove" type="button">HỦY</button>
        </div>`;
  cartRow.innerHTML = cartRowContents;
  cartItems.append(cartRow);
  var in_vendor_class = document.createElement("div");
  in_vendor_class.setAttribute("class", "cart_vendor_id");
  in_vendor_class.style.visibility = "hidden";
  in_vendor_class.innerHTML = id_vendor;
  cartRow.append(in_vendor_class);
  cartRow
    .getElementsByClassName("btn-remove")[0]
    .addEventListener("click", removeCartItem);
  cartRow
    .getElementsByClassName("cart-quantity-input")[0]
    .addEventListener("change", quantityChanged);
}

function updateCartTotal() {
  // Update the total cost
  var cartItemContainer = document.getElementsByClassName("cart-items")[0];
  var cartRows = cartItemContainer.getElementsByClassName("cart-row");
  var total = 0;
  for (var i = 0; i < cartRows.length; i++) {
    var cartRow = cartRows[i];
    var priceElement = cartRow.getElementsByClassName("cart-price")[0];
    var quantityElement = cartRow.getElementsByClassName(
      "cart-quantity-input"
    )[0];
    var price = getFloatMoneyDot(priceElement.innerText);
    var quantity = quantityElement.value;
    total = total + price * quantity;
  }
  document.getElementsByClassName(
    "cart-total-price"
  )[0].innerText = formatMoney.format(total);
  // Disable purchase button if the cart is empty
  purchaseButtonTracking();
}

function getOrder() {
  var cartItemContainer = document.getElementsByClassName("cart-items")[0];
  var cartRows = cartItemContainer.getElementsByClassName("cart-row");
  var foodArr = [];
  var quantityArr = [];
  for (var i = 0; i < cartRows.length; i++) {
    var cartRow = cartRows[i];
    foodArr.push(
      cartRow.getElementsByClassName("cart-item-title")[0].innerText
    );
    quantityArr.push(
      cartRow.getElementsByClassName("cart-quantity-input")[0].value
    );
  }
  var food = JSON.stringify(foodArr);
  var number = JSON.stringify(quantityArr);
  alert(document.getElementsByClassName("cart-total-price")[0].innerText);
  var total = getFloatMoneyDot(
    document.getElementsByClassName("cart-total-price")[0].innerText
  );
  var id_vendor = document.getElementsByClassName("cart_vendor_id")[0]
    .innerHTML;
  /* alert(food);
  alert(number);
 
  alert(id_vendor); */
  $.ajax({
    url: "order_server.php",
    type: "POST",
    async: false,
    data: { food: food, number: number, total: total, id_vendor: id_vendor },
    success: function (data) {
      alert("Cám ơn bạn đã mua hàng!");
    },
    error: function (data) {
      alert("failed");
    },
  });
}

function thanhtoan() {
  // Confirm
  var a = confirm("Bạn có chắc mình muốn đặt hàng không?");
  
  if (a == true) {
    var total = getFloatMoneyDot(
      document.getElementsByClassName("cart-total-price")[0].innerText
    );
    var userr = document.getElementsByClassName("username")[0].innerHTML;
    $.ajax({
      url: "../charging/payment_center.php",
      type: "POST",
      async: false,
      data: { total: total, userr: userr },
      success: function (data) {
        if (data == "Thanh toan thanh cong") {
          getOrder(); // Send order info to server
        } else {
          alert(data); // Alert 
        }
      },
      error: function (data) {
        alert("failed");
      },
    });
  } else {
  }
}
function cartIsEmpty() {
  // Check if the cart is empty or not
  var cartItemContainer = document.getElementsByClassName("cart-items")[0];
  var cartItems = cartItemContainer.getElementsByClassName("cart-row");
  return cartItems.length <= 0 ? true : false;
}

function purchaseButtonTracking() {
  // Disable purchase button if the current cart is empty
  var orderButton = document.getElementsByClassName("btn-purchase")[0];
  if (cartIsEmpty()) {
    orderButton.disabled = true;
  } else {
    orderButton.disabled = false;
  }
}

/*
// Extract menu function
function extractAllMenu() {
  var orderSection = document.getElementById("order-section");
  // We'll extract vender name in category section here
  var categoryContainer = orderSection.getElementsByClassName(
    "category-container"
  )[0];
  // We'll extract each vender's menu list in food section here
  var foodContainer = orderSection.getElementsByClassName("food-container")[0];
  // Iterate all_vender_menu list, using "iterable protocol"
  for (const [id_v, data_v] of Object.entries(all_vender_menu)) {
    // Category-container
    var ex_cc_vender = document.createElement("div");
    ex_cc_vender.setAttribute("class", "vender-header");
    ex_cc_vender.innerHTML = `
      <a href="#${data_v["vender_id"]}">${data_v["vender_name"]}</a>`;
    categoryContainer.append(ex_cc_vender);

    // Food-container
    // Vender name
    var ex_fc_vender = document.createElement("div");
    ex_fc_vender.setAttribute("id", ${data_v["vender_id"]});
    ex_fc_vender.setAttribute("class", "vender-container");
    ex_fc_vender.innerHTML = `
      <div class="vender-header">${data_v["vender_name"]}</div>`;
    // Menu in this vender
    var ex_fc_food_items = document.createElement("div");
    ex_fc_food_items.setAttribute("class", "food-items");
    for (let data_f of Object.values(data_v["food_list"])) {
      // Remember to format currency to string before extracting to html!!!
      var str_money = formatMoney.format(data_f["price"]);
      // Get each food item in menu
      var ex_fc_food_item = `
        <div class="food-item">
          <img
            class="food-item-image"
            src="${data_f["img_src"]}"
            alt="${data_f['name']}"
          />
          <div class="food-item-details">
            <div class="food-item-title">${data_f["name"]}</div>
            <div class="food-item-descriptions">
              ${data_f["description"]}
            </div>
            <div class="food-item-order">
              <span class="food-item-price">${str_money}</span>
              <button class="btn1 food-item-button" type="button">
                THÊM
              </button>
            </div>
          </div>
        </div>`;
      ex_fc_food_items.innerHTML += ex_fc_food_item;
    }
    ex_fc_vender.append(ex_fc_food_items);
    foodContainer.append(ex_fc_vender); // Final appending
  }
}*/

// Currency formatting (important!!!!) ver 2
var formatMoney = new Intl.NumberFormat("it-IT", {
  style: "currency",
  currency: "VND",
  format: "%v %s",
});

function getFloatMoneyComma(str_money) {
  return parseFloat(
    str_money.split(" đ").join("").split(" ₫").join("").split(",").join("")
  );
}

function getFloatMoneyDot(str_money) {
  return parseFloat(
    str_money.split(" đ").join("").split(" ₫").join("").split(".").join("")
  );
}
