if (document.readyState == "loading") {
  document.addEventListener("DOMContentLoaded", ready);
} else {
  ready();
}


function ready() {
  // Order customer
  // order-customer.html (.php)
  if (document.getElementById("order-customer")) {
    extractOrderCustomer(orderArray);
  }
  // Order cook
  // order-cook.html (.php)
  else if (document.getElementById("order-cook")) {
    extractOrderCook(orderArray);
  }
}

function openModal(event) {
  // A. Create html modal
  //    1. Create a modal (id="modal")
  var modal = document.createElement("div");
  modal.setAttribute("id", "modal");
  //    2. Create a background hider + box (includes: header, content, footer) inside the modal
  var modalBgHider = document.createElement("div");
  modalBgHider.setAttribute("id", "modal-background-hider");
  modalBgHider.addEventListener("click", closeModal); // Close modal on click
  var modalBox = document.createElement("div");
  modalBox.setAttribute("id", "modal-box");
  modalBox.innerHTML = `
    <div id="modal-header"></div>
    <div id="modal-body"></div>
    <div id="modal-footer"></div>
  `;
  modal.append(modalBgHider, modalBox);
  // 3. Append to order section
  // order-customer.html (.php)
  if (document.getElementById("order-customer")) {
    var orderCustomer = document.getElementById("order-customer");
    orderCustomer.append(modal);
  }
  // order-cook.html (.php)
  else if (document.getElementById("order-cook")) {
    var orderCook = document.getElementById("order-cook");
    orderCook.append(modal);
  }
  // 4. Set overflow of body to hidden
  var body = document.getElementsByTagName("body")[0];
  body.style.overflow = "hidden";

  // B. (php) Extract the content to the modal-body
  // 1. Get index of the clicked order -> id of <tr>
  var index = parseInt(
    event.target.parentElement.getAttribute("id").replace("order_", "")
  );

  // Extract the content
  // order-customer.html (.php)
  if (document.getElementById("order-customer")) {
    extractOrderDetailCustomer(index, orderArray, orderDetailArray);
  }
  // order-cook.html (.php)
  else if (document.getElementById("order-cook")) {
    extractOrderDetailCook(index, orderArray, orderDetailArray);
  }
}

function closeModal(event) {
  // Clear attribute: style
  var body = document.getElementsByTagName("body")[0];
  body.removeAttribute("style");
  // Remove modal
  var modal = document.getElementById("modal");
  modal.parentElement.removeChild(modal); // Remove itself
}

// Currency formatting (important!!!!)
var formatMoney = new Intl.NumberFormat("it-IT", {
  style: "currency",
  currency: "VND",
  format: "%v %s",
});

function getFloatMoneyComma(str_money) {
  return parseFloat(
    str_money.replace(" đ", "").replace(" ₫", "").replace(",", "")
  );
}

function getFloatMoneyDot(str_money) {
  return parseFloat(
    str_money.replace(" đ", "").replace(" ₫", "").replace(".", "")
  );
}

//!!! Include in php !!! ==================================================
// 1. Order customer
// General info: in the table
function extractOrderCustomer(orderArray) {
  var tableTbody = document
    .getElementsByTagName("table")[0]
    .getElementsByTagName("tbody")[0];
  // For each order
  for (var i = 0; i < orderArray.length; i++) {
    var row = document.createElement("tr");
    // Set id: arr_<index>
    // When the user clicks the row, open the modal
    row.setAttribute("id", `order_${i}`);
    row.addEventListener("click", openModal);
    // Content hereeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
    var content = `
      <td>${i + 1}</td>
      <td>${orderArray[i][0]}</td>
      <td>${orderArray[i][1]}</td>
      <td>${orderArray[i][2]}</td>
      <td>${formatMoney.format(getFloatMoneyComma(orderArray[i][3]))}</td>
      <td>${orderArray[i][4]}</td>
    `;
    // End content =========================================
    row.innerHTML = content;
    tableTbody.append(row);
  }
}

