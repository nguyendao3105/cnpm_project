function openModal() {
  var check_body_modal = document.getElementById("modal");
  // A. If modal is not existed
  // Create a new modal
  if (!check_body_modal) {
    // 1. Create a modal (id="modal")
    var modal = document.createElement("div");
    modal.setAttribute("id", "modal");
    // 2. Create a background hider + box (includes: header, content, footer) inside the modal
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
    // 3. Set overflow of body to hidden
    var body = document.getElementsByTagName("body")[0];
    body.style.overflow = "hidden";
    // 4. Append to body
    body.append(modal);
  }
  // B. If modal is currently existed:
  // Replace the current modal by the new one
  else {
    var modal = document.createElement("div");
    modal.setAttribute("id", "modal");
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
    // Replace !!
    check_body_modal = modal;
  }
}

// Close modal function
function closeModal() {
  // 1. Body: Remove attribute style
  var body = document.getElementsByTagName("body")[0];
  body.removeAttribute("style");
  // 2. Modal: Remove modal
  var modal = document.getElementById("modal");
  if (modal) modal.parentElement.removeChild(modal); // Remove itself
}

// Press ESC button can closeModal too
$(document).keyup(function (e) {
  if (e.keyCode == 27) {
    closeModal();
  }
});
