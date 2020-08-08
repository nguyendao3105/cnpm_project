if (document.readyState == "loading") {
  document.addEventListener("DOMContentLoaded", ready);
} else {
  ready();
}

function ready() {
  // Order customer
  if (document.getElementById("order-customer")) {
    extractOrderCustomer(orderArray);
  }
  // Order cook
  else if (document.getElementById("order-cook")) {
    extractOrderCook(orderArray);
  }
}

// Open modal + close modal are in "modal.js"
// The specific modal handler function for customer + cook
function modalOrderCustomer(event) {
  openModal();
  var index = parseInt(
    event.target.parentElement.getAttribute("id").replace("order_", "")
  );
  extractOrderDetailCustomer(index, orderArray, orderDetailArray);
}

function modalOrderCook(event) {
  openModal();
  var index = parseInt(
    event.target.parentElement.getAttribute("id").replace("order_", "")
  );
  extractOrderDetailCook(index, orderArray, orderDetailArray);
}

// ===================================
// 1. Order customer
// General info: in the table
function extractOrderCustomer(orderArray) {
  var tableTbody = document
    .getElementsByTagName("table")[0]
    .getElementsByTagName("tbody")[0];
  // For each order
  for (var i = 0; i < orderArray.length; i++) {
    tableTbody.append(_gen_od_extracter(i, orderArray[i], modalOrderCustomer));
  }
}

