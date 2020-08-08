/*
// Global variables
var menu = [
  [
    "1",
    "Canh khổ qua nhồi thịt",
    "29000",
    "Mì cay hải sản với cùng tôm mực khổng lồ ăn mê mệt!",
  ],
  [
    "0",
    "Gà rán bóng đêm",
    "34000",
    "Thưởng thức một món gà bóng đêm ngon mê li như ở nhà hàng!!",
  ],
  ["1", "Cơm xào bò dưa muối", "24000", "Bò cùng dưa chua chua ngọt ngọt!"],
  [
    "0",
    "Canh khổ qua nhồi thịt",
    "24000",
    "Món ăn quen thuộc với mọi nhà, nhưng lại rất là ngon nha :))))",
  ],
];
*/

/*
// 1. Menu cook
function extractMenuCook(menuArray) {
  var tableTbody = document
    .getElementsByTagName("table")[0]
    .getElementsByTagName("tbody")[0];

  // For each food item in the menu
  for (var i = 0; i < menuArray.length; i++) {
    var row = document.createElement("tr");
    row.innerHTML = `
    <td>${i + 1}</td>
    <td>${menuArray[i][1]}</td>
    <td>${formatMoney.format(getFloatMoneyComma(menuArray[i][2]))}</td>
    <td>${menuArray[i][3]}</td>`;
    // Food state
    // Create a <td> which contains <button>
    var td_btn = document.createElement("td");
    var btn = document.createElement("button");
    if (menuArray[i][0] == "1") {
      btn.setAttribute("class", "btn1 btn-remove");
      btn.innerHTML = "Hết hàng";
      btn.addEventListener("click", foodNotAvailable); // Het hang
    } else {
      btn.setAttribute("class", "btn1");
      btn.innerHTML = "Còn hàng";
      btn.addEventListener("click", foodAvailable); // Con hang
    }
    td_btn.append(btn);
    // Append to the table body
    row.append(td_btn);
    tableTbody.append(row);
  }
}
*/
// Available function + not available function
function changeFoodState(event) {
  // Get food info
  var foodInfo = getClickedFoodInfo(event);
  var send = JSON.stringify(foodInfo);
  // alert(send);
  // Change databe ...
  $.ajax({
    url: "../php_server/menu_cook_server.php",
    type: "POST",
    async: false,
    data: { send: send },
    success: function (data) {
      // alert(data);
      location.reload();
    },
    error: function (data) {
      alert("failed");
    },
  });
  return;
}

// 1. Menu cook
function extractMenuCook(menuArray) {
  var tableTbody = document
    .getElementsByTagName("table")[0]
    .getElementsByTagName("tbody")[0];
  // For each food item in the menu

  for (var i = 0; i < menuArray[1].length; i++) {
    var row = document.createElement("tr");
    row.innerHTML = `
  <td>${i + 1}</td>
  <td>${menuArray[1][i]}</td>
  <td>${formatMoney.format(getFloatMoneyComma(menuArray[2][i]))}</td>
  <td>${menuArray[3][i]}</td>`;
    // Food state
    // Create a <td> which contains <button>
    var td_btn = document.createElement("td");
    var btn = document.createElement("button");
    //alert(menuArray[0][i]);
    if (menuArray[0][i] == false) {
      btn.setAttribute("class", "btn1 btn-remove");
      btn.innerHTML = "Hết hàng";
    } else {
      btn.setAttribute("class", "btn1");
      btn.innerHTML = "Còn hàng";
    }
    btn.addEventListener("click", changeFoodState); // Het hang
    td_btn.append(btn);
    // Append to the table body
    row.append(td_btn);
    tableTbody.append(row);
  }
}

// 2. Menu owner
function extractMenuOwner(menuArray) {
  var tableTbody = document
    .getElementsByTagName("table")[0]
    .getElementsByTagName("tbody")[0];

  // For each food item in the menu
  if (menuArray.length > 0) {
    for (var i = 0; i < menuArray[0].length; i++) {
      var row = document.createElement("tr");
      row.innerHTML = `
    <td>${i + 1}</td>
    <td>${menuArray[0][i]}</td>
    <td>${formatMoney.format(getFloatMoneyComma(menuArray[1][i]))}</td>
    <td>${menuArray[2][i]}</td>
    <td><button class="btn1 btn-remove">Xóa</button></td>`;
      tableTbody.append(row);
    }
  }
  // Then add listener to each button
  var removeFoodItemButtons = document.getElementsByClassName("btn-remove");
  for (var i = 0; i < removeFoodItemButtons.length; i++) {
    var button = removeFoodItemButtons[i];
    button.addEventListener("click", removeClickedFood);
  }
}

function removeClickedFood(event) {
  var foodinfo = getClickedFoodInfo(event);
  //alert(foodinfo[0]);
  $.ajax({
    url: "../php_server/server_owner.php",
    type: "POST",
    async: false,
    data: {
      removefood: "remove",
      food_name: foodinfo[0],
      price: foodinfo[1],
      description: foodinfo[2],
    },
    // dataType: 'json',
    success: function (response) {
      alert(response);
      location.reload();
    },
    error: function (data) {
      alert("failed");
    },
  });
}

// Get info food
function getClickedFoodInfo(event) {
  // When clicked the remove item button
  var buttonClicked = event.target;
  // fooodInfo is <tr> tag, which contains rows (<td> tags)
  var foodInfo = buttonClicked.parentElement.parentElement;
  var foodInfoArray = [];

  // Info food =======
  var counter = 0;
  // Traverse the parent node: <tr>
  for (
    var child = foodInfo.firstChild;
    child !== null;
    child = child.nextSibling
  ) {
    // So 3: trong mang food co 3 thong tin: name, price, description
    if (counter > 3) break;
    // Node is <tr> (node type = 1)
    if (child.nodeType == 1) {
      // Counter: dem so luong node la <td>
      counter++;
      if (counter > 1) {
        // Bo qua STT -> counter > 1
        if (counter == 3) foodInfoArray.push(getFloatMoneyDot(child.innerHTML));
        else foodInfoArray.push(child.innerHTML);
      }
    }
  }
  // =====
  // Final info array of the target food
  return foodInfoArray;
}
