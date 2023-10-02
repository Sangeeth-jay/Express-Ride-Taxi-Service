const menu_toggle = document.querySelector(".menu-toggle");
const sidebar = document.querySelector(".sidebar");

menu_toggle.addEventListener("click", () => {
  menu_toggle.classList.toggle("is-active");
  sidebar.classList.toggle("is-active");
});

// tab transform

$(document).ready(function () {
  $("#tab2").click(function () {
    $(this).addClass("is-active").siblings().removeClass("is-active");
    $(".tab-history").css("visibility", "visible");
    $(".tab-dashboard").css("visibility", "hidden");
    $(".tab-feedbacks").css("visibility", "hidden");
  });
  $("#tab3").click(function () {
    $(this).addClass("is-active").siblings().removeClass("is-active");
    $(".tab-history").css("visibility", "hidden");
    $(".tab-dashboard").css("visibility", "hidden");
    $(".tab-feedbacks").css("visibility", "visible");
  });
  $("#tab1").click(function () {
    $(this).addClass("is-active").siblings().removeClass("is-active");
    $(".tab-history").css("visibility", "hidden");
    $(".tab-dashboard").css("visibility", "visible");
    $(".tab-feedbacks").css("visibility", "hidden");
  });
  $("#book-now").click(function () {
    $(".newBooking-conatiner").css("visibility", "visible");
    $(".opa").css("visibility", "visible");
  });

  // $("#new-booking-done").click(function () {
  //   $(".newBooking-conatiner").css("visibility", "hidden");
  //   $(".opa").css("visibility", "hidden");
  // });
});

function costCal() {
  var distance1 = parseFloat(document.getElementById("distance").value);
  var distance2 = parseFloat(document.getElementById("distance2").value);
  var costPerKm = parseFloat(document.getElementById("vehicleSelect").value); //vehicle cost

  var distance = distance1 + distance2;
  var totalCost = distance * costPerKm;

  document.getElementById("showDistance").innerHTML = distance;
  document.getElementById("showCost").innerHTML = costPerKm;
  document.getElementById("showTot").innerHTML = totalCost;

  document.getElementById("totDistance").value = distance;
  document.getElementById("amount").value = totalCost;

  var selectElement = document.getElementById("vehicleSelect");
  var selectedOption = selectElement.options[selectElement.selectedIndex];
  var selectedText = selectedOption.innerText; //vehicle type
  var selectedVehicleId = selectedOption.getAttribute("data-vehicle-id"); //vehicle id
  var selectedDriverId = selectedOption.getAttribute("data-driver-id"); //driver id

  document.getElementById("vehicleId").value = selectedVehicleId; //set value to hidden inputs
  document.getElementById("driverId").value = selectedDriverId;
}
