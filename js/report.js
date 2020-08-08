if (document.readyState == "loading") {
  document.addEventListener("DOMContentLoaded", ready);
} else {
  ready();
}

// Global variables
/*var food = ["Trà sữa truyền thống", "Bạc xỉu đá"];
var quantity = [123, 456];
var price = [19000, 14000];*/

function ready() {
  // extractReport(food,quantity,price);
}

// Extract report's content
/*function extractReport(food,quantity,price) {
  // Ensure the current page is the report page
  if (
    typeof document.getElementById("report-manager") == "undefined" &&
    typeof document.getElementById("report-owner") == "undefined"
  )
    return;

  var tableTbody = document
    .getElementsByTagName("table")[0]
    .getElementsByTagName("tbody")[0];
  for (var i = 0; i < food.length; i++) {
    var row = document.createElement("tr");
    var totalCost = parseFloat(price[i]) * parseFloat(quantity[i]);
    var content = `
      <td>${i + 1}</td>
      <td>${food[i]}</td>
      <td>${quantity[i]}</td>
      <td>${formatMoney.format(totalCost)}</td>`;
    row.innerHTML = content;
    tableTbody.append(row);
  }
  
}*/
//NEW
function addItemReport(total, quantity, food) {
  var tableTbody = document
    .getElementsByTagName("table")[0]
    .getElementsByTagName("tbody")[0];
  for (var i = 0; i < food.length; i++) {
    var row = document.createElement("tr");
    var totalCost = parseFloat(total[i]); //* parseFloat(quantity[i]);
    var content = `
      <td>${i + 1}</td>
      <td>${food[i]}</td>
      <td>${quantity[i]}</td>
      <td>${formatMoney.format(totalCost)}</td>`;
    row.innerHTML = content;
    tableTbody.append(row);
  }
}

//NEWWWWWWWWWWWWWWWW
function strToArr(str) {
  var counter = 0;
  if (checkValid(str)) {
    return _recur_(str, 0);
  } else return "not valid";
}

// Ensure str's format is array
function checkValid(str) {
  var open_bracket = []; // Stack of bracket
  var mark_counter = 0; // Counter of quotation mark
  for (var i = 0; i < str.length; i++) {
    if (str[i] == "[") {
      open_bracket.push(str[i]);
    } else if (str[i] == "]") {
      // Compare bracket character
      if (
        open_bracket.length > 0 ||
        open_bracket[open_bracket.length - 1] == "["
      )
        open_bracket.pop();
      else return false;
    } else if (str[i] == `"`) mark_counter++;
  }
  if (open_bracket.length > 0 || mark_counter % 2 > 0) return false;
  return true;
}

function _recur_(str, index) {
  var return_arr = []; // The final array to return: value array + current index
  // Return: array + traversing index
  var value_flag = false; // Chcek if the character is open quotation mark (qm), the following seciton is value, and then it's a close qm!
  var value_sec = ""; // The variable which contains value
  while (index < str.length) {
    // If meets the square bracket
    if (str[index] == "[") {
      var recur_arr = _recur_(str, index + 1);
      index = recur_arr.pop(); // Get the new index
      return_arr.push(recur_arr); // Push the new array to the return array
      continue;
    } else if (str[index] == "]") {
      return_arr.push(index + 1);
      break;
    }
    // Inside the square brackets -> assign value to the array
    if (str[index] == `"`) {
      if (value_flag) {
        // Then push value to the return array,
        return_arr.push(value_sec);
        value_sec = "";
      }
      value_flag = !value_flag;
    } else {
      // If it's a open quotation mark -> value_flag = true
      if (value_flag) {
        value_sec += str[index]; // Append value
      }
    }
    index++;
  }
  return return_arr;
}
function updateFunction() {
  var selected_vendor = document.getElementById("select_vendor").value;
  var start_day = document.getElementById("start_day").value;
  var end_day = document.getElementById("end_day").value;
  //  alert(selected_vendor);
  //alert(start_day);
  //alert(end_day);
  /*var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML = this.responseText;
      }
      };
      xhttp.open("POST", "report_server.php", true);
      xhttp.send();*/
  var ret1 = (function () {
    var tmp = null;
    $.ajax({
      url: "../php_server/report_server.php",
      type: "POST",
      async: false,
      data: {
        selected_vendor: selected_vendor,
        start_day: start_day,
        end_day: end_day,
      },
      // dataType: 'json',
      success: function (response) {
        // alert(response);
        //alert("wait");
        tmp = response;
      },
      error: function (data) {
        alert("failed");
      },
    });
    return tmp;
  })();
  var ret = strToArr(ret1);
  //alert(ret);
  return ret;
}