// Detail: in the medal
function extractOrderDetailCustomer(i, orderArray, orderDetailArray) {
  // 1. Modal header (title modal)
  var modalHeader = document.getElementById("modal-header");
  modalHeader.innerHTML = "THÔNG TIN ĐƠN HÀNG";
  // 2. Modal body
  var modalBody = document.getElementById("modal-body");
  modalBody.append(_mbody_od_extracter_(i, orderArray, orderDetailArray));
  // 3. Modal footer (button)
  var modalFooter = document.getElementById("modal-footer");
  modalFooter.append(_mfooter_od_customer_());
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

// ===================================
// 2. Order cook
// General info: in the table
function extractOrderCook(orderArray) {
  var tableTbody = document
    .getElementsByTagName("table")[0]
    .getElementsByTagName("tbody")[0];
  // For each order
  for (var i = 0; i < orderArray.length; i++) {
    tableTbody.append(_gen_od_extracter(i, orderArray[i], modalOrderCook));
  }
}

// Detail: in the medal
function extractOrderDetailCook(i, orderArray, orderDetailArray) {
  // 1. Modal header (title modal)
  var modalHeader = document.getElementById("modal-header");
  modalHeader.innerHTML = "XỬ LÝ ĐƠN HÀNG";
  // 2. Modal body
  var modalBody = document.getElementById("modal-body");
  modalBody.append(_mbody_od_extracter_(i, orderArray, orderDetailArray));
  // 3. Modal footer (button)
  var modalFooter = document.getElementById("modal-footer");
  modalFooter.append(_mfooter_od_cook_());
  return;
}

// Send data to server
// Inform ready food + Inform out of order
function inReadyFood(event) {
  var id_order = getOrderInfo(event);
  $.ajax({
    url: "../php_server/menu_cook_server.php", // Hereeeeeee
    type: "POST",
    data: { id_order: id_order, request: "sansang" },
    success: function (data) {
      // alert("success");
      //alert(data);
      // Remember to close the modal after succession
      closeModal();
      location.reload();
    },
    error: function (data) {
      alert("failed, try again");
      // In here it won't close the modal if failed ~
      //closeModal(event);
    },
  });
}

function inOutOfOrder(event) {
  var id_order = getOrderInfo(event);
  $.ajax({
    url: "../php_server/menu_cook_server.php", // Hereeeeeee
    type: "POST",
    data: { id_order: id_order, request: "tuchoi" },
    success: function (data) {
      //alert(data);
      // Remember to close the modal after succession
      closeModal();
      location.reload();
    },
    error: function (data) {
      alert("failed, try again");
      // In here it won't close the modal if failed ~
      //closeModal(event);
    },
  });
  return;
}

function getOrderInfo(event) {
  // When clicked the remove item button
  var buttonClicked = event.target;
  var orderInfo = buttonClicked.parentElement.parentElement.parentElement
    .getElementsByTagName("tbody")[0]
    .getElementsByTagName("tr")[0];
  var orderInfoArray = [];
  var counter = 0;
  // Traverse the parent node: <tr>
  for (
    var child = orderInfo.firstChild;
    child !== null;
    child = child.nextSibling
  ) {
    // Lay 1 phan tu trong mang order: id_order, tai index thu 2
    if (counter > 2) break;
    // Node is <tr> (node type = 1)
    if (child.nodeType == 1) {
      // Counter: dem so luong node la <td>
      counter++;
      if (counter > 2) {
        // Bo qua STT -> counter > 1
        orderInfoArray.push(child.innerHTML);
      }
    }
  }
  return orderInfoArray[0];
}

// Both customer + cook
// 1. General info
function _gen_od_extracter(i, orderGenInfo, btnClick) {
  var row = document.createElement("tr");
  // Set id: arr_<index>
  // When the user clicks the row, open the modal
  row.setAttribute("id", `order_${i}`);
  row.addEventListener("click", btnClick);
  // Content hereeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
  var content = `
      <td>${i + 1}</td>
      `;
  if (orderGenInfo[5] == 1) {
    content += `<td class="color-green">Đã hoàn thành</td>`;
  } else if (orderGenInfo[5] == 0) {
    content += `<td class="color-yellow">Chưa hoàn thành</td>`;
  } else {
    content += `<td class="color-red">Bị từ chối</td>`;
  }
  content += `
      <td>${orderGenInfo[0]}</td>
      <td>${orderGenInfo[1]}</td>
      <td>${orderGenInfo[2]}</td>
      <td>${formatMoney.format(getFloatMoneyComma(orderGenInfo[3]))}</td>`;

  // End content =========================================
  row.innerHTML = content;
  return row;
}

// 2. Detail info (in modal body)
function _mbody_od_extracter_(i, orderArray, orderDetailArray) {
  var content = document.createElement("div");
  //    a. General info
  var genInfo = document.createElement("div");
  genInfo.setAttribute("class", "col-md-12");
  // Content hereeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
  genInfo.innerHTML = `
  <div class="section-header-small">
    <div class="h3-heading">
      Chung
    </div>
  </div>`;
  var mb_table_1 = document.createElement("table");
  mb_table_1.setAttribute(
    "class",
    "table table-section table-hover table-bordered"
  );
  var mt_thead = document.createElement("thead");
  var mtth_tr = document.createElement("tr");
  mtth_tr.innerHTML = `
    <th>STT</th>
    <th>Tình trạng</th>
    <th>ID đơn hàng</th>
    <th>Tên khách hàng</th>
    <th>Thời gian</th>
    <th>Tổng tiền</th>`;
  mt_thead.append(mtth_tr);
  var mt_tbody = document.createElement("tbody");
  var mttb_tr = document.createElement("tr");
  mttb_tr.innerHTML = `<td>${i + 1}</td>`;
  if (orderArray[i][5] == 1) {
    mttb_tr.innerHTML += `<td class="color-green">Đã hoàn thành</td>`;
  } else if (orderArray[i][5] == 0) {
    mttb_tr.innerHTML += `<td class="color-yellow">Chưa hoàn thành</td>`;
  } else {
    mttb_tr.innerHTML += `<td class="color-red">Bị từ chối</td>`;
  }
  mttb_tr.innerHTML += `
        <td>${orderArray[i][0]}</td>
        <td>${orderArray[i][1]}</td>
        <td>${orderArray[i][2]}</td>
        <td>${formatMoney.format(getFloatMoneyComma(orderArray[i][3]))}</td>`;
  // End content =========================================
  mt_tbody.append(mttb_tr);
  mb_table_1.append(mt_thead, mt_tbody);
  genInfo.append(mb_table_1);

  //    b. Details info
  var detailInfo = document.createElement("div");
  detailInfo.setAttribute("class", "col-md-12");
  detailInfo.innerHTML += `
  <div class="section-header-small">
    <div class="h3-heading">
      Chi tiết
    </div>
  </div>`;
  var mb_table_2 = document.createElement("table");
  mb_table_2.setAttribute(
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
  mb_table_2.append(mb_thread);
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
  mb_table_2.append(mb_tbody);
  detailInfo.append(mb_table_2);
  content.append(genInfo, detailInfo);
  return content;
}

// Modal footer for customer
function _mfooter_od_customer_() {
  var content = document.createElement("div");
  // Button
  var btnModal = document.createElement("span");
  btnModal.setAttribute("class", "btn1 btn-modal");
  btnModal.innerHTML = "ĐỒNG Ý";
  btnModal.addEventListener("click", closeModal); // Close modal on click
  content.appendChild(btnModal);
  return content;
}

// Modal footer for cook
function _mfooter_od_cook_() {
  var content = document.createElement("div");
  // Button
  var btnModalLeft = document.createElement("span");
  btnModalLeft.setAttribute("class", "btn1 btn-modal-left");
  btnModalLeft.innerHTML = "ĐƠN HÀNG SẴN SÀNG!"; // Button content
  btnModalLeft.addEventListener("click", inReadyFood); // Inform ready food
  content.append(btnModalLeft);
  var btnModalRight = document.createElement("span");
  btnModalRight.setAttribute("class", "btn1 btn-modal-right btn-remove");
  btnModalRight.innerHTML = "TỪ CHỐI"; // Button content
  btnModalRight.addEventListener("click", inOutOfOrder); // Inform out of order food
  content.append(btnModalLeft, btnModalRight);
  return content;
}