// Detail: in the medal
function extractOrderDetailCustomer(i, orderArray, orderDetailArray) {
  // 1. Modal header (title modal)
  var modalHeader = document.getElementById("modal-header");
  modalHeader.innerHTML = `THÔNG TIN ĐƠN HÀNG`;
  // 2. Modal body
  var modalBody = document.getElementById("modal-body");
  //    a. General info
  var modalTop = document.createElement("div");
  modalTop.setAttribute("class", "col-md-12");
  // Content hereeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
  modalTop.innerHTML = `
  <div class="section-header-small">
    <div class="h3-heading">
      Chung
    </div>
  </div>
  <table class="table table-section table-hover table-bordered">
    <thead>
      <tr>
        <th>STT</th>
        <th>ID đơn hàng</th>
        <th>Tên khách hàng</th>
        <th>Thời gian</th>
        <th>Tổng tiền</th>
        <th>Gian hàng số</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>${i + 1}</td>
        <td>${orderArray[i][0]}</td>
        <td>${orderArray[i][1]}</td>
        <td>${orderArray[i][2]}</td>
        <td>${formatMoney.format(getFloatMoneyComma(orderArray[i][3]))}</td>
        <td>${orderArray[i][4]}</td>
      </tr>
    </thead>
  </table>`;
  // End content =========================================
  modalBody.append(modalTop);
  //    b. Details info
  var modalBottom = document.createElement("div");
  modalBottom.setAttribute("class", "col-md-12");
  modalBottom.innerHTML += `
  <div class="section-header-small">
    <div class="h3-heading">
      Chi tiết
    </div>
  </div>`;
  var mb_table = document.createElement("table");
  mb_table.setAttribute(
    "class",
    "table table-section table-hover table-bordered"
  );
  var mb_thread = document.createElement("thead");
  mb_thread.innerHTML = `
    <tr>
      <th>STT</th>
      <th>Món ăn</th>
      <th>Số lượng</th>
    </tr>`;
    //<th>Giá tiền</th>
  mb_table.append(mb_thread);
  var mb_tbody = document.createElement("tbody");
  for (var f = 0; f < orderDetailArray[i].length; f++) {
    var row = document.createElement("tr");
    // Content hereeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
    row.innerHTML = `
      <td>${f + 1}</td>
      <td>${orderDetailArray[i][f][0]}</td>
      <td>${orderDetailArray[i][f][1]}</td>
      `;
    // End content =========================================
    mb_tbody.append(row);
  }
  mb_table.append(mb_tbody);
  modalBottom.append(mb_table);
  modalBody.append(modalBottom);

  // 3. Modal footer (button)
  var modalFooter = document.getElementById("modal-footer");
  var btnModal = document.createElement("span");
  btnModal.setAttribute("class", "btn1 btn-modal");
  btnModal.innerHTML = "ĐỒNG Ý";
  btnModal.addEventListener("click", closeModal); // Close modal on click
  modalFooter.append(btnModal);
  /*
  var btnModalLeft = document.createElement("span");
  btnModalLeft.setAttribute("class", "btn1 btn-modal-left");
  btnModalLeft.innerHTML = "";
  modalFooter.append(btnModalLeft);
  var btnModalRight = document.createElement("span");
  btnModalRight.setAttribute("class", "btn1 btn-modal-right btn-remove");
  btnModalRight.innerHTML = "";
  modalFooter.append(btnModalRight);*/
  return;
}

// 2. Order cook
// General info: in the table
function extractOrderCook(orderArray) {
  var tableTbody = document
    .getElementsByTagName("table")[0]
    .getElementsByTagName("tbody")[0];
  // For each order
  for (var i = 0; i < orderArray.length; i++) {
    var row = document.createElement("tr");
    // Set id: arr_<index>
    // When the user clicks the row, open the modal
    row.setAttribute("id", `order_${i}`);
    row.addEventListener("click", openModal);
    // Content hereeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
    var content = `
      <td>${i + 1}</td>
      <td>${orderArray[i][0]}</td>
      <td>${orderArray[i][1]}</td>
      <td>${orderArray[i][2]}</td>
      <td>${formatMoney.format(getFloatMoneyComma(orderArray[i][3]))}</td>
      <td>${orderArray[i][4]}</td>
    `;
    // End content =========================================
    row.innerHTML = content;
    tableTbody.append(row);
  }
}

