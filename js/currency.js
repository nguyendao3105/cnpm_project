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