// Detail: in the medal
function extractOrderDetailCook(i, orderArray, orderDetailArray) {
  // 1. Modal header (title modal)
  var modalHeader = document.getElementById("modal-header");
  modalHeader.innerHTML = `XỬ LÝ ĐƠN HÀNG`;
  // 2. Modal body
  var modalBody = document.getElementById("modal-body");
  //    a. General info
  var modalTop = document.createElement("div");
  modalTop.setAttribute("class", "col-md-12");
  // Content hereeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
  modalTop.innerHTML = `
  <div class="section-header-small">
    <div class="h3-heading">
      Chung
    </div>
  </div>
  <table id="order-general" class="table table-section table-hover table-bordered">
    <thead>
      <tr>
        <th>STT</th>
        <th>ID đơn hàng</th>
        <th>Tên khách hàng</th>
        <th>Thời gian</th>
        <th>Tổng tiền</th>
        <th>Gian hàng số</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>${i + 1}</td>
        <td>${orderArray[i][0]}</td>
        <td>${orderArray[i][1]}</td>
        <td>${orderArray[i][2]}</td>
        <td>${formatMoney.format(getFloatMoneyComma(orderArray[i][3]))}</td>
        <td>${orderArray[i][4]}</td>
      </tr>
    </thead>
  </table>`;
  // End content =========================================
  modalBody.append(modalTop);
  //    b. Details info
  var modalBottom = document.createElement("div");
  modalBottom.setAttribute("class", "col-md-12");
  modalBottom.innerHTML += `
  <div class="section-header-small">
    <div class="h3-heading">
      Chi tiết
    </div>
  </div>`;
  var mb_table = document.createElement("table");
  mb_table.setAttribute(
    "class",
    "table table-section table-hover table-bordered"
  );
  var mb_thread = document.createElement("thead");
  mb_thread.innerHTML = `
    <tr>
      <th>STT</th>
      <th>Món ăn</th>
      <th>Số lượng</th>
    
    </tr>`;
    //<th>Giá tiền</th>
  mb_table.append(mb_thread);
  var mb_tbody = document.createElement("tbody");
  for (var f = 0; f < orderDetailArray[i].length; f++) {
    var row = document.createElement("tr");
    // Content hereeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
    row.innerHTML = `
      <td>${f + 1}</td>
      <td>${orderDetailArray[i][f][0]}</td>
      <td>${orderDetailArray[i][f][1]}</td>
      <td>${formatMoney.format(
        getFloatMoneyComma(orderDetailArray[i][f][2])
      )}</td>`;
    // End content =========================================
    mb_tbody.append(row);
  }
  mb_table.append(mb_tbody);
  modalBottom.append(mb_table);
  modalBody.append(modalBottom);

  // 3. Modal footer (button)
  var modalFooter = document.getElementById("modal-footer");
  // Button
  var btnModalLeft = document.createElement("span");
  btnModalLeft.setAttribute("class", "btn1 btn-modal-left");
  btnModalLeft.innerHTML = "ĐƠN HÀNG SẴN SÀNG!"; // Button content
  btnModalLeft.addEventListener("click", inReadyFood); // Inform ready food
  modalFooter.append(btnModalLeft);
  var btnModalRight = document.createElement("span");
  btnModalRight.setAttribute("class", "btn1 btn-modal-right btn-remove");
  btnModalRight.innerHTML = "HẾT HÀNG"; // Button content
  btnModalRight.addEventListener("click", inOutOfOrder); // Inform out of order food
  modalFooter.append(btnModalRight);
  return;
}

// Send data to server
// Inform ready food + Inform out of order
function inReadyFood(event) {
  // Get data: index ==========
  // Get the order general info
  var orderGeneralInfo = document
    .getElementById("order-general")
    .getElementsByTagName("tbody")[0]
    .getElementsByTagName("tr")[0];
  // index = STT - 1
  var orderIndex =
    parseInt(orderGeneralInfo.getElementsByTagName("td")[0].innerHTML) - 1;
  alert(orderIndex);
  // Send data: index ==========
  var order_index = JSON.stringify(orderIndex);
  $.ajax({
    url: "#.php", // Hereeeeeee
    type: "POST",
    data: { order_index: order_index },
    success: function (data) {
      alert("success");
      // Remember to close the modal after succession
      closeModal(event);
    },
    error: function (data) {
      alert("failed, try again");
      // In here it won't close the modal if failed ~
      //closeModal(event);
    },
  });
}

function inOutOfOrder(event) {
  return;
}
